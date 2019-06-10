{{csrf_field()}}
<div class="w-full">
    <div class="mb-3">
        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
        <input type="text"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('title') ? ' border-red-600' : ''}}"
               id="title" name="title" required placeholder="Title"
               value="{{ isset($event) && !old('title') ? $event->title : old('title')}}" maxlength="255">
        @if($errors->has('title'))
            <span class="text-red-600 text-sm">{{$errors->first('title')}}</span>
        @endif
    </div>

    <div class="mb-3">
        <label for="starts_at" class="block text-gray-700 text-sm font-bold mb-2">Starts At</label>
        <input type="text"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('starts_at') ? ' border-red-600' : ''}}"
               id="starts_at" name="starts_at" required placeholder="Starts At"
               value="{{ isset($event) && !old('starts_at') ? $event->starts_at : old('starts_at')}}"
               maxlength="255">
        @if($errors->has('starts_at'))
            <span class="text-red-600 text-sm">{{$errors->first('starts_at')}}</span>
        @endif
    </div>

    <div class="mb-3">
        <label for="ends_in" class="block text-gray-700 text-sm font-bold mb-2">Ends In</label>
        <input type="text"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('ends_in') ? ' border-red-600' : ''}}"
               id="ends_in" name="ends_in" required placeholder="Ends In"
               value="{{ isset($event) && !old('ends_in') ? $event->ends_in : old('ends_in')}}"
               maxlength="255">
        @if($errors->has('ends_in'))
            <span class="text-red-600 text-sm">{{$errors->first('ends_in')}}</span>
        @endif
    </div>

    <div class="mb-3">
        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
        <textarea name="description"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('description') ? ' border-red-600' : ''}}"
                rows="5">{{isset($event) && !old('description') ? $event->description : old('description')}}</textarea>
        @if($errors->has('description'))
            <span class="text-red-600 text-sm">{{$errors->first('description')}}</span>
        @endif
    </div>
</div>

@push('js')
    <script>
        flatpickr('#starts_at', {
            enableTime: true,
            dateFormat: "Y-m-d H:i:S",
        });
        flatpickr('#ends_in', {
            enableTime: true,
            dateFormat: "Y-m-d H:i:S",
        });
    </script>
@endpush