<!DOCTYPE html>
<html>
<head>
    <title>Tambah Menu Cravely</title>
</head>
<body>

    <h1>Tambah Menu</h1>

    <form action="{{ route('menu.store') }}" method="POST">
        @csrf

        <p>
            <label>Nama Kopi</label><br>
            <input type="text" name="nama_kopi" required>
        </p>

        <p>
            <label>Harga</label><br>
            <input type="number" name="harga" required>
        </p>

        <p>
            <label>Size</label><br>
            <select name="size" required>
                <option value="">-- Pilih Size --</option>
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
            </select>
        </p>

        <p>
            <label>Kategori</label><br>
            <select name="id_kategori" required>
                <option value="">-- Pilih Kategori --</option>

                @foreach($kategori as $item)
                    <option value="{{ $item->id_kategori }}">
                        {{ $item->nama_kategori }}
                    </option>
                @endforeach

            </select>
        </p>

        <button type="submit">Simpan</button>

    </form>

</body>
</html>