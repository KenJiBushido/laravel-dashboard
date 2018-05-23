<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Try...</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th rowspan="2">ID</th>
                <th rowspan="2">Name</th>
                <th colspan="4"><center>Subject</center></th>
                <th rowspan="2">Score</th>
            </tr>
            <tr>
                <th>Math</th>
                <th>Sci</th>
                <th>Eng</th>
                <th>Art</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
                <tr>
                    <td>{{ $d->id }}</td>
                    <td>{{ $d->student->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>