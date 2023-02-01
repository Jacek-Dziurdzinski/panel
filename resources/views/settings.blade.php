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

            <div class="card-header py-3">
           
                <h6 class="m-0 font-weight-bold text-primary">Rabat producenta</h6>
            </div>

            <div class="card-body">

        


                 

                

<form action="{{ route('settings.update')}}" method="POST">
    
    @csrf               
    <table style="width:100%">
    @foreach($dane as $producent)
    <tr>
    <td><label class="form-control-label">{{$producent['manufacturer']}}</label></td>
    <td><input type="text" name="{{$producent['manufacturer']}}"  size="2" class="form-control bg-light border-0 small" placeholder="{{$producent['discount']}}%" value="{{$producent['discount']}}"></td>
    </tr>
  @endforeach
  
</table>
<br>
<button class="btn btn-success" type="submit">Zapisz zmiany</button>


@endsection
