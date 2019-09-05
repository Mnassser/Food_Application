{{-- \resources\views\roles\index.blade.php --}}
@extends('layouts.app')

@section('title', '| Roles')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
    <h1><i class="fa fa-key"></i> @lang('lang.roles')

    <a href="{{ route('users.index') }}" class="btn btn-default pull-right">@lang('lang.users')</a>
    <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">@lang('lang.permissions')</a></h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>@lang('lang.role')</th>
                    <th>@lang('lang.permissions')</th>
                    <th>@lang('lang.Operation')</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                <tr>

                    <td>{{ $role->name }}</td>

                    <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                    <td>
                    <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">@lang('lang.edit')</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                    {!! Form::submit(trans('lang.Delete'), ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{ URL::to('roles/create') }}" class="btn btn-success">@lang('lang.Add') @lang('lang.role')</a>

</div>

@endsection