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
                    <th>@lang('lang.District')</th>
                    <th>@lang('lang.name')</td>
                    <th>@lang('lang.email')</th>
                    <th>@lang('lang.phone')</th>
                    <th>@lang('lang.image')</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    
                   <td>{{$item->district->name}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->phone}}</td>
                    
                    
                    <td><img width="50" src="{{asset('storage/'.$item->image) }}"/></td> 
                   @role('admin')
                    <td>
                    
                    {!! Form::open(['method' => 'DELETE', 'route' => ['clients.destroy', $item->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                    @endrole
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</div>

@endsection