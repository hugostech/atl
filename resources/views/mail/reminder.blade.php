<p>Here is a vehicle reminder for <strong>09/08/2018&nbsp;</strong>from<strong>&nbsp;</strong>System</p>

<p>The vehicles need service:</p>

<table style="width: 100%;">
    <tbody>
    <tr>
        <td style="width: 50.0000%;">Plate Number</td>
        <td style="width: 50.0000%;">Comment</td>
    </tr>
    @foreach($service as $plate=>$car)
        <tr>
            <td><a href="{{route('car_edit_by_plate',['plate'=>$plate])}}" class="text-uppercase">{{$plate}}</a></td>
            <td class="text-right">
                @if($car>0)
                    <span class="badge badge-success">Less Than {{$car}}km</span>
                @else
                    <span class="badge badge-danger">Expired ({{$car}}km)</span>
                @endif
            </td>
        </tr>
    @endforeach
    @foreach($service as $row)
    <tr>
        <td style="width: 50.0000%;">CYZ226</td>
        <td style="width: 50.0000%;">Test</td>
    </tr>
    @endforeach
    </tbody>
</table>
<hr>

<p>The vehicles need RUC:</p>