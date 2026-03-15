<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use App\Models\Cliente;

class AgendamentoController extends Controller
{

public function index()
{

$agendamentos = Agendamento::with('cliente')->get();

return view('agendamentos.index', compact('agendamentos'));

}

public function api()
{

$agendamentos = Agendamento::with('cliente')->get()->map(function($item){

return [

'title'=>$item->cliente->nome." | ".$item->servico,

'start'=>$item->data.'T'.$item->hora,

'end'=>$item->data.'T'.date('H:i',strtotime($item->hora)+3600),

'color'=>'#00c2ff'

];

});

return response()->json($agendamentos);

}

public function create()
{

return view('agendamentos.create');

}

public function store(Request $request)
{

$request->validate([

'barbeiro'=>'required',

'servico'=>'required',

'data'=>'required',

'hora'=>'required'

]);

$nome = session('user_name');

$cliente = Cliente::where('nome',$nome)->first();

if(!$cliente){

$cliente = Cliente::create([

'nome'=>$nome,
'telefone'=>''

]);

}

Agendamento::create([

'cliente_id'=>$cliente->id,
'barbeiro'=>$request->barbeiro,
'servico'=>$request->servico,
'data'=>$request->data,
'hora'=>$request->hora

]);

return redirect('/dashboard');

}

}
