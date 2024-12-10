@extends('admin.layout.app')


@section('title', 'Admin Tables Page')

@section('content')
<h2>Events</h2>
<a href="/admin/event/create_event" class="btn btn-secondary mb-3">Create New Event</a>
<p><a href="{{route('admin.index')}}">Back to Dashboard</a></p>
<div class="all-events-container mb-3" 
    style="display: flex; flex-wrap: wrap; justify-content: center; margin: auto;">
@foreach ($events as $event)
    <div class="event-single text-center m-2" style="background-color: #d9abd1; max-width: 600px; width: 600px; border-radius: 10px; padding: 10px;">
        <h4 class="text-center">{{$event->name}}</h4>
        <img src="{{$event->image_url}}" class="my-2" style="width: 250px; height: fit-content; border-radius: 10px"/>
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
        <hr />
        <form action="{{ route('admin.event.updateStatus', $event->id) }}" method="POST" class="my-2">
            @csrf
            @method('PUT') 
            <label for="status-{{$event->id}}" class="form-label">Status:</label>
            <select id="status-{{$event->id}}" name="status" class="form-select w-50" style="margin: auto" onchange="this.form.submit()">
                <option value="Open" @selected($event->status == 'open' || $event->status == 'Open')>Open</option>
                <option value="Ongoing" @selected($event->status == 'ongoing' || $event->status == 'Ongoing')>Ongoing</option>
                <option value="Closed" @selected($event->status == 'closed' || $event->status == 'Closed')>Closed</option>
            </select>
        </form>
        <div>
            <a href="/admin/event/{{$event->id}}" class="btn btn-primary me-1">View Details</a>
            <a href="/admin/event/{{$event->id}}/edit" class="btn btn-warning">Edit Event</a>
            <a href="/admin/event/{{$event->id}}/change_image" class="btn btn-success">Change Image</a>
            <form action="/admin/event/{{$event->id}}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger mt-2" onclick="return confirm('Delete?')">Delete Event</button>
            </form>
        </div>
    </div>
@endforeach
</div>
@endsection