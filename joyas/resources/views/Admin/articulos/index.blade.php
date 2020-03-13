@section('content')
    @extends('layouts.app')   
	<h2>Articulos</h2> 
	<a href="{{route('articulos.create')}}" type="button" class="btn btn-success btn-sm"> Nuevo</a>
	<div class="table-responsive">
		<table class="table table-sm">
		    <thead class="thead-dark">
		      <tr>
		        <th>ID</th>
		        <th>NOMBRE</th>
		        <th>DESCRIPCIÓN</th>
		        <th>MARCA</th>
		      </tr>
		    </thead> 
		    <tbody>
		    	@foreach($articulos as $art)
			        <tr>
			           <td>$art->id</td>
			           <td>$art->nombre</td>
			           <td>$art->descripcion</td>
			           <td>$art->marca</td>
			        </tr>
			    @endforeach					        
		    </tbody>
		 </table>
		 {{ $articulos->links() }}				
	</div>		
    	
@endsection