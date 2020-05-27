<br><br><br><br>
<div class="container-fluid">
	<div class="row">
  	<div class="col-sm-2"></div>
  	<div class="col-sm-8">
  		<div id="demo" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ul class="carousel-indicators">
				<li data-target="#demo" data-slide-to="0" class="active"></li>
			    <li data-target="#demo" data-slide-to="1"></li>
			    <li data-target="#demo" data-slide-to="2"></li>
			</ul>
		    <!-- The slideshow -->
			<div class="carousel-inner">
			    <div class="carousel-item active">
			      <img src="{{ asset('imagenes/joyas1.jpg') }}" alt="Joyas1" height="230">
			    </div>
			    <div class="carousel-item">
			      <img src="{{ asset('imagenes/joyas2.jpg') }}" alt="Joyas2" height="230">
			    </div>
			    <div class="carousel-item">
			      <img src="{{ asset('imagenes/joyas3.jpg') }}" alt="Joyas3" height="230">
			    </div>
			</div>

			<!-- Left and right controls -->
			<a class="carousel-control-prev" href="#demo" data-slide="prev">
			    <span class="carousel-control-prev-icon"></span>
			</a>
			<a class="carousel-control-next" href="#demo" data-slide="next">
			    <span class="carousel-control-next-icon"></span>
			</a>
			<hr>
		</div>
  	</div>
  	<div class="col-sm-2"></div>
</div>
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">		
		<div class="row">
			<div class="col-sm-3">
				<a href="{{route('ventas.index')}}" data-toggle="tooltip" data-placement="bottom"  title="Ventas">
					<img src="{{ asset('imagenes/venta.png') }}" class="mx-auto d-block img-fluid" alt="Cinque Terre" width="120" height="120" >
				</a>				
			</div>
			<div class="col-sm-3">
				<a href="{{route('articulos.index')}}" data-toggle="tooltip" data-placement="bottom"  title="Articulos">
					<img src="{{ asset('imagenes/AddArticulos.png') }}" class="mx-auto d-block img-fluid" alt="Cinque Terre" width="120" height="120" >
				</a>
			</div>
			<div class="col-sm-3">
				<a href="{{route('usuarios')}}" data-toggle="tooltip" data-placement="bottom"  title="Usuarios">
					<img src="{{ asset('imagenes/AddUsuarios.png') }}" class="mx-auto d-block img-fluid" alt="Cinque Terre" width="120" height="120" >
				</a>
			</div>
			<div class="col-sm-3">
				<a href="{{route('ventas.index')}}" data-toggle="tooltip" data-placement="bottom"  title="Reportes">
					<img src="{{ asset('imagenes/Estadisticas.png') }}" class="mx-auto d-block img-fluid" alt="Cinque Terre" width="120" height="120" >
				</a>
			</div>
		</div>
		<hr>
	</div>
	<div class="col-sm-2"></div>
</div>

</div>
