@extends('layouts.dashboard2')

@section('page')
<div class="container">
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="alert alert-success">
            <strong>Success!</strong> {{\Illuminate\Support\Facades\Session::get('success')}}
        </div>
    @endif
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                        <tr>
                            <th class="text-center w-1"><i class="icon-people"></i></th>
                            <th>Plate</th>
                            <th>RUC</th>
                            <th>COF</th>
                            <th>REG</th>
                            <th class="text-center">Service</th>
                            <th class="text-center">TYREINFO</th>
                            <th class="text-center"><i class="icon-settings"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        {{ Form::hidden('domain', Request::root() ) }}
                        @foreach($cars as $car)
                        <tr>
                            <td class="text-center">
                                <div class="avatar d-block" style="background-image: url({{asset('logos/Mercedes-Benz-logo.png')}})">
                                    @if($car->status==1)
                                    <span class="avatar-status bg-green"></span>
                                    @else
                                    <span class="avatar-status bg-red-dark"></span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="text-uppercase">{{$car->plate}}</div>
                                <div class="small text-muted">
                                    Registered: {{$car->year_of_manufacture}} {{strtoupper($car->main_colour)}} S: {{$car->no_of_seats}}
                                </div>
                            </td>
                            <td>
                                @component('components.ruc',['car'=>$car])
                                    N/A
                                @endcomponent

                            </td>
                            <td>
                                <div class="small text-muted">Expired On</div>
                                <div>{{\Carbon\Carbon::parse($car->cof)->format('d M Y')}}</div>
                            </td>
                            <td>
                                <div class="small text-muted">Expired On</div>
                                <div>{{\Carbon\Carbon::parse($car->reg)->format('d M Y')}}</div>
                            </td>

                            <td class="text-center">
                                @component('components.service',['car'=>$car])
                                    N/A
                                @endcomponent
                            </td>
                            <td class="text-center">
                                <div>{{$car->tyreinfo}}</div>
                            </td>
                            
                            <td class="text-center">
                                <div class="item-action dropdown">
                                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{route('car_edit',['id'=>$car->id])}}" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Edit </a>
                                        <a href="{{route('car_delete',['id'=>$car->id])}}" class="dropdown-item text-danger" onclick="return confirm('Are you sure to delete?')"><i class="dropdown-icon fe fe-delete"></i> Delete</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="javascript:void(0)" onclick="showlink(this, '{{route('sharing_url',['mark'=>$car->sharing_mark])}}')" id="{{$car->sharing_mark}}" data-plate="{{$car->plate}}" class="dropdown-item" data-toggle="modal" data-target="#exampleModal"><i class="dropdown-icon fe fe-link"></i> Update Odometer link</a>
                                        <a href="javascript:void(0)" onclick="showHistory('{{route('car_history',['id'=>$car->id])}}')" class="dropdown-item" data-toggle="modal" data-target="#history"><i class="dropdown-icon fe fe-link"></i> History</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Share Link</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <label class="form-label" id="url_label">Loading...</label>
            </div>

            <div class="text-center" id="qr_code">
            
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="download" name="" onclick="downloadQRCode(this)" data-dismiss="modal">Download QR Code</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="history" tabindex="-1" role="dialog" aria-labelledby="history" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">History</h5>                
            </div>
            <div class="text-center" id='history_table_div'>
                <table class="table" id="history_table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Driver</th>
                        <th scope="col">Date</th>
                        <th scope="col">GC</th>
                        <th scope="col">COF Due Date</th>
                        <th scope="col">REGO Due Date</th>
                        <th scope="col">RUC End At</th>
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
                        
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                
            </div>
        </div>
    </div>
</div>

<script>
    function showHistory(url) {
        $( ".modal-dialog" ).css( "maxWidth",'1200px');
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
                    row += "<td>" + item.ruc +"</td>";
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
    function showlink(obj, url) {
        $('#url_label').html(url);

        var plate = $(obj).attr("data-plate");
        var sharing_mark = $(obj).attr("id");
        domain = $('[name="domain"]').val();

        var qr_code_url = domain + "/qr_code/" + sharing_mark;
        var img_qr_code = "<img src='" + qr_code_url + "' title='" + qr_code_url + "' />";        
        $('#qr_code').html(img_qr_code);   
        $('#download').attr('data-qr_code_url', qr_code_url);  
        $('#download').attr('data-plate', plate);   
    }
    function downloadQRCode(obj) {
        url = $(obj).attr("data-qr_code_url");
        plate = $(obj).attr("data-plate");

        var a = $("<a>")
            .attr("href", url)
            .attr("download", plate + ".png")
            .appendTo("body");

        a[0].click();
        a.remove();
    }
</script>
@endsection
