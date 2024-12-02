@extends('admin.layout.app')


@section('title', 'Event ' . $event->name)

@section('content')
<div class="event-container mb-3" style="max-width:500px; margin: auto">
    <div class="event-card text-center p-3" style="background-color: #c29ded; border-radius: 10px">
        <h1>Event Details</h1>
        <h4 class="text-center">{{$event->name}}</h4>
        <img src="{{asset($image)}}" class="my-2" style="width: 250px; height: 250px; border-radius: 10px"/>
        <p style="">{{$event->description}}</p>
        <p style="">{{$event->location}}</p>
        <p style="font-weight: bold">{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }} {{ \Carbon\Carbon::parse($event->time)->format('H:i') }}</p>
        <p style="font-weight: bold">Max Participants: {{$event->max_participants}}</p>
        <p style="color: 
        @if ($event->status == 'open' || $event->status == 'Open')
            green 
        @elseif ($event->status == 'ongoing' || $event->status == 'Ongoing')
            #e06900
        @else
            red
        @endif
        ;font-weight: bolder">{{$event->status}}</p>
    </div>
    <a href="/admin/events" class="btn btn-info mt-3">Back to Event List</a>
</div>
@endsection