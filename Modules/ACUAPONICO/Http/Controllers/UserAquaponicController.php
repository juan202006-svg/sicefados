<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\UserAquaponic;
use Modules\ACUAPONICO\Entities\ProductiveUnit;

class UserAquaponicController extends Controller
{
public function index()
{
    $usuarios = UserAquaponic::with('ProductiveUnit')->get();
    $unidades = ProductiveUnit::select('id', 'name')->get();
    $pasantesCount = UserAquaponic::where('role', 'pasante')->count();
    $instructorCount = UserAquaponic::where('role', 'instructor')->count();
    $totalCount = $pasantesCount + $instructorCount;
    $usuarios = UserAquaponic::paginate(10);

    return view('acuaponico::admin.usuarios', compact('totalCount', 'pasantesCount', 'instructorCount', 'usuarios', 'unidades'));
}

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('acuaponico::create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required','string','max:100','regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/'],
            'last_name' => ['required','string','max:100','regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/'],
            'role' => 'required|in:pasante,instructor',
            'productive_unit_id' => ['nullable','exists:productive_units,id'],
        ], [
            'first_name.regex' => 'No ha sido posible crear el usuario. El nombre solo puede contener letras y espacios.',
            'last_name.regex' => 'No ha sido posible crear el usuario. El apellido solo puede contener letras y espacios.',
        ]
        );
        $exists = UserAquaponic::where('first_name', $request->first_name)
            ->where('last_name', $request->last_name)
            ->where('role', $request->role)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'El usuario ya existe.');
        }

        UserAquaponic::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role' => $request->role,
            'productive_unit_id' => $request->productive_unit_id,
            'status' => 'activo',
        ]);

        return redirect()->back()->with('success', 'Usuario creado automaticamnete.');
    }




    public function show($id)
    {
        return view('acuaponico::show');
    }


    public function edit($id)
    {
        $usuario = UserAquaponic::findOrFail($id);
        $unidades = ProductiveUnit::select('id', 'name')->get();
        return view('admin.usuarios.edit', compact('usuario', 'unidades'));
    }



public function update(Request $request, $id)
{

    $request->validate([
        'first_name' => 'required|string|max:100|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/',
        'last_name' => 'required|string|max:100|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/',
        'role' => 'required|in:pasante,instructor',
        'productive_unit_id' => 'nullable|exists:productive_units,id',
        'status' => 'required|in:activo,inactivo',
    ]);

        $exists = UserAquaponic::where('id', '!=', $id)
        ->where('role', $request->role)
        ->where('productive_unit_id', $request->productive_unit_id)
        ->exists();
    if ($exists) {
        return redirect()->back()->with('error', 'El usuario ya existe con el mismo rol y unidad productiva.');
    }

    $usuario = UserAquaponic::findOrFail($id);

    $usuario->first_name = $request->first_name;
    $usuario->last_name = $request->last_name;
    $usuario->role = $request->role;
    $usuario->productive_unit_id = $request->productive_unit_id;
    $usuario->status = $request->status;
    $usuario->save();

    return redirect()->back()->with('success', 'Usuario actualizado correctamente.');


}



    public function destroy($id)
    {
        try {
            $usuario = UserAquaponic::findOrFail($id);
            $usuario->delete();

        return redirect()->back()->with('success', 'Usuario eliminado correctamente.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'No ha sido posible eliminar el usuario. 
                                         Asegúrese de que no esté asociado a ninguna unidad productiva.');
        }
    }
}