<form action="/admin/table/create_table" method="post" enctype="multipart/form-data">
    @csrf
    Number: <input type="text" name="number" value=""><br />
    Status: <select name="status" id="status">
        <option value="open">Open</option>
        <option value="closed">Closed</option>
    </select>
    <br />
    <!-- Status: <input type="text" name="nama" value=""><br /> -->
    Capacity: <input type="number" name="capacity" value=""><br />
    <!-- Foto: <input type="file" name="photo"> -->
    <button type="submit">Submit</button>
</form>