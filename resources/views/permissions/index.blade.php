{{-- \resources\views\permissions\index.blade.php --}}
@extends('layouts.app')

@section('title', '| Permissions')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
    <h1><i class="fa fa-key"></i>@lang('lang.permissions') @lang('lang.Available')

    <a href="{{ route('users.index') }}" class="btn btn-default pull-right">@lang('lang.users')</a>
    <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">@lang('lang.roles')</a></h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>@lang('lang.permissions')</th>
                    <th>@lang('lang.Operation')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td> 
                    <td>
                    <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">@lang('lang.edit')</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
                    {!! Form::submit(trans('lang.Delete'), ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ URL::to('permissions/create') }}" class="btn btn-success">@lang('lang.Add') @lang('lang.permission')</a>

</div>

@endsection