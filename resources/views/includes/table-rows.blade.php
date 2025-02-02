<tr>
    @if(!empty($rows))
        @foreach($rows as $row)
            <th>{{$row}}</th>
        @endforeach
    @endif
</tr>
