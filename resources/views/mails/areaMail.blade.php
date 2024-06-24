<x-mail-base>

    <div style="background-color:white; padding: 16px;" class="p-4 bg-white">
        <h1 style="font-weight: 100;font-family:Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';"
            class="font-thin text-lg font-sans">New Ticket from {{ $area }}</h1>
    </div>
    <div style="background-color:white; padding: 16px; border-radius:8px; margin-top:20px;margin-right:20px;margin-left:20px;font-family:Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';" class="mt-4 bg-white rounded-lg p-4 mx-2">

        <div style="width: 100%;text-align: right;">
            <p>Date: {{$date->format('Y-m-d')}}</p>
        </div>

        <p><h2 style="font-weight: 200; margin-bottom: 0px;">N# Ticket:</h2> {{$ticketNumber}}</p> 

        <p style="margin-top:20px;"><h2 style="font-weight: 200;margin-bottom: 0px;">Made By:</h2> {{auth()->user()->name}}</p>

        <p style="margin-top:20px;"><h2 style="font-weight: 200;margin-bottom: 0px;">Company/Entity Name:</h2> {{$entity}}</p>

        <p style="margin-top:20px;"><h2 style="font-weight: 200;margin-bottom: 0px;">Employee Name:</h2> {{$employee}}</p>

        <p style="margin-top:20px;"><h2 style="font-weight: 200;margin-bottom: 0px;">Link:</h2> <a href="{{$link}}">{{$link}}</a></p>

        <h2 style="font-weight: 200;margin-top:20px;margin-bottom: 0px;">Problem:</h2>        
        
        <p style="margin-top:20px;">{{$problem}}</p>
        

    </div>

</x-mail-base>
