<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;

class AgendamentoController extends Controller
{
    public function index()
    {
        $agendamentos = Agendamento::with('cliente')->get();
        return view('agendamentos.index', compact('agendamentos'));
    }

    public function api(Request $request)
    {
        $query = Agendamento::with('cliente');

        if ($request->has('barbeiro') && $request->barbeiro != '') {
            $query->where('barbeiro', $request->barbeiro);
        }

        $agendamentos = $query->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => ($item->cliente->nome ?? 'Cliente') . " | " . $item->servico,
                'start' => $item->data . 'T' . date('H:i:s', strtotime($item->hora)),
                'end' => $item->data . 'T' . date('H:i:s', strtotime($item->hora) + 3600),
                'backgroundColor' => '#d4af37',
                'textColor' => '#000000',
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
            'barbeiro' => 'required',
            'servico' => 'required',
            'data' => 'required',
            'hora' => 'required'
        ]);

        $conflito = Agendamento::where('barbeiro', $request->barbeiro)
            ->where('data', $request->data)
            ->where('hora', $request->hora)
            ->exists();

        if ($conflito) {
            return back()->withErrors(['erro_agenda' => 'Horário já ocupado!']);
        }

        $nome = session('user_name') ?? auth()->user()->name ?? 'Cliente Deslogado';
        
        $cliente = Cliente::firstOrCreate(
            ['nome' => $nome],
            ['telefone' => '']
        );

        Agendamento::create([
            'cliente_id' => $cliente->id,
            'barbeiro' => $request->barbeiro,
            'servico' => $request->servico,
            'data' => $request->data,
            'hora' => $request->hora
        ]);

        return redirect('/dashboard')->with('status', 'Agendado com sucesso!');
    }

    // Caso precise dos métodos de edição que estão nas rotas
    public function edit($id) {
        $agendamento = Agendamento::findOrFail($id);
        return view('agendamentos.edit', compact('agendamento'));
    }

    public function update(Request $request, $id) {
        $agendamento = Agendamento::findOrFail($id);
        $agendamento->update($request->all());
        return redirect('/dashboard');
    }

    public function destroy($id) {
        Agendamento::destroy($id);
        return back();
    }
}