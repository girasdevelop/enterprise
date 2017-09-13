<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Query\Builder;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\UpdateContract;

use Gate;
use Auth;
use DB;
use App\Manager;
use App\Employee;

class UsersController extends BaseController
{
    public function __construct(UpdateContract $update) {

        $this->update = $update;

        $this->title = "All users";
        $this->description = "All users on the print screen";
        $this->keywords = "all, user";
    }

    // Select all users by using Manager model without restrictions (withoutGlobalScope) for choosing data from table. In manager content selecting dependent employees
    public function index()
    {
        $users = Manager::withoutGlobalScope('stat_man')->paginate(Config::get('app.paginate.items'));
        return view('index',['users'=>$users, 'title'=>$this->title, 'description'=>$this->description, 'keywords'=>$this->keywords]);
    }

    // Select personal information about authorized user
    public function self()
    {
        $id = Auth::user()->id; // id of authorized user
        if(Gate::denies('self_manager')==false) // Checking who is authorized user, using "status" field in AuthServiceProvider. Manager or not
        {
            $user = Manager::find($id); // After checking rights - using Manager model and selecting data for concrete id
        }
        if(Gate::denies('self_employee')==false) // Checking who is authorized user, using "status" field in AuthServiceProvider. Employee or not
        {
            $user = Employee::find($id); // After checking rights - using Employee model and selecting data for concrete id
        }
        if(Gate::denies('self_manager') && Gate::denies('self_employee')) // Checking if authorized user is not like Manager and Employee
        {
            abort(403); // Display error screen about limited rights for working with self data
        }

        return view('self',['user'=>$user, 'title'=>Auth::user()->name, 'description'=>"Update myself"]); // Display view "self" on the screen with data in "user" object
    }

    // Update data in different situations. Updating self data and data of other user when $id is given
    public function update(Request $request)
    {
        if(Gate::denies('self_manager') && Gate::denies('self_employee') && Gate::denies('edit')) // Checking rights for working with: self data and data of other user
        {
            abort(403); // Display error screen about limited rights for updating: self data and data of other user
        }
        return $this->update->update($request);
    }
}
