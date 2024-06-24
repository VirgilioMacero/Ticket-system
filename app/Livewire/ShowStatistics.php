<?php

namespace App\Livewire;

use App\Models\AreaService;
use App\Models\Employee;
use App\Models\Entity;
use App\Models\Ticket;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Livewire\Component;
use App\Models\User;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;

class ShowStatistics extends Component
{

    public $Entity;

    public $Employees;

    public $EntityEmployee;

    public $Area;

    public $shownAreas;

    public $TicketsMonth;

    public $TicketsYear;

    public $SelectedMonth;

    public $SelectedYear;

    public $ticketsFiltered;

    public $filteredDates;

    public $filteredAreas;

    public $filteredEntities;

    public $totalTime;

    public function mount()
    {
        $this->Entity = 'ALL';
        $this->TicketsMonth = [];
        $this->TicketsYear = [];
        $this->filteredDates = [];
        $this->filteredAreas = [];
        $this->filteredEntities = [];
        $this->totalTime = 0;
    }

    public function loadSelects()
    {

        $this->cleanSpaces();

        $this->TicketsMonth = [];

        $this->TicketsYear = [];

        $employees = Employee::where('entity_id', $this->Entity)->orderBy('name', 'asc')->get();

        $this->Employees = $employees;

        $tickets = Ticket::where('entity_id', $this->Entity)->get();

        foreach ($tickets as $ticket) {

            $date = $ticket->created_at;

            $dateCarbon = Carbon::parse($date);


            if (!in_array($dateCarbon->month, $this->TicketsMonth)) {

                $this->TicketsMonth[] = $dateCarbon->month;
            }
            if (!in_array($dateCarbon->year, $this->TicketsYear)) {

                $this->TicketsYear[] = $dateCarbon->year;
            }
            continue;
        }
    }

    public function FilterByTime()
    {

        $this->shownAreas = [];

        $query = Ticket::with('status', 'problem', 'service', 'entity', 'user');

        if ($this->Entity != 'ALL' && $this->Entity != null) {

            $query->where('entity_id', $this->Entity);
        }

        if ($this->SelectedMonth != null && $this->SelectedYear == null) {
            $query->whereMonth('created_at', $this->SelectedMonth)->whereYear('created_at', now()->year);
        }

        if ($this->SelectedMonth != null) {
            $query->whereMonth('created_at', $this->SelectedMonth);
        }

        if ($this->SelectedYear != null) {
            $query->whereYear('created_at', $this->SelectedYear);
        }

        if ($this->EntityEmployee != null) {
            $query->where('employee_id', $this->EntityEmployee);
        }

        if ($this->Area != null) {
            $query->whereHas('service', function ($query) {

                $query->whereHas('areaServices', function ($query) {

                    $query->where('id', $this->Area);
                });
            });
        }

        $this->ticketsFiltered = $query->orderBy('title', 'asc')->get();

        $this->filteredAreas = [];
        $this->filteredDates = [];
        $this->filteredEntities = [];


        foreach ($this->ticketsFiltered as $ticket) {

            if (!in_array($ticket->service->areaServices->name, $this->shownAreas)) {
                $this->shownAreas[] = $ticket->service->areaServices->name;
            }

            if(!in_array($ticket->created_at->format('Y-m-d'),$this->filteredDates)){

                $this->filteredDates[] = $ticket->created_at->format('Y-m-d');

            }

            if(!in_array($ticket->service->areaServices->name,$this->filteredAreas)){

                $this->filteredAreas[] = $ticket->service->areaServices->name;

            }
            if(!in_array($ticket->entity->name,$this->filteredEntities)){

                $this->filteredEntities[] = $ticket->entity->name;

            }

        }
    }

    public function cleanSpaces()
    {
        $this->EntityEmployee = null;
        $this->SelectedMonth = null;
        $this->SelectedYear = null;
        $this->EntityEmployee = null;
        $this->Area = null;
    }

    public function render()
    {
        $entities = Entity::with('employees')->orderBy("name", "asc")->get();

        $areas = AreaService::all();

        $formattedTotalTime = 0;

        $ticketMonths = Ticket::selectRaw(' MONTH(created_at) as month')
            ->distinct()
            ->get();
        $ticketYears = Ticket::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->get();



        $this->TicketsYear = $ticketYears->pluck('year');
        $this->TicketsMonth = $ticketMonths->pluck('month');


        if ($this->ticketsFiltered != null) {
            $totalSeconds = 0;

            foreach ($this->ticketsFiltered as $ticket) {
                if ($ticket->status->state === 'CLOSED') {
                    // Calcula la diferencia entre created_at y updated_at en forma de segundos
                    $timeDifference = $ticket->status->updated_at->floatDiffInRealSeconds($ticket->status->created_at);
                    $totalSeconds += $timeDifference;
                }
            }

            // Convierte el tiempo total a horas
            $totalHours = $totalSeconds / 3600; // 3600 segundos en una hora

            // Puedes usar $totalHours directamente o formatearlo según tus necesidades
            $formattedTotalTime = number_format($totalHours, 2) . ' Hours';

        }

        $chart = $this->ShowNumberOfTickets();

        $pieChart = $this->PersentPerArea();

        $chartEntity = $this->PersentPerEntity();

        return view('livewire.show-statistics', compact('entities', 'formattedTotalTime', 'areas', 'chart','pieChart','chartEntity'));
    }

    public function ShowNumberOfTickets(){


        $chart =
        (new ColumnChartModel())
        ->setTitle('Tickets By Date')->withoutLegend();


            foreach($this->filteredDates as $date){

                $formattedDate = Carbon::parse($date)->format('M d');

                $filteredTickets = $this->ticketsFiltered->filter(function ($ticket) use ($date) {
                    return Carbon::parse($ticket->created_at)->format('Y-m-d') == $date;
                });

                $ticketCount = is_numeric($filteredTickets->count()) ? $filteredTickets->count() : 0;

                $chart->addColumn($formattedDate,$ticketCount, $this->randomColor());

            }


        return $chart;

    }

    public function PersentPerArea(){

        $pieChart = null;

        $pieChart = (new pieChartModel());

        foreach($this->filteredAreas as $area){

            $ticketCount = $this->ticketsFiltered->filter(function ($ticket) use ($area) {
                return optional($ticket->service->areaServices)->name == $area;
            })->count();

            $pieChart->addSlice($area, $ticketCount,$this->randomColor());

        }


        return $pieChart;

    }
    public function PersentPerEntity(){

        $pieChart = null;

        $pieChart = (new pieChartModel())->withoutLegend();

        foreach($this->filteredEntities as $entity){

            $ticketCount = $this->ticketsFiltered->filter(function ($ticket) use ($entity) {
                return optional($ticket->entity)->name == $entity;
            })->count();

            $pieChart->addSlice($entity, $ticketCount,$this->randomColor());

        }


        return $pieChart;

    }

    function randomColor() {
        $str = '#';
        for($i = 0 ; $i < 6 ; $i++) {
            $randNum = rand(0 , 15);
            switch ($randNum) {
                case 10: $randNum = 'A'; break;
                case 11: $randNum = 'B'; break;
                case 12: $randNum = 'C'; break;
                case 13: $randNum = 'D'; break;
                case 14: $randNum = 'E'; break;
                case 15: $randNum = 'F'; break;
            }
            $str .= $randNum;
        }
        return $str;
    }

}
