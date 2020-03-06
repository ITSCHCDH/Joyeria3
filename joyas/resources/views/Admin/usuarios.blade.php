@section('content')
    @extends('layouts.app')
    <div class="row">
    	<div class="col-md-2"></div>
    	<div class="col-md-8">
    		<h3>Usuarios</h3> 
    		<a href="{{route('registro')}}" type="button" class="btn btn-success btn-sm"> Nuevo</a>
    		<div class="table-responsive">
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
    	</div>
    	<div class="col-md-2"></div>
    </div>    
@endsection