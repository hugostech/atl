@extends('layouts.dashboard2')

@section('page')
<div class="container">
    <div class="row">
        <div class="col-12">
            {!! Form::open(['route'=>'car_create','method'=>'post','class'=>'card','onsubmit'=>"return confirm('Are you sure?')"]) !!}
            {!! Form::hidden('last_editor',\Illuminate\Support\Facades\Auth::user()->id) !!}
            {{ Form::hidden('vehicle_type', 'Digger Vehicle') }}
            <div class="card-header">
                <h3 class="card-title">Create Vehicle - Digger</h3>
            </div>
            <div class="card-body">
                <div class="btn-group">
                    <a href="{{ url('car/new') }}" class="vehicle">{{Html::image(asset('dist/assets/images/car.png'))}}</a>
                    <a href="{{ url('car/new_digger') }}" class="vehicle" >{{Html::image(asset('dist/assets/images/digger.png'))}}</a>                    
                </div>

                @component('components.error')
                @endcomponent
                <div class="row">                    
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label class="form-label">Plate <span class="form-required">*</span></label>
                            <div class="input-group">
                                {!! Form::text('plate',null,['class'=>'form-control','placeholder'=>'Plate','required']) !!}
                                <span class="input-group-append">
                                  <button class="btn btn-default" type="button">Fill (Beta)</button>
                                </span>
                            </div>

                        </div>                                              
                                             
                        <div class="form-group">
                            <label class="form-label">Tyre Info </label>
                            {!! Form::text('tyreinfo',null,['class'=>'form-control','placeholder'=>'eg: 255/70R22.5']) !!}
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
                            <label class="form-label">Engine no</label>
                            {!! Form::text('engine_no',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label">Main colour</label>
                            {!! Form::text('main_colour',null,['class'=>'form-control']) !!}
                        </div>
                        
                        <div class="form-group">
                            {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}
                        </div>

                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label class="form-label">COF/WOF Expires On</label>
                            {!! Form::date('cof',null,['class'=>"form-control"]) !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label">REG Expires On</label>
                            {!! Form::date('reg',null,['class'=>"form-control"]) !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label">Last Service Date<span </label>
                            {!! Form::date('last_service_date',null,['class'=>"form-control"]) !!}
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
                            <label class="form-label">Year Of Manufacture</label>
                            {!! Form::text('year_of_manufacture',null,['class'=>'form-control']) !!}
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
                        
                        <div class="form-group">
                            <label class="form-label">Hours <span class="form-required">*</span></label>
                            {!! Form::number('hours',null,['class'=>'form-control','placeholder'=>'Hours','required']) !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label">Service Hours <span class="form-required">*</span></label>
                            {!! Form::number('service_hours',null,['class'=>'form-control','placeholder'=>'Service Hours','required']) !!}
                        </div>

                    </div>
                </div>
            </div>
            {!! Form::close() !!}

        </div>

    </div>
</div>
@endsection
