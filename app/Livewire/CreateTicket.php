<?php

namespace App\Livewire;

use App\Models\Employee;
use App\Models\Entity;
use App\Models\Problem;
use App\Models\Service;
use App\Models\Status;
use App\Models\Ticket;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Mail\Notification;
use App\Models\AreaService;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class CreateTicket extends Component
{
    
    public $entitys;

    public $contractedServices;

    public $companyEmployees;

    public $entity;

    public $service;

    public $employee;

    public $type;

    public $newEntityName;

    public $newEntityphone;

    public $newEntitymail;

    public $titleTicket;

    public $descriptionTicket;

    public function mount(){

        $this->entity ='';
        $this->service ='';
        $this->employee='';
        $this->type='';
        $this->newEntityName='';
        $this->newEntityphone='';
        $this->newEntitymail='';
        $this->titleTicket='';
        $this->descriptionTicket='';
    }

    public function loadSelects(){
        

        $services = Service::orderBy('name','asc')->get();

        if($this->entity != 'Walk-In Company'){

                    $entity = Entity::find($this->entity);

            
                    $this->contractedServices = $services;
            
                    $this->companyEmployees = $entity->employees;

        }
        else{

            $this->contractedServices = $services;

            
            $this->companyEmployees = new Collection();

            

        }

    }

    protected $rules = [

        'entity'=>'required',
        'service'=>'required',
        'employee'=>'required',
        'type'=>'required',
        'newEntityName'=>'required_if:entity,Walk-In Company',
        'newEntityphone'=>'required_if:entity,Walk-In Company',
        'titleTicket'=>'required',
        'descriptionTicket'=>'required',

    ];

    public function save(){

        $this->validate();
        
        $ticket = new Ticket();
        $ticket->title = $this->titleTicket;
        $ticket->type = $this->type;
        $ticket->user_id = auth()->user()->id;

        if($this->entity == "Walk-In Company"){

            $newEntity = new Entity();

            $newEntity->name = $this->newEntityName;
            if($this->newEntitymail != ''){
                $newEntity->mail = $this->newEntitymail;
            }
            else{

                $newEntity->mail = 'N/A';

            }
            $newEntity->phone = $this->newEntityphone;
            $newEntity->address = "NSS Office";

            $newEntity->save();

            $newEmployee = new Employee();
            $newEmployee->entity_id = $newEntity->id;

            $newEmployee->name = 'ITAdmin - '.$newEntity->name;
            $newEmployee->mail = $newEntity->mail;
            $newEmployee->phone = $newEntity->phone;

            $newEmployee->save();
            
            $ticket->employee_id = $newEmployee->id;

            $ticket->entity_id = $newEntity->id;


        }
        else{

            $ticket->entity_id = $this->entity;
            $ticket->employee_id = $this->employee;
        }


        $ticket->service_id = $this->service;
        
        $ticket->save();
        
        $problem = new Problem();

        $problem->description = $this->descriptionTicket;

        $problem->ticket_id = $ticket->id;

        $problem->save();

        $status = new Status();

        $status->state = "OPEN";

        $status->ticket_id = $ticket->id;

        $status->save();

        $serviceTem = Service::find($this->service);

        $areaServiceTemp = AreaService::find( $serviceTem->areaServices->id);

        $entityTem = Entity::find($ticket->entity_id); 

        $employeeTemp = Employee::find($ticket->employee_id);

        if($areaServiceTemp->mail != null){

            $SendMail = Mail::to($areaServiceTemp->mail)->queue(new Notification('New Ticket',$ticket->title,$serviceTem->areaServices->name,$ticket->created_at,$ticket->id,$entityTem->name,$employeeTemp->name,route('ticket.show',['ticket'=>$ticket->id]),$problem->description));


        }
        else{            
            $allUsers = User::all();
    
            foreach($allUsers as $user) {
    
                if($user->area_service_id == $serviceTem->areaServices->id){
                    
                    $SendMail = Mail::to($user->email)->queue(new Notification('New Ticket',$ticket->title,$serviceTem->areaServices->name,$ticket->created_at,$ticket->id,$entityTem->name,$employeeTemp->name,route('ticket.show',['ticket'=>$ticket->id]),$problem->description));
                }
    
    
            }
        }




        return redirect()->route('ticket.index');        

    }
    
    public function render()
    {
     
        $this->entitys = Entity::orderBy('name','asc')->get();

        return view('livewire.create-ticket',['entitys'=>$this->entitys]);
    
    }





}
