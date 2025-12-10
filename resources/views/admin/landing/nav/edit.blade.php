<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Navigation Menu
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form action="{{ route('admin.landing.navigation.update', $item->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Label</label>
                        <input type="text" name="label" value="{{ old('label', $item->label) }}"
                               class="border rounded w-full px-3 py-2" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">URL</label>
                        <input type="text" name="url" value="{{ old('url', $item->url) }}"
                               class="border rounded w-full px-3 py-2" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Position</label>
                        <input type="number" name="position" value="{{ old('position', $item->position) }}"
                               class="border rounded w-full px-3 py-2" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Status</label>
                        <select name="status" class="border rounded w-full px-3 py-2">
                            <option value="1" {{ old('status', $item->status) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status', $item->status) == 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded hover:from-blue-600 hover:to-purple-700">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
