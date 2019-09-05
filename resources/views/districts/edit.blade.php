@extends('layouts.app')

@section('title', '| Edit district')

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-key'></i> Edit {{$item->name}}</h1>
    <br>
    {{ Form::model($item, array('route' => array('districts.update', $item->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with item data --}}

    <div class="form-group">
        {{ Form::label('name', 'item Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    <br>
    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection