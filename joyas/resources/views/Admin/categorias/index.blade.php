@section('content')
    @extends('layouts.app')  
	<h2>Categorias</h2>
	
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
			           		<a class="btn btn-warning btn-sm" href="#" data-toggle="modal" data-target="#modalEdit" onclick="editar_articulo({{$cat}})"><i class="fa fa-edit" style="font-size:15px" ></i></a>
			           		<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modalUndo" onclick="undo_articulo({{$cat}})"><i class="material-icons" style="font-size:15px; color:black">delete_forever</i></a>
			           </td>
			        </tr>			       
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


	 <!-- Modal para editar -->
	  <div class="modal fade" id="modalEdit">
	    <div class="modal-dialog">
	      <div class="modal-content">
	      
	        <!-- Modal Header -->
	        <div class="modal-header">
	          <h4 class="modal-title" id="textCabecera">Categorias/Edit</h4>	          				         
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>		       				        
	        <!-- Modal body -->
	        <form id="formEditar">
	        	@csrf
		        <div class="modal-body">            
				    <div class="form-group">
				      <label for="name">Categoria:</label>
				      <input type="input" class="form-control" placeholder="Introduzca nombre de la categoria" id="cat" name="categoria"  required>
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

	   <!-- Modal para eliminar -->
	  <div class="modal fade" id="modalUndo">
	    <div class="modal-dialog">
	      <div class="modal-content">
	      
	        <!-- Modal Header -->
	        <div class="modal-header">
	          <h4 class="modal-title" id="textCabecera">Categorias/Eliminar</h4>	          				         
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>		       				        
	        <!-- Modal body -->
	        <form action="{{ route('categorias.eliminar',$cat->id) }}">
	        	@csrf
		        <div class="modal-body">            
				    <div class="form-group">
				      <label for="name" id="msgEliminar">Esta seguro de eliminar la categoria: </label>
				    </div>				
		        </div>						        
		        <!-- Modal footer -->
		        <div class="modal-footer">
		        	<button type="submit" class="btn btn-danger btn-sm">Eliminar</button>  
		            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancelar</button>
		        </div>    
		    </form>    
	      </div>
	    </div>
	  </div>
	<script>
	  //Script que toma los datos de la tabla y los envia al modal pra ser editados    
        function editar_articulo(n)
        {
            var text,text2,r;
            text="";
            text2="";
            console.log(n);//Este comando envia datos a la consola del navegador para poder observar que esta pasando
            document.getElementById("cat").value = n["categoria"];
            text= $("#textCabecera").text();
            text2=text+"("+n["categoria"]+")";            
            $("#textCabecera").text(text2);
            r=n["id"];
            $('#formEditar').attr('action', '{{ route("categorias.actualizar",'r') }}');
            
        }

        function undo_articulo(n)
        {   
            var text,text2;
            text="";
            text2="";
            console.log(n);//Este comando envia datos a la consola del navegador para poder observar que esta pasando            
            text= $("#msgEliminar").text();
            text2=text+n["categoria"];            
            $("#msgEliminar").text(text2);             
        }
    </script>
@endsection