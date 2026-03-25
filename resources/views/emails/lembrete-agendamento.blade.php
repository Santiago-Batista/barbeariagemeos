<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .header { background: #1a1a1a; color: #fff; padding: 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 22px; letter-spacing: 1px; }
        .body { padding: 32px; color: #333; line-height: 1.6; }
        .info-box { background: #f9f9f9; border-left: 4px solid #c8a96e; padding: 16px 20px; border-radius: 4px; margin: 24px 0; }
        .info-box p { margin: 8px 0; font-size: 15px; }
        .footer { background: #1a1a1a; color: #888; text-align: center; padding: 16px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✂️ Lembrete de Agendamento</h1>
        </div>
        <div class="body">

            {{-- cliente->nome vem do relacionamento belongsTo(Cliente::class) --}}
            <p>Olá, <strong>{{ $agendamento->cliente->nome }}</strong>!</p>
            <p>Passamos para lembrar que você tem um agendamento <strong>amanhã</strong>:</p>

            <div class="info-box">
                {{-- campo 'data' formatado de Y-m-d para d/m/Y --}}
                <p>📅 <strong>Data:</strong> {{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}</p>

                {{-- campo 'hora' direto da tabela --}}
                <p>🕐 <strong>Horário:</strong> {{ $agendamento->hora }}</p>

                {{-- campo 'servico' direto da tabela --}}
                <p>✂️ <strong>Serviço:</strong> {{ $agendamento->servico }}</p>

                {{-- campo 'barbeiro' é string direto da tabela --}}
                <p>💈 <strong>Barbeiro:</strong> {{ $agendamento->barbeiro }}</p>
            </div>

            <p>Caso precise cancelar ou reagendar, entre em contato conosco com antecedência.</p>
            <p>Te esperamos amanhã! 😊</p>

        </div>
        <div class="footer">
            Este é um e-mail automático — não responda a esta mensagem.
        </div>
    </div>
</body>
</html>