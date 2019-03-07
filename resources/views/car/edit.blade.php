@extends('layouts.dashboard2')

@section('page')
<div class="container">
    <div class="row">        
        <div class="col-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">Edit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history"
                    aria-selected="false">History</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent"> 
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"> <!-- start home tab -->
                    {!! Form::model($car,['route'=>['car_update','id'=>$car->id],'method'=>'post','class'=>'card','onsubmit'=>"return confirm('Are you sure?')"]) !!}
                    {!! Form::hidden('last_editor',\Illuminate\Support\Facades\Auth::user()->id) !!}
                    {!! Form::hidden('vehicle_type', $car->vehicle_type) !!}
                    <div class="card-header">
                        @if($car->vehicle_type == "Digger Vehicle")
                            <h3 class="card-title">Edit Digger {{$car->plate}}</h3>
                        @else
                            <h3 class="card-title">Edit Vehicle {{$car->plate}}</h3>
                        @endif

                    </div>
                    
                    <div class="card-body">
                        <h6 class="card-subtitle mb-20 text-muted">Last Edit:
                            @if($car->lastEditor)
                                {{$car->lastEditor->name}} < {{$car->lastEditor->email}} >
                            @endif
                            at {{$car->updated_at}}</h6>
                        @if(\Illuminate\Support\Facades\Session::has('update_success'))
                            <div class="alert alert-success">
                                <strong>Success!</strong> {{\Illuminate\Support\Facades\Session::get('update_success')}}
                            </div>
                        @endif
                        @component('components.error')
                        @endcomponent
                        <div class="row">


                            <div class="col-md-6 col-lg-4">
                                @if($car->vehicle_type == "Vehicle")
                                <div class="form-group">
                                    <label class="form-label">No of Seats <span class="form-required">*</span></label>
                                    {!! Form::number('no_of_seats',null,['class'=>'form-control','placeholder'=>'Seats','required']) !!}
                                </div>
                                @endif
                                <div class="form-group">
                                    <label class="form-label">Tyre Info <span class="form-required">*</span></label>
                                    {!! Form::text('tyreinfo',null,['class'=>'form-control','placeholder'=>'eg: 255/70R22.5','required']) !!}
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Current Odometer Reading</label>

                                    <div class="input-group">
                                        {!! Form::number('odometer_reading',null,['class'=>'form-control']) !!}
                                        <span class="input-group-append">
                                            <span class="input-group-text">KM</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Current Hubometer Reading </label>

                                    <div class="input-group">
                                        {!! Form::number('hubemeter_reading',null,['class'=>'form-control']) !!}
                                        <span class="input-group-append">
                                            <span class="input-group-text">KM</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Year Of Manufacture</label>
                                    {!! Form::text('year_of_manufacture',null,['class'=>'form-control']) !!}
                                </div>         
                                
                                <div class="form-group">
                                    <label class="form-label">Engine no</label>
                                    {!! Form::text('engine_no',null,['class'=>'form-control']) !!}
                                </div>
                                
                                <div class="form-group">
                                    {!! Form::submit('Update',['class'=>'btn btn-primary']) !!}
                                </div>

                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="form-label">COF/WOF Expires On<span class="form-required">*</span></label>
                                    {!! Form::date('cof',null,['class'=>"form-control",'required']) !!}
                                </div>
                                <div class="form-group">
                                    <label class="form-label">REG Expires On<span class="form-required">*</span></label>
                                    {!! Form::date('reg',null,['class'=>"form-control",'required']) !!}
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Last Service Date<span class="form-required">*</span></label>
                                    {!! Form::date('last_service_date',null,['class'=>"form-control",'required']) !!}
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Next Service</label>
                                    <div class="input-group">
                                        {!! Form::number('service',null,['class'=>"form-control"]) !!}
                                        <span class="input-group-append">
                                            <span class="input-group-text">KM</span>
                                        </span>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="form-label">RUC End At</label>
                                    <div class="input-group">
                                        {!! Form::number('ruc',null,['class'=>"form-control"]) !!}
                                        <span class="input-group-append">
                                            <span class="input-group-text">KM</span>
                                        </span>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="form-label">Main colour</label>
                                    {!! Form::text('main_colour',null,['class'=>'form-control']) !!}
                                </div>
                                

                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="form-label">Company <span class="form-required">*</span></label>                            
                                    @if (\Illuminate\Support\Facades\Auth::user()->company == "")
                                    {!! Form::select('company',config('car.company',[]),null,['class'=>'form-control','placeholder'=>'Select Company', 'required']) !!}
                                    @else
                                        {!! Form::select('company',
                                            [\Illuminate\Support\Facades\Auth::user()->company => \Illuminate\Support\Facades\Auth::user()->company],
                                            \Illuminate\Support\Facades\Auth::user()->company,
                                            ['class'=>'form-control', 'required']
                                        ) !!}
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Make</label>
                                    {!! Form::text('make',null,['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Model</label>
                                    {!! Form::text('model',null,['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Vin</label>
                                    {!! Form::text('vin',null,['class'=>'form-control']) !!}
                                </div>                        

                                @if($car->vehicle_type == "Digger Vehicle")
                                <div class="form-group">
                                    <label class="form-label">Service Hours<span class="form-required">*</span></label>
                                    {!! Form::text('service_hours',null,['class'=>'form-control', 'required']) !!}
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Hours<span class="form-required">*</span></label>
                                    {!! Form::text('hours',null,['class'=>'form-control', 'required']) !!}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div> <!-- end home tab -->
                <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab"><!-- start history tab -->                    
                    <div class="row ">
                        <div>From{!! Form::date('from', Carbon\Carbon::today()->format('Y-m-d'), ['class'=>"form-control", 'id'=>'from', 'required']) !!}</div>
                        <div>To{!! Form::date('to', Carbon\Carbon::today()->format('Y-m-d'), ['class'=>"form-control", 'id'=>'to','required']) !!}</div>
                        <div style="margin-right: 5px; margin-top: 23px;"><input type="button" value="Search" class="btn btn-primary" onclick="showHistory('{{route('car_history_print',['id'=>$car->id,"from"=>"from","to"=>"to"])}}')" > </div>
                        <div style="margin-right: 5px; margin-top: 23px;"><input type="button" value="This Month" class="btn btn-primary" onclick="showHistory('{{route('car_history_print',['id'=>$car->id,"from"=>Carbon\Carbon::now()->startOfMonth()->format('Y-m-d'),"to"=>Carbon\Carbon::now()->endOfMonth()->format('Y-m-d') ])}}')" > </div>
                        <div style="margin-right: 5px; margin-top: 23px;"><input type="button" value="Last Month" class="btn btn-primary" onclick="showHistory('{{route('car_history_print',['id'=>$car->id,"from"=>Carbon\Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d'),"to"=>Carbon\Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d') ])}}')" > </div>
                        <div style="margin-top: 23px;"><input type="button" value="Print" class="btn btn-primary" onclick="print_table()" > </div>
                    </div>
                    <table class="table" id="history_table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Driver</th>
                            <th scope="col">Date</th>
                            <th scope="col">GC</th>
                            <th scope="col">COF Due Date</th>
                            <th scope="col">REGO Due Date</th>
                            <th scope="col">Next Service</th>
                            <th scope="col">Total Fuel(L)</th>
                            <th scope="col">Odometer(Km)</th>
                            <th scope="col">Hubo(Km)</th>
                            <th scope="col">Body</th>
                            <th scope="col">Mechanics</th>
                            <th scope="col">Hygiene</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($history as $indexKey => $item)
                            <tr>
                            <th scope='row'>{{ ($indexKey + 1) }}</th>
                            <td>{{$item->name }}</td>
                            <td>{{$item->date }}</td>
                            <td class='text-uppercase'>{{$item->group_code }}</td>
                            <td>{{$item->cof_due_date }}</td>
                            <td>{{$item->rego_due_date != null ? $item->rego_due_date : '' }}</td>
                            
                            <td>{{$item->next_service != null ? $item->next_service : '' }}</td>
                            <td>{{$item->total_fuel != null ? $item->total_fuel : '' }}</td>
                            <td>{{$item->odometer_reading }}</td>
                            <td>{{$item->hubmeter_reading }}</td>
                            <td>{{$item->body }}</td>
                            <td>{{$item->mechanics }}</td>
                            <td>{{$item->hygiene }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- end history tab -->
            
            </div>
        </div>

    </div>
</div>
@endsection

<script>
    
    function print_table()
    {
        var divToPrint=document.getElementById("history_table");
        newWin= window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }

    function showHistory(url) {
        var from = $('#from').val();
        var to = $('#to').val();  
        url = url.replace("/from/", "/" + from + "/" );
        url = url.replace("/to", "/" + to);
        $.ajax({
            url: url,
            type: "get",
            data: '' ,
            dataType: "json",
            success: function (res) {
                //console.log(res[0])
                $("#history_table > tbody").html("");
                jQuery.each(res, function(index, item) {
                    var rego_due_date = item.rego_due_date != null ? item.rego_due_date : '';
                    var next_service = item.next_service != null ? item.next_service : '';
                    var total_fuel = item.total_fuel != null ? item.total_fuel : '';

                    var row = "<tr>";
                    row += "<th scope='row'>"+ (index + 1) +"</th>";
                    row += "<td>" + item.name +"</td>";
                    row += "<td>" + item.date +"</td>";
                    row += "<td class='text-uppercase'>" + item.group_code +"</td>";
                    row += "<td>" + item.cof_due_date +"</td>";
                    row += "<td>" + rego_due_date +"</td>";
                    row += "<td>" + next_service +"</td>";
                    row += "<td>" + total_fuel +"</td>";
                    row += "<td>" + item.odometer_reading +"</td>";
                    row += "<td>" + item.hubmeter_reading +"</td>";
                    row += "<td>" + item.body +"</td>";
                    row += "<td>" + item.mechanics +"</td>";
                    row += "<td>" + item.hygiene +"</td>";
                    row += "</tr>";

                    $("#history_table tbody").append(row);
                });         
                if (res.length == 0) {
                    $("#history_table > tbody").html("<tr><td colspan='13' class='text-danger'>No data found.</td><tr>");
                }      
            }
        });
    }
</script>