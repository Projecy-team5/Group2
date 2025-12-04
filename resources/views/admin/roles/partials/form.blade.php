<div class="space-y-6">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Role Name</label>
        <input type="text" name="name" id="name"
            value="{{ old('name', $role->name ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            placeholder="e.g. Scholarship Reviewer" required>
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" id="description" rows="3"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            placeholder="Describe what this role can do">{{ old('description', $role->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div class="flex items-start justify-between gap-4 rounded-lg border border-gray-200 bg-gray-50/60 p-4">
        <div>
            <p class="text-sm font-medium text-gray-900">Administrator Access</p>
            <p class="mt-1 text-sm text-gray-500">
                Admin roles can access the dashboard and manage scholarships, users, and articles.
            </p>
        </div>
        <div class="flex items-center">
            <input type="hidden" name="is_admin" value="0">
            <label class="relative inline-flex cursor-pointer items-center">
                <input type="checkbox" value="1" name="is_admin"
                    class="peer sr-only" {{ old('is_admin', $role->is_admin ?? false) ? 'checked' : '' }}>
                <div
                    class="peer h-6 w-11 rounded-full bg-gray-300 after:absolute after:left-[4px] after:top-[4px] after:h-4 after:w-4 after:rounded-full after:bg-white after:transition-all peer-checked:bg-blue-600 peer-checked:after:translate-x-full">
                </div>
            </label>
        </div>
    </div>
    @error('is_admin')
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
