<?php

namespace App\Http\Controllers;

use App\Models\AreaService;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    public function indexServices(int $id)
    {

        $services = Service::with('entity','tickets','entity.tickets')->where('area_service_id',$id)->paginate(10);

        $areas = AreaService::orderBy('name')->get();

        return view('service.index',['services'=>$services,'id'=>$id,'areas'=>$areas]);

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

            'ServiceName'=>'required',
            'ServiceDescription'=>'required',
            'Areaid'=>'required',

        ]);

        $service = new Service();

        $service->name = $request->input('ServiceName');
        $service->description = $request->input('ServiceDescription');
        $service->area_service_id = $request->input('Areaid');

        $service->save();

        return back() ;


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

            'NewServiceName'=>'required',
            'NewServiceDescription'=>'required',

        ]);

        $service = Service::find($id);
        $service->name = $request->input('NewServiceName');
        $service->description = $request->input('NewServiceDescription');

        $service->update();
        return back();

    }

    public function move(Request $request,string $serviceId){

        $request->validate([

            'MoveServiceSelect'=> 'required',

        ]);

        $service = Service::find($serviceId);

        $service->area_service_id = $request->input('MoveServiceSelect');

        $service->update();

        return back() ;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $service = Service::find($id);

        $service->delete();

        return back();

    }
}
