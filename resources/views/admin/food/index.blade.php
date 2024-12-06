@extends('admin.layout.app')


@section('title', 'Admin Foods Page')

@section('content')
<h2>Foods</h2>
<a href="/admin/food/create_food" class="btn btn-secondary mb-3">Create New food</a>
<p><a href="{{route(name: 'admin.index')}}">Back to Dashboard</a></p>
@foreach ($categories as $categoryName => $foods)
    <h3 style="font-style: italic">{{ $categoryName }}</h3>
    <div class="all-foods-container mb-3" 
        style="display: flex; flex-wrap: wrap; justify-content: center; margin: auto;">
    @foreach ($foods as $food)
        <div class="food-single text-center m-2" style="background-color: #d18f88; max-width: 400px; width: 400px; min-height: 300px; border-radius: 10px; padding: 10px;">
            <h4 class="text-center">{{$food->name}}</h4>
            <img src="{{$food->image_url}}" class="my-2" style="width: 150px; border-radius: 10px"/>
            <p>{{$food->description}}</p>
            <p style="font-size: 30px; font-weight: bold">Rp. {{$food->price}}</p>
            <p style="color: 
            @if ($food->status == 'available' || $food->status == 'Available')
                green 
            @elseif ($food->status == 'unavailable' || $food->status == 'Unavailable')
                red
            @endif
            ;font-weight: bolder">{{$food->status}}</p>
            <hr />
            <form action="{{ route('food.updateStatus', $food->id) }}" method="POST" class="my-2">
                @csrf
                @method('PUT') 
                <label for="status-{{$food->id}}" class="form-label">Status:</label>
                <select id="status-{{$food->id}}" name="status" class="form-select w-50" style="margin: auto" onchange="this.form.submit()">
                    <option value="Available" @selected($food->status == 'available' || $food->status == 'Available')>Available</option>
                    <option value="Unavailable" @selected($food->status == 'unavailable' || $food->status == 'Unavailable')>Unavailable</option>
                </select>
            </form>
            <div>
                <a href="/admin/food/{{$food->id}}" class="btn btn-primary me-1">View Details</a>
                <a href="/admin/food/{{$food->id}}/edit" class="btn btn-warning">Edit Food</a>
                <a href="/admin/food/{{$food->id}}/change_image" class="btn btn-success">Change Image</a>
                <form action="/admin/food/{{$food->id}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger mt-2" onclick="return confirm('Delete?')">Delete Food</button>
                </form>
            </div>
        </div>
    @endforeach
    </div>
    <hr />
@endforeach
@endsection