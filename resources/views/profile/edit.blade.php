<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profile - Cravely Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-950 min-h-screen text-white p-8">

    <div class="max-w-md mx-auto bg-gray-900 p-6 rounded-2xl">
        <h1 class="text-xl font-bold mb-6">Profile Saya</h1>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-900/40 border border-green-700 rounded-lg text-sm text-green-300">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs text-gray-400 mb-1">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $barista->nama) }}"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2">
                @error('nama')
                    <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs text-gray-400 mb-1">Posisi</label>
                <input type="text" value="{{ $barista->posisi }}" disabled
                    class="w-full bg-gray-800/50 border border-gray-700 rounded-lg px-3 py-2 text-gray-400">
                <p class="text-xs text-gray-500 mt-1">Posisi tidak bisa diubah sendiri, hubungi admin.</p>
            </div>

            <div>
                <label class="block text-xs text-gray-400 mb-1">Shift</label>
                <input type="text" name="shift" value="{{ old('shift', $barista->shift) }}"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2">
            </div>

            <hr class="border-gray-800">

            <div>
                <label class="block text-xs text-gray-400 mb-1">Password Baru (opsional)</label>
                <input type="password" name="password"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2"
                    placeholder="Kosongkan jika tidak ingin ganti">
                @error('password')
                    <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs text-gray-400 mb-1">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2">
            </div>

            <button type="submit"
                class="w-full bg-amber-600 hover:bg-amber-700 font-semibold py-2 rounded-lg transition">
                Simpan Perubahan
            </button>
        </form>
    </div>

</body>
</html>