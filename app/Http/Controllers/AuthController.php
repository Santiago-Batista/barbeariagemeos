<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;


class AuthController extends Controller
{

    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_role' => $user->role
            ]);

            return redirect('/dashboard');

        }

        return back()->with('erro', 'Login inválido');

    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }

    public function registerForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {

        $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'cliente'

        ]);

        Cliente::create([

            'nome' => $request->name,
            'email' => $request->email,
            'telefone' => $request->telefone

        ]);

        return redirect('/');
    }

    public function showForgotForm()
    {
        return view('recuperar');
    }

    public function sendResetLink(Request $request)
    {

        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => 'Link enviado para o seu e-mail!'])
            : back()->withErrors(['email' => 'Não conseguimos encontrar um usuário com esse e-mail.']);
    }

    // Exibe a tela de nova senha
    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    // Salva a nova senha
    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed', // 'confirmed' exige o campo password_confirmation
        ]);

        // O Laravel verifica o token e troca a senha
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill(['password' => Hash::make($password)])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect('/')->with('status', 'Senha alterada com sucesso!')
            : back()->withErrors(['email' => __($status)]);
    }
}