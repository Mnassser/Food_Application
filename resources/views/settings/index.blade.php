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
                    <td>@lang('lang.about') </td> 
                    <td>@lang('lang.commission_details')</td> 
                    <td>@lang('lang.email') </td> 
                    <td>@lang('lang.phone') </td> 
                    <td>@lang('lang.facebook') </td>
                    <td>@lang('lang.whatsapp') </td> 
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <td>{{ $item->about }}</td> 
                    <td>{{ $item->commission_details }}</td> 
                    <td>{{ $item->email }}</td> 
                    <td>{{ $item->phone }}</td> 
                    <td>{{ $item->facebook }}</td>
                    <td>{{ $item->whatsapp }}</td> 
                   


                    <td>
                    <a href="{{ URL::to('settings/'.$item->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">@lang('lang.edit')</a>
                    </td>
                </tr>
                
            </tbody>
        </table>
       
    </div>


</div>

@endsection