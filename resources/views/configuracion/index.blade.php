@extends('layouts.layout')

@section('title')
	Parametros
@endsection

@section('menu')
   @include('layouts.menu')
@endsection

@section('breadcrumb')
	<li class="active"><i class="fa fa-money"></i> Configuración</li>
@endsection
 
@section('content')

			<!-- box PagoLS -->
			<div class="box box-primary">
			  <div class="box-header with-border">
			    <h3 class="box-title">Listado de parametros</h3>
			  </div>

			  <div class="box-body">

				@if (Auth::user()->permiso(array('menu',9002)) == 2) 
				{{-- <a class="btn btn-primary" data-toggle="modal" data-identifier="0" data-formulario="crear" data-target="#modalPagoLS" style="margin-bottom: 15px;">Agregar parametro</a> --}}
			    @endif
	            
	            <!-- Listado de PagoLS -->
				<div class="table-responsive">
		          <table id="dtPagoLS" class="table table-condensed small table-striped table-bordered table-hover">  				                     
                  <thead>
                          <tr>
                              
                              <th style="max-width:40px"></th>
                              <th>Identificador</th>
                              <th>Nombre</th>
                              <th>Valor</th>
                                                     
                          </tr>
                   </thead>
                  <tbody>
                  </tbody>
		          </table>
		      	</div>
		      	<!-- /Listado de PagoLS -->

			  </div>

			  <div class="box-footer">
			    
			  </div>
			  
			</div>
			<!-- /box de PagoLS-->

			<!-- Modal PagoLS -->
			<div class="modal fade" id="modalPagoLS">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="modalPagoLSTitle"></h4>
						</div>						
						<span id="contenido_modal"><!-- Desde script --></span>
					</div>
				</div>
			</div>
			<!-- /Modal PagoLS -->

@endsection 


@section('script')

	@include('layouts.includes.datatables')	

	<script type="text/javascript">

		$(function(){ 

			$('#modalPagoLS').on('shown.bs.modal', function(evento){
				var id = $(evento.relatedTarget).data('identifier');
				var formulario = $(evento.relatedTarget).data('formulario');
				var url = "";
				var titulo = "";

				switch (formulario) {
					case 'crear':
						titulo = "Crear parametro";
						url = "{{ url('parametros/crear') }}";
						break;
					case 'editar':
						titulo = "Editar parametro";
						url = "{{ url('parametros/editar') }}/"+id;
						break;
					default:
						// statements_def
						break;
				}

				$('#modalPagoLSTitle').text(titulo);
				$('#contenido_modal').load(url);
			});

		    $('#dtPagoLS').DataTable({
	            processing: true,
	            serverSide: true,
	            stateSave: true,
	            order: [],
	            ajax: "{!!URL::to('parametros/datatables')!!}",
	            columns: [
	                {data: 'id', name: 'id'},                
	                {data: 'identificador', name: 'identificador'},
	                {data: 'nombre', name: 'nombre'},
	                {data: 'valor', name: 'valor'}
                ],

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
