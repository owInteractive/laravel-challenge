@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center content-center flex-wrap min-h-screen h-full">
            <p class="w-full text-center text-2xl text-gray-800 mb-3">OW Interactive - Schedule</p>
            <div class="w-full max-w-sm">
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <h2 class="mb-4 text-2xl text-gray-700">Recuperar senha</h2>

                    <form method="post" action="{{ route('password.email') }}">
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

                        <div class="inline-block float-left">
                            <button class="py-2 px-3 bg-blue-800 text-white rounded">Recuperar Senha</button>
                        </div>

                        <div class="inline-block float-right">
                            <a href="{{ route('login') }}" class="block text-sm text-gray-800 text-right hover:text-blue-600">
                                Lembrou a senha?
                            </a>
                        </div>

                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
