@extends('layout')

@section('page-title', 'Dashboard')

@section('content')

    {{-- Saudação de Bem-vindo --}}
    <div style="margin-bottom: 25px;">
        <h2 style="color: #fff; font-size: 24px; margin-bottom: 5px;">
           <h3> Olá {{ session('user_name') }}</h3>
        </h2>
        <p style="color: #888; font-size: 14px;">Bem-vindo de volta ao seu painel de controle.</p>
    </div>

    {{-- Filtro de Barbeiro --}}
    <div class="filter-container"
        style="margin-bottom: 20px; background: #151515; padding: 15px; border-radius: 10px; border: 1px solid #1f1f1f; display: flex; align-items: center; gap: 15px;">
        <label style="color: #d4af37; font-weight: bold;">Visualizar Barbeiro:</label>
        <select id="barberFilter"
            style="background: #1f1f1f; color: #fff; border: 1px solid #333; padding: 8px 15px; border-radius: 5px; outline: none; cursor: pointer;">
            <option value="">Todos os Barbeiros</option>
            {{-- O value deve ser exatamente como está salvo no banco --}}
            <option value="João">João</option>
            <option value="Carlos">Carlos</option>
            <option value="Pedro">Pedro</option>
        </select>
    </div>

    <div id="calendar"></div>

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <style>
        #calendar {
            background: #151515;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #1f1f1f;
            color: #ccc;
        }

        /* Customização para manter o tema Dark Gold */
        .fc-toolbar-title {
            color: #d4af37 !important;
            font-size: 1.2em !important;
        }

        .fc-button {
            background: #1f1f1f !important;
            border: 1px solid #333 !important;
            color: #d4af37 !important;
            text-transform: capitalize !important;
        }

        .fc-button:hover {
            background: #d4af37 !important;
            color: #000 !important;
        }

        .fc-button-active {
            background: #d4af37 !important;
            color: #000 !important;
        }

        .fc-col-header-cell {
            background: #1a1a1a;
            padding: 10px 0 !important;
        }

        .fc-col-header-cell-cushion {
            color: #d4af37 !important;
            text-decoration: none !important;
        }

        .fc-timegrid-slot {
            border-bottom: 1px solid #1f1f1f !important;
            height: 3em !important;
        }

        .fc-timegrid-slot-label-cushion {
            color: #888 !important;
        }

        .fc-theme-standard td,
        .fc-theme-standard th {
            border: 1px solid #1f1f1f !important;
        }

        .fc-scrollgrid {
            border: 1px solid #1f1f1f !important;
        }

        .fc-event {
            border: none !important;
            padding: 2px 5px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .fc-event:hover {
            transform: scale(1.02);
        }

        .fc-day-today {
            background: rgba(212, 175, 55, 0.05) !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var barberFilter = document.getElementById('barberFilter');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                locale: 'pt-br',
                height: 'auto',
                slotMinTime: "08:00:00",
                slotMaxTime: "20:00:00",
                allDaySlot: false,
                nowIndicator: true,

                // A mágica acontece aqui: passamos o valor do filtro para a API
                events: function (fetchInfo, successCallback, failureCallback) {
                    let barber = barberFilter.value;
                    fetch(`/api/agendamentos?barbeiro=${barber}`)
                        .then(response => response.json())
                        .then(data => successCallback(data))
                        .catch(error => failureCallback(error));
                },

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

                dateClick: function (info) {
                    window.location.href = "/agendar?data=" + info.dateStr.split('T')[0];
                }
            });

            calendar.render();

            // Sempre que mudar o barbeiro no select, o calendário atualiza
            barberFilter.addEventListener('change', function () {
                calendar.refetchEvents();
            });
        });
    </script>
@endsection