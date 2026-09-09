<x-app-layout>
    <form action="/register" method="POST">
        @csrf
        <div class="flex items-center justify-center min-h-screen bg-gray-100">
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4">
                <legend class="fieldset-legend">Register</legend>

                <label class="label">Username</label>
                <input type="text" name="name" class="input" :value="old('name')" placeholder="Username" />
                @error('name')<p>{{ $message }}</p>@enderror

                <label class="label">Phonenumber</label>
                <input type="text" name="phone" class="input" :value="old('phone')" placeholder="Phone" />
                @error('phone')<p>{{ $message }}</p>@enderror

                <button class="btn btn-neutral mt-4">Register</button>
            </fieldset>
        </div>
    </form>
</x-app-layout>
