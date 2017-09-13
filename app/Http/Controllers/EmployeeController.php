<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Query\Builder;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Employee;
use App\Contracts\UpdateEmployee;

use Gate;

class EmployeeController extends BaseController
{
    public function __construct(UpdateEmployee $update) {

        $this->update = $update;

        $this->title = "Employees";
        $this->description = "Employees on the print screen";
        $this->keywords = "employees";
    }

    // Select just employees
    public function employees()
    {
        $employees = Employee::paginate(Config::get('app.paginate.items')); // Using configuration of quantity items in one page for paginate function and also selecting data
        return view('index',['users'=>$employees, 'title'=>$this->title, 'description'=>$this->description, 'keywords'=>$this->keywords]);
    }

    // Select personal information about one employee
    public function showEmployee($id)
    {
        $employee = Employee::find($id);
        return view('show',['user'=>$employee, 'title'=>$employee->name, 'description'=>$this->description, 'keywords'=>$this->keywords.', '.$employee->name]);
    }

    // Update Employee data
    public function updateEmployee(Request $request, $id=NULL)
    {
        if(Gate::denies('edit')) // Checking if authorized user can "edit" data
        {
            abort(403); // Display error screen about limited rights to edit data
        }
        return $this->update->update($request, $id);
    }
}
