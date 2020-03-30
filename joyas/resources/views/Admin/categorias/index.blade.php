@section('content')
    @extends('layouts.app')  
	<h2>Categorias</h2>
	
	<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modCreate">
		<i class="fa fa-plus-square" style="font-size:15px"></i>
    	Nuevo
  	</button>  	
  	<hr>
  	<input class="form-control pull-right form-control-sm" id="inpBuscar" type="text" placeholder="Buscar.." style="width: 200px;">
	<div class="table-responsive">
		<br>
		<table class="table table-sm" id="mitabla">
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
			           		<a class="btn btn-warning btn-sm" href="#" data-toggle="modal" data-target="#modalEdit" onclick="edit({{$cat}},'{{ route('categorias.actualizar',$cat->id) }}')"><i class="fa fa-edit" style="font-size:15px" ></i></a>
			           		<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modalUndo" onclick="undo({{$cat}},'{{ route('categorias.eliminar',$cat->id) }}')"><i class="material-icons" style="font-size:15px; color:black">delete_forever</i></a>
			           </td>
			        </tr>			       
			    @endforeach					        
		    </tbody>
		 </table>
		 {{ $categorias->links() }}				
	</div>		
	     



	<!-- Modal para altas -->
	  <div class="modal fade" id="modCreate">
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
	          <h4 class="modal-title" id="textCabUpd"></h4>	          				         
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
	          <h4 class="modal-title" id="textCabUnd"></h4>	          				         
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>		       				        
	        <!-- Modal body -->
	        <form id="formEliminar">
	        	@csrf
		        <div class="modal-body">            
				    <div class="form-group">
				      <label for="name" id="msgEliminar"></label>
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
        function edit(n,r)
        {                            
            //console.log(r);//Este comando envia datos a la consola del navegador para poder observar que esta pasando
            document.getElementById("cat").value = n["categoria"];           
            txt="Categorias/Editar"+"("+n["categoria"]+")";            
            $("#textCabUpd").text(txt);           
            $('#formEditar').attr('action', r);            
        }

        function undo(n,r)
        {                            
            txt="Categorias/Eliminar"+"("+n["categoria"]+")"; //Creamos la cadena que aparecera en la cabecera del modal     
            txt2 ="Esta seguro de eliminar la categoria: "+n["categoria"];    
            $("#textCabUnd").text(txt);
            $("#msgEliminar").text(txt2);           
            $('#formEliminar').attr('action', r);            
        }
    </script>

    <script>
    	 //Codigo que busca dentro de la tabla 	    
	    $(document).ready(function(){
		    $("#inpBuscar").on("keyup", function() {
		        var value = $(this).val().toLowerCase();
		        $("#mitabla tr").filter(function() {
		        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		        });
		    });			   
		});
	</script>
@endsection