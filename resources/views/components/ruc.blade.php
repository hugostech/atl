
@if(!empty($car->ruc))
    @php
    try{
        $odometer = $car->needRuc();
        $p = round($odometer/50);
        $c = 'green';
        if ($p<=10){
            $c = 'red';
        }elseif ($p<=30){
            $c = 'yellow';
        }
    }catch(\Exception $e){
        $odometer = false;
    }
    @endphp
    @if($odometer)
    <div class="clearfix">

        <div class="float-left">
            <strong>{{$p}}%</strong>

        </div>
        <div class="float-right">
            @if(!empty($car->hubemeter_reading))
                <div><span class="small text-muted">(H)</span>{{$car->hubemeter_reading}}/{{$car->ruc}}</div>

            @else
                <div><span class="small text-muted">(O)</span>{{$car->odometer_reading}}/{{$car->ruc}}</div>
            @endif
            <small class="text-muted">{{$odometer}}/5000</small>
        </div>

    </div>
    <div class="progress progress-xs">
        <div class="progress-bar bg-{{$c}}" role="progressbar" style="width: {{$p}}%"
             aria-valuenow="{{$p}}" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    @else
        {{$slot}}
    @endif
@else
    {{$slot}}
@endif