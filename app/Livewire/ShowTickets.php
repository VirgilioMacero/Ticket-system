<?php

namespace App\Livewire;

use App\Models\AreaService;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use phpDocumentor\Reflection\Types\This;

class ShowTickets extends Component
{

    use WithPagination;

    public $ticket;

    public $value;

    public $workArea;

    public $state = 'OPEN';

    public $searchType;
    public $sortBy = "created_at";
    public $direction = 'asc';

    public function mount()
    {

        $this->workArea = null;

        $this->searchType = 'Title';
    }


    public function render()
    {

        $workingArea = AreaService::find($this->workArea);

        $tickets = "";

        if ($this->workArea == null) {

            $tickets = Ticket::with(['status', 'entity', 'problem', 'service'])
                ->whereHas('status', function ($query) {
                    $query->where('state', $this->state);
                })
                ->where(function ($querty) {

                    $querty->whereHas('problem', function ($querty) {

                        $querty->where('description', 'like', '%' . $this->ticket . '%')

                            ->orWhere('solution', 'like', '%' . $this->ticket . '%');
                    })
                        ->orWhereHas('entity', function ($query) {

                            $query->where('name', 'like', '%' . $this->ticket . '%')

                                ->orWhere('title', 'like', '%' . $this->ticket . '%');
                        });
                });

            if ($this->sortBy == 'created_at') {

                $tickets->orderBy('created_at', $this->direction);
            } elseif ($this->sortBy == 'title') {

                $tickets->orderBy('title', $this->direction);
            } elseif ($this->sortBy == 'updated_at') {

                $tickets->orderBy('updated_at', $this->direction);
            } elseif ($this->sortBy == 'entity') {
                $tickets->orderBy(function ($query) {

                    $query->select('name')
                        ->from('entity')
                        ->whereColumn('entity.id', 'tickets.entity_id')
                        ->orderBy('name', $this->direction);
                }, $this->direction);
            } elseif ($this->sortBy == 'employee') {

                $tickets->orderBy(function ($query) {

                    $query->select('name')
                        ->from('employee')
                        ->whereColumn('employee.id', 'tickets.employee_id')
                        ->orderBy('name', $this->direction);
                }, $this->direction);
            } elseif ($this->sortBy == 'area') {

                $tickets->whereHas('service', function ($query) {

                    $query->orderBy(function ($query) {
                        $query->select('name')
                            ->from('area_services')
                            ->whereColumn('area_services.id', 'services.area_service_id')
                            ->orderBy('name', $this->direction);
                    }, $this->direction);
                });
            }

            if ($this->state == 'CLOSED') {

                $tickets = $tickets->paginate(40);
            } else {

                $tickets = $tickets->paginate(20);
            }
        } else {

            $tickets = Ticket::with(['status', 'entity', 'problem', 'service'])
                ->whereHas('status', function ($query) {
                    $query->where('state', $this->state);
                })
                ->where(function ($querty) {

                    $querty->whereHas('problem', function ($querty) {

                        $querty->where('description', 'like', '%' . $this->ticket . '%')

                            ->orWhere('solution', 'like', '%' . $this->ticket . '%');
                    })
                        ->orWhereHas('entity', function ($query) {

                            $query->where('name', 'like', '%' . $this->ticket . '%')

                                ->orWhere('title', 'like', '%' . $this->ticket . '%');
                        });
                })
                ->whereHas('service', function ($query) {

                    $query->whereHas('areaServices', function ($query) {

                        $query->where('id', $this->workArea);
                    });
                });

            if ($this->sortBy == 'created_at') {

                $tickets->orderBy('created_at', $this->direction);
            } elseif ($this->sortBy == 'title') {

                $tickets->orderBy('title', $this->direction);
            } elseif ($this->sortBy == 'updated_at') {

                $tickets->orderBy('updated_at', $this->direction);
            } elseif ($this->sortBy == 'entity') {
                $tickets->orderBy(function ($query) {

                    $query->select('name')
                        ->from('entity')
                        ->whereColumn('entity.id', 'tickets.entity_id')
                        ->orderBy('name', $this->direction);
                }, $this->direction);
            } elseif ($this->sortBy == 'employee') {

                $tickets->orderBy(function ($query) {

                    $query->select('name')
                        ->from('employee')
                        ->whereColumn('employee.id', 'tickets.employee_id')
                        ->orderBy('name', $this->direction);
                }, $this->direction);
            } elseif ($this->sortBy == 'area') {

                $tickets->whereHas('service', function ($query) {

                    $query->orderBy(function ($query) {
                        $query->select('name')
                            ->from('area_services')
                            ->whereColumn('area_services.id', 'services.area_service_id')
                            ->orderBy('name', $this->direction);
                    }, $this->direction);
                });
            }
            if ($this->state == 'CLOSED') {
                $tickets = $tickets->paginate(40);
            } else {

                $tickets = $tickets->paginate(20);
            }
        }


        return view('livewire.show-tickets', ['tickets' => $tickets, 'workingArea' => $workingArea]);
    }


    public function order($sortBy)
    {
        if ($this->sortBy == $sortBy) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->direction = 'asc';
            $this->sortBy = $sortBy;
        }
    }


    public function setOpen()
    {

        $this->state = "OPEN";
        $this->resetPage();
    }
    public function setInProgress()
    {

        $this->state = "IN PROGRESS";
        $this->resetPage();
    }

    public function setClosed()
    {

        $this->state = "CLOSED";
        $this->resetPage();
    }
    public function search()
    {

        $this->ticket = $this->value;
    }
    public function setMyArea()
    {

        $this->workArea = auth()->user()->area_service_id;
    }
    public function setAllAreas()
    {

        $this->workArea = null;
    }
}
