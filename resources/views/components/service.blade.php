@if(!empty($car->odometer_reading) && !empty($car->service))
    @php
    $service_remain = $car->needService();
    $s = $service_remain/100;
    @endphp
    <div class="mx-auto chart-circle chart-circle-xs" data-value="{{$s/100}}" data-thickness="3" data-color="blue">
        <div class="chart-circle-value">{{$s}}%</div>
    </div>
    <div class="mx-auto">
        {{$car->odometer_reading}}/{{$car->service}}
    </div>
    <div class="small text-muted">Last Service On</div>
    <div class="small text-muted">{{\Carbon\Carbon::parse($car->last_service_date)->format('d M Y')}}</div>

@else
    {{$slot}}
@endif