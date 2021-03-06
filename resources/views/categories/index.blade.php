{{-- \resources\views\items\index.blade.php --}}
@extends('layouts.app')

@section('title', '| items')

@section('content')

<div class="col-lg-10 col-lg-offset-1">

    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>@lang('lang.Category')</th>
                    <th>@lang('lang.Operation')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td>{{ $item->name }}</td> 
                    <td>
                    <a href="{{ URL::to('categories/'.$item->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">@lang('lang.edit')</a>
                    @role('admin')
                    {!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $item->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    @endrole
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <links>{{$items}}</links>
    </div>

    <a href="{{ URL::to('categories/create') }}" class="btn btn-success">@lang('lang.Add') @lang('lang.Category')</a>

</div>

@endsection