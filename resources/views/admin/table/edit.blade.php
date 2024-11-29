<h1>Edit Table</h1>

<form method="POST" action="/admin/table/{{ $table->id }}">
    @csrf
    @method('PUT')

    <label for="number">Table Number:</label>
    <input type="text" id="number" name="number" value="{{ $table->number }}" required>
    <br />
    <label for="status">Status:</label>
    <select name="status" id="status" required>
        <option value="open">Open</option>
        <option value="closed">Closed</option>
    </select>
    <br />
    <label for="capacity">Capacity:</label>
    <input type="number" id="capacity" name="capacity" value="{{ $table->capacity }}" required>
    <br />
    <button type="submit">Update Table</button>
</form>

<a href="/admin">Back to Table List</a>