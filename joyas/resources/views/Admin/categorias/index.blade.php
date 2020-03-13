@section('content')
    @extends('layouts.app')  
	<h2>Categorias</h2>
	<div class="alert alert-success alert-block " style=''>
		<button type="button" class="close" data-dismiss="alert">×</button>	
	        <strong>Hola</strong>
	</div>
	<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#mod_Cat_create">
		<i class="fa fa-plus-square" style="font-size:15px"></i>
    	Nuevo
  	</button>  	
  	<hr>
  	
	<div class="table-responsive">
		<table class="table table-sm">
		    <thead class="thead-dark">
		      <tr>
		        <th>ID</th>
		        <th>CATEGORIA</th>	
		        <th>ACCIONES</th>			        
		      </tr>
		    </thead> 
		    <tbody>
		    	@foreach($categorias as $cat)
			        <tr>
			           <td>{{$cat->id}}</td>
			           <td>{{$cat->categoria}}</td>	
			           <td>
			           		<a class="btn btn-warning btn-sm" href="#"><i class="fa fa-edit" style="font-size:15px" data-toggle="modal" data-target="#mod_Cat_edit{{ $cat->id }}"></i></a>
			           		<a class="btn btn-danger btn-sm" href="#"><i class="material-icons" style="font-size:15px; color:black">delete_forever</i></a>
			           </td>		

			        </tr>
			        <!-- Modal para editar -->
					  <div class="modal fade" id="mod_Cat_edit{{ $cat->id }}">
					    <div class="modal-dialog">
					      <div class="modal-content">
					      
					        <!-- Modal Header -->
					        <div class="modal-header">
					          <h4 class="modal-title">Categorias/Editar({{$cat->categoria}})</h4>					          				         
					          <button type="button" class="close" data-dismiss="modal">&times;</button>
					        </div>					        
					        <!-- Modal body -->
					        
					        	@csrf
						        <div class="modal-body">            
								    <div class="form-group">
								      <label for="name">Categoria:</label>
								      <input type="input" class="form-control" placeholder="Introduzca nombre de la categoria" id="categoria{{$cat->id}}" name="categoria" value="{{ $cat->categoria }}" required>
								    </div>				
						        </div>						        
						        <!-- Modal footer -->
						        <div class="modal-footer">
						        	<a href="#" class="btn btn-primary btn-sm " onclick="guardar({{$cat->id}});" data-dismiss="modal">Guardar</a>   
						          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
						        </div>
					      
					        
					      </div>
					    </div>
					  </div>
			    @endforeach					        
		    </tbody>
		 </table>
		 {{ $categorias->links() }}				
	</div>		
	     



	<!-- Modal para altas -->
	  <div class="modal fade" id="mod_Cat_create">
	    <div class="modal-dialog">
	      <div class="modal-content">
	      
	        <!-- Modal Header -->
	        <div class="modal-header">
	          <h4 class="modal-title">Categorias/Altas</h4>
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        
	        <!-- Modal body -->
	        <form action="{{ route('categorias.store') }}">
	        	@csrf
		        <div class="modal-body">            
				    <div class="form-group">
				      <label for="name">Categoria:</label>
				      <input type="text" class="form-control" placeholder="Introduzca nombre de la categoria" id="categoria" name="categoria" required>
				    </div>				
		        </div>
		        
		        <!-- Modal footer -->
		        <div class="modal-footer">
		          <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
		          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
		        </div>
	        </form>
	        
	      </div>
	    </div>
	  </div>	 

	 
@endsection