<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\DireccionCliente as Direccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DireccionController extends Controller
{
    public function getAll(){
        $direcciones = Direccion::join('clientes as c','c.id','direccion_clientes.cliente_id')
                                ->select('direccion_clientes.*','c.nombre as nombre','c.apellido_paterno as apellido_paterno','c.apellido_materno as apellido_materno')
                                ->orderBy('nombre','asc')
                                ->paginate(10);
    
        return view('direcciones.index',[
            'direcciones' => $direcciones,
            'clientes'    => Cliente::orderBy('nombre','asc')->get()
        ]);
    }

    public function getOne(Request $request){
        $id = $request->post('id');
        $direccion = Direccion::join('clientes as c','c.id','direccion_clientes.id')
                                ->select('direccion_clientes.*','c.id','c.nombre as nombre','c.apellido_paterno as apellido_paterno','c.apellido_materno as apellido_materno')
                                ->where('direccion_clientes.id',$id)
                                ->first();
        return response()->json([$direccion]);
    }

    public function Store(Request $request){
        $id = $request->post('id');
        if($id != 0 || $id='Elegir'){
            $rules= [
                'cliente_id' =>'required|not_in:Elegir|unique:direccion_clientes,id,'.$id,
                'calle' =>'required',
                'num_ext' =>'required',
                'pais' =>'required',
                'colonia' =>'required',
                'estado' =>'required'
            ];
        }else{
            $rules= [
                'cliente_id' =>'required|not_in:Elegir|unique:direccion_clientes',
                'calle' =>'required',
                'num_ext' =>'required',
                'pais' =>'required',
                'colonia' =>'required',
                'estado' =>'required'
            ];
        }
        
        $messages=[
            'cliente_id.required' =>'El cliente es requerido',
            'cliente_id.not_in' =>  'Seleccione un cliente valido',
            'cliente_id.unique' =>  'El cliente ya tiene una direccion registrada',
            'calle.required' =>'La calle es requerida',
            'num_ext.required'    =>'El numero externo es requerido',
            'pais.required' =>'EL pais es requerido',
            'colonia.required' =>'La colonia es requerida',
            'estado.required' =>'EL estado es requerido'
        ];
       
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->passes()) {
            if($id != 0){
                $direccion = Direccion::find($id);
                $direccion->update($request->all());
                $direccion->save();
    
                return response()->json([
                    'type' => 'success',
                    'message' =>'Se ha actualizado correctamente'
                ]);
            }else{
                $direccion = Direccion::create($request->all());
                $direccion->save();
    
                return response()->json([
                    'type' => 'success',
                    'message' =>'Se ha registrado correctamente'
                ]);
            }
           
        
        }else{
            return response()->json([
                    'type' => 'validate',
                    'errors' => $validator->errors()
                ]);
        
        }
    }



    public function Destroy($id){
        $direccion = Direccion::find($id);
        $deleted = $direccion->delete(); 
        if($deleted){
                return response()->json(['type' => 'deleted',
                                        'message' =>'Se ha eliminado correctamente']);
        }else{
            return response()->json(['type' => 'not_deleted', 'message' =>'No se ha podido eliminar']);
        }

    }
}
