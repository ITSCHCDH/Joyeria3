@section('content')
    @extends('layouts.app')    
	<h2>Usuarios</h2> 
	<a href="{{route('registro')}}" type="button" class="btn btn-success btn-sm"> <i class="fa fa-plus-square" style="font-size:15px"></i> Nuevo</a>
	<hr>

	<input class="form-control pull-right form-control-sm" id="inpBuscar" type="text" placeholder="Buscar.." style="width: 200px;">
	 	
	<div class="table-responsive">
		<br>
		<table class="table table-sm" id="mitabla">
		    <thead class="thead-dark">
		      <tr>
		        <th>ID</th>
		        <th>NOMBRE</th>
		        <th>CORREO ELECTRONICO</th>
		        <th>ACCIONES</th>
		      </tr>
		    </thead> 
		    <tbody>
		    	@foreach($usuarios as $us)
			        <tr>
			           <td>{{$us->id}}</td>
			           <td>{{$us->name}}</td>
			           <td>{{$us->email}}</td>
			           <td>
			           		<a class="btn btn-warning btn-sm" href="#" data-toggle="modal" data-target="#modalEdit" onclick="edit({{$us}})"><i class="fa fa-edit" style="font-size:15px" ></i></a>
			           		<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modalUndo" onclick="undo({{$us}})"><i class="material-icons" style="font-size:15px; color:black">delete_forever</i></a>
			           </td>
			        </tr>
			    @endforeach					        
		    </tbody>
		 </table>
		 {{ $usuarios->links() }}				
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
				      <input type="text" class="form-control form-control-sm" placeholder="Introduzca nombre" id="nombreAdd" name="name" required>
				    </div>
				    <div class="form-group">
				      <label for="name">Correo electronico:</label>
				      <input type="email" class="form-control form-control-sm" placeholder="Introduzca email" id="emailAdd" name="email" required>
				    </div>	
				    <div class="form-group">
				      <label for="name">Password:</label>
				      <input type="password" class="form-control form-control-sm" placeholder="Introduzca password" id="passwordAdd" name="password">
				    </div>	
				    <div class="form-group">
				      <label for="name">Confirma Password:</label>
				      <input type="password" class="form-control form-control-sm" placeholder="Introduzca password" id="password2Add" name="password2">
				    </div>			   				
		        </div>						        
		        <!-- Modal footer -->
		        <div class="modal-footer">
		        	<button type="submit" class="btn btn-primary btn-sm" onclick="verifPass({{$us}})">Guardar</button>  
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
        function edit(o)
        {                            
            //console.log(r);//Este comando envia datos a la consola del navegador para poder observar que esta pasando            
            document.getElementById("nombreAdd").value = o["name"];
            document.getElementById("emailAdd").value = o["email"];  
            document.getElementById("passwordAdd").value = o["password"]; 
            document.getElementById("password2Add").value = o["password"]; 
                   
            txt="Usuarios/Editar"+"("+o["name"]+")";            
            $("#textCabUpd").text(txt); 
                      
        }

        function verifPass(o)
        {
        	pas1=document.getElementById("passwordAdd").value; 
            pas2=document.getElementById("password2Add").value; 
            if(pas1==pas2)
            {            	
            	r=o["id"]+"/update/"            	          
            	$('#formEditar').attr('action', r); 
            }
            else
            {
            	txt2 ="Los campos de password, no son iguales, favor de verificarlos: ";    
            	$('#modalEdit').modal('hide');	
            	alert(txt2);
            }
        }

        function undo(o)
        {                            
            txt="Usuarios/Eliminar"+"("+o["name"]+")"; //Creamos la cadena que aparecera en la cabecera del modal     
            txt2 ="Esta seguro de eliminar al usuario: "+o["name"];    
            $("#textCabUnd").text(txt);
            $("#msgEliminar").text(txt2); 
            r=o["id"]+"/destroy/";          
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