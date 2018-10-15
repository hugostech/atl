@extends('layouts.dashboard2')

@section('page')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
            Dashboard
        </h1>
    </div>
    <div class="row row-cards">
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="text-right text-green">
                        {{--6%--}}
                        <i class="fe fe-chevron-up"></i>
                    </div>
                    <div class="h1 m-0"><a href="{{route('car_list')}}">{{\App\Car::where('company','like',\Illuminate\Support\Facades\Input::get('company','%'))->count()}}</a></div>
                    <div class="text-muted mb-4">Car Number</div>
                </div>
            </div>
        </div>
        {{--<div class="col-6 col-sm-4 col-lg-2">--}}
            {{--<div class="card">--}}
                {{--<div class="card-body p-3 text-center">--}}
                    {{--<div class="text-right text-red">--}}
                        {{---3%--}}
                        {{--<i class="fe fe-chevron-down"></i>--}}
                    {{--</div>--}}
                    {{--<div class="h1 m-0">17</div>--}}
                    {{--<div class="text-muted mb-4">Closed Today</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-6 col-sm-4 col-lg-2">--}}
            {{--<div class="card">--}}
                {{--<div class="card-body p-3 text-center">--}}
                    {{--<div class="text-right text-green">--}}
                        {{--9%--}}
                        {{--<i class="fe fe-chevron-up"></i>--}}
                    {{--</div>--}}
                    {{--<div class="h1 m-0">7</div>--}}
                    {{--<div class="text-muted mb-4">New Replies</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-6 col-sm-4 col-lg-2">--}}
            {{--<div class="card">--}}
                {{--<div class="card-body p-3 text-center">--}}
                    {{--<div class="text-right text-green">--}}
                        {{--3%--}}
                        {{--<i class="fe fe-chevron-up"></i>--}}
                    {{--</div>--}}
                    {{--<div class="h1 m-0">27.3K</div>--}}
                    {{--<div class="text-muted mb-4">Followers</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-6 col-sm-4 col-lg-2">--}}
            {{--<div class="card">--}}
                {{--<div class="card-body p-3 text-center">--}}
                    {{--<div class="text-right text-red">--}}
                        {{---2%--}}
                        {{--<i class="fe fe-chevron-down"></i>--}}
                    {{--</div>--}}
                    {{--<div class="h1 m-0">$95</div>--}}
                    {{--<div class="text-muted mb-4">Daily Earnings</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-6 col-sm-4 col-lg-2">--}}
            {{--<div class="card">--}}
                {{--<div class="card-body p-3 text-center">--}}
                    {{--<div class="text-right text-red">--}}
                        {{---1%--}}
                        {{--<i class="fe fe-chevron-down"></i>--}}
                    {{--</div>--}}
                    {{--<div class="h1 m-0">621</div>--}}
                    {{--<div class="text-muted mb-4">Products</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}


    </div>

    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Service</h4>
                </div>
                <table class="table card-table">
                    {{--@if(count($service)>0)--}}
                    {{--@foreach($service as $car)--}}
                        {{--<tr>--}}
                            {{--<td><a href="{{route('car_detail',['id'=>$car->id])}}">{{$car->plate}}</a></td>--}}
                            {{--<td class="text-right">--}}
                                {{--@if($car->service-$car->odometer_reading>0)--}}
                                    {{--<span class="badge badge-success">Less Than 1000km</span>--}}
                                {{--@else--}}
                                    {{--<span class="badge badge-danger">Expired</span>--}}
                                {{--@endif--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                    {{--@endforeach--}}
                    {{--@endif--}}
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
                </table>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">RUC</h2>
                </div>
                <table class="table card-table">

                    @foreach($ruc as $plate=>$car)
                        <tr>
                            <td><a href="{{route('car_edit_by_plate',['plate'=>$plate])}}" class="text-uppercase">{{$plate}}</a></td>
                            <td class="text-right">
                                @if($car>0)
                                    <span class="badge badge-success">Less Than 1000km</span>
                                @else
                                    <span class="badge badge-danger">Expired ({{$car}}km)</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">REG</h2>
                </div>
                <table class="table card-table">
                    @foreach($reg as $plate=>$car)
                        <tr>
                            <td><a href="{{route('car_edit_by_plate',['plate'=>$plate])}}" class="text-uppercase">{{$plate}}</a></td>
                            <td class="text-right">
                                @if($car>0)
                                    <span class="badge badge-success">Expire in {{$car}} days</span>
                                @else
                                    <span class="badge badge-danger">Expired</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">COF/WOF</h2>
                </div>
                <table class="table card-table">
                    @foreach($cof as $plate=>$car)
                        <tr>
                            <td><a href="{{route('car_edit_by_plate',['plate'=>$plate])}}" class="text-uppercase">{{$plate}}</a></td>
                            <td class="text-right">
                                @if($car>0)
                                    <span class="badge badge-success">Expire in {{$car}} days</span>
                                @else
                                    <span class="badge badge-danger">Expired</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>

</div>

@endsection
