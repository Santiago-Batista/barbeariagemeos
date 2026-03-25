<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Mail\LembreteAgendamento;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RelatorioController extends Controller
{
    public function index()
    {
        return view('relatorios.index');
    }

    public function gerar(Request $request)
    {
        $request->validate([
            'data_inicio' => 'required|date',
            'data_fim'    => 'required|date|after_or_equal:data_inicio',
        ]);

        $dataInicio = Carbon::parse($request->data_inicio)->startOfDay();
        $dataFim    = Carbon::parse($request->data_fim)->endOfDay();

        $agendamentos = Agendamento::with('cliente')
            ->whereBetween('data', [$dataInicio, $dataFim])
            ->orderBy('data')
            ->orderBy('hora')
            ->get();

        $porBarbeiro = Agendamento::whereBetween('data', [$dataInicio, $dataFim])
            ->selectRaw('barbeiro, COUNT(*) as total')
            ->groupBy('barbeiro')
            ->orderByDesc('total')
            ->get();

        $dados = [
            'agendamentos' => $agendamentos,
            'porBarbeiro'  => $porBarbeiro,
            'dataInicio'   => $dataInicio,
            'dataFim'      => $dataFim,
            'totalGeral'   => $agendamentos->count(),
        ];

        $pdf = Pdf::loadView('relatorios.pdf', $dados)
            ->setPaper('a4', 'portrait');

        if ($request->acao === 'download') {
            $nomeArquivo = 'relatorio-' . $dataInicio->format('d-m-Y') . '-a-' . $dataFim->format('d-m-Y') . '.pdf';
            return $pdf->download($nomeArquivo);
        }

        if ($request->acao === 'email') {
            $emailDestino = $request->email_destino ?? auth()->user()->email;

            Mail::send([], [], function ($message) use ($pdf, $emailDestino, $dataInicio, $dataFim) {
                $message->to($emailDestino)
                    ->subject('Relatório de Agendamentos — ' . $dataInicio->format('d/m/Y') . ' a ' . $dataFim->format('d/m/Y'))
                    ->attachData($pdf->output(), 'relatorio.pdf', [
                        'mime' => 'application/pdf',
                    ]);
            });

            return back()->with('sucesso', 'Relatório enviado para ' . $emailDestino);
        }
    }
}