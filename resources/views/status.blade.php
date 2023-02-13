@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Status</h1>

    <div class="row">

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <!-- API OK -->

      @foreach($accounts as $account) 
      @if($account->api_token == NULL)
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">{{$account->name}} - Nie połączony</div>
                           
                            <a class="btn btn-primary" href="https://allegro.pl/auth/oauth/authorize?response_type=code&client_id=f299351b2f26486a81911465c91e923c&redirect_uri=https://panel.3sell.pl/allegro_api" role="button">Autoryzuj</a>

                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{$account->name}} - Połączony</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">OD: {{$account->updated_at}}</div>
                        

                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endforeach
        
     

        <div class="container mt-4">

</DIV>   
     
         
        

<div class="container mt-4">
<div class="card">
<div class="card-body">
<form name="employee" id="employee" method="post" action="{{url('status')}}">
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
