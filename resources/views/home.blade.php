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
 
    @if (isset($alert))
        <div class="alert alert-danger border-left-danger" role="alert">
            {{ $alert }}
        </div>
    @endif


DODAĆ SUMOWANIE DNIA

{{var_dump($suma);}}
            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">ZAMÓWIENIA</h6>
                </div>
                <div class="card-body">
                 
               
           

 



<div class="event-schedule-area-two bg-color pad100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
               
            </div>
            <!-- /.col end-->
        </div>
        <!-- row end-->
        <div class="row">
            <div class="col-lg-12">
               
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
                                    
                                              
                                                    <th scope="col">Nazwa</th>
                                                    <th scope="col">Zarobek</th>
                                                    <th scope="col">Data</th>
                                                    <th class="text-center" scope="col">Więcej</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                    
                                                 <!-- start-->
                                                 
                                                 @foreach($orders ?? [] as $order)
                                                <tr class="inner-box">
                                              
                                                
                                           
                                                    <td>
                                                        <div class=".fs-6">
                                                            <h4>{{$order->buyer}}</h4>
                                                            <div class="meta">
                                                                </td>
                                                                <td>
                                                                <div class="categories">
                                                                    {{$order->offer}}zł
                                                                </div>
                                                                </td>
                                                                <td>
                                                                <div class="categories">
                                                                   {{$order->buy_time}}
                                                                </div>
                                                                </td>
                                                            </div>
                                                        </div>
                                                    </td>
                                                   
                                                    <td>
                                                      
                                                        <div class="primary-btn">
                                                        <a class="btn btn-info" href="{{  $order->id}}">Szczegóły</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                        <!-- end-->
                                        @endforeach
                                        </tbody>
                                        </table>
                                    </div>
                                  
                                 </div>
                     
                             </div>
                        </div>
        
    </div>
   
@endsection
