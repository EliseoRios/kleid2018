{!! Form::open(array('action' => 'ConfiguracionController@guardar',"class" => "form")) !!}
<div class="modal-body">
	<div class="form-group">
		{!! Form::label('identificador', 'Identificador : ', ['class'=>'control-label']) !!}

		{!! Form::text('identificador', null, ['class'=>'form-control', 'required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('nombre', 'Nombre : ', ['class'=>'control-label']) !!}

		{!! Form::text('nombre', null, ['class'=>'form-control', 'required']) !!}
	</div>	

	<div class="form-group">
		{!! Form::label('valor', 'Valor : ', ['class'=>'control-label']) !!}

		{!! Form::text('valor', null, ['class'=>'form-control','required', 'step'=>'any']) !!}
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
	<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
</div>
{!! Form::close() !!}