<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Configuracion;

use Hashids;
use Auth;
use Datatables;

class ConfiguracionController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

    public function obtener($id){
        $material = Materiales::find($id);

        return response()->json([
            'material' => $material
        ]);
    }

    public function index(Request $request) {
        if(Auth::user()->permiso(array('menu',9002)) < 1 )
            return redirect()->back();

        return view('configuracion.index');
    }

    public function datatables() {

        $datos = Configuracion::activos()->get();

        return Datatables::of($datos)
        ->editcolumn('id',function ($registro) {

            $opciones = "";

            if (Auth::user()->permiso(array('menu',9002)) > 0) {

                $opciones = '<a class="btn btn-primary btn-xs" title="Consultar" data-identifier="'.Hashids::encode($registro->id).'" data-formulario="editar" data-toggle="modal" data-target="#modalPagoLS" style="margin-right: 4px;">    <i class="fa fa-folder-open"></i> </a>';
            }

            /*if (Auth::user()->permiso(array('menu',9002)) == 2) {
                $opciones .= '<a href="'. url('parametros/eliminar/'.  Hashids::encode($registro->id) ) .'"  onclick="return confirm('."' Eliminar parametro ?'".')" class="btn btn-danger btn-xs " title="eliminar">   <i class="fa fa-trash"></i> </a>';
            }*/

            return $opciones;

        })
        ->editColumn('valor', function($registro){
        	return $registro->valor;
        })
        ->escapeColumns([])       
        ->make(TRUE);
    }

    public function crear(){
        if(Auth::user()->permiso(array('menu',9002)) < 2)
            return redirect()->back();

        return view('configuracion.formularios.crear');
    }

    public function guardar(Request $request) {
        if(Auth::user()->permiso(array('menu',9002)) < 2)
            return redirect()->back();

        $parametro = new Configuracion;

        $parametro->identificador = ($request->identificador != null)?$request->identificador:"";
        $parametro->nombre   = ($request->nombre != null)?$request->nombre:"";
        $parametro->valor    = ($request->valor != null)?$request->valor:"";
                       
        $parametro->save();

        return redirect()->back();
    }

    public function ver($hash_id){
        if(Auth::user()->permiso(array('menu',9002)) < 2)
            return redirect()->back();
        
        $id = Hashids::decode($hash_id);

        if ($id[0] == null)
            return redirect()->back();
        
        $parametro = Configuracion::find($id[0]);

        return view('configuracion.ver',compact('parametro'));
    }

    public function editar($hash_id){
        if(Auth::user()->permiso(array('menu',9002)) < 1)
            return redirect()->back();
        
        $id = Hashids::decode($hash_id);

        if ($id[0] == null)
            return redirect()->back();

        $parametro = Configuracion::find($id[0]);

        return view('configuracion.formularios.editar',compact('parametro'));
    }

    public function actualizar(Request $request) {
        if(Auth::user()->permiso(array('menu',9002)) < 2)
            return redirect()->back();

        $parametro = Configuracion::find($request->id);

        if ($parametro) {
            $parametro->identificador = ($request->identificador != null)?$request->identificador:"";
            $parametro->nombre   = ($request->nombre != null)?$request->nombre:"";
            $parametro->valor    = ($request->valor != null)?$request->valor:"";
                   
            $parametro->save();
        }

        return redirect()->back();
    }
	
	public function eliminar($hash_id){
        if(Auth::user()->permiso(array('menu',9002)) < 2)
            return redirect()->back();
		
		$id = Hashids::decode($hash_id);
                
        $parametro = Configuracion::find($id[0]);

		if ($parametro) { 
			$parametro->estatus = 0; 
			$parametro->save();
		}

		return redirect()->back();
	}
}
