@extends('layouts.app')

@section('content')
@inject('orders', 'App\Models\Order')
@inject('clients', 'App\Models\Client')
@inject('restaurant', 'App\Models\Restaurant')
@inject('offers', 'App\Models\Offer')
@inject('products', 'App\Models\Product')
@inject('settings', 'App\Models\Setting')
@inject('cities', 'App\Models\City')
@inject('districts', 'App\Models\District')
@inject('categories', 'App\Models\Category')
        <div class="col-lg-5 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$orders->count()}}</h3>

                 
               <h2>@lang('lang.Orders')</h2>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="orders" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-5 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$offers->count()}}</h3>

              <h2>@lang('lang.Offers')</h2>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="offers" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-5 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$clients->count()}}</h3>

              <h2>@lang('lang.Clients')</h2>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="clients" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-5 col-xs-6">
                 <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$restaurant->count()}}</h3>

              <h2>@lang('lang.Restaurant')</h2>
            </div>
            <div class="icon">
              <i class="fas fa-utensils"></i>
            </div>
            <a href="resturants" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

          <div class="col-lg-5 col-xs-6">
                 <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>{{$products->count()}}</h3>

              <h2>@lang('lang.Products')</h2>
            </div>
            <div class="icon">
              <i class="fas fa-hamburger"></i>
            </div>
            <a href="products" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-5 col-xs-6">
                 <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3>{{$settings->count()}}</h3>

              <h2>@lang('lang.Settings')</h2>
            </div>
            <div class="icon">
              <i class="fas fa-cogs"></i>
            </div>
            <a href="settings" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
         <div class="col-lg-5 col-xs-6">
                 <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$cities->count()}}</h3>

              <h2>@lang('lang.Cities')</h2>
            </div>
            <div class="icon">
              <i class="fas fa-city"></i>
            </div>
            <a href="cities" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

         <div class="col-lg-5 col-xs-6">
                 <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$districts->count()}}</h3>

              <h2>@lang('lang.Districts')</h2>
            </div>
            <div class="icon">
              <i class="fas fa-swatchbook"></i>
            </div>
            <a href="districts" class="small-box-footer">More info <i class="fa fa-arrow-circle-right-danger"></i></a>
          </div>
        </div>
        <!-- ./col -->

         <div class="col-lg-5 col-xs-6">
                 <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>{{$categories->count()}}</h3>

              <h2>@lang('lang.Categoires')</h2>
            </div>
            <div class="icon">
              <i class="fas fa-tags"></i>
            </div>
            <a href="categories" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->


@endsection
