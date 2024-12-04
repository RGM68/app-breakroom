@extends('admin.layout.app')


@section('title', 'Admin Products Page')

@section('content')
<h2>Products</h2>
<a href="/admin/product/create_product" class="btn btn-secondary mb-3">Create New Product</a>
<p><a href="{{route('admin.index')}}">Back to Dashboard</a></p>
<div class="all-products-container mb-3" 
    style="display: flex; flex-wrap: wrap; justify-content: center; margin: auto;">
@foreach ($products as $product)
    <div class="product-single text-center m-2" style="background-color: #79e374; max-width: 400px; width: 400px; min-height: 300px; border-radius: 10px; padding: 10px;">
        <h4 class="text-center">{{$product->name}}</h4>
        <img src="{{$product->image_url}}" class="my-2" style="width: 250px; border-radius: 10px"/>
        <p>{{$product->description}}</p>
        <p style="font-size: 30px; font-weight: bold">Rp. {{$product->price}}</p>
        <p style="color: 
        @if ($product->status == 'available' || $product->status == 'Available')
            green 
        @elseif ($product->status == 'unavailable' || $product->status == 'Unavailable')
            red
        @endif
        ;font-weight: bolder">{{$product->status}}</p>
        <hr />
        <form action="{{ route('product.updateStatus', $product->id) }}" method="POST" class="my-2">
            @csrf
            @method('PUT') 
            <label for="status-{{$product->id}}" class="form-label">Status:</label>
            <select id="status-{{$product->id}}" name="status" class="form-select w-50" style="margin: auto" onchange="this.form.submit()">
                <option value="Available" @selected($product->status == 'available' || $product->status == 'Available')>Available</option>
                <option value="Unavailable" @selected($product->status == 'unavailable' || $product->status == 'Unavailable')>Unavailable</option>
            </select>
        </form>
        <div>
            <a href="/admin/product/{{$product->id}}" class="btn btn-primary me-1">View Details</a>
            <a href="/admin/product/{{$product->id}}/edit" class="btn btn-warning">Edit Product</a>
            <a href="/admin/product/{{$product->id}}/change_image" class="btn btn-success">Change Image</a>
            <form action="/admin/product/{{$product->id}}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger mt-2" onclick="return confirm('Delete?')">Delete Product</button>
            </form>
        </div>
    </div>
@endforeach
</div>
@endsection