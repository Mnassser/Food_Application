@extends('layouts.app')

@section('title', '| Edit city')

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-key'></i> Edit {{$item->name}}</h1>
    <br>
    {{ Form::model($item, array('route' => array('settings.update', $item->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with item data --}}

    <div class="form-group">
        {{ Form::label('name', 'about') }}
        {{ Form::text('about', null, array('class' => 'form-control')) }}
    </div>
        <div class="form-group">
        {{ Form::label('name', 'commission_details') }}
        {{ Form::text('commission_details', null, array('class' => 'form-control')) }}
    </div>
        <div class="form-group">
        {{ Form::label('name', 'email') }}
        {{ Form::text('email', null, array('class' => 'form-control')) }}
    </div>
        <div class="form-group">
        {{ Form::label('name', 'phone') }}
        {{ Form::text('phone', null, array('class' => 'form-control')) }}
    </div>
        <div class="form-group">
        {{ Form::label('name', 'facebook') }}
        {{ Form::text('facebook', null, array('class' => 'form-control')) }}
    </div>
        <div class="form-group">
        {{ Form::label('name', 'whatsapp') }}
        {{ Form::text('whatsapp', null, array('class' => 'form-control')) }}
    </div>
    <br>
    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection