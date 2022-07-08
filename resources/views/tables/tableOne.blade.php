<?php 
    $count = 1;
    $total = 0;
?>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
                        
    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
                        
    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>

<table>
    <tr>
        <th>A</th>
        <th>B</th>
        <th>C</th>
        <th>D</th>
        <th>E</th>
        <td>Soma</td>
    </tr>
    @for ($i = 0; $i < 76; $i++)
        <tr>
            @for ($j = 0; $j < 5; $j++)
                @if (($count % 2) == 0)
                    <td style="color:red;"> {{ $count++ }} </td>
                @else
                    <td> {{ $count++ }} </td>
                @endif
                <?php $total = $total + $count?>
            @endfor
            <?php $total = $total - 5 ?>
            <td>{{ $total }}</td>
            <?php $total = 0 ?>
        </tr>
    @endfor
</table>