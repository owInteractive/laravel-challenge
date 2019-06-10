@extends('layouts.backend')

@section('page')
    <div class="mb-5">
        <h2 class="text-3xl mt-6 text-gray-800">Import Events</h2>
    </div>

    <form class="bg-white w-full rounded shadow p-5 border-t-2 border-blue-600" action="{{route('events.import')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="w-full">
            <div class="mb-3">
                <label for="file" class="block text-gray-700 text-sm font-bold mb-2">File</label>
                <input type="file" accept=".csv"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('file') ? ' border-red-600' : ''}}"
                       id="file" name="file" required>
                @if($errors->has('file'))
                    <span class="text-red-600 text-sm">{{$errors->first('file')}}</span>
                @endif
            </div>
        </div>

        <button class="py-2 px-3 bg-blue-800 text-white rounded">Import Events</button>
    </form>
@endsection