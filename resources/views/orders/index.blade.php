@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">

      <div class="col-lg-12 col-sm-12">
        <strong><h1>orders</h1></strong>
        <hr>
      </div>
    </div>
  </div>
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table Witd Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                
                <tbody>
      
                
                <tr role="row" class="odd">
                  <th class="sorting_1">Client_name</th>
                  <th>Resto_name</th>
                  <th>Address</th>
                  
                  <th>Total_price</th>
                  <th>additional_cost</th>
                  <th>payment</th>
                  <th>Rstatus</th>
                  <th>Cstatus</th>
                  <th>notes</th>
                  <th>Commission</th>
                  <th>Created_at</th>
                </tr>
              @foreach($orders as $order)
                <tr role="row" class="even">
                  <td>{{$order->client->name}}</td>
                  <td>{{$order->restaurant->name}}</td>
                  <td>{{$order->address}}</td>
                  
                  <td>{{$order->total_price}}</td>
                  <td>{{$order->additional_cost}}</td>
                  <td>{{$order->payment}}</td>
                  <td>{{$order->status}}</td>
                  <td>{{$order->Cstatus}}</td>
                  <td>{{$order->notes}}</td>
                  <td>{{$order->commission}}</td>
                  <td>{{$order->created_at}}</td>
                </tr>
                    @endforeach
                </tr></tbody>
               
              </table>
             <br>
             <links>{{$orders}}</links>
            </div>
           
@endsection
