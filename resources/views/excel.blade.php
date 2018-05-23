<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($members as $m)
        <tr>
            <td><a href="www.workmotioncreative.com/{{ $m->name }}"></a> www.workmotioncreative.com/{{ $m->name }}</td>
            <td>{{ $m->email }}</td>
        </tr>
    @endforeach
    </tbody>
</table>