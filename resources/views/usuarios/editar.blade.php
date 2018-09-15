
@extends('layouts.layout')

@section('title')
	Usuarios
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{!! URL::to('usuarios') !!}"><i class="fa fa-user"></i> Usuarios </a> </li>
  <li class="breadcrumb-item active"><i class="fa fa-edit"></i> Editar </li>
@endsection
 
@section('content')

<div class="row">
<div class="col-md-3">

  <!-- Informacion ventas -->
  <div class="box box-primary">
    <div class="box-body box-profile">
      <img class="profile-user-img img-responsive img-circle" src="{{ asset('img/profile-temporal.jpg') }}" alt="User profile picture">

      <h3 class="profile-username text-center">{{ $usuario->nombre }}</h3>

      <p class="text-muted text-center">{{ $usuario->departamento->nombre or "N/D" }}</p>

      <ul class="list-group list-group-unbordered">
        <li class="list-group-item">
          <b>Ventas</b> <a class="pull-right">45</a>
        </li>
        <li class="list-group-item">
          <b>Clientes</b> <a class="pull-right">8</a>
        </li>
        <li class="list-group-item">
          <b>Poductividad</b> <a class="pull-right">89%</a>
        </li>
      </ul>

      <a href="#" onclick="return confirm('Desea eliminar?');" class="btn btn-danger btn-block"><b>Dar de baja</b></a>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /Informacion ventas -->

</div>
<!-- /.col -->


<div class="col-md-9">
  <div class="nav-tabs-custom">

  	{{-- Tabs Header --}}
    <ul class="nav nav-tabs">
      <li class="active"><a href="#informacion" data-toggle="tab">Información</a></li>
      <li><a href="#permisos" data-toggle="tab">Permisos</a></li>
      <li><a href="#productividad" data-toggle="tab">Productividad</a></li>
      <li><a href="#Ventas" data-toggle="tab">Ventas</a></li>
    </ul>
    {{-- /Tabs Header --}}

    {{-- Tab content --}}
    <div class="tab-content">

      {{-- Tab informacion --}}
      <div class="active tab-pane" id="informacion">

        <div class="box box-info">
            <div class="box-header with-border">Datos del usuario</div>
            <div class="box-body"> 
            	@if(Auth::user()->permiso(array('menu',9001)) == 2) 
            	   
        			<div align="right">
                     <a href="#" class="btn btn-primary btn-xs  fa fa-edit fa4x" id="boton_editar" title="Consultar">  </a>          
        			</div>
        		@endif
        		
        		{!! Form::open(array('action' => 'UsuariosController@actualizar','class'=>'form-horizontal','role'=>'form')) !!}

        				<div class="form-group" >
        	 				{!! Form::label('Nombre : ',null, array('class'=>'col-sm-2 control-label')) !!}	
        	 				<div class="input-group col-sm-8">

        	 					{!! Form::text('nombre',$usuario->nombre ,array( 'class' => 'form-control', 'placeholder' => 'Nombre completo del usuario', 'readonly'=>'false')) !!} 
        	 					<p class="text-danger">	{!! $errors->first('nombre')!!} </p>
        	 				</div>
        					
        	 			</div>	
        				
        				<div class="form-group">
        	 				{!! Form::label('Correo :',null, array('class'=>'col-sm-2 control-label')) !!}
        	 				<div class="input-group col-sm-8">
        	 					{!! Form::email('email',$usuario->email,array( 'class' => 'form-control','placeholder' => 'Correo Electronico', 'readonly'=>'readonly')) !!}
        	 				  <p class="text-danger">	{!! $errors->first('email')!!} </p>
        	 				</div>        	 			
        	 			</div>	

 						<div class="form-group">
 			 				{!! Form::label('Telefono(s) :',null, array('class'=>'col-sm-2 control-label')) !!}
 			 				<div class="input-group col-sm-8">
 			 					{!! Form::text('telefonos',$usuario->telefonos,array( 'class' => 'form-control','placeholder' => 'Telefonos', 'readonly'=>'readonly')) !!}
 			 				  <p class="text-danger">	{!! $errors->first('telefonos')!!} </p>
 			 				</div>        	 			
 			 			</div>	

        	 			<div class="form-group">
        	 				{!! Form::label('Contraseña :', null, array('class'=>'col-sm-2 control-label')) !!}
        	 				<div class="input-group col-sm-8">
        	 					{!! Form::text('password','',array( 'class' => 'form-control','placeholder' => 'Contraseña', 'readonly'=>'readonly')) !!}
        	 					<p class="text-danger">	{!! $errors->first('password')!!} </p>
        	 				</div>
        	 				
        	 			</div>

        	 			<div class="form-group">
        	 				{!! Form::label('Departamento :', null, array('class'=>'col-sm-2 control-label')) !!}

        	 				<div class="input-group col-sm-8">
        	 					{!! Form::select('departamentos_id',$departamentos,$usuario->departamentos_id,array( 'class' => 'form-control select','placeholder' => '-- Seleccione departamento --', 'disabled'=>'disabled')) !!}
        	 					<p class="text-danger">	{!! $errors->first('departamentos')!!} </p>
        	 				</div>        	 				
        	 			</div>

        	 			{!! Form::hidden('id',$usuario->id)!!}
        				<div align="right" class="box-footer">
                    	    <button type="submit" class="btn btn-primary"  id="boton_grabar", secure = null style="display:none"> <i class="fa fa-floppy-o" aria-hidden="true" ></i> Grabar</button>
        				</div>
        				
        		{!! Form::close()!!}			

            </div>
        </div>

      </div>
      <!-- /Tab informacion -->

      {{-- Tab permisos --}}
      <div class="tab-pane" id="permisos">

      	<!-- Permisos -->
      	<div class="box box-info">
      	    <div class="box-header with-border">Permisos</div>
      	    <div class="box-body">

      	    	@if( Auth::user()->permiso(array('menu',9001)) == 2)   
      				<div align="right" style="padding-bottom:20px">

      				<div class="btn-group pull-left" id="botonesTodosPermisos" style="display: none;" title="Selección rápida de permisos globales">
      				 <button class="btn btn-success" data-toggle="dropdown"><i class="fa fa-star-o"></i> Permisos Globales</button>
      			     <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
      			        <span class="caret"></span>
      			     </button>

      			      <ul class="dropdown-menu" role="menu">
      			        <li><a id="btnAccesoTotal"><i class="fa fa-android"></i> Acceso Total</a></li>
      			        <li><a id="btnAccesoLectura"><i class="fa fa-book"></i> Acceso Lectura</a></li>
      			        <li><a id="btnRemoverPermisos"><i class="fa fa-user-times"></i> Remover permisos</a></li>
      			      </ul>

      			    </div>

      	             <a class="btn btn-primary btn-xs  fa fa-edit fa4x" id="boton_editar2" title="Consultar">  </a>         
      				</div>
      			@endif


      			{!! Form::open(array('action' => 'UsuariosController@update_permisos','class'=>'form-horizontal','role'=>'form')) !!}
      						

      		    <?php $elemento= 0;?>
      		    				
      		    @foreach ($menus as $menu) 

      				
      				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      					  <div class="panel panel-default">
      					    <div class="panel-heading" role="tab" id="headingOne">
      					      <h4 class="panel-title">
      					        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#{!! substr($menu->codigo,0,2) !!} " aria-expanded="true" aria-controls="collapseOne">
      					          {!! $menu->area !!}
      					        </a>
      					      </h4>
      					    </div>
      					    <div id="{!! substr($menu->codigo,0,2) !!}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      					      <div class="panel-body">
      					     
      					      <?php 
      					     
      					      	 $opcs   = DB::table('menus')->where( DB::raw('substr(codigo,1,2)'),'=',substr($menu->codigo,0,2) )->select('id','codigo','dependencia','area','opcion','url')->get();
      					     
      					      ?>			

      						  @foreach( $opcs as $opc)


      							<div class="form-group">
      		 						{!! Form::label($opc->codigo,$opc->opcion, array('class'=>'col-sm-4 control-label')) !!}
      				 				<div class="input-group col-sm-2">

      				 					{!! Form::select($opc->codigo,$opciones, $usuario->permiso(array('menu',$opc->codigo)) ,array( 'class' => 'form-control opciones', 'disabled'=>'disabled')) !!}
      				 					
      				 				</div>
      		 					</div>
      		 					<?php $elemento  = $elemento + 1; ?>
      		 				  @endforeach

      					      </div>
      					    </div>
      					  </div>
      				</div>
      				@endforeach

      				<div class="col-md-12">
      					
      					{{-- <div class="form-ckeck">
      						{!! Form::label('permiso_supervisor_crm', 'Permiso supervisar CRM', ['class'=>'form-check-label']) !!}

      						{!! Form::checkbox('permiso_supervisor_crm', 1, ($permiso_supervisor_crm == 1)?true:false, ['class'=>'form-check-input opciones', 'disabled'=>'disabled']) !!}
      					</div>	 --}}

      				</div>
      				
      				{!! Form::hidden('usuario_id',$usuario->id)!!}

      				<div align="right" class="box-footer">
      	        	    <button type="submit" class="btn btn-primary"  id="boton_grabar2", secure = null style="display:none"> <i class="fa fa-floppy-o" aria-hidden="true" ></i> Grabar</button>
      				</div>

      			{!! Form::close() !!}

      			

      	    </div>
      	</div>
      	<!-- /Permisos -->

      </div>
      <!-- /Tab permisos -->

      {{-- Tab Productividad --}}
      <div class="tab-pane" id="productividad">
      </div>
      {{-- /Tab Productividad --}}

      {{-- Tab Ventas --}}
      <div class="tab-pane" id="ventas">
      </div>
      {{-- /Tab Ventas --}}

    </div>
    <!-- /.tab-content -->
  </div>
  <!-- /.nav-tabs-custom -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->

@endsection


@section('script')
	
	@include('layouts.includes.autocomplete')

	<script type="text/javascript">

		$(function(){ 

			//Deshabilitar Selects al recargar
			$('#grupo').prop("disabled", true);
			$('#proceso').prop("disabled", true);
			$('#puesto').prop("disabled", true);

		 	//Boton Permiso Total
		 	var btnAccesoTotal = $('#btnAccesoTotal');
		 	var btnAccesoLectura = $('#btnAccesoLectura');
		 	var btnRemoverPermisos = $('#btnRemoverPermisos');

		 	$('#boton_editar2').click(function(event) {
		        event.preventDefault();
		        $('#boton_grabar2').show();
		        $('.opciones').removeAttr("disabled",false);			        
		        $('#botonesTodosPermisos').show();
		    });

		    btnAccesoTotal.click(function(event) {
		       	$('.opciones').val(2);
		    });

		    btnAccesoLectura.click(function(event) {
		       	$('.opciones').val(1);
		    });

		    btnRemoverPermisos.click(function(event) {
			    $('.opciones').val(0);
		    });

			//Acciones si pertenece a junta
			$('#boton_editar').click(function(event) {

				event.preventDefault();
				$('#boton_grabar').show();
				//$('#boton_editar').hide();

				$('.select').removeAttr("disabled");

				$('input[name="nombre"]').prop("readonly", false);
				$('input[name="email"]').prop("readonly", false);
				$('input[name="password"]').prop("readonly", false);
				$('input[name="puesto"]').prop("readonly", false);
				$('#grupo').prop("disabled", false);
				$('#proceso').prop("disabled", false);
				$('#puesto').prop("disabled", false);
				$('input[name="pertenece_junta"]').prop("disabled",false);
				$('input[name="puesto_junta"]').prop("readonly",false);
				$('input[name="smtp_usuario"]').prop("readonly", false);
				$('input[name="smtp_pass"]').prop("readonly", false);
				$('input[name="smtp_port"]').prop("readonly", false);
				$('input[name="smtp_server"]').prop("readonly", false);
				$('input[name="telefonos"]').prop("readonly", false);

				$('#smtp_security').removeAttr("readonly");
				$('#smtp_security').removeAttr("disabled");

				$('.empresas_id').removeAttr("disabled",false);

			});
		 
			$('#boton_editar2').click(function(event) {

				event.preventDefault();
				$('#boton_grabar2').show();
				$('.opciones').removeAttr("disabled",false);
				$('.permiso-checkbox').removeAttr("disabled",false);
				$('#btnAdministrador').show();


			});

		});
	</script>
@endsection
	