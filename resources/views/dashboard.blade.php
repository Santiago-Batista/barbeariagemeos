<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<style>

body{

display:flex;

background:#121212;

color:white;

font-family:Arial;

margin:0;

}

.sidebar{

width:230px;

background:#1e1e1e;

padding:20px;

}

.menu a{

display:block;

padding:12px;

margin-bottom:10px;

background:#2a2a2a;

color:white;

text-decoration:none;

border-radius:6px;

}

.menu a:hover{

background:#00c2ff;

color:black;

}

.main{

flex:1;

}

.header{

background:#1f1f1f;

padding:15px;

display:flex;

justify-content:space-between;

}

.content{

padding:25px;

}

#calendar{

background:white;

padding:20px;

border-radius:10px;

color:black;

}

.card{

background:#1e1e1e;

padding:20px;

border-radius:10px;

margin-bottom:20px;

}

</style>

</head>

<body>

<div class="sidebar">

<h2>Barbearia</h2>

<div class="menu">

@if(session('user_role') == 'admin')

<a href="/dashboard">Dashboard</a>

<a href="/clientes">Clientes</a>

<a href="/agendamentos">Agendamentos</a>

@else

<a href="/dashboard">Dashboard</a>

<a href="/agendar">Agendar Corte</a>

@endif

</div>

</div>

<div class="main">

<div class="header">

<h3>Bem vindo {{ session('user_name') }}</h3>

<form method="POST" action="/logout">

@csrf

<button>Sair</button>

</form>

</div>

<div class="content">

@if(session('user_role') == 'admin')

<div class="card">

<h4>Painel Admin</h4>

<p>Gerencie os agendamentos no calendário.</p>

</div>

@else

<div class="card">

<h4>Área Cliente</h4>

<p>Clique em um horário para agendar.</p>

</div>

@endif

<div id="calendar"></div>

</div>

</div>

<script>

document.addEventListener('DOMContentLoaded', function() {

var calendarEl=document.getElementById('calendar');

var calendar=new FullCalendar.Calendar(calendarEl,{

initialView:'timeGridWeek',

locale:'pt-br',

height:650,

slotMinTime:"08:00:00",

slotMaxTime:"20:00:00",

allDaySlot:false,

events:'/api/agendamentos',

headerToolbar:{

left:'prev,next today',

center:'title',

right:'dayGridMonth,timeGridWeek,timeGridDay'

},

dateClick:function(info){

window.location="/agendar?data="+info.dateStr;

},

eventClick:function(info){

alert(info.event.title);

}

});

calendar.render();

});

</script>

</body>

</html>
