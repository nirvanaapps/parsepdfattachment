<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parse Pdf</title>
</head>

<body>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>From</th>
                <th>Subject</th>
                <th>Select</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mails as $m)
            <tr>
                <td>{{$m->getDate()}}</td>
                <td>{{$m->getFrom()[0]->mail}}</td>
                <td>{{$m->getSubject()}}</td>
                <td>
                    <form action="{{route('pdfparse')}}" method="post">
                        @csrf
                        <input type="hidden" name="uid" value="{{$m->getUid()}}">
                        <button type="submit">Select</a>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
