@extends('layouts.app')

@section('title', '| Add city')

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-key'></i> @lang('lang.Add') @lang('lang.City')</h1>
    <hr>

    {{ Form::open(array('url' => 'cities')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <h5><b>Assign items</b></h5>

    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection