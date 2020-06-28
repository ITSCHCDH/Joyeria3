@section('content')
    @extends('layouts.app')  
	<h2>Inversiones</h2>
	
	<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalCreate">
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
			           <td>{{$inv->cantidad}}</td>
			           <td>{{$inv->nombre}}</td>
			           <td>							
			           		<a class="btn btn-warning btn-sm" href="#" data-toggle="modal" data-target="#modalEdit" onclick="edit({{$inv->cantidad}},'{{$inv->id}}',{{$inv->id_inversionista}},'{{$inv->fecha}}')"><i class="fa fa-edit" style="font-size:15px" ></i></a>
			           		<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modalUndo" onclick="undo({{$inv->id}},'{{ route('inversiones.eliminar',$inv->id) }}')"><i class="material-icons" style="font-size:15px; color:black">delete_forever</i></a>
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
	        <form id="formAltas">
	        	@csrf
		        <div class="modal-body">            
				    <div class="form-group">
				      <label for="name">Fecha de inversión:</label>
				      <input type="date" name="calendario" class="form-control form-control-sm" required>
				    </div>	
				    <div class="form-group">
				      <label for="name" >Cantidad:</label>
				      <input type="text" name="cantidad" class="form-control form-control-sm" required>
				    </div>			     
				    <div class="form-group">
						<label for="selAdd">Inversionista:</label>
						<select class="form-control form-control-sm" id="selAdd" required=>					
							<option value="0">Selecciona un inversionista</option>    
						   @foreach($inversionistas as $inv2)
								<option value="{{$inv2->id}}">{{$inv2->nombre}}</option>
							@endforeach
						</select>
					</div>		   			
		        </div>
		        
		        <!-- Modal footer -->
		        <div class="modal-footer">
		          <button type="submit" class="btn btn-primary btn-sm" onclick="obtIdSelectAdd()">Guardar</button>
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
				      <label for="name">Inversión a modificar:</label>
				      <input type="text" name="inversion" id="inversion" class="form-control form-control-sm" readonly="true">
				    </div>           
				    <div class="form-group">
				      <label for="name">Fecha de inversión:</label>
				      <input type="date" name="calendario" id="dateEdit" class="form-control form-control-sm" required>
				    </div>	
				    <div class="form-group">
				      <label for="name">Cantidad:</label>
				      <input type="input" class="form-control" placeholder="Introduzca nombre del inversionista" id="cantidad" name="cantidad"  required>
				    </div>	
				     <div class="form-group">
						<label for="selEdit">Inversionista:</label>
						<select class="form-control form-control-sm" id="selEdit" required>				    
						    @foreach($inversionistas as $inv2)
								<option value="{{$inv2->id}}">{{$inv2->nombre}}</option>
							@endforeach
						</select>
					</div>			
		        </div>						        
		        <!-- Modal footer -->
		        <div class="modal-footer">
		        	<button type="submit" class="btn btn-primary btn-sm" onclick="obtIdSelectEdit()">Guardar</button>  
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
        function edit(c,n,id,f)
        {                            
            //console.log(r);//Este comando envia datos a la consola del navegador para poder observar que esta pasando
           
            document.getElementById("cantidad").value = c;           
            txt="inversionistas/Editar("+n+")";            
            $("#textCabUpd").text(txt);  
             document.getElementById("inversion").value = n;         
            $("#selEdit").val(id);
            $('#dateEdit').val(f); 

                
        }

        function undo(n,r)
        {                            
            txt="inversionistas/Eliminar"+"("+n+")"; //Creamos la cadena que aparecera en la cabecera del modal     
            txt2 ="Esta seguro de eliminar la inversión numero "+n;    
            $("#textCabUnd").text(txt);
            $("#msgEliminar").text(txt2);           
            $('#formEliminar').attr('action', r); 

        }

        function obtIdSelectAdd()
        {
        	//Con esta linea obtenemos el valor del option seleccionado
        	id=document.getElementById('selAdd').value;
        	//Esta linea es para crear la ruta que seguira el form para dar de alta
        	r=id+"/store";
        	$('#formAltas').attr('action', r);        	
        }

        function obtIdSelectEdit()
        {
        	//Con esta linea obtenemos el valor del option seleccionado
        	id_i=document.getElementById('selEdit').value;
        	id_e=document.getElementById('inversion').value;
        	//Esta linea es para crear la ruta que seguira el form para dar de alta
        	r=id_e+"/actualizar/"+id_i;         	                  
            $('#formEditar').attr('action', r);       	
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