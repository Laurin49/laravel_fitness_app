<x-app-layout>
    <div class="max-w-6xl mx-auto">
        <form class="space-y-5" method="POST" action="{{ route('workouts.update.beschreibung', [$workout->id, 'exercise_id' => $exercise_id]) }}">
            @csrf
            @method('PUT')
            
            <div class="flex justify-between w-2/3 mx-auto">
                <label for="name" class="text-xl">{{ $exercise_name }}</label>
                <a href="{{ route('workouts.show', $workout->id) }}" class="px-4 py-2 bg-indigo-400 rounded hover:bg-indigo-600">
                    <-- Back
                </a>
            </div>
            <!-- Beschreibung -->
            <div class="w-2/3 mx-auto mt-4">
                <label class="block text-1xl" for="beschreibung">
                    Beschreibung
                </label>
                <textarea name="beschreibung"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    rows="4" placeholder="">{{old('beschreibung', $beschreibung)}}</textarea>
                @error('beschreibung')
                <span class="text-sm text-red-600">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="flex justify-end w-2/3 mx-auto">
                <button type="submit"
                    class="p-2 mt-4 font-medium text-white uppercase bg-indigo-400 rounded-md hover:bg-indigo-600 focus:outline-none hover:shadow-none">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-app-layout>