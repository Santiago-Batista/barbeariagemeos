<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<title>Dashboard - Barbearia MS</title>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<style>

body{
display:flex;
background:#0a0a0a;
color:white;
font-family:Arial, Helvetica, sans-serif;
margin:0;
}

/* SIDEBAR */

.sidebar{
width:240px;
background:#151515;
padding:25px;
border-right:2px solid #d4af37;
}

.sidebar h2{
color:#d4af37;
text-align:center;
margin-bottom:30px;
letter-spacing:2px;
}

/* MENU */

.menu a{
display:block;
padding:12px;
margin-bottom:10px;
background:#222;
color:#ccc;
text-decoration:none;
border-radius:6px;
font-weight:bold;
transition:0.3s;
}

.menu a:hover{
background:#d4af37;
color:black;
transform:scale(1.03);
}

/* MAIN */

.main{
flex:1;
}

/* HEADER */

.header{
background:#151515;
padding:15px 30px;
display:flex;
justify-content:space-between;
align-items:center;
border-bottom:1px solid #333;
}

.header h3{
color:#d4af37;
}

/* BOTÃO SAIR */

.header button{
background:#d4af37;
border:none;
padding:8px 14px;
border-radius:5px;
font-weight:bold;
cursor:pointer;
}

.header button:hover{
background:#c19b2e;
}

/* CONTEUDO */

.content{
padding:30px;
}

/* CARD */

.card{
background:#151515;
padding:20px;
border-radius:10px;
margin-bottom:25px;
border-left:4px solid #d4af37;
}

.card h4{
margin-top:0;
color:#d4af37;
}

/* CALENDARIO */

#calendar{
background:white;
padding:20px;
border-radius:10px;
color:black;
box-shadow:0 0 20px rgba(0,0,0,0.6);
}

</style>

</head>

<body>

<div class="sidebar">

<h2>💈 Barbearia MS</h2>

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
<p>Clique em um horário para agendar seu corte.</p>
</div>

@endif

<div id="calendar"></div>

</div>

</div>

<script>

document.addEventListener('DOMContentLoaded', function() {

var calendarEl = document.getElementById('calendar');

var calendar = new FullCalendar.Calendar(calendarEl, {

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