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
                        <h5 class="font-weight-bold">Zarobek: {{  $dane[1]['earn']}}zł</h5>
                           
                        </div>
                    </div>
                </div>

           
            </div>
        </div>

    </div>

    <div class="col-lg-8 order-lg-1">

        <div class="card shadow mb-4">

            <div class="card-header py-3">
           
                <h6 class="m-0 font-weight-bold text-primary">{{strtoupper($dane[0]['manufacturer'])}} {{strtoupper($dane[0]['name'])}}</h6>
            </div>

            <div class="card-body">

        


                    <h6 class="heading-small text-muted mb-4">Informacje o produkcie</h6>

          
                  
<form action="{{ route('products.update')}}" method="POST">
    
    @csrf               
    <table style="width:100%">
    <tr>
    <td style="width:200px"><label class="form-control-label">Producent</label></td>
    <td>  <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='manufacturer'>
      @if(empty($dane[0]["manufacturer"]))<option selected>Wybierz...</option>@endif
      @if(!empty($dane[0]["manufacturer"]))<option selected>{{$dane[0]["manufacturer"]}}</option>@endif
        @foreach($manufacturer as $value)
        <option  value='{{$value["manufacturer"]}}'>{{$value["manufacturer"]}}</option>
    @endforeach
      </select></td>

  </tr>
    <tr>
    <td><label class="form-control-label">Nazwa</label></td>
    <td><input type="text" name='name'  size="2" class="form-control bg-light border-0 small" placeholder="{{$dane[0]['name']}}" value="{{$dane[0]['name']}}"></td>

  </tr>
  <tr>
    <td><label class="form-control-label">EAN</label></td>
    <td><input type="text" name='ean'  size="2" class="form-control bg-light border-0 small" placeholder="{{$dane[0]['ean']}}" value="{{$dane[0]['ean']}}"></td>
 
  </tr>
  <tr>
    <td><label class="form-control-label" >Ilość</label></td>
    <td><input type="text" name='stock'  size="2" class="form-control bg-light border-0 small" placeholder="{{$dane[0]['stock']}}" value="{{$dane[0]['stock']}}"></td>
 
  </tr>
  <tr>
    <td><label class="form-control-label">Cena zakupu (netto)</label></td>
    <td><input type="text" name='buy_price'  size="2" class="form-control bg-light border-0 small" placeholder="{{$dane[0]['buy_price']}}" value="{{$dane[0]['buy_price']}}"></td>
 
  </tr>
  <tr>
    <td><label class="form-control-label">Rabat</label></td>
    <td><input type="text" name='discount'  size="2" class="form-control bg-light border-0 small" placeholder="{{$dane[0]['discount']}}" value="{{$dane[0]['discount']}}"></td>
 
  </tr>
  

</table>
<br>
<h6 class="heading-small text-muted mb-4">Informacje o sprzedaży</h6>
<table style="width:100%">

<tr>
<td style="width:200px"><label class="form-control-label">Numer Oferty</label></td>
<td ><a href="https://allegro.pl/oferta/{{$dane[0]['offer_id']}}">Pokaż ofertę</a><input type="text" name='offer_id'  size="2" class="form-control bg-light border-0 small" placeholder="{{$dane[0]['offer_id']}}" value="{{$dane[0]['offer_id']}}"></td>
 
  </tr>
<tr>
<td><label class="form-control-label">Cena sprzedaży (brutto)</label></td>
<td><input type="text" name='sell_price'  size="2" class="form-control bg-light border-0 small" placeholder="{{$dane[0]['sell_price']}}" value="{{$dane[0]['sell_price']}}"></td>
 
  </tr>
  <tr>
<td><label class="form-control-label">Promowanie</label></td>
<td>  <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='promotion'>
      @if($dane[0]['promotion'] == true)<option value='1' selected>TAK</option><option value='0'>NIE</option>@endif
      @if($dane[0]['promotion'] == false)<option value='0' selected>NIE</option><option value='1'>TAK</option>@endif
     
      </select></td>

  </tr>
  <tr>
<td><label class="form-control-label">Monety</label></td>
<td>  <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='coins'>
@if($dane[0]['coins'] == 0)<option selected>0</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>@endif
@if($dane[0]['coins'] == 1)<option>0</option><option selected>1</option><option>2</option><option>3</option><option>4</option><option>5</option>@endif
@if($dane[0]['coins'] == 2)<option>0</option><option>1</option><option selected>2</option><option>3</option><option>4</option><option>5</option>@endif
@if($dane[0]['coins'] == 3)<option>0</option><option>1</option><option >2</option><option selected>3</option><option>4</option><option>5</option>@endif
@if($dane[0]['coins'] == 4)<option>0</option><option>1</option><option >2</option><option>3</option><option selected>4</option><option>5</option>@endif
@if($dane[0]['coins'] == 5)<option>0</option><option>1</option><option >2</option><option>3</option><option>4</option><option selected>5</option>@endif



</select></td>

  </tr>
</table>
<br>
<button class="btn btn-success" type="submit">Zapisz zmiany</button>


@endsection
