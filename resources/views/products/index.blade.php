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
                    <th>items</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td><img width="50" src="{{asset('storage/'.$item->image) }}"/></td> 
                    <td>{{ $item->name }}</td> 
                    <td>
                    
                    {!! Form::open(['method' => 'DELETE', 'route' => ['products.destroy', $item->id] ]) !!}
                    {!! Form::submit(trans('lang.Delete'), ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</div>

@endsection