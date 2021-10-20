<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function getAll(){
        $clientes = Cliente::orderBy('nombre','asc')->paginate(10);

        return view('clientes.index',[
            'clientes' => $clientes,
            'id'       =>0
        ]);
    }

    public function getOne(Request $request){
        $id = $request->post('id');
        $cliente = Cliente::find($id);

        return response()->json([$cliente]);
    }

    public function Store(Request $request){
        $id = $request->post('id');
        if($id != 0){
            $rules= [
                'nombre' =>'required|min:3',
                'apellido_paterno' =>'required',
                'email' =>'required|unique:clientes,email,'.$id,
                'telefono' =>'required'
            ];
        }else{
            $rules= [
                'nombre' =>'required|min:3',
                'apellido_paterno' =>'required',
                'email' =>'required|unique:clientes',
                'telefono' =>'required'
            ];
        }
        
        $messages=[
            'nombre.required' =>'El nombre es requerido',
            'nombre.min'      =>'Debe tener al menos 3 caracteres',
            'apellido_paterno.required' =>'El apellido paterno es requerido',
            'email.required'    =>'El correo electronico es requerido',
            'telefono.required' =>'EL telefono es requerido'
        ];
       
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->passes()) {
            if($id != 0){
                $cliente = Cliente::find($id);
                $cliente->update($request->all());
                $cliente->save();
    
                return response()->json([
                    'type' => 'success',
                    'message' =>'Se ha actualizado correctamente'
                ]);
            }else{
                $cliente = Cliente::create($request->all());
                $cliente->save();
    
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


    public function Update(Request $request){

    }

    public function Destroy($id){
        $cliente = Cliente::join('direccion_clientes as dc','dc.cliente_id','clientes.id')
                                ->where('clientes.id',$id)
                                ->first();
        if($cliente==null){
            $cliente_deleted = Cliente::find($id);
            $deleted = $cliente_deleted->delete(); 
        }else{
            $deleted= false;
        }
        
        if($deleted){
                return response()->json(['type' => 'deleted',
                                        'message' =>'Se ha eliminado correctamente']);
        }else{
            return response()->json(['type' => 'not_deleted', 'message' =>'No se ha podido eliminar porque el cliente tiene una direccion asignada']);
        }

    }
}
