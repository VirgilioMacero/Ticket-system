<?php

namespace App\Livewire;

use App\Models\AreaService;
use App\Models\EntityService;
use App\Models\Service;
use Illuminate\Http\Request;
use Livewire\Component;

class EntityServices extends Component
{

    public $areasServices;

    public $areaService;

    public $services;

    public $Service;

    public $Quantity;
    
    public $InsertQuantity;

    public $company;

    public function mount($company){

        $this->Service = '';
        $this->Quantity = '';
        $this->areaService='';
        $this->InsertQuantity = '';
        $this->company = $company;

    }

    public function render()
    {
        $this->areasServices = AreaService::all();

        return view('livewire.entity-services',['areas'=>$this->areasServices]);
    }

    public function updateSelectService(){

        $this->services = Service::where('area_service_id',$this->areaService)->get();

    }

    protected $rules = [

        'Service'=>'required',
        'Quantity'=>'required',
        'areaService'=>'required',
        'InsertQuantity'=>'required_if:Quantity,Apply'
    ];


    public function save(){

        $this->validate();

        $entityService = new EntityService();

        $entityService->entity_id = $this->company->id;

        $entityService->service_id = $this->Service;

        if($this->Quantity != 'N/A'){

            $entityService->quantity = $this->InsertQuantity;

        }

        $entityService->save();

        return redirect()->route('company.showContractedServices',['id'=>$this->company->id]);


    }

}
