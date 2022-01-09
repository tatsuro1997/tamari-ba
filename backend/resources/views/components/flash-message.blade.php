@props(['status' => 'info'])

@php
  if(session('status') === 'info'){$bgColor = 'bg-blue-300';}
  if(session('status') === 'alert'){$bgColor = 'bg-red-500';}
@endphp

@if (session('message'))
  <div class="{{ $bgColor }} w-1/2 mx-auto p-2 text-white text-center font-bold">
    {{ session('message') }}
  </div>
@endif
