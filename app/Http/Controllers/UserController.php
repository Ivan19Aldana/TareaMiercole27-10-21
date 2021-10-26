<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Rol;
use App\Usuario;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Listado de Usuario
    public function list(){
        $users = DB::table("usuarios")
        ->join('rol', 'usuarios.rol_id', '=', 'rol.id_rol')
        ->select('usuarios.*', 'rol.descripcion')
        ->paginate(5);

        return view('usuarios.listar',compact('users'));

    }

    //Formulario de usuarios
    public function userform(){
        $rol = Rol::all();
        return view('usuarios.userform',compact('rol'));
    }

    //Guardar usuarios
    public function save(Request $request){

        $validator = $this->validate($request, [
            'nombre'=> 'required|string|max:255',
            'email'=> 'required|string|max:255|email|unique:usuarios',
            'rol' => 'required'
 
        ]);
        Usuario:: create([
            'nombre' => $validator['nombre'],
            'email' => $validator['email'],
            'rol_id' => $validator['rol']
        ]);

        return back()->with('usuarioGuardado','Usuario Guardado');
    }
       // Usuario::insert($userdata);

    //Eliminar Usuarios
    public function delete($id){
        Usuario::destroy($id);

        return back()->with('usuarioEliminado','Usuario Eliminado');
    }

    //Formulario para editar Usuarios
    public function editform($id){
        $usuario=Usuario::findorFail($id);
        $rol = Rol::all();
        return view('usuarios.editform', compact('usuario','rol'));
    }

    //Edicion de usuarios
    public function edit(Request $request,$id){
       $datosUsuario = request()->except((['_token', '_method']));
       Usuario::where('id', '=', $id)->update($datosUsuario);

       return back()->with('usuarioModificado', 'Usuario modificado');
    }

}