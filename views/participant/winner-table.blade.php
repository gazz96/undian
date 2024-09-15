<div>
    <table class="table">
        <thead>
            <tr>
                <th>NIPP</th>
                <th>NAME</th>
                <th>SUBAREA</th>
            </tr>
        </thead>
        <tbody>
            @foreach($participants as $participant)
            <tr>
                <td>{{$participant->nipp}}</td>
                <td>{{$participant->name}}</td>
                <td>{{$participant->subarea}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>