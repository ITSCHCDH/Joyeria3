@section('content')
    @extends('layouts.app')
    <div class="row">
    	<div class="col-md-2"></div>
    	<div class="col-md-8">
    		<h2>Usuarios</h2> 
    		<a href="{{route('registro')}}" type="button" class="btn btn-success btn-sm"> Nuevo</a>
    		<div class="table-responsive">
	    		<table class="table table-sm">
				    <thead class="thead-dark">
				      <tr>
				        <th>ID</th>
				        <th>NOMBRE</th>
				        <th>CORREO ELECTRONICO</th>
				      </tr>
				    </thead> 
				    <tbody>
				    	@foreach($usuarios as $us)
					        <tr>
					           <td>{{$us->id}}</td>
					           <td>{{$us->name}}</td>
					           <td>{{$us->email}}</td>
					        </tr>
					    @endforeach					        
				    </tbody>
				 </table>
				 {{ $usuarios->links() }}				
			</div>		
    	</div>
    	<div class="col-md-2"></div>
    </div>    
@endsection