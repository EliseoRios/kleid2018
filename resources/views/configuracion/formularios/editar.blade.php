{!! Form::open(array('action' => 'ConfiguracionController@actualizar',"class" => "form")) !!}
<div class="modal-body">
	@if(Auth::user()->permiso(array('menu',2005)) == 2 || Auth::user()->departamentos_id == 1)
	<button type="button" id="btnEditar" class="btn btn-xs btn-info pull-right" style="margin: 5px;" title="Editar"><i class="fa fa-edit"></i> Editar</button>
	<br>
	@endif

	<div class="form-group">
		{!! Form::label('identificador', 'Identificador : ', ['class'=>'control-label']) !!}

		{!! Form::text('identificador',  $parametro->identificador, ['class'=>'form-control input-text', 'readonly','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('nombre', 'Nombre : ', ['class'=>'control-label']) !!}

		{!! Form::text('nombre', $parametro->nombre, ['class'=>'form-control input-text', 'readonly','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('valor', 'Valor : ', ['class'=>'control-label']) !!}

		{!! Form::number('valor', $parametro->valor, ['class'=>'form-control input-text', 'readonly','required', 'step'=>'any']) !!}
	</div>

	{!! Form::hidden('id', $parametro->id, ['style'=>'width: 0px;']) !!}
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
	<button type="submit" class="btn btn-primary" style="display: none;" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
</div>
{!! Form::close() !!}

<script>
$(function(){
	$('#btnEditar').click(function(){
		$('.input-text').removeAttr('readonly');
		$('#btnGuardar').show();
	});
});
</script>