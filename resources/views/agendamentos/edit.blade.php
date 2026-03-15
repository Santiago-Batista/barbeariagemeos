@extends('layout')

@section('content')

<style>

.edit-box{
max-width:500px;
background:#151515;
padding:30px;
border-radius:10px;
border-left:4px solid #d4af37;
box-shadow:0 0 15px rgba(0,0,0,0.6);
}

.edit-box h2{
color:#d4af37;
margin-bottom:25px;
}

label{
color:#ccc;
font-weight:bold;
}

select,input{
width:100%;
padding:10px;
margin-top:6px;
margin-bottom:18px;
border:none;
border-radius:6px;
background:#222;
color:white;
}

select:focus,input:focus{
outline:none;
background:#2a2a2a;
}

button{
background:#d4af37;
border:none;
padding:10px 16px;
border-radius:6px;
font-weight:bold;
cursor:pointer;
transition:0.3s;
}

button:hover{
background:#c19b2e;
transform:scale(1.03);
}

</style>

<div class="edit-box">

<h2>Editar Agendamento</h2>

<form action="/agendamentos/{{ $agendamento->id }}" method="POST">

@csrf
@method('PUT')

<label>Cliente</label>

<select name="cliente_id">

@foreach($clientes as $cliente)

<option value="{{ $cliente->id }}"
@if($cliente->id == $agendamento->cliente_id) selected @endif>

{{ $cliente->nome }}

</option>

@endforeach

</select>

<label>Data</label>
<input type="date" name="data" value="{{ $agendamento->data }}">

<label>Hora</label>
<input type="time" name="hora" value="{{ $agendamento->hora }}">

<button type="submit">Atualizar</button>

</form>

</div>

@endsection