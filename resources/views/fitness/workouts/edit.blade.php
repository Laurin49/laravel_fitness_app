<x-app-layout>
    <div class="max-w-6xl mx-auto mt-12">
        <div class="flex p-2 m-2">
            <a href="{{ route('workouts.index') }}" class="px-4 py-2 bg-indigo-400 rounded hover:bg-indigo-600">
            <-- Back</a>
        </div>
        <div class="grid gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            <div class="max-w-md p-4 bg-slate-300">
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
            <div class="max-w-md max-h-full p-4 bg-gray-200">
                <form action="{{ route('workouts.categories', $workout->id) }}" method="POST">
                    @csrf
                    <div class="flex items-end justify-between mt-4">
                        <label class="block text-sm font-medium text-gray-700" for="category">
                            <span class=""> Categories: </span>
                            <select class="block w-full mt-1" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected( $category->id === $sel_category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <button type="submit"
                            class="inline-flex items-baseline px-6 py-2 text-sm font-semibold rounded-md text-sky-100 bg-sky-500 hover:bg-sky-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">
                            Select
                        </button>
                    </div>
                </form>
            </div>
            <div class="max-w-md p-4 bg-blue-200">
                <form class="space-y-5" method="POST" action="{{ route('workouts.exercises', $workout->id) }}">
                    @csrf
                    <div>
                        <label class="text-xl" style="max-width: 300px">
                            <span class="text-gray-700">Exercises</span>
                            <select name="exercises[]"
                                class="block w-full px-3 py-3 mt-2 text-gray-800 border-2 border-gray-100 rounded-md appearance-none focus:text-gray-500 focus:outline-none focus:border-gray-200"
                                multiple>
                                @foreach ($exercises as $exercise)
                                    <option value="{{ $exercise->id }}" @selected($workout->hasExercise($exercise->name))>
                                        {{ $exercise->name }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>
    
                    <button type="submit"
                        class="w-full py-3 mt-10 font-medium text-white uppercase bg-indigo-400 rounded-md hover:bg-indigo-600 focus:outline-none hover:shadow-none">
                        Assign Exercises
                    </button>
                </form>
            </div>
        </div>
        

    </div>
</x-app-layout>