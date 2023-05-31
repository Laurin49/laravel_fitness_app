<x-app-layout>
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between p-2 m-2">
            <div>
                <span class="text-2xl">{{ $workout->name }}: {{ date('d.m.Y', strtotime($workout->datum)) }}</span>
            </div>
            <div>
                <a href="{{ route('workouts.index') }}" class="px-4 py-2 bg-indigo-400 rounded hover:bg-indigo-600">
                    <-- Back </a>
            </div>
        </div>
        <div class="m-4 overflow-hidden rounded shadow-lg max-5-xl bg-slate-200">
            <div class="px-4 py-4">
                <div class="w-3/4 mx-auto mb-2 text-xl font-bold">Workout - Exercises</div>
                <table class="w-3/4 mx-auto">
                    <thead>
                        <tr>
                            <th class="px-2 py-2 text-left border-b border-gray-200 text-md gray-500 bg-gray-50">
                                Name
                            </th>
                            <th class="px-2 py-2 text-left border-b border-gray-200 text-md gray-500 bg-gray-50">
                                Beschreibung
                            </th>
                            <th class="px-2 py-2 text-left border-b border-gray-200 text-md gray-500 bg-gray-50">
                                Edit
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($workout->exercises as $w_exercise)
                        <tr>
                            <td class="px-2 py-2 text-left border-b border-gray-200">
                                {{ $w_exercise->name }}
                            </td>
                            <td class="px-2 py-2 text-left border-b border-gray-200">
                                {{ $w_exercise->pivot->beschreibung }}
                            </td>
                            <td class="px-2 py-2 text-left border-b border-gray-200">
                                <a href="{{ route('workouts.update.exercise', [
                                    $workout->id, 
                                    'exercise_id' => $w_exercise,
                                    'exercise_name' => $w_exercise->name, 
                                    'beschreibung' => $w_exercise->pivot->beschreibung
                                    ]) }}" 
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="grid gap-2 px-4 md:grid-cols-1 lg:grid-cols-2">
            <div class="max-w-6xl col-span-1 p-2 bg-slate-400">
                <span class="font-bold text-1xl">Attach Exercises</span><br />
                <form action="{{ route('workouts.attach.exercise', $workout->id) }}" method="POST" class="text-1xl">
                    @csrf
                    <select name="exercise_id"
                        class="block w-3/4 px-1 py-1 mt-2 text-gray-800 border-2 border-gray-100 rounded-md appearance-none focus:text-gray-500 focus:outline-none focus:border-gray-200">
                        @foreach ($available_exercises as $exercise)
                        <option value="{{ $exercise->id }}" @selected($workout->hasExercise($exercise->name))>
                            {{ $exercise->name }}
                        </option>
                        @endforeach
                    </select>
                    <!-- Description -->
                    <div class="mt-4">
                        <label class="block text-1xl" for="beschreibung">
                            Beschreibung
                        </label>
                        <textarea name="beschreibung"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            rows="4" placeholder="">{{old('beschreibung', $workout->beschreibung)}}</textarea>
                        @error('beschreibung')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="w-1/2 py-1 mt-4 font-medium text-white uppercase bg-indigo-400 rounded-md hover:bg-indigo-600 focus:outline-none hover:shadow-none">
                            Attach
                        </button>
                    </div>
                </form>
            </div>
            <div class="max-w-6xl p-2 bg-slate-500">
                <span class="font-bold text-1xl">Detach Exercises</span><br />
                <form action="{{ route('workouts.detach.exercise', $workout->id) }}" method="POST" class="text-1xl">
                    @csrf
                    <select name="exercise_id"
                        class="block w-3/4 px-1 py-1 mt-2 text-gray-800 border-2 border-gray-100 rounded-md appearance-none focus:text-gray-500 focus:outline-none focus:border-gray-200">
                        @foreach ($workout_exercises as $detach_ex)
                        <option value="{{ $detach_ex->id }}" @selected($workout->hasExercise($detach_ex->name))>
                            {{ $detach_ex->name }}
                        </option>
                        @endforeach
                    </select>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="w-1/2 py-1 mt-4 font-medium text-white uppercase bg-indigo-400 rounded-md hover:bg-indigo-600 focus:outline-none hover:shadow-none">
                            Detach
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</x-app-layout>