@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center content-center flex-wrap min-h-screen h-full">
            <p class="w-full text-center text-2xl text-gray-800 mb-3">OW Interactive - Schedule</p>
            <div class="w-full max-w-sm">
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <h2 class="mb-4 text-2xl text-gray-700">Cadastrar Nova Senha</h2>

                    <form method="post" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <div class="mb-3">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">E-mail</label>
                            <input type="email"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('email') ? ' border-red-600' : ''}}"
                                   id="email" name="email" required placeholder="E-mail" value="{{ old('email') }}">
                            @if($errors->has('email'))
                                <span class="text-red-600 text-sm">{{$errors->first('email')}}</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Senha</label>
                            <input type="password"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('password') ? ' border-red-600' : ''}}"
                                   id="password" name="password" required placeholder="Senha">
                            @if($errors->has('password'))
                                <span class="text-red-600 text-sm">{{$errors->first('password')}}</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">
                                Confirmar Senha
                            </label>
                            <input type="password"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('password_confirmation') ? ' border-red-600' : ''}}"
                                   id="password_confirmation" name="password_confirmation" required placeholder="Confirmar Senha">
                            @if($errors->has('password_confirmation'))
                                <span class="text-red-600 text-sm">{{$errors->first('password_confirmation')}}</span>
                            @endif
                        </div>

                        <button class="py-2 px-3 bg-blue-800 text-white rounded">Cadastrar Nova Senha</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
