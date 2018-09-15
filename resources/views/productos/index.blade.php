@extends('layouts.layout')

@section('title')
	Productos
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item active">Productos</li> 
@endsection
 
@section('content')

<!-- Panel Productos -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Listado de Productos</h3>
  </div>

  <div class="box-body">

	@if (Auth::user()->permiso(array('menu',2002)) == 2 )	
		{!! Html::link('#','Agregar producto',array('class'=>"btn btn-primary m-b-10 m-l-5",'style'=>'margin-bottom:40px', 'data-toggle' => 'modal', 'data-target' => '#modalNuevo'))!!}
    @endif
    
    <!-- Listado de productos -->
	<div class="table-responsive">
      <table id="dtusuarios" class="table table-condensed small table-striped table-bordered table-hover">  				                     
      <thead>
          <tr>

	          <th style="max-width:40px"></th>
	          <th>Código</th>
	          <th>Nombre</th>
	          <th>Material</th>
	          <th>Genero</th>
	          <th>Costo</th>
	          <th>Precio</th>
                                     
          </tr>
       </thead>
      <tbody>
      </tbody>
      </table>
  	</div>
  	<!-- /Listado de productos -->

  </div>
  
</div>
<!-- /Panel de productos-->

{{-- Modal nuevo --}}
<div class="modal fade" id="modalNuevo">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Nuevo producto</h4>
			</div>
			{!! Form::open(array('action' => 'ProductosController@guardar','role'=>'form')) !!}
			<div class="modal-body">

					{!! Form::hidden('_token', csrf_token(),array('id'=>'token')) !!}

					<div class="row">
						<div class="col-md-6">
							<div class="form-group" >
								{!! Form::label('codigo', 'Código :' ,array('class'=>'control-label')) !!}

								{!! Form::text('codigo','',array( 'class' => 'form-control', 'placeholder' => 'Código', 'required')) !!}
							</div>

							<div class="form-group" >
								{!! Form::label('materiales_id', 'Material :' ,array('class'=>'control-label')) !!}

								{!! Form::select('materiales_id',[],null,array( 'class' => 'form-control select2-tags', 'data-placeholder' => 'Material', 'style'=>'width: 100%;')) !!}
							</div>

							<div class="form-group" >
								{!! Form::label('costo', 'Costo :' ,array('class'=>'control-label')) !!}

								{!! Form::number('costo',null,array( 'class' => 'form-control', 'step'=>'any','placeholder' => 'Costo', 'required')) !!}
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group" >
								{!! Form::label('nombre', 'Nombre :' ,array('class'=>'control-label')) !!}

								{!! Form::text('nombre','',array( 'class' => 'form-control', 'placeholder' => 'Nombre', 'required')) !!}
							</div>					

							<div class="form-group" >
								{!! Form::label('genero', 'Genero :' ,array('class'=>'control-label')) !!}

								{!! Form::select('genero',[0=>'Unisex', 1=>'Masculino', 2=>'Femenino'],0,array( 'class' => 'form-control', 'required')) !!}
							</div>					

							<div class="form-group" >
								{!! Form::label('precio', 'Precio :' ,array('class'=>'control-label')) !!}

								{!! Form::number('precio',null,array( 'class' => 'form-control', 'step'=>'any','placeholder' => 'Precio', 'required')) !!}
							</div>
						</div>
					</div>
					
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
				<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
			</div>
			{!! Form::close()!!}
		</div>
	</div>
</div>
{{-- /Modal nuevo --}}

{{-- <div class="form-group">
	{!! Form::label('Correo :',null, array('class'=>'col-sm-2 control-label')) !!}
	<div class="input-group col-sm-8">
		{!! Form::email('email','',array( 'class' => 'form-control','placeholder' => 'Correo Electronico')) !!}
	  <p class="text-danger">	{!! $errors->first('email')!!} </p>
	</div>
</div> --}}
@endsection 


@section('script')

	@include('layouts.includes.datatables')
	@include('layouts.includes.select2')	

	<script type="text/javascript">

		$(function(){ 

		   $(".select2-tags").select2({
		     tags: true
		   });

		   @if ($errors->any())
	              $('#modalNuevo').modal('show');
		   @endif

		    $('#dtusuarios').DataTable({
	            processing: true,
	            serverSide: true,
	            ajax: "{!!URL::to('productos/datatables')!!}",
	            columns: [
	                {data: 'id', name: 'id'},                
	                {data: 'codigo', name: 'codigo'},               
	                {data: 'nombre', name: 'nombre'},
	                {data: 'materiales_id', name: 'materiales_id'},
	                {data: 'genero', name: 'genero'},
	                {data: 'costo', name: 'costo'},
	                {data: 'precio', name: 'precio'}
                ],
                order: [],
	            language: {
	               "sProcessing":     "Procesando...",
					"sLengthMenu":     "Mostrar _MENU_ registros",
					"sZeroRecords":    "No se encontraron resultados",
					"sEmptyTable":     "Ningún dato disponible en esta tabla",
					"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
					"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
					"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
					"sInfoPostFix":    "",
					"sSearch":         "Buscar:",
					"sUrl":            "",
					"sInfoThousands":  ",",
					"sLoadingRecords": "Cargando...",
					"oPaginate": {
						"sFirst":    "Primero",
						"sLast":     "Ultimo",
						"sNext":     "Siguiente",
						"sPrevious": "Anterior"
					},
					"oAria": {
						"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
						"sSortDescending": ": Activar para ordenar la columna de manera descendente"
					} 
				}   
	            
	      });
		
		});

	</script>

@endsection
