<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Entity;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }    
    public function indexCompany(int $id)
    {

      $employee = Employee::with('tickets')->where('entity_id',$id)->get();

        return view('employee.index',['employee'=>$employee,'id'=>$id]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'EmployeeName'=>'required',
            'EmployeeMail'=>'required|email',
            'EmployeePhone'=>'required',
            'Companyid'=>'required',


        ]);

        $employee = new Employee();
        $employee->name = $request->input('EmployeeName') ;
        $employee->mail = $request->input('EmployeeMail') ;
        $employee->phone = $request->input('EmployeePhone') ;
        $employee->entity_id = $request->input('Companyid') ;

        $employee->save();

        return redirect()->route('employee.indexCompany',['id'=>$request->input('Companyid')]);




    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'NewEmployeeName'=> 'required',
            'NewEmployeeMail'=> 'required|email',
            'NewEmployeePhone'=> 'required',
        ]);

        $employee = Employee::find($id);
    
        $employee->name = $request->input('NewEmployeeName') ;
        $employee->mail = $request->input('NewEmployeeMail') ;
        $employee->phone = $request->input('NewEmployeePhone') ;

        $employee->update();

        return back();
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $employee )
    {
        
        $employeeToDelete = Employee::find($employee);
        
        $employeeToDelete->delete();

        return back();

    }
}
