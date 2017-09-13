<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Query\Builder;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Manager;
use App\Contracts\UpdateManager;

use Gate;

class ManagerController extends BaseController
{
    public function __construct(UpdateManager $update) {

        $this->update = $update;

        $this->title = "Managers";
        $this->description = "Managers on the print screen";
        $this->keywords = "managers";
    }

    // Select just managers
    public function managers()
    {
        $managers = Manager::paginate(Config::get('app.paginate.items')); // Using configuration of quantity items in one page for paginate function and also selecting data
        return view('index',['users'=>$managers, 'title'=>$this->title, 'description'=>$this->description, 'keywords'=>$this->keywords]);
    }

    // Select personal information about one manager
    public function showManager($id)
    {
        if(Gate::denies('show')) // Checking rights for "show" action of authorized user
        {
            abort(403); // Display error screen about limited rights
        }
        $manager = Manager::find($id);
        return view('show',['user'=>$manager, 'title'=>$manager->name, 'description'=>$this->description, 'keywords'=>$this->keywords.', '.$manager->name]);
    }

    // Update Manager data
    public function updateManager(Request $request, $id=NULL)
    {
        if(Gate::denies('edit')) // Checking if authorized user can "edit" data
        {
            abort(403); // Display error screen about limited rights to edit data
        }
        return $this->update->update($request, $id);
    }
}
