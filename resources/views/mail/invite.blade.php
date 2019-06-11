<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Convite para Evento</title>
</head>
<body>
    Você foi convidado para o Evento: <b>{!! $event->title !!}</b><br>

    <b>Descrição:</b> {!! $event->description !!}<br>

    <b>Data Início:</b> {!! \App\Models\Event::convertStringToDate($event->date_start) !!}<br>
    <b>Data Término:</b> {!! \App\Models\Event::convertStringToDate($event->date_end) !!}<br>
</body>
</html>