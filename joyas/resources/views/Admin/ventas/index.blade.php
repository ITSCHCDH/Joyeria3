 @section('content')
    @extends('layouts.app') 
	<h3>Ventas</h3>
	<hr>
	<dt>Datos de articulos</dt>
	<hr>
	<div class="row">
		<div class="col-sm-3">
			<div class="input-group mb-3 input-group-sm">
			  <input type="text" class="form-control" placeholder="Nombre/Codigo" data-toggle="tooltip" data-placement="bottom"  title="Introduce el codigo/nombre del articulo">
			  <div class="input-group-append">
			    <button class="btn btn-success" type="submit">Buscar</button>
			  </div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">			  
			  <select class="form-control form-control-sm" id="sel1" data-toggle="tooltip" data-placement="bottom"  title="Selecciona el articulo manualmente">
			    <option value="0">Selecciona un articulo</option>
			    @foreach($articulos as $art)
			    	<option value="{{$art->id}}">{{$art->nombre}}</option>	
			    @endforeach		   
			  </select>
			</div>
		</div>
		<div class="col-sm-2">
			 <input type="text" class="form-control form-control-sm" placeholder="Cantidad de articulos" value="1" data-toggle="tooltip" data-placement="bottom"  title="Escribe la cantidad de articulos vendidos">
		</div>
		<div class="col-sm-2">
			<input type="text" class="form-control form-control-sm" placeholder="Subtotal" data-toggle="tooltip" data-placement="bottom"  title="No cambiar a menos de caso extraordinario">
		</div>
		<div class="col-sm-2">
			<button class="btn btn-primary btn-sm pull-right">Agregar</button>
		</div>			
	</div>	
	<hr>
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4" style="text-align: right;">
			<dt>Total</dt>
		</div>
		<div class="col-sm-3">
			<input type="text" class="form-control form-control-sm" placeholder="Total venta" data-toggle="tooltip" data-placement="bottom"  title="Total acumulado de la venta">
		</div>
		<div class="col-sm-1">
			<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#myModalVentas">Vender</button>
		</div>
	</div>	
	<div class="table-responsive">	  
	 <br>
	  <table class="table table-sm">
	    <thead class="thead-dark">
	      <tr>
	        <th>Firstname</th>
	        <th>Lastname</th>
	        <th>Email</th>
	      </tr>
	    </thead>
	    <tbody>
	      <tr>
	        <td>John</td>
	        <td>Doe</td>
	        <td>john@example.com</td>
	      </tr>
	      <tr>
	        <td>Mary</td>
	        <td>Moe</td>
	        <td>mary@example.com</td>
	      </tr>
	      <tr>
	        <td>July</td>
	        <td>Dooley</td>
	        <td>july@example.com</td>
	      </tr>
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
 @endsection