@section('content')
    @extends('layouts.app')  
	<h2>inversiones</h2>
	
	<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalCreate">
		<i class="fa fa-plus-square" style="font-size:15px"></i>
    	Nuevo
  	</button>  	
  	<hr>
  	
	<div class="table-responsive">
		<table class="table table-sm">
		    <thead class="thead-dark">
		      <tr>
		        <th>ID</th>
		        <th>FECHA</th>	
		        <th>CANTIDAD</th>	
		        <th>INVERSIONISTA</th>
		        <th>ACCIONES</th>		        
		      </tr>
		    </thead> 
		    <tbody>
		    	@foreach($inversiones as $inv)
			        <tr>
			           <td>{{$inv->id}}</td>
			           <td>{{$inv->fecha}}</td>	
			           <td>X</td>
			           <td>Y</td>
			           <td>							
			           		<a class="btn btn-warning btn-sm" href="#" data-toggle="modal" data-target="#modalEdit" onclick="editar_articulo({{$inv}},'{{ route('inversionistas.actualizar',$inv->id) }}')"><i class="fa fa-edit" style="font-size:15px" ></i></a>
			           		<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modalUndo" onclick="undo_articulo({{$inv}},'{{ route('inversionistas.eliminar',$inv->id) }}')"><i class="material-icons" style="font-size:15px; color:black">delete_forever</i></a>
			           </td>
			        </tr>			       
			    @endforeach					        
		    </tbody>
		 </table>
		 {{ $inversiones->links() }}				
	</div>		
	     



	<!-- Modal para altas -->
	  <div class="modal fade" id="modalCreate">
	    <div class="modal-dialog">
	      <div class="modal-content">
	      
	        <!-- Modal Header -->
	        <div class="modal-header">
	          <h4 class="modal-title">inversiones/Altas</h4>
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        
	        <!-- Modal body -->
	        <form action="{{ route('inversionistas.store') }}">
	        	@csrf
		        <div class="modal-body">            
				    <div class="form-group">
				      <label for="name">Fecha de inversión:</label>
				      <input type="date" name="calendario" class="form-control form-control-sm">
				    </div>	
				    <div class="form-group">
				      <label for="name">Cantidad:</label>
				      <input type="text" name="cantidad" class="form-control form-control-sm">
				    </div>			     
				    <div class="form-group">
						<label for="sel1">Inversionista:</label>
						<select class="form-control form-control-sm" id="sel1">
						    <option>1</option>
						    <option>2</option>
						    <option>3</option>
						    <option>4</option>
						</select>
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
				      <label for="name">nombre:</label>
				      <input type="input" class="form-control" placeholder="Introduzca nombre del inversionista" id="inv" name="nombre"  required>
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
        function editar_articulo(n,r)
        {                            
            //console.log(r);//Este comando envia datos a la consola del navegador para poder observar que esta pasando
            document.getElementById("inv").value = n["nombre"];           
            txt="inversionistas/Editar"+"("+n["nombre"]+")";            
            $("#textCabUpd").text(txt);           
            $('#formEditar').attr('action', r);            
        }

        function undo_articulo(n,r)
        {                            
            txt="inversionistas/Eliminar"+"("+n["nombre"]+")"; //Creamos la cadena que aparecera en la cabecera del modal     
            txt2 ="Esta seguro de eliminar el inversionista: "+n["nombre"];    
            $("#textCabUnd").text(txt);
            $("#msgEliminar").text(txt2);           
            $('#formEliminar').attr('action', r);            
        }
    </script>
@endsection