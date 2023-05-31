<x-app-layout>
    <div class="max-w-6xl p-4 mx-auto mt-2 rounded bg-slate-50">
        <div class="flex justify-end p-2 m-2">
            <a href="{{ route('workouts.index') }}" class="px-4 py-2 bg-indigo-400 rounded hover:bg-indigo-600">
            <-- Back</a>
        </div>
        <div class="max-w-md p-6 mx-auto mt-2 bg-gray-100 rounded">
            <div class="p-4 bg-slate-300">
                <form class="space-y-5" method="POST" action="{{ route('workouts.update', $workout->id) }}">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="name" class="text-xl">Name</label>
                        <input id="name" type="text" name="name" value="{{old('name', $workout->name)}}"
                            class="block w-full px-3 py-3 mt-2 text-gray-800 border-2 border-gray-100 rounded-md appearance-none focus:text-gray-500 focus:outline-none focus:border-gray-200" />
                        @error('name')
                            <span class="text-sm text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Datum -->
                    <div class="mt-4">
                        <label class="text-xl" for="datum">
                            Datum
                        </label>
                        <x-text-input id="datum" type="date" name="datum" required value="{{old('datum', $workout->datum)}}"
                            class="block w-full px-3 py-3 mt-2 text-gray-800 border-2 appearance-none"  />
                        @error('datum')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="mt-4 mb-6">
                        <label class="block text-sm font-medium text-gray-700" for="category">
                            <span class=""> Categories: </span>
                            <select class="block w-full mt-1" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $workout->category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>                    
                    <button type="submit"
                        class="w-full py-3 mt-10 font-medium text-white uppercase bg-indigo-400 rounded-md hover:bg-indigo-600 focus:outline-none hover:shadow-none">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>