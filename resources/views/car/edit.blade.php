@extends('layouts.dashboard2')

@section('page')
<div class="container">
    <div class="row">
        <div class="col-12">
            {!! Form::model($car,['route'=>['car_update','id'=>$car->id],'method'=>'post','class'=>'card','onsubmit'=>"return confirm('Are you sure?')"]) !!}
            <div class="card-header">
                <h3 class="card-title">Edit Car {{$car->plate}}</h3>
            </div>
            <div class="card-body">
                @if(\Illuminate\Support\Facades\Session::has('update_success'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{\Illuminate\Support\Facades\Session::get('update_success')}}
                    </div>
                @endif
                @component('components.error')
                @endcomponent
                <div class="row">


                    <div class="col-md-6 col-lg-4">

                        <div class="form-group">
                            <label class="form-label">No of Seats <span class="form-required">*</span></label>
                            {!! Form::number('no_of_seats',null,['class'=>'form-control','placeholder'=>'Seats','required']) !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tyre Info <span class="form-required">*</span></label>
                            {!! Form::text('tyreinfo',null,['class'=>'form-control','placeholder'=>'eg: 255/70R22.5','required']) !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label">Odometer reading <span class="form-required">*</span></label>

                            <div class="input-group">
                                {!! Form::number('odometer_reading',null,['class'=>'form-control','required']) !!}
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
                            {!! Form::submit('Update',['class'=>'btn btn-primary']) !!}
                        </div>

                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label class="form-label">CoF<span class="form-required">*</span></label>
                            {!! Form::date('cof',null,['class'=>"form-control",'required']) !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label">REG<span class="form-required">*</span></label>
                            {!! Form::date('reg',null,['class'=>"form-control",'required']) !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label">Service<span class="form-required">*</span></label>
                            <div class="input-group">
                                {!! Form::number('service',null,['class'=>"form-control",'required']) !!}
                                <span class="input-group-append">
                                    <span class="input-group-text">KM</span>
                                </span>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="form-label">RUC<span class="form-required">*</span></label>
                            <div class="input-group">
                                {!! Form::number('ruc',null,['class'=>"form-control",'required']) !!}
                                <span class="input-group-append">
                                    <span class="input-group-text">KM</span>
                                </span>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">

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
                            <label class="form-label">Engine no</label>
                            {!! Form::text('engine_no',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label">Main colour</label>
                            {!! Form::text('main_colour',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

        </div>

    </div>
</div>
@endsection
