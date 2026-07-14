<!DOCTYPE html>
<html>
<head>
    <title>Daftar Menu Cravely</title>
</head>
<body>

<h1>Daftar Menu Cravely</h1>

@foreach($menu as $item)

    <p>
        Nama Menu: {{ $item->nama_kopi }} <br>
        Harga: {{ $item->harga }} <br>
        Size: {{ $item->size }} <br>
        Kategori:
        {{ $item->kategori->nama_kategori ?? 'Tidak ada kategori' }}
    </p>

    <hr>

@endforeach

</body>
</html>