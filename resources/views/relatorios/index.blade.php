@extends('layout')

@section('page-title', 'Relatórios')

@section('content')
<h2 class="page-title">Gerar Relatório PDF</h2>

@if(session('sucesso'))
<div class="alert alert-success">{{ session('sucesso') }}</div>
@endif

<div class="form-box">
    <form method="POST" action="{{ route('relatorios.gerar') }}">
        @csrf
        <div class="form-group">
            <label>Data início</label>
            <input type="date" name="data_inicio" value="{{ date('Y-m-01') }}" required>
        </div>
        <div class="form-group">
            <label>Data fim</label>
            <input type="date" name="data_fim" value="{{ date('Y-m-t') }}" required>
        </div>
        <div class="form-group">
            <label>E-mail para envio (opcional)</label>
            <input type="email" name="email_destino" placeholder="seuemail@email.com">
        </div>
        <div style="display:flex;gap:10px;margin-top:8px;">
            <button class="btn btn-gold" type="submit" name="acao" value="download">⬇ Baixar PDF</button>
            <button class="btn btn-outline" type="submit" name="acao" value="email">✉ Enviar por E-mail</button>
        </div>
    </form>
</div>
@endsection