@props(['link'=>''])

<a href="{{$link}}" {{$attributes->merge(['class'=>'group bg-yellow-500 text-white  hover:text-black hover:cursor-pointer hover:bg-yellow-400 rounded-md p-2 my-2 flex flex-row gap-2'])}}>
    
      <svg class="w-4 h-4 text-white group-hover:text-black self-center" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
      </svg>

    <p class="self-center">{{$slot}}</p>

</a>