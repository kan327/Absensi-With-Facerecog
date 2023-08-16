<table>
    <tr>
        <th></th> <!-- Empty cell at the top-left corner -->
        @foreach ($dataArray as $value)
            <th>{{ $value }}</th>
        @endforeach
    </tr>
    @foreach ($names as $name)
        <tr>
            <td>{{ $name }}</td> <!-- Left column with names -->
            @foreach ($dataArray as $day)
                <td>
                    @if (($monthNumber === 2 && $year % 4 === 0 && ($year % 100 !== 0 || $year % 400 === 0)) && $day === 29)
                        29
                    @elseif ($monthNumber === 2 && $day > 28)
                        <!-- Handle February in non-leap years -->
                    @else
                        <!-- Your content for other months -->
                    @endif
                </td>
            @endforeach
        </tr>
    @endforeach
</table>
