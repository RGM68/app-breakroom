<h1>Table Details</h1>
<p><strong>Table Number:</strong> {{ $table->number }}</p>
<p><strong>Status:</strong> {{ $table->status }}</p>
<p><strong>Capacity:</strong> {{ $table->capacity }}</p>
Photo: <img src="{{asset($image)}}"  style="width: 100px"/><br />

<a href="/admin">Back to Table List</a>