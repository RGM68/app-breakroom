@extends('layout.app')

@section('title', 'Table #' . $table->number)

@section('content')

<div class="event-container" style="max-width:500px; margin: auto">
    <div class="event-card text-center p-3" style="background-color: lightblue; border-radius: 10px">
        <h1>Table Details</h1>
        <img src="{{asset($image)}}"  style="width: 200px; border-radius: 10px"/><br />
        <p><strong>Table Number:</strong> {{ $table->number }}</p>
        <p><strong>Capacity:</strong> {{ $table->capacity }}</p>
        <p style="color: 
        @if ($table->status == 'open' || $table->status == 'Open')
            green 
        @else
            red
        @endif
        ;font-weight: bolder">{{$table->status}}</p>
        <div>
    </div>
    <a href="/admin" class="btn btn-info my-3">Back to Dashboard</a>
</div>

@endsection