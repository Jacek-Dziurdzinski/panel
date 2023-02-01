@extends('layouts.admin')
@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Panel') }}</h1>

    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
 

    
            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">PRODUKTY Z BAZY DANYCH </h6>
                    <a href="{{ route('products.settings')}}">USTAWIENIA</a> 
                
                </div>
                <div class="card-body">
                 

                


<div class="event-schedule-area-two bg-color pad100">
    
     
        <!-- row end-->
        <div class="row">
            <div class="col-lg-12">
        
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="home" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Zdjęcie</th>
                                        <th scope="col">Producent</th>
                                        <th scope="col">Nazwa</th>
                                        <th scope="col">Ilość</th>
                                        <th scope="col">Cena Zakupu</th>
                                        <th class="text-center" scope="col">Więcej</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <!-- start-->
                                     @foreach($dane ?? [] as $products)
                                    <tr class="inner-box">
                                    
                                        <td>
                                            <div class="event-img">
                                                <img height="40"' src='' alt="" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class=".fs-6">
                                                <h4>{{$products['manufacturer']}}</h4>
                                                <div class="meta">
                                                </td>
                                        <td>
                                            <div class=".fs-6">
                                                <h4>{{$products['name']}}</h4>
                                                <div class="meta">
                                                    </td>
                                                    <td>
                                                    <div class="categories">
                                                       {{$products["stock"]}} sztuk
                                                        @if($products["stock"] <'2')
                                                        <i class="fa fa-exclamation-triangle tip_trigger"></i>
                                                        @endif
                                                    </div>
                                                    </td>
                                                    <td>
                                                    <div class="categories">
                                                       {{$products["buy_price"]}} zł
                                                    </div>
                                                    </td>
                                                </div>
                                            </div>
                                        </td>
                                       
                                        <td>
                                          
                                            <div class="primary-btn">
                                            <a class="btn btn-info" href="{{ route('products.show', ['product' => $products['ean']])}}">Szczegóły</a>
                                            </div>
                                        </td>
                                    </tr>
                            <!-- end-->
                            @endforeach
                           
                </div>
            </div>
         
        </div>
        
   
   
@endsection