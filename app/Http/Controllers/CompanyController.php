<?php

namespace App\Http\Controllers;

use App\Models\AreaService;
use App\Models\Employee;
use App\Models\Entity;
use App\Models\EntityService;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $entities = Entity::orderBy('name','asc')->paginate(20);


        return view('company.index',['entities'=>$entities]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        
        $request->validate([

            'CompanyName'=>'required',
            'CompanyPhone'=>'required',
            'CompanyMail'=>'required|email',
            'CompanyAddress'=>'required',
            
        ]);

        $company = new Entity();

        $company->name = $request->input('CompanyName') ;
        $company->phone = $request->input('CompanyPhone') ;
        $company->mail = $request->input('CompanyMail') ;
        $company->address = $request->input('CompanyAddress') ;
        $company->website = $request->input('CompanyWebPage') ;
        
        $company->save();

        $employee = new Employee();
        $employee->entity_id = $company->id; 


        $employee->name = "ITAdmin - ".$company->name;
        $employee->mail = $company->mail;
        $employee->phone = $company->phone;

        $employee->save();


        
        return redirect()->route('company.index');
        
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
        
        $company = Entity::find($id);

        return view('company.edit',['company'=>$company]);

    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entity $company)
    {
        
        $request->validate([
            
            'CompanyName'=>'required',
            'CompanyPhone'=>'required',
            'CompanyMail'=>'required|email',
            'CompanyAddress'=>'required',
            
        ]);
        
        
        $company->name = $request->input('CompanyName') ;
        $company->phone = $request->input('CompanyPhone') ;
        $company->mail = $request->input('CompanyMail') ;
        $company->address = $request->input('CompanyAddress') ;
        $company->website = $request->input('CompanyWebPage') ;
        
        $company->save();
        
        return redirect()->route('company.index');
        
        
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $company)
    {


        $company = Entity::find($company);

        $employees = Employee::where('entity_id','=',$company->id)->get();

        foreach($employees as $employee){

            $employee->delete();
        }

        if($company){

            $company->services()->detach();

        }

        
        $company->delete();
        
        return redirect()->route('company.index');
    }

    /**
     * Shows the Services Contracted by the Company 
     */

    public function showContractedServices($id){

        $company = Entity::find($id);

        $company->services->load('areaServices');

        $Areas = [] ;

        foreach($company->services as $service){

            if (!in_array($service->areaServices->name , $Areas)) {
                
                $Areas[] = $service->areaServices->name;

            }

        }

        return view('company.show-services',['company'=>$company,'Areas'=>$Areas]);

    }

    public function destroyContractedService($EntityId,$ServiceId){


        $entity = Entity::find($EntityId);

        if($entity){

            $entity->services()->detach($ServiceId);

        }

        return back();

    }

}
