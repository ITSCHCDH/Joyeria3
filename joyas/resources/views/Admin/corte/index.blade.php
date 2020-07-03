@section('content')
    @extends('layouts.app')  
	<h2>Estado de cuenta(Cortes por periodo)</h2>
	<hr>
	<div class="input-group mb-3 input-group-sm">
	    <div class="input-group-prepend">
	       <span class="input-group-text">Fecha de corte</span>
	    </div>
	    <input type="date" id="addFcEl" name="fecha_compra" class="form-control form-control-sm" required value="@php echo date("Y-m-d"); @endphp">
	    <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAddCorte" onclick="calcular()">Realizar corte</button>
  	</div>	
    <hr>
    <input class="form-control pull-right form-control-sm" id="inpBuscar" type="text" placeholder="Buscar.." style="width: 200px;">
  	<br>
  	<br>
	<div class="table-responsive">
	    <table class="table" id="mitabla">
		    <thead class="thead-dark">
		      <tr>
		      	<th>ID</th>
		        <th>Fecha de corte</th>
		        <th>Ventas del periodo</th>
		        <th>Gastos operativos</th>
		        <th>Descripción de gastos</th>
		        <th>Gastos Extraordinarios</th>
		        <th>Descripción de gastos extras</th>
		      </tr>
		    </thead>
		    <tbody>
		    	@foreach($corte as $cor)
			      	<tr>
			        	<td>{{$cor->id}}</td>
			       	 	<td>{{$cor->fecha_corte}}</td>
			        	<td>{{$cor->ventas_periodo}}</td>
			        	<td>{{$cor->gastos_operativos}}</td>
			        	<td>{{$cor->descripcion_gastos}}</td>
			        	<td>{{$cor->gastos_extraordinarios}}</td>
			        	<td>{{$cor->descripcion_gastos_extra}}</td>
			      	</tr>
			    @endforeach		     
		    </tbody>
	  </table>	
	</div>

	
	<!-- The Modal -->
	<div class="modal fade" id="modalAddCorte">		
	    <div class="modal-dialog">
	        <div class="modal-content">
	        <form id="modAddCorte"  action="{{ route('corte.store')}}">
		        <!-- Modal Header -->
		        <div class="modal-header">
		          <h4 class="modal-title">Agregar corte</h4>
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		        </div>
		        
		        <!-- Modal body -->
		        	<!-- si no hay ventas en el periodo, no se hace el corte -->
					@if($venPer!=0)
						<div class="modal-body">	        	
				        	<div class="input-group mb-3 input-group-sm">
							    <div class="input-group-prepend">
							       <span class="input-group-text">Fecha de corte</span>
							    </div>
							    <input type="text" class="form-control" readonly name="fecha_corte" id="addFc">
						    </div>
				        	<div class="input-group mb-3 input-group-sm">
							    <div class="input-group-prepend">
							       <span class="input-group-text">Ventas del periodo</span>
							    </div>
							    <input type="text" class="form-control" readonly name="ventas_periodo" value="{{$venPer}}">
						    </div>
						    <div class="input-group mb-3 input-group-sm">
							    <div class="input-group-prepend">
							       <span class="input-group-text">Gastos operativos</span>
							    </div>
							    <input type="text" class="form-control" readonly name="gastos_operativos" value="{{$gasOp}}"> 
						    </div>
						    <div class="input-group mb-3 input-group-sm">
							    <div class="input-group-prepend">
							       <span class="input-group-text">Descripción de gastos</span>
							    </div>
							    <input type="text" class="form-control" name="descripcion_gastos">
						    </div>
						    <div class="input-group mb-3 input-group-sm">
							    <div class="input-group-prepend">
							       <span class="input-group-text">Gastos extraordinarios</span>
							    </div>
							    <input type="text" class="form-control" name="gastos_extraordinarios">
						    </div>
						    <div class="input-group mb-3 input-group-sm">
							    <div class="input-group-prepend">
							       <span class="input-group-text">Descripción de gastos extraordinarios</span>
							    </div>
							    <input type="text" class="form-control" name="descripcion_gastos_extra">
						    </div>				 
				        </div>
				        <!-- Modal footer -->
				        <div class="modal-footer">
				        	<button type="submit" class="btn btn-primary btn-sm">Guardar</button>
				            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
				        </div>
					@else
						<div class="modal-body">	        	
				        <h5>No hay ventas para realizar el corte!</h5>
				         <div class="modal-footer">				        	
				            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
				        </div>
					@endif
		       
		        
		       
	        </form>   
	      </div>
	    </div>
	</div>

	<script>
		function calcular()
		{
			document.getElementById("addFc").value=document.getElementById("addFcEl").value
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