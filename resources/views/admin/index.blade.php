@extends('admin.layout.app')

@section('title', 'Admin Home Page')

@section(section: 'content')
    
<h2>Tables</h2>
<p><a href="{{route('admin.table.index')}}">View All Tables</a></p>
<div class="tables-container" style="display: flex; flex-wrap: wrap; justify-content: center; margin: auto;;">
@foreach ($tables as $table)
    <div class="table-single text-center m-2" style="background-color: lightgrey; max-width: 400px; width: 400px; border-radius: 10px; padding: 10px">
        <h4 class="text-center">{{$table->number}}</h4>
        <img src="{{$table->image_url}}" class="my-2" style="width: 100px; border-radius: 10px"/>
        <p><b>Rp. {{$table->price}}</b>/hr</p>
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
<p><a href="{{route('admin.event.adminIndex')}}">View All Events</a></p>
<div class="events-container" 
    style="display: flex; flex-wrap: wrap; justify-content: center; margin: auto;">
@foreach ($events as $event)
    <div class="event-single text-center m-2" style="background-color: #d9abd1; max-width: 600px; width: 600px; min-height: 400px; border-radius: 10px; padding: 10px;">
        <h4 class="text-center">{{$event->name}}</h4>
        <img src="{{$event->image_url}}" class="my-2" style="width: 250px; border-radius: 10px"/>
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
@endforeach
</div>

<h2>Products</h2>
<p><a href="{{route('admin.product.adminIndex')}}">View All Products</a></p>
<div class="products-container" 
    style="display: flex; flex-wrap: wrap; justify-content: center; margin: auto;">
@foreach ($products as $product)
    <div class="product-single text-center m-2" style="background-color: #79e374; max-width: 400px; width: 400px; min-height: 300px; border-radius: 10px; padding: 10px;">
        <h4 class="text-center">{{$product->name}}</h4>
        <img src="{{$product->image_url}}" class="my-2" style="width: 250px; border-radius: 10px"/>
        <p style="font-size: 30px; font-weight: bold">Rp. {{$product->price}}</p>
        <p style="color: 
        @if ($product->status == 'available' || $product->status == 'Available')
            green 
        @elseif ($product->status == 'unavailable' || $product->status == 'Unavailable')
            red
        @endif
        ;font-weight: bolder">{{$product->status}}</p>
    </div>
@endforeach
</div>

<h2>Food and Drinks</h2>
<p><a href="{{route('admin.food.adminIndex')}}">View All Foods</a></p>
<div class="foods-container" 
    style="display: flex; flex-wrap: wrap; justify-content: center; margin: auto;">
@foreach ($foods as $food)
    <div class="food-single text-center m-2" style="background-color: #e07b70; max-width: 400px; width: 400px; min-height: 300px; border-radius: 10px; padding: 10px;">
        <h4 class="text-center">{{$food->name}}</h4>
        <img src="{{$food->image_url}}" class="my-2" style="width: 250px; border-radius: 10px"/>
        <p style="font-size: 28px; font-weight: bold">Rp. {{$food->price}}</p>
        <p style="font-size: 18px; font-weight: bold">{{$food->category}}</p>
        <p style="color: 
        @if ($food->status == 'available' || $food->status == 'Available')
            green 
        @elseif ($food->status == 'unavailable' || $food->status == 'Unavailable')
            red
        @endif
        ;font-weight: bolder">{{$food->status}}</p>
    </div>
@endforeach
</div>
@endsection
