<?php
namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Aprendiz;
use App\RegistroHistorico;

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
     * Show the application dashboard.
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

    public function updatePassword(PasswordRequest $request){
        $admin = Auth::User();
        if (Hash::check($request->mypassword, $admin->password)){
            $admin2 = new User();
            $admin2->where('email', '=', $admin->email)
                 ->update(['password' => bcrypt($request->password)]);
            return redirect('admin')->with('status', 'Contraseña cambiada con éxito');
        }
        else
        {
            return redirect('admin/password')->with('message', 'Su contraseña actual es incorrecta');
        }
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
