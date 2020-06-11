@if(!empty($car->hours) && !empty($car->service_hours))
    @php
    $service_remain = $car->service_hours - $car->hours;
    $s = (250-$service_remain)/250*100;
    @endphp
    <div class="mx-auto chart-circle chart-circle-xs" data-value="{{$s/100}}" data-thickness="3" data-color="blue">
        <div class="chart-circle-value">{{$s}}%</div>
    </div>
    <div class="mx-auto">
        {{$car->hours}}/{{$car->service_hours}}
    </div>
    <div class="small text-muted">Last Service On</div>
    <div class="small text-muted">{{\Carbon\Carbon::parse($car->last_service_date)->format('d M Y')}}</div>

@else
    {{$slot}}
@endif
