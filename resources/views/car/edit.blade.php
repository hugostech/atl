@extends('layouts.dashboard2')

@section('page')
<div class="container">
    <div class="row">
        <div class="col-12">
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
                            <label class="form-label">Current Hubemeter Reading </label>

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
                            {!! Form::select('company',config('car.company',[]),null,['class'=>'form-control','placeholder'=>'Select Company', 'required']) !!}
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

        </div>

    </div>
</div>
@endsection
