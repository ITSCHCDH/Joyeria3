 @section('content')
    @extends('layouts.app') 
	<h2>Ventas</h2>
	<hr>
	<dt>Datos de articulos</dt>
	<hr>
	<div class="row">
		<div class="col-sm-3">
			<div class="input-group mb-3 input-group-sm">
			  <input type="text" class="form-control" placeholder="Nombre/Codigo" data-toggle="tooltip" data-placement="bottom"  title="Introduce el codigo/nombre del articulo" id="buscar" onkeyup="buscarSelect()">
			  <div class="input-group-append">
			    <button class="btn btn-success" type="submit" onclick="buscarSelect()">Buscar</button>
			  </div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">			  
			  <select class="form-control form-control-sm" id="selArt" data-toggle="tooltip" data-placement="bottom"  title="Selecciona el articulo manualmente" onchange="
			  calcSubtotal()">
			    <option value="0">Selecciona un articulo</option>
			    @foreach($articulos as $art)
			    	@php
						$dat=$art->id.','.$art->precio_venta.','.$art->descripcion.','.$art->art_exist;
			    	@endphp
			    	<option value="{{$art->id}}" title="{{$dat}}">{{$art->nombre}}</option>	
			    @endforeach		   
			  </select>
			</div>
		</div>
		<div class="col-sm-2">
			 <input class="form-control form-control-sm" type="number" name="cantidad" min="1" max="99" step="1"  required="required" data-toggle="tooltip" data-placement="bottom"  title="Escribe la cantidad de articulos vendidos" value="1" id="cantidad" onchange="calcSubtotal()">
		</div>
		<div class="col-sm-2">
			<input type="text" class="form-control form-control-sm" placeholder="Subtotal" data-toggle="tooltip" data-placement="bottom"  title="No cambiar a menos de caso extraordinario" id="subtotal" style="font-weight: bold;">
		</div>
		<div class="col-sm-2">
			<a  class="btn btn-primary btn-sm pull-right" id="btnAgregar" onclick="agregarFila()">Agregar</a>			
		</div>			
	</div>	
	<hr>
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4" style="text-align: right;">
			<dt>Total</dt>
		</div>
		<div class="col-sm-3">
			<div class="input-group mb-3 input-group-lg">
			    <div class="input-group-prepend">
			      <span class="input-group-text">$</span>
			    </div>
			    <input type="text" class="form-control" placeholder="Total venta" data-toggle="tooltip" data-placement="bottom"  title="Total acumulado de la venta" value="0" readonly="true" id="total" style="height:50px; font-size: 40px;padding: 5px">
			</div>		
		</div>
		<div class="col-sm-1">
			<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#myModalVentas">Vender</button>
		</div>
	</div>	
	<div class="table-responsive">	  
	 <br>
	  <table class="table table-sm" id="tabVentas">
	  	
	    <thead class="thead-dark">
	    	<tr>
	    		<th>No.</th>
	    		<th>Nombre</th>
	    		<th>Descripción</th>
	    		<th>Precio unitario</th>
	    		<th>Cantidad</th>
	    		<th>SubTotal</th>
	    		<th>Acción</th>
	    	</tr>
		</thead>
	    <tbody>
			
	    </tbody>
	  </table>
	  <br>
	  <br>
	  <br>
	</div>

	 <!-- The Modal Ventas -->
<form action="{{route('ventas.artVentas')}}" method="post">
	@csrf <!-- Token para usar con metodo post -->
    <div class="modal" id="myModalVentas">
	    <div class="modal-dialog">
	      <div class="modal-content">
	      
	        <!-- Modal Header -->
	        <div class="modal-header">
	          <h1 class="modal-title">Venta</h1>
	          <button type="button" class="close" data-dismiss="modal">×</button>
	        </div>
	        
	        <!-- Modal body -->
	        <div class="modal-body">
	          	<h3>Total de la venta..</h3>
	          	<div class="table-responsive-sm">
		          <table class="table table-bordered table-sm" id="tabRegistro">
		          	<thead>
		          		<tr>
		          			<th>No.</th>
		          			<th>Nombre</th>
		          			<th>Cantidad</th>
		          			<th>Total</th>
		          		</tr>
		          	</thead>
		          	<tbody>	          		
		          	</tbody>
		          </table>
		          <div class="row">
		          	<div class="col-sm-4"></div>
		          	<div class="col-sm-4">
		          		<dt class="pull-right">TOTAL</dt>
		          	</div>
		          	<div class="col-sm-4">
		          		 <input type="text" class="form-control form-control-sm" placeholder="Total venta" data-toggle="tooltip" data-placement="bottom"  title="Total acumulado de la venta" id="totReg" value="0" name="total">
		          	</div>
		          </div>
		         
				</div>
	        </div>
	        
	        <!-- Modal footer -->
	        <div class="modal-footer">
	        	<button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Cancelar</button>
	          	<button type="submit" class="btn btn-danger btn-sm">Registrar</button>
	        </div>
	        
	      </div>
	    </div>
    </div>
</form>
@section('js')
<script>
	function buscarSelect()
	{
		// creamos un variable que hace referencia al select
		var select=document.getElementById("selArt");
	 
		// obtenemos el valor a buscar
		var buscar=document.getElementById("buscar").value;
	 
		// recorremos todos los valores del select
		for(var i=1;i<select.length;i++)
		{
			if(select.options[i].text==buscar || select.options[i].value==buscar)
			{
				// seleccionamos el valor que coincide
				select.selectedIndex=i;
				//Borramos el text de busqueda
				document.getElementById('buscar').value="";
				//Ejecutamos evento change del select para que se lllene en automatico el text de subtotal
				document.getElementById('selArt').onchange();
				
			}
		}
	}

	function calcSubtotal()
	{
		//Guardamos el elemento select en la variable sel
		var sel = document.getElementById("selArt");
		if(sel.options[sel.selectedIndex].text!='Selecciona un articulo')
		{	
			//Sacamos todos los datos concatenados en title y los pasamos a variables independientes		
			var cad=sel.options[sel.selectedIndex].title;
			var pcom=cad.indexOf(","); //Localiza la primera coma en la cadena
			var scom=cad.indexOf(",",pcom+1);//Localiza la segunda coma		
			var ucom=cad.indexOf(",",scom+1);//Localiza la ultima coma en la cadena		
			var cant=document.getElementById("cantidad").value;			
			var subt=cad.substring(pcom+1,scom);				
			document.getElementById('subtotal').value=cant*subt;
			//Obtenemos la cantidad de articulos disponibles
			var cmax=cad.substring(ucom+1,cad.length);	
			//Colocamos el limite maximo de articulos que podemos vender		
			document.getElementById('cantidad').max=cmax;
		}
		else
		{
			//En caso de que no haya un articulo seleccionado no permitir aumente la cantidad
			document.getElementById('cantidad').value=1;
		}
		
	}

	function agregarFila()
	{
		var sel = document.getElementById("selArt");
		var cad=sel.options[sel.selectedIndex].title;			
		var pcom=cad.indexOf(","); //Localiza la primera coma en la cadena		
		var scom=cad.indexOf(",",pcom+1);//Localiza la segunda coma		
		var ucom=cad.indexOf(",",scom+1);//Localiza la ultima coma en la cadena	
		var id=cad.substring(0,pcom);			
		var preu=cad.substring(pcom+1,scom);
		var desc=cad.substring(scom+1,ucom);
		var cant=document.getElementById("cantidad").value;
		var subt=document.getElementById("subtotal").value;
		//Hacer el concecutivo para la tabla
		var acum= $("#tabVentas").find("tr").length;
		//Calculamos el total de la venta
		var tot=parseInt(document.getElementById("total").value)+parseInt(subt);
		//Agrega el total al input de la pagina principal de ventas			
		document.getElementById("total").value=tot;
		//Agrega el total al input del modal de notificacion de registro
		document.getElementById("totReg").value=tot;
		
		no="<td> <input type='hidden' readonly style = 'border: 0' name='no[]' value='"+acum+"'>  <input type='hidden' readonly style = 'border: 0' name='id[]' value='"+id+"'>         <input type='hidden' readonly style = 'border: 0' name='des[]' value='"+desc+"'>"+acum+"</td>";
		des="<td>"+desc+"</td>";
		nom="<td> <input type='hidden' readonly style = 'border: 0' name='nom[]' value='"+sel.options[sel.selectedIndex].text+"'>"+sel.options[sel.selectedIndex].text+"</td>";		
		pu="<td> <input type='hidden' readonly style = 'border: 0'  name='pu[]' value='"+preu+"'>"+preu+"</td>";
		can="<td> <input type='hidden' readonly style = 'border: 0' name='can[]' value='"+cant+"'>"+cant+"</td>";
		sut="<td> <input type='hidden' readonly style = 'border: 0' name='sut[]' value='"+subt+"'>"+subt+"</td>";
		acc="<button  class='btn btn-danger btn-sm' onclick='eliminarFila("+acum+")' id='btn"+acum+"'> <i class='fas fa-minus-circle'> </button>";
		//Agrega la fila a la tabla principal de ventas
		var table = document.getElementById("tabVentas").tBodies[0];
		var row = table.insertRow();
		row.id = acum;
		row.innerHTML = no+nom+des+pu+can+sut+acc;
				
		//Agrega fila a la tabla de notificacion para registro modal
		document.getElementById("tabRegistro").insertRow(-1).innerHTML = no+nom+can+sut;

		//Limpiar formulario de articulos
		document.getElementById("selArt").value=0;
		document.getElementById("cantidad").value=1;
		document.getElementById("subtotal").value="";
	}

	function eliminarFila(id)
	{			
	    var table = document.getElementById("tabVentas");
	    var table2 = document.getElementById("tabRegistro");
	    var rowCount = table.rows.length;
	    var i = document.getElementById(id).rowIndex;		   
	    //Hace la resta en el total 
	    var tot=parseInt(document.getElementById("total").value)-parseInt(document.getElementById("tabVentas").rows[i].cells[5].innerText);
	    //Resta el total al input de la pagina principal de ventas			
	    document.getElementById("total").value=tot;
	    //Resta el total al input del modal de notificacion de registro
	    document.getElementById("totReg").value=tot;
	  
	    if(rowCount <= 1)
	    	alert('No se puede eliminar el encabezado');
	    else
	   
	 	
			document.getElementById("tabVentas").deleteRow(i);
			table2.deleteRow(i);
	 	reEnumerar();		 			
	}

	function reEnumerar()
	{
		var table = document.getElementById("tabVentas");
		var rowCount = table.rows.length;

		for(x=1;x<=rowCount;x++)
	    {
			document.getElementById("tabVentas").rows[x].cells[0].innerText=x;
			document.getElementById("tabRegistro").rows[x].cells[0].innerText=x;		
		}
	}


</script>
@endsection
@endsection