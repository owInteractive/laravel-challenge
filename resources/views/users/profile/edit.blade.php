@extends('layouts.backend')

@section('page')
    <div class="mb-5">
        <h2 class="text-3xl mt-6 text-gray-800">Edit Profile</h2>
    </div>

    <form class="bg-white w-full rounded shadow p-5 border-t-2 border-blue-600" action="{{route('profile.update')}}" method="post">
        {{csrf_field()}}
        {{method_field('put')}}

        <div class="mb-3">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
            <input type="text"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('name') ? ' border-red-600' : ''}}"
                   id="name" name="name" required placeholder="Name" value="{{ old('name') ? old('name') : $user->name }}">
            @if($errors->has('name'))
                <span class="text-red-600 text-sm">{{$errors->first('name')}}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">E-mail</label>
            <input type="email"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('email') ? ' border-red-600' : ''}}"
                   id="email" name="email" required placeholder="E-mail" value="{{ old('email') ? old('email') : $user->email }}">
            @if($errors->has('email'))
                <span class="text-red-600 text-sm">{{$errors->first('email')}}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Current Password</label>
            <input type="password"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('password') ? ' border-red-600' : ''}}"
                   id="password" name="password" required placeholder="Current Password">
            @if($errors->has('password'))
                <span class="text-red-600 text-sm">{{$errors->first('password')}}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="new_password" class="block text-gray-700 text-sm font-bold mb-2">New Password</label>
            <input type="password"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('new_password') ? ' border-red-600' : ''}}"
                   id="new_password" name="new_password" placeholder="New Password">
            @if($errors->has('new_password'))
                <span class="text-red-600 text-sm">{{$errors->first('new_password')}}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm New Password</label>
            <input type="password"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('new_password_confirmation') ? ' border-red-600' : ''}}"
                   id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm New Password">
            @if($errors->has('new_password_confirmation'))
                <span class="text-red-600 text-sm">{{$errors->first('new_password_confirmation')}}</span>
            @endif
        </div>

        <div>
            <button class="py-2 px-3 bg-blue-800 text-white rounded">Update Profile</button>
        </div>
    </form>
@endsection