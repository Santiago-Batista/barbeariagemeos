<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Agendamentos</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #d4af37; padding-bottom: 10px; }
        .header h1 { margin: 0; color: #000; text-transform: uppercase; font-size: 20px; }
        .header p { margin: 5px 0; color: #666; }
        
        .resumo { margin-bottom: 20px; width: 100%; }
        .resumo-box { background: #f9f9f9; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #1a1a1a; color: #d4af37; padding: 10px; text-align: left; text-transform: uppercase; font-size: 10px; }
        td { padding: 8px; border-bottom: 1px solid #eee; }
        
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #999; border-top: 1px solid #eee; padding-top: 5px; }
        .total-badge { font-weight: bold; color: #000; }
        .barbeiro-rank { color: #555; font-style: italic; }
    </style>
</head>
<body>

    <div class="header">
        <h1>✂ Barbearia MS - Relatório</h1>
        <p>Período: {{ $dataInicio->format('d/m/Y') }} até {{ $dataFim->format('d/m/Y') }}</p>
    </div>

    <div class="resumo">
        <div class="resumo-box">
            <strong>Resumo de Desempenho:</strong><br>
            Total de atendimentos no período: <span class="total-badge">{{ $totalGeral }}</span><br>
            @foreach($porBarbeiro as $item)
                <span class="barbeiro-rank">● {{ $item->barbeiro }}: {{ $item->total }} cortes</span>{{ !$loop->last ? ' | ' : '' }}
            @endforeach
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Hora</th>
                <th>Cliente</th>
                <th>Serviço</th>
                <th>Barbeiro</th>
            </tr>
        </thead>
        <tbody>
            @foreach($agendamentos as $agendamento)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}</td>
                    <td>{{ $agendamento->hora }}</td>
                    <td>{{ $agendamento->cliente->nome ?? 'N/A' }}</td>
                    <td>{{ $agendamento->servico }}</td>
                    <td>{{ $agendamento->barbeiro }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Relatório gerado em {{ date('d/m/Y H:i') }} - Sistema Barbearia MS
    </div>

</body>
</html>