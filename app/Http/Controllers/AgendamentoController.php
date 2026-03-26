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

    public function api(Request $request)
    {
        $query = Agendamento::with('cliente');

        // Filtro por barbeiro funcionando certinho!
        if ($request->has('barbeiro') && $request->barbeiro != '') {
            $query->where('barbeiro', $request->barbeiro);
        }

        $agendamentos = $query->get()->map(function ($item) {
            return [
                // Adicionado '?? 'Cliente'' para evitar erro se o cliente sumir do banco
                'title' => ($item->cliente->nome ?? 'Cliente') . " | " . $item->servico,
                'start' => $item->data . 'T' . $item->hora,
                'end' => $item->data . 'T' . date('H:i', strtotime($item->hora) + 3600),
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

        // Trava individual por barbeiro correta!
        $conflito = Agendamento::where('barbeiro', $request->barbeiro)
            ->where('data', $request->data)
            ->where('hora', $request->hora)
            ->exists();

        if ($conflito) {
            return back()->withErrors(['erro_agenda' => 'Este barbeiro já possui um cliente agendado para este horário!']);
        }

        // Ajuste: Fallback caso a session falhe (tenta pegar do Auth se houver)
        $nome = session('user_name') ?? auth()->user()->name ?? 'Cliente Deslogado';
        
        $cliente = Cliente::firstOrCreate(
            ['nome' => $nome],
            ['telefone' => ''] // Cria com telefone vazio se não existir
        );

        Agendamento::create([
            'cliente_id' => $cliente->id,
            'barbeiro' => $request->barbeiro,
            'servico' => $request->servico,
            'data' => $request->data,
            'hora' => $request->hora
        ]);

        return redirect('/dashboard')->with('status', 'Agendamento realizado com sucesso!');
    }
}