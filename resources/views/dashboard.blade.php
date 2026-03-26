@extends('layout')

@section('page-title', 'Dashboard')

@section('content')

@if(session('user_role') == 'admin')
<div class="cards-grid">
    <div class="card">
        <label>Agendamentos hoje</label>
        <div class="val">—</div>
        <div class="sub">Veja o calendário abaixo</div>
    </div>
    <div class="card">
        <label>Clientes cadastrados</label>
        <div class="val">—</div>
        <div class="sub">Total no sistema</div>
    </div>
    <div class="card">
        <label>Este mês</label>
        <div class="val">—</div>
        <div class="sub">Agendamentos no mês</div>
    </div>
</div>
@endif

<div class="section-title">Calendário de agendamentos</div>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<style>
#calendar{
    background:#151515;
    padding:20px;
    border-radius:10px;
    border:1px solid #1f1f1f;
}
#calendar .fc-toolbar-title{ color:#d4af37; font-size:16px; }
#calendar .fc-button{
    background:#1f1f1f !important;
    border:1px solid #333 !important;
    color:#ccc !important;
    font-size:12px !important;
}
#calendar .fc-button:hover{
    background:#d4af37 !important;
    color:#000 !important;
}
#calendar .fc-button-active{
    background:#d4af37 !important;
    color:#000 !important;
}
#calendar .fc-col-header-cell{ background:#1a1a1a; color:#d4af37; }
#calendar .fc-timegrid-slot{ border-color:#1f1f1f; }
#calendar .fc-scrollgrid{ border-color:#1f1f1f; }
#calendar .fc-day-today{ background:#1a1500 !important; }
#calendar td, #calendar th{ border-color:#1f1f1f !important; }
#calendar .fc-event{
    background:#d4af37;
    border:none;
    color:#000;
    font-size:12px;
    font-weight:bold;
    border-radius:4px;
}
#calendar .fc-daygrid-day-number,
#calendar .fc-col-header-cell-cushion{ color:#ccc; text-decoration:none; }
</style>

<div id="calendar"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
        initialView: 'timeGridWeek',
        locale: 'pt-br',
        height: 620,
        slotMinTime: "08:00:00",
        slotMaxTime: "20:00:00",
        allDaySlot: false,
        events: '/api/agendamentos',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        dateClick: function(info) {
            window.location = "/agendar?data=" + info.dateStr;
        },
        eventClick: function(info) {
            alert(info.event.title);
        }
    });
    calendar.render();
});
</script>

@endsection
