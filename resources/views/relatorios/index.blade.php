@extends('layouts.app') {{-- ajuste para o seu layout --}}

@section('content')
<div class="container">
    <h2>Gerar Relatório PDF</h2>

    @if(session('sucesso'))
        <div class="alert alert-success">{{ session('sucesso') }}</div>
    @endif

    <form method="POST" action="{{ route('relatorios.gerar') }}">
        @csrf

        <div class="row">
            <div class="col-md-4">
                <label>Data início</label>
                <input type="date" name="data_inicio" class="form-control"
                    value="{{ date('Y-m-01') }}" required>
            </div>
            <div class="col-md-4">
                <label>Data fim</label>
                <input type="date" name="data_fim" class="form-control"
                    value="{{ date('Y-m-t') }}" required>
            </div>
            <div class="col-md-4">
                <label>E-mail para envio (opcional)</label>
                <input type="email" name="email_destino" class="form-control"
                    placeholder="seuemail@email.com">
            </div>
        </div>

        <div class="mt-3 d-flex gap-2">
            <button type="submit" name="acao" value="download" class="btn btn-dark">
                ⬇️ Baixar PDF
            </button>
            <button type="submit" name="acao" value="email" class="btn btn-outline-dark">
                📧 Enviar por E-mail
            </button>
        </div>

    </form>
</div>
@endsection