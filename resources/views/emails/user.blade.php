<!DOCTYPE html>
<html>
<head>
    <title>Convite</title>
    <!-- Latest compiled and minified CSS -->
</head>
<body>
    <div>
        <h1 class="text-danger">Convite</h1>
    </div>
	<h2>Ola {!!$user->dataEmail->name_friend!!} você foi convidado para partcipar de um evento com  {!! $user->name !!}</h2>
    <a class="btn" href="{!!url('convite')!!}"> Clique aqui</a>
</body>
</html>
