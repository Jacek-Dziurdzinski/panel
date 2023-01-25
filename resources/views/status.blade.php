@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Status</h1>

   

    <div class="row">

        
        <!-- API OK -->

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Allegro API 3SELL - Połączony</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">23.01.2023 11:00</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      @foreach($accounts as $account) 
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            @if($account->token == NULL)
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">{{$account->name}} - Nie połączony</div>
                            @else
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{$account->name}} - Połączony</div>
                            @endif
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$account->updated_at}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
        
     

        <div class="container mt-4">

</DIV>   
     
         
        

<div class="container mt-4">
<div class="card">
<div class="card-body">
<form name="employee" id="employee" method="post" action="{{url('allegro')}}">
{{ csrf_field() }} 
<div class="form-group">
<label for="exampleInputEmail1">Nazwa</label>
<input type="text" id="name" name="name" class="form-control">
</div>        
<div class="form-group">
<label for="exampleInputEmail1">Client ID</label>
<input type="text" id="client" name="client" class="form-control">
</div>        
<div class="form-group">
<label for="exampleInputEmail1">Client Secret</label>
<input type="text" id="secret" name="secret" class="form-control">
</div>        
<button type="submit" class="btn btn-primary">Dodaj</button>
</form>
</div>
</div>
</div>  


  <div>
@endsection
