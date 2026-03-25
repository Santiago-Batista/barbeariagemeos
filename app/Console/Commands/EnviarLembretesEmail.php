<?php

namespace App\Console\Commands;

use App\Mail\LembreteAgendamento;
use App\Models\Agendamento;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EnviarLembretesEmail extends Command
{
    protected $signature   = 'lembretes:enviar';
    protected $description = 'Envia e-mails de lembrete para agendamentos de amanhã';

    public function handle(): void
    {
        $amanha = Carbon::tomorrow()->toDateString();

        $agendamentos = Agendamento::whereDate('data', $amanha)
            ->with('cliente')
            ->get();

        if ($agendamentos->isEmpty()) {
            $this->info('Nenhum agendamento encontrado para amanhã.');
            return;
        }

        $enviados = 0;
        $pulados  = 0;

        foreach ($agendamentos as $agendamento) {
            $email = $agendamento->cliente?->email ?? null;

            if (!$email) {
                $this->warn("Agendamento #{$agendamento->id} — cliente sem e-mail, pulando.");
                $pulados++;
                continue;
            }

            Mail::to($email)->send(new LembreteAgendamento($agendamento));
            $this->info("✓ Lembrete enviado → {$agendamento->cliente->nome} <{$email}>");
            $enviados++;
        }

        $this->info("Concluído: {$enviados} enviado(s), {$pulados} pulado(s).");
    }
}