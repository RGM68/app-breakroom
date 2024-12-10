@extends('admin.layout.app')

@section('title', 'Book a Table')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Available Tables</h2>
    
    <div class="tables-container" style="display: flex; flex-wrap: wrap; justify-content: center; margin: auto;">
        @foreach ($tables as $table)
            <div class="table-single text-center m-2" style="background-color: lightgrey; max-width: 400px; width: 400px; border-radius: 10px; padding: 10px">
                <h4 class="text-center">Table {{$table->number}}</h4>
                <img src="{{$table->image_url}}" class="my-2" style="width: 100px; border-radius: 10px"/>
                <p><b>Rp. {{$table->price}}</b>/hr</p>
                <p style="font-weight: bold">Capacity: {{$table->capacity}}</p>
                <p style="color: {{ $table->status == 'Open' ? 'green' : 'red' }}; font-weight: bolder">
                    {{$table->status}}
                </p>
                @if($table->status == 'Open')
                    <form action="{{ route('table-bookings.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="table_id" value="{{ $table->id }}">
                        <button type="submit" class="btn btn-primary">Book Now</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection