 @section('content')
    @extends('layouts.app') 
	<h3>Ventas</h3>
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
						$dat=$art->precio_venta.','.$art->descripcion;
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
			<input type="text" class="form-control form-control-sm" placeholder="Subtotal" data-toggle="tooltip" data-placement="bottom"  title="No cambiar a menos de caso extraordinario" id="subtotal">
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
			<input type="text" class="form-control form-control-sm" placeholder="Total venta" data-toggle="tooltip" data-placement="bottom"  title="Total acumulado de la venta" id="total" value="0">
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
	    	</tr>
		</thead>
	    <tbody>
			
	    </tbody>
	  </table>
	</div>

	 <!-- The Modal Ventas -->
  <div class="modal" id="myModalVentas">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h1 class="modal-title">Modal Heading</h1>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <h3>Some text to enable scrolling..</h3>
          <p>Some text to enable scrolling.. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          <p>Some text to enable scrolling.. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

          <p>Some text to enable scrolling.. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
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
			var cad=sel.options[sel.selectedIndex].title;			
			var subt=cad.substring(0,cad.indexOf(","));				
			document.getElementById('subtotal').value=document.getElementById('cantidad').value*subt;			
		}

		function agregarFila()
		{
			var sel = document.getElementById("selArt");
			var cad=sel.options[sel.selectedIndex].title;
			var desc=cad.substring(cad.length,cad.indexOf(",")+1);
			var preu=cad.substring(0,cad.indexOf(","));
			var subt=document.getElementById("subtotal").value;
			//Hacer el concecutivo para la tabla
			var acum= $("#tabVentas").find("tr").length;
			//Calculamos el total de la venta
			var tot=parseInt(document.getElementById("total").value)+parseInt(subt);			
			document.getElementById("total").value=tot;
			no="<td>"+acum+"</td>";
			nom="<td>"+sel.options[sel.selectedIndex].text+"</td>";
			des="<td>"+desc+"</td>";
			pu="<td>"+preu+"</td>";
			can="<td>"+document.getElementById("cantidad").value+"</td>";
			sut="<td>"+subt+"</td>";
			document.getElementById("tabVentas").insertRow(-1).innerHTML = no+nom+des+pu+can+sut;

			//Limpiar formulario de articulos
			document.getElementById("selArt").value=0;
			document.getElementById("cantidad").value=1;
			document.getElementById("subtotal").value="";
		}

		function eliminarFila(){
		  var table = document.getElementById("tablaprueba");
		  var rowCount = table.rows.length;
		  //console.log(rowCount);
		  
		  if(rowCount <= 1)
		    alert('No se puede eliminar el encabezado');
		  else
		    table.deleteRow(rowCount -1);
		}
	

	</script>
  @endsection
 @endsection