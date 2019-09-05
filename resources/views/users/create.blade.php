{{-- \resources\views\users\create.blade.php --}}
@extends('layouts.app')

@section('title', '| Add User')

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> Add User</h1>
    <hr>

    {{ Form::open(array('url' => 'users')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', '', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', '', array('class' => 'form-control')) }}
    </div>

    <div class='form-group'>
        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
    </div>

    <div class="form-group">
        {{ Form::label('password', 'password' )}}<br>
        {{ Form::password('password', array('class' => 'form-control')) }}

    </div>

    <div class="form-group">
        {{ Form::label('cofirm Password', 'Confirm Password') }}<br>
        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

    </div>

    {{ Form::submit(trans('lang.Add'), array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection