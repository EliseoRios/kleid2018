@extends('layouts.layout')

@section('title')
	Usuarios
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item active">Usuarios</li> 
@endsection
 
@section('content')

<!-- Panel Usuarios -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Listado de Usuarios</h3>
  </div>

  <div class="box-body">

	@if (Auth::user()->permiso(array('menu',9001)) == 2 ) 
	
	{!! Html::link('#','Agregar Usuario',array('class'=>"btn btn-primary m-b-10 m-l-5",'style'=>'margin-bottom:40px', 'data-toggle' => 'modal', 'data-target' => '#modalNuevo'))!!}
    @endif
    
    <!-- Listado de usuarios -->
	<div class="table-responsive">
      <table id="dtusuarios" class="table table-condensed small table-striped table-bordered table-hover">  				                     
      <thead>
              <tr>
                  
                  <th style="max-width:40px"></th>
                  <th>Nombre</th>
                  <th>Correo</th>
                  <th>Estatus</th>
                                         
              </tr>
       </thead>
      <tbody>
      </tbody>
      </table>
  	</div>
  	<!-- /Listado de usuarios -->

  </div>

  <div class="box-footer">
    
  </div>
  
</div>
<!-- /Panel de Usuarios-->

<!-- Modal -->
<div class="modal fade" id="modalNuevo" role="dialog" aria-labelledby="modalNuevo">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #f5f5f5">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar Usuario</h4>
      </div>

			{!! Form::open(array('action' => 'UsuariosController@guardar','class'=>'form-horizontal','role'=>'form')) !!}
		   	        
				
      <div class="modal-body">
      
				{!! Form::hidden('_token', csrf_token(),array('id'=>'token')) !!}

		

				<div class="form-group" >
	 				{!! Form::label('Nombre : ', null ,array('class'=>'col-sm-2 control-label')) !!}	
	 				<div class="input-group col-sm-8">
	 					{!! Form::text('nombre','',array( 'class' => 'form-control', 'placeholder' => 'Nombre completo del usuario')) !!} 
	 					<p class="text-danger">	{!! $errors->first('nombre')!!} </p>
	 				</div>
					
	 			</div>	
				
				<div class="form-group">
	 				{!! Form::label('Correo :',null, array('class'=>'col-sm-2 control-label')) !!}
	 				<div class="input-group col-sm-8">
	 					{!! Form::email('email','',array( 'class' => 'form-control','placeholder' => 'Correo Electronico')) !!}
	 				  <p class="text-danger">	{!! $errors->first('email')!!} </p>
	 				</div>
	 			
	 			</div>

	 			<div class="form-group">
	 				{!! Form::label('Password :', null, array('class'=>'col-sm-2 control-label')) !!}
	 				<div class="input-group col-sm-8">
	 					{!! Form::text('password','',array( 'class' => 'form-control','placeholder' => 'Password')) !!}
	 					<p class="text-danger">	{!! $errors->first('password')!!} </p>
	 				</div>
	 				
	 			</div>
        </div>
     	
        <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> Cancelar</button>
		        <button type="submit" class="btn btn-primary"  id="grabar", secure = null> <i class="fa fa-floppy-o" aria-hidden="true" ></i> Grabar</button>
		
        </div>
      {!! Form::close()!!}
    </div>

@endsection 


@section('script')

	@include('layouts.includes.datatables')
	

	<script type="text/javascript">

		$(function(){ 

		   @if ($errors->any())
	              $('#modalNuevo').modal('show');
		   @endif

		    $('#dtusuarios').DataTable({
	            processing: true,
	            serverSide: true,
	            ajax: "{!!URL::to('usuarios/datatables')!!}",
	            columns: [
                {data: 'id', name: 'id'},                
                {data: 'nombre', name: 'nombre'},
                {data: 'email', name: 'email'},
                {data: 'estatus', name: 'estatus'}
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
