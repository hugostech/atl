@extends('layouts.dashboard')
@section('title', 'Page Title')
@section('page')
    {!! Form::open() !!}
    <div class="form-group">
        <label class="form-label">Car:</label>
        {{$car->plate}}
    </div>
    <div class="form-group">
        <label class="form-label">Driver<span class="form-required">*</span></label>
        {!! Form::select('driver_id', $drivers, null, ['class'=>'form-control','placeholder'=>'Select Driver','required']) !!}
    </div>
    <div class="form-group">
    <label class="form-label">Date<span class="form-required">*</span></label>
        {!! Form::date('date',\Carbon\Carbon::now(),['class'=>"form-control",'required']) !!}
    </div>
    <div class="form-group">
        <label class="form-label">Group Code<span class="form-required">*</span></label>
        {!! Form::text('group_code',null,['class'=>'form-control','required']) !!}
    </div>
    <div class="form-group">
        <label class="form-label">COF Due Date: </label>
        {!! Form::date('cof_due_date', \Carbon\Carbon::parse($car->cof)->format('Y-m-d'),['class'=>"form-control"]) !!}
    </div>
    <div class="form-group">
        <label class="form-label">REGO Due Date</label>
        {!! Form::date('rego_due_date',\Carbon\Carbon::parse($car->reg)->format('Y-m-d'),['class'=>"form-control",'readonly']) !!}
    </div>
    <div class="form-group">
        <label class="form-label">Last Service Date</label>
        {!! Form::date('last_service_date',\Carbon\Carbon::parse($car->last_service_date)->format('Y-m-d'),['class'=>"form-control",'required']) !!}
    </div>
    <div class="form-group">
        <label class="form-label">RUC End At</label>
        <div class="input-group">
            {!! Form::number('ruc',$car->ruc,['class'=>"form-control"]) !!}
            <span class="input-group-append">
                <span class="input-group-text">KM</span>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label">Next Service</label>
        <div class="input-group">
            {!! Form::number('next_service',$car->service,['class'=>"form-control"]) !!}
            <span class="input-group-append">
                <span class="input-group-text">KM</span>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label">Total Fuel of This Group</label>
        <div class="input-group">
            {!! Form::number('total_fuel',null,['class'=>"form-control"]) !!}
            <span class="input-group-append">
                <span class="input-group-text">L</span>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label">Odometer Reading<span class="form-required">*</span></label>
        <div class="input-group">
            {!! Form::number('odometer_reading',null,['class'=>'form-control','required']) !!}
            <span class="input-group-append">
                <span class="input-group-text">KM</span>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label">Hubo Reading<span class="form-required">*</span></label>
        <div class="input-group">
            {!! Form::number('hubmeter_reading',null,['class'=>'form-control','required']) !!}
            <span class="input-group-append">
                <span class="input-group-text">KM</span>
            </span>
        </div>
    </div>
    <!-- @todo if user select problem here we need to send an email  -->
    <div class="form-group">
        <label class="form-label">Body: </label>
        Fine {{ Form::radio('body', 'fine' , true) }}
        Problem {{ Form::radio('body', 'problem' , false) }}
    </div>
    <div class="form-group">
        <label class="form-label">Mechanics: </label>
        Fine {{ Form::radio('mechanics', 'fine' , true) }}
        Problem {{ Form::radio('mechanics', 'problem' , false) }}
    </div>
    <div class="form-group">
        <label class="form-label">Hygiene: </label>
        Fine {{ Form::radio('hygiene', 'fine' , true) }}
        Problem {{ Form::radio('hygiene', 'problem' , false) }}
    </div>


    <div class="form-group">
        {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}
    </div>    
    {!! Form::close() !!}

@endsection
