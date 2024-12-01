@extends('layout.app')

@section('title', 'Admin Home Page')

@section('content')
    
<h2>Tables</h2>
<p><a href="{{route('table.index')}}">View All Tables</a></p>
<div class="tables-container" style="display: flex; flex-wrap: wrap;">
@foreach ($tables as $table)
    <div class="table-single text-center m-2" style="background-color: lightgrey; max-width: 400px; width: 400px; border-radius: 10px; padding: 10px">
        <h4 class="text-center">{{$table->number}}</h4>
        <img src="{{$table->image_url}}" class="my-2" style="width: 100px; border-radius: 10px"/>
        <p style="font-weight: bold">Capacity: {{$table->capacity}}</p>
        <p style="color: 
        @if ($table->status == 'open' || $table->status == 'Open')
            green 
        @else
            red
        @endif
        ;font-weight: bolder">{{$table->status}}</p>
       
    </div>
@endforeach
</div>

<h2>Events</h2>
<a href="#" class="btn btn-secondary mb-3">Create New Event</a>

<h2>Products, Food, and Drinks</h2>
<a href="#" class="btn btn-secondary mb-3">Create New Product</a>

@endsection
