<?php

namespace App\Http\Controllers;

use App\Models\AreaService;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class AreaServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $areaService = AreaService::with('services','users')->orderBy('name','asc')->paginate(10);

        return view('area_service.index',['AreaService'=>$areaService]);
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

            'addAreaName'=>'required|unique:area_services,name,NULL,id,name,' . strtolower($request->addAreaName),
            'addAreaMail'=>'required|email'

        ]);

        $areaService = new AreaService();

        $areaService->name = $request->input('addAreaName');
        $areaService->mail = $request->input('addAreaMail');

        $areaService->save();

        return redirect()->route('area_service.index');

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


            'EditAreaName' => [
                'required',
                'unique:area_services,name,' . $id . ',id',
                function ($attribute, $value, $fail) use ($id) {
                    // Verifica si existe otra área con el mismo nombre
                    $existingArea = AreaService::where('name', $value)->where('id', '<>', $id)->first();
                    if ($existingArea) {
                        $fail('The name is already in use by another area.');
                    }
                },
            ],
            'EditAreaMail'=>'required|email',
        ]);

        $area = AreaService::find($id);

        $area->name = $request->input('EditAreaName');
        $area->mail = $request->input('EditAreaMail');

        $area->update();

        return back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $areaService = AreaService::find($id);
     

        $services = Service::where('area_service_id',$id)->get();
        

            foreach($services as $service){
    
                $service->delete();
    
            }

         

        $areaService->delete();

        return back();

    }
}
