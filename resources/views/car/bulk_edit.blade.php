@extends('layouts.dashboard2')

@section('page')
<div class="container">
        <div class="alert alert-success" id="msg" style="display:none" >
            <strong>Success!</strong> 
        </div>
    
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    {!! Form::open(['route'=>'batch_save','method'=>'post','class'=>'card']) !!}
                        {!! Form::hidden('last_editor',\Illuminate\Support\Facades\Auth::user()->id) !!}
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                            <thead>
                            <tr>
                                <th class="text-center w-1"><i class="icon-people"></i></th>
                                <th>Plate</th>
                                <th>Hubometer</th>
                                <th>Service</th>
                                <th>Odometer</th>
                                <th>RUC</th>
                                <th>COF</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cars as $car)
                            <tr>
                                <td class="text-center">
                                    <div class="avatar d-block" style="background-image: url({{asset('logos/Mercedes-Benz-logo.png')}})">
                                        <span class="avatar-status bg-green"></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-uppercase">{{$car->plate}}
                                        <input type="hidden" name="plate[]" value="{{$car->plate}}" /> 
                                        <input type="hidden" name="id[]" value="{{$car->id}}" />
                                    </div>
                                    <div class="small text-muted">
                                        Registered: {{$car->year_of_manufacture}} {{strtoupper($car->main_colour)}} S: {{$car->no_of_seats}}
                                    </div>
                                </td>
                                <td>
                                    <div class="small text-muted">Current: {{number_format($car->hubemeter_reading)}}KM</div>
                                    <span class="input-group-append"> 
                                        <input type="text" name="hubemeter_reading[]" size="10" />
                                        <span class="input-group-text">KM</span>
                                    </span>
                                </td>
                                <td>
                                    <div class="small text-muted">Current: {{number_format($car->service)}}KM</div>
                                    <span class="input-group-append">
                                        <input type="text" name="service[]" size="10" />
                                        <span class="input-group-text">KM</span>
                                    </span>                                
                                </td>
                                <td>
                                    <div class="small text-muted">Current: {{number_format($car->odometer_reading)}}KM</div>
                                    <span class="input-group-append">
                                        <input type="text" name="odometer_reading[]" size="10" />
                                        <span class="input-group-text">KM</span>
                                    </span>
                                </td>

                                <td>
                                    <div class="small text-muted">Current: {{number_format($car->ruc)}}KM</div>
                                    <span class="input-group-append">
                                        <input type="text" name="ruc[]" size="10" />
                                        <span class="input-group-text">KM</span>
                                    </span>
                                </td>

                                <td>
                                    @if (!empty($car->cof) )
                                        <div class="small text-muted">Current: {{ date('d/m/Y', strtotime($car->cof)) }}</div> 
                                    @else
                                        <div class="small text-muted">Current: </div> 
                                    @endif
                                    {!! Form::date('cof[]',null,['class'=>"form-control"]) !!}
                                </td>                                
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="8" class="text-center">
                                    <input type="button" name="submit" value="Submit" onclick="confirm_save(this,'{{route('batch_save')}}')" class="btn btn-primary" data-toggle="modal" data-target="#confirm" />
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="confirm" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 800px; min-width: " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">You did following changes.</h5>                
            </div>
            <div class="text-center" id='confirm_table_div'>
                <table class="table" id="confirm_table">
                    <thead>
                        <tr>
                        <th scope="col">Plate</th>
                        <th scope="col">Hubmeter</th>
                        <th scope="col">Service</th>
                        <th scope="col">Odometer</th>
                        <th scope="col">RUC</th>
                        <th scope="col">COF</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <div>Are you sure? </div> 
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="save()">Yes. Save Please.</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                
            </div>
        </div>
    </div>
</div>

<script>    
    var data = [];
    var url = "";
    function confirm_save(obj, url){
        $("#confirm_table > tbody").html("");
        var x = 0;
        this.url = url;
        this.data = [];
        var id = $("input[name='id[]']").map(function(){return $(this).val();}).get().toString().split(",");
        var hubemeter_reading = $("input[name='hubemeter_reading[]']").map(function(){return $(this).val();}).get().toString().split(",");
        var service = $("input[name='service[]']").map(function(){return $(this).val();}).get().toString().split(",");
        var odometer_reading = $("input[name='odometer_reading[]']").map(function(){return $(this).val();}).get().toString().split(",");
        var ruc = $("input[name='ruc[]']").map(function(){return $(this).val();}).get().toString().split(",");
        var cof = $("input[name='cof[]']").map(function(){return $(this).val();}).get().toString().split(",");

        $('input[name^="plate"]').each(function() {
            var row = "<tr>";
            row += "<td>" + $(this).val() +"</td>";
            row += "<td>" + hubemeter_reading[x] +"</td>";
            row += "<td>" + service[x] +"</td>";
            row += "<td>" + odometer_reading[x] +"</td>";
            row += "<td>" + ruc[x] +"</td>";
            row += "<td>" + cof[x] +"</td>";
            row += "</tr>";

            if (hubemeter_reading[x] != '' 
                || service[x] != '' 
                || odometer_reading[x] != ''
                || ruc[x] != ''
                || cof[x] != ''
            ) {
                $("#confirm_table tbody").append(row);

                var item = {}
                item['id'] = id[x];
                item['hubemeter_reading'] = hubemeter_reading[x];
                item['service'] = service[x];
                item['odometer_reading'] = odometer_reading[x];
                item['ruc'] = ruc[x];
                item['cof'] = cof[x];

                data.push(item);
            }            
            x++;
        });
        // console.log(data)
    }

    function save() {
        // console.log(JSON.stringify(data))
        $.ajax({
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            data: JSON.stringify(data) ,
            dataType: "json",
            success: function (res) {
                $("#msg").attr("style", "display:block");
                $("#msg")[0].scrollIntoView();
            }
        });
    }
      
</script>
@endsection
