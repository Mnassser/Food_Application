{{-- \resources\views\items\create.blade.php --}}
@extends('layouts.app')

@section('title', '| Create item')

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-key'></i> Add district</h1>
    <br>

    {{ Form::open(array('url' => 'districts')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', '', array('class' => 'form-control')) }}
    </div><br>
    @if(!$items->isEmpty()) //If no items exist yet
        <h4>Assign item to items</h4>
        <select name="city_id">
        @foreach ($items as $item) 
            <option value="{{$item->id}}">
                {{$item->name}}
            </option>
        @endforeach
        </select>
    @endif
    <br>
    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection