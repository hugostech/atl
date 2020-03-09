@extends('layouts.dashboard2')

@section('page')
<div class="container">
    <div class="row">
        <div class="col-12">
            {!! Form::open(['route'=>'driver_create','method'=>'post','class'=>'card','onsubmit'=>"return confirm('Are you sure?')"]) !!}
            {!! Form::hidden('last_editor',\Illuminate\Support\Facades\Auth::user()->id) !!}
            <div class="card-header">
                <h3 class="card-title">Create Driver</h3>
            </div>
            <div class="card-body">
                @component('components.error')
                @endcomponent
                <div class="">
                <!-- <div class="row">       -->
                    <!-- <div class="col-md-6 col-lg-4"> -->
                    <div class="">
                        <div class="form-group">
                            <label class="form-label">Name <span class="form-required">*</span></label>
                            <div class="input-group">
                                {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Name of the driver','required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone</label>
                            <div class="input-group">
                                {!! Form::text('phone',null,['class'=>'form-control','placeholder'=>'phone of the driver']) !!}
                            </div>
                        </div>

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
                            <div class="form-label">Status <span class="form-required">*</span></div>
                            <div class="custom-controls-stacked">
                                <label class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('status',1,true,['class'=>'custom-control-input']) !!}
                                    <span class="custom-control-label">Enable</span>
                                </label>
                                <label class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio('status',0,false,['class'=>'custom-control-input']) !!}
                                    <span class="custom-control-label">Disable</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}
                        </div>

                    </div>
                    <!-- <div class="col-md-6 col-lg-4">

                    </div>
                    <div class="col-md-6 col-lg-4">
                    </div> -->
                </div>
            </div>
            {!! Form::close() !!}

        </div>

    </div>
</div>
@endsection
