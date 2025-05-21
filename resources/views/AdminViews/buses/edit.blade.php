<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Bus - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Edit Bus</h1>
                <a href="{{ route('admin.buses') }}" class="text-gray-600 hover:text-black">&larr; Back to Buses</a>
            </div>

            <form action="{{ route('admin.buses.update', $bus->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-2 gap-6">
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Bus Name</label>
                        <input type="text" name="name" value="{{ old('name', $bus->name) }}" 
                               class="w-full border rounded px-3 py-2" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Standard</label>
                        <select name="standard_id" class="w-full border rounded px-3 py-2" required>
                            @foreach($standards as $standard)
                                <option value="{{ $standard->id }}" 
                                    {{ $bus->standard_id == $standard->id ? 'selected' : '' }}>
                                    {{ $standard->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Features</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach($features as $feature)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="features[]" value="{{ $feature->id }}"
                                        {{ in_array($feature->id, $bus->features) ? 'checked' : '' }}
                                        class="form-checkbox">
                                    <span class="ml-2">{{ $feature->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-4">
                    <a href="{{ route('admin.buses') }}" class="px-4 py-2 border rounded">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-black text-white rounded">Update Bus</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
