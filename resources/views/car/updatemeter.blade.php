@extends('layouts.dashboard')
@section('page')
    {!! Form::open() !!}
    <div class="form-group">
        <label class="form-label">Odometer Reading</label>
        {!! Form::number('odometer_reading',null,['class'=>'form-control','required']) !!}
    </div>
    <div class="form-group">
        <label class="form-label">Your Name</label>
        {!! Form::text('name',null,['class'=>'form-control','required']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

@endsection
