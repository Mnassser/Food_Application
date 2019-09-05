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
                    <th>@lang('lang.image')</th>
                    <th>@lang('lang.District')</th>
                    <th>@lang('lang.Category')</th>
                    <th>@lang('lang.name')</td>
                    <th>@lang('lang.minimum_charge')</th>
                    <th>@lang('lang.delivery')</th>
                    <th>@lang('lang.phone')</th>
                    <th>@lang('lang.whatsapp')</th>
                    <th>@lang('lang.email')</th>
                    <th>@lang('lang.status')</th> 
                         <th class="btn-warning">@lang('lang.Commission')</th> 

                    
                    <th class="btn-success">@lang('lang.paid')</th>

                    <th>@lang('lang.activated')</th> 
                    @role('admin')
                    <th>@lang('lang.Operation')</th>
                    @endrole
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td><img width="50" src="{{asset('storage/'.$item->image) }}"/></td> 
                    <td>{{ $item->district->name }}</td> 
                    <td>{{ $item->category_id }}</td> 
                    <td>{{ $item->name }}</td> 
                    <td>{{ $item->minimum_charge }}</td> 
                    <td>{{ $item->delivery }}</td> 
                    <td>{{ $item->phone }}</td> 
                    <td>{{ $item->whatsapp }}</td> 
                    <td>{{ $item->email }}</td> 
                    <td>{{ $item->status }}</td> 

                    <td class="btn-warning">{{ $item->orders()->where('status', 'delevered')->sum('commission') }}</td> 

                    
                    <td class="btn-success">{{ $item->payments()->sum('paid') }}</td>

                    <td>
                      @if($item->activated == 1)
                        {!! Form::open(['method' => 'PUT', 'route' => ['resturants.update', $item->id] ]) !!}
                    {!! Form::submit('acitvated', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                      @else
                      {!! Form::open(['method' => 'PUT', 'route' => ['resturants.update', $item->id] ]) !!}
                    {!! Form::submit('deacitvated', ['class' => 'btn btn-warning']) !!}
                    {!! Form::close() !!}
                      @endif

                    </td> 
                    
                    @role('admin')
                    <td>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['resturants.destroy', $item->id] ]) !!}
                    {!! Form::submit(trans('lang.Delete'), ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                    @endrole
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<br>
 
</div>

@endsection