AAAAAAAAAAAAAA
<a href="/admin/table/create_table">Create New table</a>
<table border="1">
    <tr>
        <th>Number</th>
        <th>Status</th>
        <th>Capacity</th>
        <th>Action</th>
    </tr>
    @foreach($tables as $table)
    <tr>
        <td>{{$table->number}}</td>
        <td>{{$table->status}}</td>
        <td>{{$table->capacity}}</td>
        <td>
            <a href="/admin/table/{{$table->id}}">SHOW</a> |
            <a href="/admin/table/{{$table->id}}/edit">EDIT</a> | 
            <form action="/admin/table/{{$table->id}}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit">DELETE</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
