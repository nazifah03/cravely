<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Akses Ditolak - Cravely Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-950 min-h-screen flex items-center justify-center text-white p-4">

    <div class="text-center max-w-md">
        <div class="text-6xl mb-4">🔒</div>
        <h1 class="text-2xl font-bold mb-2">Akses Ditolak</h1>
        <p class="text-gray-400 mb-6">
            {{ $exception->getMessage() ?: 'Anda tidak memiliki izin untuk mengakses halaman ini. Fitur ini khusus untuk Admin.' }}
        </p>
        <a href="{{ route('dashboard') }}"
            class="inline-block bg-amber-600 hover:bg-amber-700 px-6 py-3 rounded-xl font-semibold transition">
            Kembali ke Dashboard
        </a>
    </div>

</body>
</html>