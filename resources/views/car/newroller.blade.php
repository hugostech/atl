@extends('layouts.dashboard2')

@section('page')
<div class="container">
    <div class="row">
        <div class="col-12">
            {!! Form::open(['route'=>'car_create','method'=>'post','class'=>'card','onsubmit'=>"return confirm('Are you sure?')"]) !!}
            {!! Form::hidden('last_editor',\Illuminate\Support\Facades\Auth::user()->id) !!}
            {{ Form::hidden('vehicle_type', 'Roller') }}
            <div class="card-header">
                <h3 class="card-title">Create Vehicle - Roller</h3>
            </div>
            <div class="card-body">
                <div class="btn-group">
                    <a href="{{ url('car/new') }}" class="btn btn-blue">Car</a>
                    <a href="{{ url('car/new_digger') }}" class="btn btn-blue" >Digger</a>
                    <a href="{{ url('car/new_roller') }}" class="btn btn-dark" >Roller</a>
                    <a href="{{ url('car/new_compactor') }}" class="btn btn-blue" >Compactor</a>
                </div>

                @component('components.error')
                @endcomponent
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label class="form-label">Plate or Roller Number <span class="form-required">*</span></label>
                            <div class="input-group">
                                {!! Form::text('plate',null,['class'=>'form-control','placeholder'=>'Plate','required']) !!}
                                <span class="input-group-append">
                                  <button class="btn btn-default" type="button">Fill (Beta)</button>
                                </span>
                            </div>

                        </div>




                        {!! Form::hidden('hours',0,['class'=>'form-control','placeholder'=>'Hours','required']) !!}
                        <div class="form-group">
                            <label class="form-label">Serial no</label>
                            {!! Form::text('engine_no',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label">Main colour</label>
                            {!! Form::text('main_colour',null,['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label class="form-label">Year Of Manufacture</label>
                            {!! Form::text('year_of_manufacture',null,['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}
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




                    </div>
                </div>
            </div>
            {!! Form::close() !!}

        </div>

    </div>
</div>
@endsection
