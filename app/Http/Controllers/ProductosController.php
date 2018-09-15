<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Productos;
use App\Models\Materiales;
use App\Models\Configuracion;
use App\Models\Usuarios;
use App\Models\Departamentos;

use Auth;
use Datatables;
use Hashids;

class ProductosController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

    public function index(Request $request) {
        return view('productos.index');      
    }

    public function datatables() {

        $datos = Productos::activos()->get();

        return Datatables::of($datos)
        ->editcolumn('id',function ($registro) {

            $opciones = "";

            if (Auth::user()->permiso(array('menu',2002)) == 2 ) {

                $opciones = '<a href="'. url('productos/editar/'.  Hashids::encode($registro->id) ) .'" class="btn btn-primary btn-xs " title="Consultar" style="margin-right: 5px;"><i class="fa fa-folder-open"></i> </a>';

                $opciones .= '<a href="'. url('productos/eliminar/'.  Hashids::encode($registro->id) ) .'"  onclick="return confirm('."' Eliminar producto ?'".')" class="btn btn-danger btn-xs " title="eliminar">   <i class="fa fa-trash"></i> </a>';

            } 

            return $opciones;

        })
        ->editcolumn('materiales_id', function($producto){
            $material = ($producto->material != null)?$producto->material->nombre:"N/D";
            return $material;
        })
        ->editcolumn('genero', function($producto){
            $array_genero = config('sistema.generos');
            $genero = (array_key_exists($producto->genero, $array_genero))?$array_genero[$producto->genero]:"N/D";
            return $genero;
        })
        ->editcolumn('estatus',function ($usuario){ 

            if ($usuario->estatus ==1)  {
                return "Activo";
            } else {
                return "Eliminado";
            }

        })

        ->escapeColumns([])       
        ->make(TRUE);
    }
    
    public function guardar(Request $request) {

         $producto = new Productos;

         $producto->codigo = ($request->codigo)?$request->codigo:"";
         $producto->usuarios_id = Auth::user()->id;
         $producto->nombre = ($request->nombre)?$request->nombre:"";
         $producto->descripcion = ($request->descripcion)?$request->descripcion:"";

         $material = Materiales::find($request->materiales_id);
         if(isset($material)){
	         $producto->materiales_id = ($request->materiales_id)?$request->materiales_id:0;
         }else{
         	$material = new Materiales;
         	$material->nombre = $request->materiales_id;
         	$material->save();

         	$producto->materiales_id = $material->id;
         }

         $producto->genero = ($request->genero)?$request->genero:0;

         $producto->costo = ($request->costo)?(float)$request->costo:0;
         $producto->precio = ($request->precio)?(float)$request->precio:0;
         $producto->ganancia = $producto->precio - $producto->costo;

         //Automaticos
         $parametro_comision = (int)Configuracion::where('identificador','comision')->first()->valor;
         $parametro_abono = (int)Configuracion::where('identificador','abono')->first()->valor;

         $producto->comision_propuesta = $parametro_comision * $producto->ganancia / 100;
         $producto->precio_abono = ($parametro_abono * $producto->precio / 100) + $producto->precio;
         $producto->ganancia_final = $producto->ganancia - $producto->comision_propuesta;

         $producto->save();

         return redirect('productos/editar/'.Hashids::encode($producto->id));
        
    }

    public function editar($hash_id){
        
        $id = Hashids::decode($hash_id);
                
        $usuario = Usuarios::find($id[0]);

        if ($id[0] == null)
            return redirect()->back();

        $opciones = array('0'=>'Sin Permiso','1'=>'Lectura','2'=>'Total');

        //$permiso_supervisor_crm = $usuario->permiso(array('permiso_supervisor_crm','9999'));
        $departamentos = Departamentos::activos()->pluck('nombre','id');

        return view('usuarios.editar',compact('usuario','opciones','permiso_supervisor_crm','permiso_crear_proyectos','permiso_reportes_oportunidades','departamentos'));
    }

    public function actualizar(Request $request) {

        $usuario = Usuarios::find($request->id);
        //dd($request->all());

        if ($usuario) {

            $usuario->nombre = ($request->nombre != null)?$request->nombre:"";
            $usuario->email = ($request->email != null)?$request->email:"";
            $usuario->telefonos = ($request->telefonos != null)?$request->telefonos:"";
            $usuario->departamentos_id = ($request->departamentos_id != null)?$request->departamentos_id:0;

            if ($request->password != "")
                $usuario->password = Hash::make($request->password);
            
            $usuario->save();

        }

        //return redirect('usuarios/editar/'.Hashids::encode($usuario->id));
        return redirect()->back();
    }	
	
	public function eliminar($hash_id){
		
		$id = Hashids::decode($hash_id);
                
        $usuario = Usuarios::find($id[0]);

        if ($id[0] == null)
            return redirect()->back();

		if ($usuario) { 
			$usuario->estatus = 0; 
			$usuario->email   = 'x'. $usuario->email;

			$usuario->save();
		}

		return redirect()->back();

	}	

	public function update_permisos(Request $request) {

		$usuario  = Usuarios::find($request->usuario_id);

		$opciones= array();
		$opciones = $request->except('usuario_id','_token');

		$usuario->borrar_permisos();

		foreach($opciones as $codigo => $valor) {
		
			if ($valor != 0 ) {
				$usuario->agregar_permiso(array('menu',$codigo,$valor));
			}

		}

        //Permiso Supervisor de CRM
        /*if ($request->has('permiso_supervisor_crm'))
            $usuario->agregar_permiso(array('permiso_supervisor_crm',9999,$request->permiso_supervisor_crm)); 
        else
            $usuario->agregar_permiso(array('permiso_supervisor_crm',9999,0));*/
        
		$usuario->save();
		
		// return redirect('usuarios/editar/'.Hashids::encode($usuario->id));
		return redirect()->back();
	}
}
