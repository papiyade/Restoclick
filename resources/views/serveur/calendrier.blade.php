@extends('layouts.app_serveur')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-intro-title">Sélectionner une date et une heure</h4>
                <form id="reservationForm">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date">
                    </div>
                    <div class="form-group">
                        <label for="time">Heure</label>
                        <input type="time" class="form-control" id="time" name="time">
                    </div>
                    <button type="button" class="btn btn-primary mt-3" id="loadCalendar">Afficher le calendrier</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/min/moment.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            editable: true,
            selectable: true,
            events: @json($reservationEvents)
        });
        calendar.render();

        // Écouter le clic sur le bouton pour charger les événements
        document.getElementById('loadCalendar').addEventListener('click', function() {
            var formData = new FormData(document.getElementById('reservationForm'));
            var date = formData.get('date');
            var time = formData.get('time');

            if (date && time) {
                var dateTime = moment(date + ' ' + time).format('YYYY-MM-DD HH:mm:ss');
                loadEvents(dateTime);
            } else {
                alert('Veuillez sélectionner une date et une heure.');
            }
        });

        // Fonction pour charger les événements à partir de la date et heure sélectionnées
        function loadEvents(dateTime) {
            // Exemple de requête Ajax pour charger les événements
            // Remplacez ceci par votre propre logique pour récupérer les réservations et commandes
            var events = [
                {
                    title: 'Réservation de John',
                    start: dateTime,
                    description: 'Nouvelle réservation',
                    backgroundColor: '#ff0000',
                    borderColor: '#ff0000',
                    textColor: '#ffffff'
                }
                // Ajoutez d'autres événements ici si nécessaire
            ];

            // Effacer les événements existants et ajouter les nouveaux
            calendar.removeAllEvents();
            calendar.addEventSource(events);
        }
    });
</script>
@endsection
