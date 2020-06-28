@section('content')
    @extends('layouts.app')   
	<h2>Articulos</h2> 
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
		        <th>NOMBRE</th>
		        <th>DESCRIPCIÓN</th>
		        <th>MARCA</th>
		        <th>EXISTENCIA</th>
		        <th>PRECIO</th>
		        <th>UBICACIÓN</th>
		        <th>ACCIONES</th>
		      </tr>
		    </thead> 
		    <tbody>
		    	@foreach($articulos as $art)
			        <tr>
			           <td>{{$art->id}}</td>
			           <td>{{$art->categoria}}</td>
			           <td>{{$art->nombre}}</td>
			           <td>{{$art->descripcion}}</td>
			           <td>{{$art->marca}}</td>
			           <td>{{$art->art_exist}}</td>
			           <td>{{$art->precio_venta}}</td>
			           <td>{{$art->ubicacion}}</td>
			           <td>
			           		<a class="btn btn-warning btn-sm" href="#" data-toggle="modal" data-target="#modalEdit" 
			           		onclick="
			           		edit(
			           			{{$art->id}},
			           			{{$art->id_categoria}},
			           			'{{$art->nombre}}',
			           			'{{$art->descripcion}}',
			           			'{{$art->marca}}',
			           			'{{$art->fecha_compra}}',
			           			'{{$art->num_factura}}',
			           			{{$art->num_piezas}},
			           			{{$art->art_exist}},
			           			{{$art->iva}},
			           			{{$art->precio_compra}},
			           			{{$art->porcentaje}},
			           			{{$art->precio_venta}},
			           			'{{$art->ubicacion}}',
			           			'{{$art->status}}',
			           			{{$art->id_proveedor}}
			           			)"			           			
			           		><i class="fa fa-edit" style="font-size:15px" ></i></a>
			           		<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modalUndo" onclick="undo({{$art->id}},'{{$art->nombre}}')" ><i class="material-icons" style="font-size:15px; color:black">delete_forever</i></a>
			           </td>
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
	        <form id="formAdd">	
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
							      <input type="text" name="nombre" class="form-control form-control-sm" required placeholder="Introduce el nombre del articulo">
							    </div>	
							    <div class="form-group">
								  <label for="descripcion">Descripción del articulo:</label>
								  <textarea class="form-control" rows="4" name="descripcion" id="descripcionAdd" placeholder="Introduce una descripción"></textarea>
								</div>	
								<div class="form-group">
							      <label for="name" >Marca:</label>
							      <input type="text" name="marca" class="form-control form-control-sm" required placeholder="Introduce la marca del articulo" value="N/A">
							    </div>				        
						        <div class="form-group">
							      <label for="name">Fecha de compra:</label>
							      <input type="date" name="fecha_compra" class="form-control form-control-sm" required value="@php echo date("Y-m-d"); @endphp">
							    </div>						   
				        	</div>
			        		<div class="col-md-4">
								<div class="form-group">
							      <label for="name" >Numero de factura:</label>
							      <input type="text" name="num_factura" class="form-control form-control-sm" required value="N/A" placeholder="Introduce el numero de la factura de compra o N/A si no se tiene">
							    </div>
							    <div class="form-group">
							      <label for="name" >Numero de piezas:</label>
							      <input type="text" name="num_piezas" class="form-control form-control-sm" required placeholder="Introduce el numero de piezas que componen el articulo" value="1">
							    </div>
							    <div class="form-group">
							      <label for="name" >Cantidad en existencia:</label>
							      <input type="text" name="art_exist" class="form-control form-control-sm" required placeholder="Introduce cuantos articulos iguales se adquirierón">
							    </div>
							    <div class="form-group">
							      <label for="name" >IVA:</label>
							      <input type="text" name="iva" class="form-control form-control-sm" required value="16" placeholder="Introduce el IVA aplicable">
							    </div>
							    <div class="form-group">
							      <label for="name" >Precio de compra:</label>
							      <input type="text" name="precio_compra" id="pcom" class="form-control form-control-sm" onchange="calPreVen()" required placeholder="Introduce el precio de compra por articulo individual">
							    </div>
							    <div class="form-group">
							      <label for="name" >Porcentaje de ganancia:</label>
							      <input type="text" name="porcentaje" id="pjG" class="form-control form-control-sm" onchange="calPreVen()" required placeholder="Introduce el porcentaje de ganancia" value="100">
							    </div>
			        		</div>        		
			       			<div class="col-md-4">
								<div class="form-group">
							      <label for="name" >Precio de venta:</label>
							      <input type="text" name="precio_venta" id="pv" class="form-control form-control-sm" required placeholder="Introduce el precio real de venta a publico">
							    </div>
							    <div class="form-group">
							      <label for="name" >Ubicación:</label>
							      <input type="text" name="ubicacion" class="form-control form-control-sm" required placeholder="Introduce el lugar donde se almacenara el articulo">
							    </div>
							    <div class="form-group">
							      <label for="name" >Status:</label>
							      <input type="text" name="status" class="form-control form-control-sm" readonly="true" value="Existente">
							    </div>
							    <div class="form-group">
									<label for="id_proveedor">Proveedor:</label>
									<select class="form-control form-control-sm" id="id_proveedor" required=>					
										<option value="0">Selecciona un proveedor</option>
										@foreach($proveedores as $pro)
											<option value="{{$pro->id}}">{{$pro->nombre}}</option>
										@endforeach
									</select>
								</div>
			       			</div>
		        </div> 	              
		        <!-- Modal footer -->
		        <div class="modal-footer">
		          <button type="submit" class="btn btn-primary btn-sm" onclick="obtIdSelect()">Guardar</button>
		          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
		        </div> 
	        </form>       
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
		        <div class="modal-body row">            
				   <div class="col-md-4">				        		            
							    <div class="form-group">
									<label for="selCatEdit">Categoria:</label>
									<select class="form-control form-control-sm" id="selCatEdit" required=>					
										<option value="0">Selecciona una categoria</option>
										@foreach($categorias as $cat)
											<option value="{{$cat->id}}">{{$cat->categoria}}</option>
										@endforeach  
									</select>
								</div>
								<div class="form-group">
							      <label for="name" >Nombre del articulo:</label>
							      <input type="text" id="nombre" name="nombre" class="form-control form-control-sm" required placeholder="Introduce el nombre del articulo">
							    </div>	
							    <div class="form-group">
								  <label for="descripcion">Descripción del articulo:</label>
								  <textarea class="form-control" rows="4" name="descripcion" id="descripcionEdit" placeholder="Introduce una descripción">></textarea>
								</div>	
								<div class="form-group">
							      <label for="name" >Marca:</label>
							      <input type="text" name="marca" id="marca" class="form-control form-control-sm" required placeholder="Introduce la marca del articulo">
							    </div>				        
						        <div class="form-group">
							      <label for="name">Fecha de compra:</label>
							      <input type="date" name="fecha_compra" id="fecha_compra" class="form-control form-control-sm" required>
							    </div>						   
				        	</div>
			        		<div class="col-md-4">
								<div class="form-group">
							      <label for="name" >Numero de factura:</label>
							      <input type="text" name="num_factura" id="num_factura" class="form-control form-control-sm" required placeholder="Introduce el numero de la factura de compra o N/A si no se tiene">
							    </div>
							    <div class="form-group">
							      <label for="name" >Numero de piezas:</label>
							      <input type="text" name="num_piezas" id="num_piezas" class="form-control form-control-sm" required placeholder="Introduce el numero de piezas que componen el articulo">
							    </div>
							    <div class="form-group">
							      <label for="name" >Cantidad en existencia:</label>
							      <input type="text" name="art_exist" id="art_exist" class="form-control form-control-sm" required placeholder="Introduce cuantos articulos iguales se adquirierón">
							    </div>
							    <div class="form-group">
							      <label for="name" >IVA:</label>
							      <input type="text" name="iva" id="iva" class="form-control form-control-sm" required placeholder="Introduce el IVA aplicable">
							    </div>
							    <div class="form-group">
							      <label for="name" >Precio de compra:</label>
							      <input type="text" name="precio_compra" id="precio_compra" class="form-control form-control-sm" required placeholder="Introduce el precio de compra por articulo individual">
							    </div>
							    <div class="form-group">
							      <label for="name" >Porcentaje de ganancia:</label>
							      <input type="text" name="porcentaje" id="porcentaje" class="form-control form-control-sm" required placeholder="Introduce el porcentaje de ganancia">
							    </div>
			        		</div>        		
			       			<div class="col-md-4">
								<div class="form-group">
							      <label for="precio_ventaEd" >Precio de venta:</label>
							      <input type="text" name="precio_venta" id="precio_ventaEd" class="form-control form-control-sm" required placeholder="Introduce el precio real de venta a publico">
							    </div>
							    <div class="form-group">
							        <label for="ubicacionEdit" >Ubicación:</label>
							        <input type="text" name="ubicacion"  id="ubicacionEdit" class="form-control form-control-sm" required placeholder="Introduce el lugar donde se almacenara el articulo">
							    </div>
							    <div class="form-group">
							    	<label for="selStaEdit">Status:</label>
									<select class="form-control form-control-sm" id="selStaEdit" required name="status">					
										<option value="0">Selecciona ua opción</option>
										<option value="1">Existente</option>
										<option value="2">Vendido</option>				
									</select>							      
							    </div>
							    <div class="form-group">
									<label for="selProEdit">Proveedor:</label>
									<select class="form-control form-control-sm" id="selProEdit" required>					
										<option value="0">Selecciona un proveedor</option>
										@foreach($proveedores as $pro)
											<option value="{{$pro->id}}">{{$pro->nombre}}</option>
										@endforeach
									</select>
								</div>
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

	
	@section('js')  
		<script>
		  //Script que toma los datos de la tabla y los envia al modal pra ser editados    
	        function edit(id,id_cat,n,d,m,dat,f,p,e,i,pc,pj,pve,ub,st,id_pro)
	        {   
	        	$("#selCatEdit").val(id_cat);      
	            document.getElementById("nombre").value = n;  
	            document.getElementById("descripcionEdit").value = d;
	            document.getElementById("marca").value = m; 
	            $('#fecha_compra').val(dat);
	            document.getElementById("num_factura").value = f;
	            document.getElementById("num_piezas").value = p; 
	            document.getElementById("art_exist").value = e;
	            document.getElementById("iva").value = i;
	            document.getElementById("precio_compra").value = pc;
	            document.getElementById("porcentaje").value = pj;
	            document.getElementById("precio_ventaEd").value = pve;
	            document.getElementById("ubicacionEdit").value = ub;
	            if(st=='Existente')
	              	opc='1';	            
	            else
	               	opc='2';

	            $("#selStaEdit").val(opc);
	            $("#selProEdit").val(id_pro);
	            txt="Articulos/Editar"+"("+n+")";            
	            $("#textCabUpd").text(txt);
	            r=id+"/update/";
	            $('#formEditar').attr('action', r);            
	        }

	        function undo(id,n)
	        {              		                   
	            txt="Articulos/Eliminar"+"("+n+")"; //Creamos la cadena que aparecera en la cabecera del modal     
	            txt2 ="Esta seguro de eliminar el articulo: "+n;    
	            $("#textCabUnd").text(txt);
	            $("#msgEliminar").text(txt2);           
	            r=id+"/destroy/";                                
	            $('#formEliminar').attr('action', r);            
	        }

	        function obtIdSelect()
	        {        
	        	id_cat=document.getElementById('selAdd').value;	
	        	id_pro=document.getElementById('id_proveedor').value;
	        	r="store/"+id_cat+"/"+id_pro+"/";         	      	
	        	$('#formAdd').attr('action', r);
	        }

	        function calPreVen()
            {   
            	pc1=parseInt(document.getElementById('pcom').value);      	
                pj1=parseInt(document.getElementById('pjG').value);
                incr2=(pc1*pj1)/100;
                pv3=pc1+incr2;
                document.getElementById('pv').value=pv3;
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
    	
@endsection