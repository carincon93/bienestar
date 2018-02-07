<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Auth;

use App\User;
use App\Aprendiz;
use App\RegistroHistorico;
use App\Rules\checkHashedPass;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudAceptado  = Aprendiz::where('estado_solicitud', '!=', 0)->orWhere('estado_solicitud', NULL)->get()->sortBy('nombre_completo');
        $solicitudDenegado  = Aprendiz::where('estado_solicitud', 0)->get()->sortBy('nombre_completo');
        return view('admins.dashboard', compact('solicitudAceptado', 'solicitudDenegado'));
    }

    public function password(){
        return View('auth.passwords.password');
    }

    public function updatePassword(Request $request){
        $user = Auth::user();

        $validation = Validator::make($request->all(), [
            // Here's how our new validation rule is used.
            'mypassword'    => ['required', new checkHashedPass],
            'password'      => 'required|different:mypassword|confirmed|min:6|max:18'
        ],
        [
            'mypassword.required'  => 'El campo es requerido',
            'password.required'    => 'El campo es requerido',
            'password.confirmed'   => 'Los contraseñas no coinciden',
            'password.min'         => 'El mínimo permitido son 6 caracteres',
            'password.max'         => 'El máximo permitido son 18 caracteres',
            'password.different'   => 'La nueva contraseña debe ser diferente a la contraseña antigua',
        ]);


        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }

        $user->password = Hash::make($request->get('password'));
        $user->save();

        return redirect()->back()
            ->with('status', 'Tu contraseña ha sido cambiada!');
    }

    public function truncateAll()
    {
        Schema::disableForeignKeyConstraints();
        Aprendiz::truncate();
        RegistroHistorico::truncate();
        Schema::enableForeignKeyConstraints();
        return redirect('admin/dashboard')->with('status', 'Todos los registros del sistem fueron eliminados con éxito!');
    }

    public function view_sistema()
    {
        return view('admins.sistema');
    }
}
