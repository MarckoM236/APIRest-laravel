<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class clienteController extends Controller
{
    public function __construct(){
    $this->middleware('auth:api');
    $this->middleware('role:User,Admin',['only' => ['store']]);
    $this->middleware('role:Admin',['except' => ['index','store']]);
    }

    public function index(){
        $client=Cliente::all();
        return response()->json($client);
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'document' => 'required|min:6',
            'name' => 'required|max:35',
            'email' => 'required|email',
            'address' => 'required'
        ]);

            if(Cliente::create($validate)){
                return response()->json("Cliente Creado Exitosamente",201);
            }
            else{
                return response()->json("Cliente No creado",401);
            }
        
    }
    public function update(Request $request,$id){
        $validate = $request->validate([
            'document' => 'required|min:6',
            'name' => 'required|max:35',
            'email' => 'required|email',
            'address' => 'required'
        ]);

        $cliente = Cliente::findOrFail($id);

        if($cliente->update($validate)){
            return response()->json("Cliente Actualizado Exitosamente",201);
        }
        else{

            return response()->json("Cliente No actualizado",401);
        }

    }
    public function destroy($id){
        $cliente = Cliente::findOrFail($id);
        if($cliente->delete($id)){
            return response()->json("Cliente eliminado",200);
        }
        else{
            return response()->json("No se logro eliminar el cliente",200);
        }

        
    }
}
