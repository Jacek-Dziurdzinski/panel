@extends('layouts.admin')
@section('main-content')
 <!-- Page Heading -->
 <h1 class="h3 mb-4 text-gray-800">{{ __('Edycja Produktu') }}</h1>

@if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if($dane->producer == 0)


@endif
@if ($dane->producer == 0)
    <div class="alert alert-warning border-left-warning" role="warning">
        <ul class="pl-4 my-2">
           
               Zarobek nie jest obliczony! Sprawdź czy uzupełnione są wszytkie pola
        
        </ul>
    </div>
@endif


<div class="row">

    <div class="col-lg-4 order-lg-2">

        <div class="card shadow mb-4">
            <div class="card-profile-image mt-4">
            <img src="{{asset('storage/'.$dane->ean.'.png')}}" width='100%'> 
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                        <h6 class="m-0 font-weight-bold text-primary">{{strtoupper($dane->producer)}}</h6><h6 class="m-0 font-weight-bold text-primary"> {{strtoupper($dane->name)}}</h6>
                        <br>
                        <h5 class="font-weight-bold">Zarobek: {{ $dane->earn}}zł</h5>
                           
                        </div>
                    </div>
                </div>

           
            </div>
        </div>

    </div>

    <div class="col-lg-8 order-lg-1">

        <div class="card shadow mb-4">

            

            <div class="card-body">

        


                    <h6 class="heading-small text-muted mb-4">Informacje o produkcie</h6>

          
                  
<form action="{{ route('products.update')}}" method="POST">
    
    @csrf               
    <table style="width:100%">
    <tr>

    <td style="width:200px"><label class="form-control-label">Producent</label></td>
    <td>  <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='producer'>
    @if(!empty($dane->producer))<option  value='{{$dane->producers->id}}' selected>{{$dane->producers->name}}</option>@endif  
    @if(empty($dane->producer))<option selected>Wybierz...</option>@endif
        @foreach($producers as $value)
        <option  value='{{$value["id"]}}'>{{$value["name"]}}</option>
        @endforeach
      </select></td>

  </tr>
    <tr>
    <td><label class="form-control-label">Nazwa</label></td>
    <td><input type="text" name='name'  size="2" class="form-control bg-light border-0 small" placeholder="{{$dane->name}}" value="{{$dane->name}}"></td>

  </tr>
  <tr>
    <td><label class="form-control-label">EAN</label></td>
    <td><input type="text" name='ean'  size="2" class="form-control bg-light border-0 small" placeholder="{{$dane->ean}}" value="{{$dane->ean}}"></td>
 
  </tr>
  <tr>
    <td><label class="form-control-label" >Ilość</label></td>
    <td><input type="text" name='stock'  size="2" class="form-control bg-light border-0 small" placeholder="{{$dane->stock}}" value="{{$dane->stock}}"></td>
 
  </tr>
  <tr>
    <td><label class="form-control-label">Cena zakupu (netto)</label></td>
    <td><input type="text" name='buy_price'  size="2" class="form-control bg-light border-0 small" placeholder="{{$dane->buy_price}}" value="{{$dane->buy_price}}"></td>
 
  </tr>
  <tr>
    <td><label class="form-control-label">Rabat</label></td>
    <td><input type="text" name='discount'  size="2" class="form-control bg-light border-0 small" placeholder="{{$dane->discount}}" value="{{$dane->discount}}"></td>
 
  </tr>
  

</table>
<br>
<h6 class="heading-small text-muted mb-4">Informacje o sprzedaży</h6>
<table style="width:100%">

<tr>
<td style="width:200px"><label class="form-control-label">Numer Oferty</label></td>
<td ><a href="https://allegro.pl/oferta/{{$dane->offers->offer_id}}">Pokaż ofertę</a><input type="text" name='offer_id'  size="2" class="form-control bg-light border-0 small" placeholder="{{$dane->offers->offer_id}}" value="{{$dane->offers->offer_id}}"></td>
 
  </tr>
<tr>
<td><label class="form-control-label">Cena sprzedaży (brutto)</label></td>
<td><input type="text" name='sell_price'  size="2" class="form-control bg-light border-0 small" placeholder="{{$dane->offers->sell_price}}" value="{{$dane->offers->sell_price}}"></td>
 
  </tr>
  <tr>
<td><label class="form-control-label">Promowanie</label></td>
<td>  <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='promotion'>
      @if($dane->offers->promotion == true)<option value='1' selected>TAK</option><option value='0'>NIE</option>@endif
      @if($dane->offers->promotion == false)<option value='0' selected>NIE</option><option value='1'>TAK</option>@endif
     
      </select></td>

  </tr>
  <tr>
<td><label class="form-control-label">Monety</label></td>
<td>  <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='coins'>
@if($dane->offers->coins == 0)<option selected>0</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>@endif
@if($dane->offers->coins == 1)<option>0</option><option selected>1</option><option>2</option><option>3</option><option>4</option><option>5</option>@endif
@if($dane->offers->coins == 2)<option>0</option><option>1</option><option selected>2</option><option>3</option><option>4</option><option>5</option>@endif
@if($dane->offers->coins == 3)<option>0</option><option>1</option><option >2</option><option selected>3</option><option>4</option><option>5</option>@endif
@if($dane->offers->coins == 4)<option>0</option><option>1</option><option >2</option><option>3</option><option selected>4</option><option>5</option>@endif
@if($dane->offers->coins == 5)<option>0</option><option>1</option><option >2</option><option>3</option><option>4</option><option selected>5</option>@endif



</select></td>

  </tr>
</table>
<br>
<button class="btn btn-success" type="submit">Zapisz zmiany</button>


@endsection
