<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 13px; color: #333; }

        .header { background: #1a1a1a; color: #fff; padding: 20px 24px; margin-bottom: 24px; }
        .header h1 { font-size: 20px; margin-bottom: 4px; }
        .header p { font-size: 12px; color: #aaa; }

        .section-title { font-size: 14px; font-weight: bold; color: #1a1a1a;
            border-bottom: 2px solid #c8a96e; padding-bottom: 6px; margin-bottom: 12px; margin-top: 24px; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
        thead { background: #1a1a1a; color: #fff; }
        thead th { padding: 8px 10px; text-align: left; font-size: 12px; }
        tbody tr:nth-child(even) { background: #f5f5f5; }
        tbody td { padding: 7px 10px; border-bottom: 1px solid #e0e0e0; font-size: 12px; }

        .resumo-box { background: #f9f9f9; border-left: 4px solid #c8a96e;
            padding: 12px 16px; border-radius: 4px; margin-bottom: 8px; display: inline-block; }
        .resumo-box strong { font-size: 22px; display: block; }
        .resumo-box span { font-size: 11px; color: #777; }

        .footer { margin-top: 32px; text-align: center; font-size: 11px; color: #999; border-top: 1px solid #eee; padding-top: 12px; }
    </style>
</head>
<body>

    <div class="header">
        <h1>✂️ Relatório de Agendamentos</h1>
        <p>Período: {{ $dataInicio->format('d/m/Y') }} até {{ $dataFim->format('d/m/Y') }}</p>
        <p>Gerado em: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    {{-- Resumo geral --}}
    <div class="section-title">Resumo</div>
    <div class="resumo-box">
        <strong>{{ $totalGeral }}</strong>
        <span>Total de agendamentos</span>
    </div>

    {{-- Total por barbeiro --}}
    <div class="section-title">Serviços por Barbeiro</div>
    <table>
        <thead>
            <tr>
                <th>Barbeiro</th>
                <th>Total de Serviços</th>
            </tr>
        </thead>
        <tbody>
            @foreach($porBarbeiro as $item)
            <tr>
                <td>{{ $item->barbeiro }}</td>
                <td>{{ $item->total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Lista de agendamentos --}}
    <div class="section-title">Lista de Agendamentos</div>
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Hora</th>
                <th>Cliente</th>
                <th>Serviço</th>
                <th>Barbeiro</th>
                <th>Telefone</th>
            </tr>
        </thead>
        <tbody>
            @forelse($agendamentos as $ag)
            <tr>
                <td>{{ \Carbon\Carbon::parse($ag->data)->format('d/m/Y') }}</td>
                <td>{{ $ag->hora }}</td>
                <td>{{ $ag->cliente->nome }}</td>
                <td>{{ $ag->servico }}</td>
                <td>{{ $ag->barbeiro }}</td>
                <td>{{ $ag->cliente->telefone }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center; color:#999;">Nenhum agendamento no período.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Relatório gerado automaticamente pelo sistema da Barbearia.
    </div>

</body>
</html>