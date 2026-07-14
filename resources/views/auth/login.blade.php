<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cravely Coffee - Login Pengelola</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-950 via-gray-900 to-amber-950 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <div class="absolute w-96 h-96 bg-amber-600/10 rounded-full blur-3xl -top-20 -left-20 pointer-events-none"></div>
    <div class="absolute w-96 h-96 bg-amber-900/20 rounded-full blur-3xl -bottom-20 -right-20 pointer-events-none"></div>

    <div class="w-full max-w-md bg-gray-900/40 backdrop-blur-xl border border-gray-800 p-8 rounded-2xl shadow-2xl transition-all duration-300 hover:border-amber-500/30">

        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-700 rounded-2xl shadow-lg shadow-amber-500/20 mb-4 text-3xl">
                ☕
            </div>
            <h2 class="text-2xl font-bold tracking-tight text-white">Cravely <span class="text-amber-500">Coffee</span></h2>
            <p class="text-sm text-gray-400 mt-1">Dashboard Portal Pengelola & Barista</p>
        </div>

        @if($errors->has('login_error'))
        <div class="mb-5 p-4 bg-red-950/40 border border-red-800/60 rounded-xl flex items-start gap-3 animate-pulse">
            <span class="text-red-400 mt-0.5">⚠️</span>
            <p class="text-sm text-red-300 font-medium">{{ $errors->first('login_error') }}</p>
        </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="posisi" class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Posisi</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">👤</span>
                    <input type="text" name="posisi" id="posisi" value="{{ old('posisi') }}" required
                        class="w-full bg-gray-950/60 border @error('posisi') border-red-500 @else border-gray-800 @enderror text-white pl-11 pr-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all placeholder-gray-600"
                        placeholder="Masukkan posisi Anda (admin)...">
                </div>
                @error('posisi')
                <p class="text-xs text-red-400 mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">🔒</span>
                    <input type="password" name="password" id="password" required
                        class="w-full bg-gray-950/60 border @error('password') border-red-500 @else border-gray-800 @enderror text-white pl-11 pr-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all placeholder-gray-600"
                        placeholder="••••••••">
                </div>
                @error('password')
                <p class="text-xs text-red-400 mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-800 text-amber-600 bg-gray-950/60 focus:ring-amber-500/50 focus:ring-offset-gray-900">
                    <span class="text-xs text-gray-400 ml-2 font-medium hover:text-gray-300 transition">Ingat saya di perangkat ini</span>
                </label>
            </div>

            <button type="submit"
                class="w-full bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-gray-950 font-bold py-3 px-4 rounded-xl shadow-lg shadow-amber-500/10 hover:shadow-amber-600/20 active:scale-[0.98] transition-all duration-150 flex items-center justify-center gap-2 mt-2">
                <span>Masuk ke Dashboard</span>
                <span class="text-sm">➜</span>
            </button>
        </form>

        <div class="mt-8 text-center border-t border-gray-800/60 pt-4">
            <p class="text-xs text-gray-500">Cravely Coffee App v1.0 • Sistem Keamanan Terenkripsi</p>
        </div>

    </div>

</body>

</html>