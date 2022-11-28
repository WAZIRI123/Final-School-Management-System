<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>

<h1>Student Result</h1>

<table id="customers">
    @if ($semester1_result->count())
    <tr> <td>semester 1 Result</td></tr>
  <tr>
    <th>Subjects</th>
    <th>Marks</th>
    <th>Remark</th>
  </tr>
  @foreach ($semester1_result as $result)
  <tr class="hover:bg-blue-300 {{ ($loop->even ) ? " bg-blue-100" : "" }}">
    <td class="px-3 py-2 capitalize">{{ $result->subjects?->name }}</td>
    <td class="px-3 py-2 capitalize">{{ $result->marks }}</td>
    @switch($result->marks)
    @case($result->marks>=80)
    <td class="px-3 py-2 capitalize">Excellence</td>
        @break

        @case($result->marks>=70 && $result->marks<80 )
        <td class="px-3 py-2 capitalize">Very Good</td>
        @break

        @case($result->marks>=60 && $result->marks<70 )
        <td class="px-3 py-2 capitalize">Good</td>
        @break

        @case($result->marks>=50 && $result->marks<60 )
        <td class="px-3 py-2 capitalize">Credit</td>
        @break

        @case($result->marks>=30 && $result->marks<50 )
        <td class="px-3 py-2 capitalize">Average</td>
        @break

        @case($result->marks<30 )
        <td class="px-3 py-2 capitalize">Fail</td>
        @break

    @default                               
@endswitch
</tr>
@endforeach
<td>Total Marks:{{ $semester1_result->count()*100 }}  Acquired: {{ $semester1_result->sum('marks') }}</td>

</table>
@endif

@if (count($semester2_result))
<table id="customers">
    <tr> <td>semester 2 Result</td></tr>
<tr>
    <th>Subjects</th>
    <th>Marks</th>
    <th>Remark</th>
  </tr>
  @foreach ($semester2_result as $result)
  <tr class="hover:bg-blue-300 {{ ($loop->even ) ? " bg-blue-100" : "" }}">
    <td class="px-3 py-2 capitalize">{{ $result->subjects?->name }}</td>
    <td class="px-3 py-2 capitalize">{{ $result->marks }}</td>
    @switch($result->marks)
    @case($result->marks>=80)
    <td class="px-3 py-2 capitalize">Excellence</td>
        @break

        @case($result->marks>=70 && $result->marks<80 )
        <td class="px-3 py-2 capitalize">Very Good</td>
        @break

        @case($result->marks>=60 && $result->marks<70 )
        <td class="px-3 py-2 capitalize">Good</td>
        @break

        @case($result->marks>=50 && $result->marks<60 )
        <td class="px-3 py-2 capitalize">Credit</td>
        @break

        @case($result->marks>=30 && $result->marks<50 )
        <td class="px-3 py-2 capitalize">Average</td>
        @break

        @case($result->marks<30 )
        <td class="px-3 py-2 capitalize">Fail</td>
        @break

    @default                               
@endswitch
</tr>
@endforeach
<td>Total Marks:{{ $semester2_result->count()*100 }}  Acquired: {{ $semester1_result->sum('marks') }}</td>

</table>
@endif

</body>
</html>
</div>
