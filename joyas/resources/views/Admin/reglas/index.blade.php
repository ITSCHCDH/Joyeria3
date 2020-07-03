@section('content')
    @extends('layouts.app')  
	<h2>Reglas de negocio</h2>
	<hr>		
		@if($reglas->isEmpty())
			<form action="{{ route('reglas.store') }}">	
				<div class="input-group mb-3 input-group-sm">
				    <div class="input-group-prepend">
				       <span class="input-group-text">Gastos operativos</span>
				    </div>
				    <input type="number" min="1" max="100" class="form-control" placeholder="Introduce el porcentaje" data-toggle="tooltip" data-placement="top" title="Porcentaje de las ganancias destinado a gastos operativos del negocio" id="prc_op" name="prc_operacion">
		    	</div>
			    <div class="input-group mb-3 input-group-sm">
				    <div class="input-group-prepend">
				       <span class="input-group-text">Ganancia</span>
				    </div>
				    <input type="number" min="1" max="100" class="form-control" placeholder="Introduce el porcentaje" data-toggle="tooltip" data-placement="top" title="Porcentaje de ganancia en cada producto vendido" id="prc_gan" name="prc_ganancia">
			  	</div>
		  		<button type="submit" class="btn btn-primary btn-sm pull-right">Guardar</button>
			</form>
		@else
			@foreach($reglas as $reg)
				<form action="{{ route('reglas.actualizar',$reg->id) }}">	
			  		<div class="input-group mb-3 input-group-sm">
					    <div class="input-group-prepend">
					       <span class="input-group-text">Gastos operativos</span>
					    </div>
					    <input type="number" min="1" max="100" class="form-control" placeholder="Introduce el porcentaje" data-toggle="tooltip" data-placement="top" title="Porcentaje de las ganancias destinado a gastos operativos del negocio" value="{{$reg->prc_operacion}}" id="prc_op" name="prc_operacion">
			    	</div>
				    <div class="input-group mb-3 input-group-sm">
					    <div class="input-group-prepend">
					       <span class="input-group-text">Ganancia</span>
					    </div>
					    <input type="number" min="1" max="100" class="form-control" placeholder="Introduce el porcentaje" data-toggle="tooltip" data-placement="top" title="Porcentaje de ganancia en cada producto vendido" value="{{$reg->prc_ganancia}}" id="prc_gan" name="prc_ganancia">
				  	</div>
				  	<button type="submit" class="btn btn-primary btn-sm pull-right">Guardar</button>
			  	</form>					
	  		@endforeach	
		@endif	
@endsection