<form action="/admin/table/create_table" method="post" enctype="multipart/form-data">
    @csrf
    Number: <input type="text" name="number" value="" required><br />
    Status: <select name="status" id="status" required>
        <option value="open">Open</option>
        <option value="closed">Closed</option>
    </select>
    <br />
    Capacity: <input type="number" name="capacity" value="" required><br />
    Image: <input type="file" name="image" required>
    <button type="submit">Submit</button>
</form>