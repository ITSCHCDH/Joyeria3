@section('content')
    @extends('layouts.app')
    <div class="row">
    	<div class="col-md-2"></div>
    	<div class="col-md-8">
    		<h2>Categorias</h2> 
    		<a href="{{route('articulos.create')}}" type="button" class="btn btn-success btn-sm"> Nuevo</a>
    		<div class="table-responsive">
	    		<table class="table table-sm">
				    <thead class="thead-dark">
				      <tr>
				        <th>ID</th>
				        <th>NOMBRE</th>				        
				      </tr>
				    </thead> 
				    <tbody>
				    	@foreach($categorias as $cat)
					        <tr>
					           <td>$cat->id</td>
					           <td>$cat->nombre</td>					          
					        </tr>
					    @endforeach					        
				    </tbody>
				 </table>
				 {{ $categorias->links() }}				
			</div>		
    	</div>
    	<div class="col-md-2"></div>
    </div>
@endsection