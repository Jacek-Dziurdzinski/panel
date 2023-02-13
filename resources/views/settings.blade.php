@extends('layouts.admin')
@section('main-content')
 <!-- Page Heading -->
 <h1 class="h3 mb-4 text-gray-800">{{ __('Ustawienia Produktów') }}</h1>

@if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger border-left-danger" role="alert">
        <ul class="pl-4 my-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="row">

    <div class="col-lg-4 order-lg-2">

        <div class="card shadow mb-4">
            <div class="card-profile-image mt-4">
                <figure class="rounded-circle avatar avatar font-weight-bold" style="font-size: 60px; height: 180px; width: 180px;" data-initial="{{ Auth::user()->name[0] }}"></figure>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                    
                           
                        </div>
                    </div>
                </div>

           
            </div>
        </div>

    </div>

    <div class="col-lg-8 order-lg-1">

        <div class="card shadow mb-4">

         
            <div class="card-body">

     


                 
            <h6 class="heading-small text-muted mb-4">Rabat producenta</h6>
                

<form action="{{ route('settings.update')}}" method="POST">
    
    @csrf               
    <table style="width:100%">
    @foreach($producers as $producer)
 
    <tr>
    <td><label class="form-control-label">{{$producer->name}}</label></td>
    <td><input type="text" name="{{$producer->id}}"  size="2" class="form-control bg-light border-0 small" placeholder="{{$producer->discount}}%" value="{{$producer->discount}}"></td>
    </tr>
  @endforeach
  
</table>

<h6 class="heading-small text-muted mb-4">Monety allegro</h6>
<table style="width:100%">
<tr>
    <td><label class="form-control-label">1 Moneta</label></td>
    <td><input type="text" name="one_coin_from"  size="2" class="form-control bg-light border-0 small" placeholder="1.00" value="1.00"><input type="text" name="one_coin_to"  size="2" class="form-control bg-light border-0 small" placeholder="29.99" value="29.99"></td>
    </tr>
    <tr>
    <td><label class="form-control-label">2 Monety - nie działa</label></td>
    <td><input type="text" name="two_coin_from"  size="2" class="form-control bg-light border-0 small" placeholder="30.00" value="30.00"><input type="text" name="two_coin_to"  size="2" class="form-control bg-light border-0 small" placeholder="200.00" value="200.00"></td>
    </tr>
</table>
<br>

<button class="btn btn-success" type="submit">Zapisz zmiany</button>


@endsection
