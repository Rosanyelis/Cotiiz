<?php

namespace App\Http\Controllers\Admin; // Define el espacio de nombres de este controlador. Esto permite organizar el código y evitar conflictos con otros controladores.
use App\Models\User; // Importa el modelo `User` para interactuar con la tabla de usuarios en la base de datos.
use App\Models\RfcSupplier; // Importa el modelo `RfcSupplier`, aunque no se utiliza en este controlador.
use Illuminate\Http\Request;// Importa la clase `Request` para manejar las solicitudes HTTP.
use Yajra\DataTables\DataTables; // Importa la biblioteca `DataTables` para trabajar con datos en formato de tablas, útil para manejar grandes volúmenes de datos en vistas.
use App\Http\Controllers\Controller; // Importa la clase base de los controladores para que este controlador herede sus funcionalidades.

class UsersPruebaController extends Controller // Define la clase del controlador que gestionará las acciones relacionadas con los usuarios de prueba.
{
    public function index(Request $request) // Método principal para manejar la vista de índice. Este método se ejecuta cuando se accede a la ruta asociada.
    {
        if ($request->ajax()) { // Verifica si la solicitud es AJAX. Esto es útil para manejar peticiones de datos dinámicamente en el frontend.
            $data = User::with('rfcbussines')->role('Empresa-Prueba')->get(); // Obtiene usuarios con una relación llamada `rfcbussines` y un rol específico 'Empresa-Prueba'.
            return DataTables::of($data)
                ->addColumn('actions', function ($data) { // Añade una columna de acciones para cada fila de la tabla.
                    return view('admin.usersprueba.partials.actions', ['data' => $data]); // Renderiza una vista parcial que contiene botones u opciones para cada usuario.
                })
                ->rawColumns(['actions']) // Indica que la columna `actions` puede contener HTML.
                ->make(true); // Retorna los datos formateados para ser usados por DataTables.
        }
        return view('admin.usersprueba.index'); // Si no es una solicitud AJAX, carga la vista principal `index` para usuarios de prueba.
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) // Método para mostrar un usuario específico.
    {
        $data = User::find($id); // Busca un usuario por su ID.
        return view('admin.usersprueba.show', compact('data')); // Retorna la vista `show` con los datos del usuario.
    }

    /**
     * Update the specified resource in storage.
     */
    public function changePasword(Request $request) // Método para cambiar la contraseña de un usuario.
    {
        if ($request->password == null) { // Valida si la contraseña está vacía.
            return redirect()->back()->with('error', 'La contraseña no puede estar vacia'); // Redirige de vuelta con un mensaje de error.
        }

        $user = User::find($request->id); // Busca el usuario por su ID.
        $user->passwordshow = $request->password; // Guarda la contraseña sin encriptar (mala práctica por temas de seguridad).
        $user->password = bcrypt($request->password); // Encripta la contraseña y la guarda en el campo `password`.
        $user->save(); // Guarda los cambios en la base de datos.

        return redirect()->back()->with('success', 'Contraseña actualizada correctamente'); // Redirige con un mensaje de éxito.
    }

    public function getPassword($id) // Método para obtener la contraseña visible de un usuario.
    {
        $user = User::find($id); // Busca al usuario por su ID.

        if (!$user) { // Valida si el usuario no existe.
            return response()->json(['error' => 'Usuario no encontrado.'], 404); // Retorna un mensaje de error en formato JSON con un código 404.
        }

        return response()->json(['passwordshow' => $user->passwordshow], 200); // Retorna la contraseña sin encriptar en formato JSON.
    }

    /**
     * Remove the specified resource from storage.
     */
    public function activated($user) // Método para activar un usuario.
    {
        $data = User::find($user); // Busca al usuario por su ID.
        $data->status = '1'; // Cambia el estado del usuario a '1' (activo).
        $data->save(); // Guarda los cambios en la base de datos.

        return redirect()->back()->with('success', 'Usuario Aprobada con exito'); // Redirige con un mensaje de éxito.
    }

    public function desactivated($user) // Método para desactivar un usuario.
    {
        $data = User::find($user); // Busca al usuario por su ID.
        $data->status = '2'; // Cambia el estado del usuario a '2' (inactivo).
        $data->save(); // Guarda los cambios en la base de datos.

        return redirect()->back()->with('success', 'Usuario Desactivado con exito'); // Redirige con un mensaje de éxito.
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id) // Método para eliminar un usuario.
    {
        $data = User::find($id); // Busca al usuario por su ID.
        $data->delete(); // Elimina el registro del usuario de la base de datos.
        return redirect()->back()->with('success', 'Usuario eliminado con exito'); // Redirige con un mensaje de éxito.
    }
}
