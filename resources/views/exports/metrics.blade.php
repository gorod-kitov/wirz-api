<p>Campaign: {{$campaign}}</p>
<p>Date From: {{$from}}</p>
<p>Date To: &nbsp; {{$to}}</p>
<p>Engagements: {{$engagement}}</p>
<br>

<table>
    <thead>
    <tr>
        <th>Number Description</th>
        <th>Metric Name</th>
        <th>KPI</th>
        <th>Metric Description</th>
        <th>Metric Percent Text</th>
        <th>Metric Percent</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    @foreach($rows as $row)
    <tr>
        <td>{{$row->number_description}}</td>
        <td>{{$row->metric_name}}</td>
        <td>{{$row->kpi}}</td>
        <td>{{$row->description}}</td>
        <td>{{$row->percent_text}}</td>
        <td>{{$row->percent}}</td>
        <td>{{$row->date}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
