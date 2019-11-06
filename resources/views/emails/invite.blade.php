<html>
    <body>
        <p>Olá {{$nome}}</p>
        <p></p>
        <p>Venha partipar do nosso evento =>  {{$event->title}}</p>
        <p>Data: {{ date('d/m/Y H:i', strtotime(str_replace('-','/', $event->ts_start))) }}</p>
        <p>Contamos com sua presença.</p>
        <p></p>
        <p>Att, <br>
        {{$usuario}}!</p>
    </body>
