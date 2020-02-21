<form method="post" action="{{ route('users.update', $user) }}">
    {{ csrf_field() }}
    {{ method_field('patch') }}

    <input type="text" name="name"  value="{{ $user->name }}" />

    <input type="email" name="email"  value="{{ $user->email }}" />

    <input type="password" name="password" />

    <input type="password" name="password_confirmation" />

    <button type="submit">Enviar</button>
</form>