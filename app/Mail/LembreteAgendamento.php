<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LembreteAgendamento extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $agendamento) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🗓️ Lembrete: seu agendamento é amanhã!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.lembrete-agendamento',
        );
    }
}