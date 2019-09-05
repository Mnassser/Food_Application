@extends('layouts.app')

@section('content')
<div class="box">
            <div class="box-header">
              <h1>Products</h1>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<div class="row">
<div class="col-lg-4 col-md-4 col-sm-4">
	<table id="example2" class="table table-bordered table-hover">
                <tr>
                	
                	<th>@lang('lang.Restaurant')</th>
                  <th>@lang('lang.image')</th>
                  <th>@lang('lang.name')</th>
                  <th>@lang('lang.description')</th>
                  <th>@lang('lang.start')</th>
                  <th>@lang('lang.end')</th>
                	
                </tr>
               
                	@foreach($items as $item)
                <tr>	
              
                	
                  
                 <td>{{$item->restaurant->name}}</td>
                  <td>{{$item->image}}</td>
                  <td>{{$item->name}}</td>
                  <td>{{$item->description}}</td>
                  <td>{{$item->start}}</td>
                  <td>{{$item->end}}</td>
                </tr>
                  
                @endforeach
              </table>
          <links>{{$items}}</links>
          </div>
      </div>
  </div>
</div>

@endsection