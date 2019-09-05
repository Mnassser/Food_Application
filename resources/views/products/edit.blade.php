@extends('layouts.app')

@section('title', '| Edit city')

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-key'></i> Edit {{$item->name}}</h1>
    <br>
    {{ Form::model($item, array('route' => array('cities.update', $item->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with item data --}}

    <div class="form-group">
        {{ Form::label('name', 'item Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    <br>
    {{ Form::submittrans('lang.edit'), array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection