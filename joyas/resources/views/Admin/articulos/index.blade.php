@section('content')
    @extends('layouts.app')   
	<h2>Articulos</h2> 
	<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modCreate">
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
		        <th>NOMBRE</th>
		        <th>DESCRIPCIÓN</th>
		        <th>MARCA</th>
		        <th>EXISTENCIA</th>
		        <th>PRECIO</th>
		        <th>UBICACIÓN</th>
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



	<!-- Modal para altas -->
	  <div class="modal fade" id="modCreate">
	    <div class="modal-dialog modal-xl">
	      <div class="modal-content">
	      
	        <!-- Modal Header -->
	        <div class="modal-header">
	          <h4 class="modal-title">Articulos/Altas</h4>
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        <form action="{{ route('articulos.store') }}">	
		        <div class="modal-body row">
		        	<!-- Modal body -->
			               	@csrf	        		
			        		<div class="col-md-4">				        		            
							    <div class="form-group">
									<label for="selAdd">Categoria:</label>
									<select class="form-control form-control-sm" id="selAdd" required=>					
										<option value="0">Selecciona una categoria</option>
										@foreach($categorias as $cat)
											<option value="{{$cat->id}}">{{$cat->categoria}}</option>
										@endforeach  
									</select>
								</div>
								<div class="form-group">
							      <label for="name" >Nombre del articulo:</label>
							      <input type="text" name="nombre" class="form-control form-control-sm" required>
							    </div>	
							    <div class="form-group">
								  <label for="descripcion">Descripción del articulo:</label>
								  <textarea class="form-control" rows="4" id="descripcion"></textarea>
								</div>	
								<div class="form-group">
							      <label for="name" >Marca:</label>
							      <input type="text" name="marca" class="form-control form-control-sm" required>
							    </div>				        
						        <div class="form-group">
							      <label for="name">Fecha de compra:</label>
							      <input type="date" name="fecha_compra" class="form-control form-control-sm" required>
							    </div>						   
				        	</div>
			        		<div class="col-md-4">
								<div class="form-group">
							      <label for="name" >Numero de factura:</label>
							      <input type="text" name="num_factura" class="form-control form-control-sm" required>
							    </div>
							    <div class="form-group">
							      <label for="name" >Numero de piezas:</label>
							      <input type="text" name="num_piezas" class="form-control form-control-sm" required>
							    </div>
							    <div class="form-group">
							      <label for="name" >Cantidad en existencia:</label>
							      <input type="text" name="art_exist" class="form-control form-control-sm" required>
							    </div>
							    <div class="form-group">
							      <label for="name" >IVA:</label>
							      <input type="text" name="iva" class="form-control form-control-sm" required>
							    </div>
							    <div class="form-group">
							      <label for="name" >Precio de compra:</label>
							      <input type="text" name="precio_compra" class="form-control form-control-sm" required>
							    </div>
							    <div class="form-group">
							      <label for="name" >Porcentaje de ganancia:</label>
							      <input type="text" name="porcentaje" class="form-control form-control-sm" required>
							    </div>
			        		</div>        		
			       			<div class="col-md-4">
								<div class="form-group">
							      <label for="name" >Precio de venta:</label>
							      <input type="text" name="precio_venta" class="form-control form-control-sm" required>
							    </div>
							    <div class="form-group">
							      <label for="name" >Ubicación:</label>
							      <input type="text" name="ubicación" class="form-control form-control-sm" required>
							    </div>
							    <div class="form-group">
							      <label for="name" >Status:</label>
							      <input type="text" name="ubicación" class="form-control form-control-sm" readonly="true" value="Existente">
							    </div>
							    <div class="form-group">
									<label for="selAdd">Proveedor:</label>
									<select class="form-control form-control-sm" id="selAdd" required=>					
										<option value="0">Selecciona un proveedor</option>
										@foreach($proveedores as $pro)
											<option value="{{$pro->id}}">{{$pro->nombre}}</option>
										@endforeach
									</select>
								</div>
			       			</div>
		        </div> 
	        </form>       
	        <!-- Modal footer -->
	        <div class="modal-footer">
	          <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
	          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
	        </div>        
	      </div>
	    </div>
	  </div>	 


	 <!-- Modal para editar -->
	  <div class="modal fade" id="modalEdit">
	    <div class="modal-dialog modal-xl">
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
    	
@endsection