<x-app-layout>
    <div class="max-w-6xl mx-auto mt-12">
        {{-- @can('create', App\Models\Post::class) --}}
            <div class="flex justify-end p-2 m-2">
                <a href="{{ route('workouts.index') }}" class="px-4 py-2 bg-indigo-400 rounded hover:bg-indigo-600">
                <-- Back</a>
            </div>
        {{-- @endcan --}}
        <div class="max-w-md p-4 mx-auto">
            <form class="space-y-5" method="POST" action="{{ route('workouts.store') }}">
                @csrf
                <div>
                    <label for="name" class="text-xl">Name</label>
                    <input id="name" type="text" name="name"
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
                    <x-text-input id="datum" type="date" name="datum" required
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
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </label>
                </div>                
                <button type="submit"
                    class="w-full py-3 mt-10 font-medium text-white uppercase bg-indigo-400 rounded-md hover:bg-indigo-600 focus:outline-none hover:shadow-none">
                    Create
                </button>
            </form>
        </div>

    </div>
</x-app-layout>