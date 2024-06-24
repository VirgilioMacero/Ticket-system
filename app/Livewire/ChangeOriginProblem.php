<?php

namespace App\Livewire;

use App\Models\Service;
use App\Models\Ticket;
use Livewire\Component;

class ChangeOriginProblem extends Component
{

    public $ticket;

    public $services;

    public $select;


    public function mount(){

        $this->select  = $this->ticket->service->id ;

    }

    public function render()
    {

        $this->services = Service::all();


        return view('livewire.change-origin-problem' , ['services'=>$this->services]);
    }

    public function updateService(){

        $temp = Ticket::find($this->ticket->id);

         $temp->service()->associate($this->select) ;
         $temp->update();

    }

}
