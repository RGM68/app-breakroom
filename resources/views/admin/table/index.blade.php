@extends('admin.layout.app')


@section('title', 'Admin Tables Page')

@section('content')
    
<h2>Tables</h2>
<a href="/admin/table/create_table" class="btn btn-secondary mb-3">Create New table</a>
<p><a href="{{route('admin.index')}}">Back to Dashboard</a></p>
<div class="all-tables-container" style="display: flex; flex-wrap: wrap;">
@foreach ($tables as $table)
    <div class="table-single text-center m-2" style="background-color: lightgrey; max-width: 400px; width: 400px; border-radius: 10px; padding: 10px">
        <h4 class="text-center">{{$table->number}}</h4>
        <img src="{{$table->image_url}}" class="my-2" style="width: 100px; border-radius: 10px"/>
        <p style="font-weight: bold">Capacity: {{$table->capacity}}</p>
        <p><b>Rp. {{$table->price}}</b>/hr</p>
        <form action="{{ route('table.updateStatus', $table->id) }}" method="POST" class="my-2">
            @csrf
            @method('PUT') 
            <label for="status-{{$table->id}}" class="form-label">Status:</label>
            <select id="status-{{$table->id}}" name="status" class="form-select w-50" style="margin: auto" onchange="this.form.submit()">
                <option value="Open" @selected($table->status == 'open' || $table->status == 'Open')>Open</option>
                <option value="Closed" @selected($table->status == 'closed' || $table->status == 'Closed')>Closed</option>
            </select>
        </form>
        <div>
            <a href="/admin/table/{{$table->id}}" class="btn btn-primary me-1">View Details</a>
            <a href="/admin/table/{{$table->id}}/edit" class="btn btn-warning">Edit Table</a>
            <a href="/admin/table/{{$table->id}}/change_image" class="btn btn-success">Change Image</a>
            <form action="/admin/table/{{$table->id}}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger mt-2" onclick="return confirm('Delete?')">Delete Table</button>
            </form>
        </div>
    </div>
@endforeach
</div>

@endsection
