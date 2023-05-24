<x-admin-layout>
    <div class="max-w-6xl p-4 mx-auto mt-12 rounded bg-slate-50">
        <div class="flex p-2 m-2">
            <a href="{{ route('admin.roles.index') }}" class="px-4 py-2 bg-indigo-400 rounded hover:bg-indigo-600">
                Back</a>
        </div>
        <div class="max-w-md p-6 mx-auto mt-12 bg-gray-100 rounded">
            <form class="space-y-5" method="POST" action="{{ route('admin.roles.update', $role->id) }}">
                @csrf
                @method('PUT')
                <div>
                    <label for="name" class="text-xl">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $role->name) }}" 
                        class="block w-full px-3 py-3 mt-2 text-gray-800 border-2 border-gray-100 rounded-md appearance-none focus:text-gray-500 focus:outline-none focus:border-gray-200" />
                    @error('name')
                        <span class="text-sm text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full py-3 mt-10 font-medium text-white uppercase bg-indigo-400 rounded-md hover:bg-indigo-600 focus:outline-none hover:shadow-none">
                    Update
                </button>
            </form>
        </div>
    </div>

    <div class="max-w-6xl p-4 mx-auto mt-12 rounded bg-slate-50">
        <div class="flex p-2 m-2">
            <h2>Permissions</h2>
            <div class="max-w-md mx-auto">
                @foreach ($role->permissions as $rp)
                    <span class="p-2 m-2 bg-indigo-300 rounded-md">{{ $rp->name }}</span>
                @endforeach
            </div>
        </div>
        <div class="max-w-md p-6 mx-auto mt-12 bg-gray-100 rounded">
            <form class="space-y-5" method="POST" action="{{ route('admin.roles.permissions', $role->id) }}">
                @csrf
                <div>
                    <label class="text-xl" style="max-width: 300px">
                        <span class="text-gray-700">Permissions</span>
                        <select name="permissions[]"
                            class="block w-full px-3 py-3 mt-2 text-gray-800 border-2 border-gray-100 rounded-md appearance-none focus:text-gray-500 focus:outline-none focus:border-gray-200"
                            multiple>
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->id }}" @selected($role->hasPermission($permission->name))>
                                    {{ $permission->name }}
								</option>
                            @endforeach
                        </select>
                    </label>
                </div>

                <button type="submit"
                    class="w-full py-3 mt-10 font-medium text-white uppercase bg-indigo-400 rounded-md hover:bg-indigo-600 focus:outline-none hover:shadow-none">
                    Assign Permissions
                </button>
            </form>
        </div>
    </div>
</x-admin-layout>