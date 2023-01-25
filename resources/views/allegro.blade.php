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
                    <h6 class="m-0 font-weight-bold text-primary">NAZWA</h6>
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
               
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="home" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Zdjęcie</th>
                                        <th scope="col">Dane</th>
                                        <th scope="col">Zamówione</th>
                                        <th class="text-center" scope="col">Więcej</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <!-- start-->
                                    <tr class="inner-box">
                                    
                                        <td>
                                            <div class="event-img">
                                                <img height="80"' src="https://aliness.pl/userdata/public/gfx/560.jpg" alt="" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="event-wrap">
                                                <h3><a href="#">Witamina C 1000mg</a></h3>
                                                <div class="meta">
                                                    <div class="organizers">
                                                        <a href="#">EAN 8292832232</a>
                                                    </div>
                                                    <div class="categories">
                                                        <a href="#">16 sztuk</a>
                                                    </div>
                                                 
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                        <div class="categories">
                                                        <a href="#">20 sztuk</a>
                                                    </div>
                                                    <div class="time">
                                                        <span>Dostawa 28 sztyczeń 2023'</span>
                                                    </div>
                                        </td>
                                        <td>
                                            <div class="primary-btn">
                                                <a class="btn btn-primary" href="#">Szczegóły</a>
                                            </div>
                                        </td>
                                    </tr>
                            <!-- end-->
                                  
                           
                </div>
            </div>
         
        </div>
        
    </div>
   
@endsection
