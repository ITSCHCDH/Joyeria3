@section('content')
    @extends('layouts.app')  
	<h2>Proveedores</h2>
	
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
		        <th>NOMBRE</th>	
		        <th>DIRECCIÓN</th>
		        <th>RFC</th>			        
		        <th>TELEFONO</th>
		        <th>CORREO ELECTRONICO</th>
		        <th>ACCIONES</th>
		      </tr>
		    </thead> 
		    <tbody>
		    	@foreach($proveedores as $pro)
			        <tr>
			           <td>{{$pro->id}}</td>
			           <td>{{$pro->nombre}}</td>	
			           <td>{{$pro->direccion}}</td>
			           <td>{{$pro->rfc}}</td>
			           <td>{{$pro->telefono}}</td>
			           <td>{{$pro->email}}</td>
			           <td>							
			           		<a class="btn btn-warning btn-sm" href="#" data-toggle="modal" data-target="#modalEdit" onclick="edit({{$pro}},'{{ route('proveedores.actualizar',$pro->id) }}')"><i class="fa fa-edit" style="font-size:15px" ></i></a>
			           		<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modalUndo" onclick="undo({{$pro}},'{{ route('proveedores.eliminar',$pro->id) }}')"><i class="material-icons" style="font-size:15px; color:black">delete_forever</i></a>
			           </td>
			        </tr>			       
			    @endforeach					        
		    </tbody>
		 </table>
		 {{ $proveedores->links() }}				
	</div>		
	     



	<!-- Modal para altas -->
	  <div class="modal fade" id="modCreate">
	    <div class="modal-dialog">
	      <div class="modal-content">
	      
	        <!-- Modal Header -->
	        <div class="modal-header">
	          <h4 class="modal-title">Proveedores/Altas</h4>
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        
	        <!-- Modal body -->
	        <form action="{{ route('proveedores.store') }}">
	        	@csrf
		        <div class="modal-body">            
				    <div class="form-group">
				      <label for="name">Nombre:</label>
				      <input type="text" class="form-control form-control-sm" placeholder="Introduzca nombre" id="nombreA" name="nombreA" required>
				    </div>
				    <div class="form-group">
				      <label for="name">Dirección:</label>
				      <input type="text" class="form-control form-control-sm" placeholder="Introduzca dirección" id="direccionA" name="direccionA" required>
				    </div>	
				    <div class="form-group">
				      <label for="name">RFC:</label>
				      <input type="text" class="form-control form-control-sm" placeholder="Introduzca rfc" id="rfcA" name="rfcA">
				    </div>
				    <div class="form-group">
				      <label for="Telefono">Telefono:</label>
				      <input type="tel" id="telefonoA"  class="form-control form-control-sm" name="telefonoA" pattern="[0-9]{3}[0-9]{3}[0-9]{2}[0-9]{2}" placeholder="Telefono 10 digitos">
				    </div>	
				    <div class="form-group">
				      <label for="name">Correo electronico:</label>
				      <input type="email" class="form-control form-control-sm" placeholder="Introduzca email" id="emailA" name="emailA">
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
				      <label for="name">Nombre:</label>
				      <input type="text" class="form-control form-control-sm" placeholder="Introduzca nombre" id="nombre" name="nombre" required>
				    </div>
				    <div class="form-group">
				      <label for="name">Dirección:</label>
				      <input type="text" class="form-control form-control-sm" placeholder="Introduzca dirección" id="direccion" name="direccion" required>
				    </div>	
				    <div class="form-group">
				      <label for="name">RFC:</label>
				      <input type="text" class="form-control form-control-sm" placeholder="Introduzca rfc" id="rfc" name="rfc">
				    </div>
				    <div class="form-group">
				      <label for="name">Telefono:</label>
				      <input type="text" class="form-control form-control-sm" placeholder="Introduzca telefono" id="telefono" name="telefono">
				    </div>	
				    <div class="form-group">
				      <label for="name">Correo electronico:</label>
				      <input type="email" class="form-control form-control-sm" placeholder="Introduzca email" id="email" name="email">
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
            document.getElementById("nombre").value = n["nombre"];
            document.getElementById("direccion").value = n["direccion"];  
            document.getElementById("rfc").value = n["rfc"]; 
            document.getElementById("telefono").value = n["telefono"]; 
            document.getElementById("email").value = n["email"];       
            txt="Proveedores/Editar"+"("+n["nombre"]+")";            
            $("#textCabUpd").text(txt);           
            $('#formEditar').attr('action', r);            
        }

        function undo(n,r)
        {                            
            txt="Proveedores/Eliminar"+"("+n["nombre"]+")"; //Creamos la cadena que aparecera en la cabecera del modal     
            txt2 ="Esta seguro de eliminar al proveedor: "+n["nombre"];    
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