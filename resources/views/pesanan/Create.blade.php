@extends('layouts.app')

@section('title', 'Buat Pesanan')
@section('page-title', 'Buat Pesanan Baru')

@section('content')

    <div class="bg-white rounded-lg shadow-sm p-6 max-w-2xl">
        <form action="{{ route('pesanan.store') }}" method="POST" id="pesanan-form" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pelanggan</label>
                <select name="id_pelanggan"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-500 focus:outline-none">
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach ($pelanggan as $item)
                        <option value="{{ $item->id_pelanggan }}" {{ old('id_pelanggan') == $item->id_pelanggan ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
                @error('id_pelanggan')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <label class="block text-sm font-medium text-gray-700">Item Pesanan</label>
                    <button type="button" onclick="addItemRow()"
                        class="text-xs text-amber-600 hover:text-amber-700 font-semibold">+ Tambah Item</button>
                </div>

                <div id="items-container" class="space-y-2"></div>
                @error('items')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-right text-lg font-bold text-gray-800">
                Total: Rp <span id="total-display">0</span>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="bg-amber-600 hover:bg-amber-700 text-white font-semibold px-5 py-2 rounded-lg transition">
                    Buat Pesanan
                </button>
                <a href="{{ route('pesanan.index') }}"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-5 py-2 rounded-lg transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        const menuData = @json($menu->map(fn($m) => ['id' => $m->id_menu, 'nama' => $m->nama_kopi . ' (' . $m->size . ')', 'harga' => (float) $m->harga]));
        let rowIndex = 0;

        function addItemRow() {
            const container = document.getElementById('items-container');
            const row = document.createElement('div');
            row.className = 'flex gap-2 items-center';
            row.id = `row-${rowIndex}`;

            let options = '<option value="">-- Pilih Menu --</option>';
            menuData.forEach(m => {
                options += `<option value="${m.id}" data-harga="${m.harga}">${m.nama} - Rp ${m.harga.toLocaleString('id-ID')}</option>`;
            });

            row.innerHTML = `
                <select name="items[${rowIndex}][id_menu]" class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm" onchange="calculateTotal()">
                    ${options}
                </select>
                <input type="number" name="items[${rowIndex}][jumlah]" value="1" min="1" onchange="calculateTotal()"
                    class="w-20 border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <button type="button" onclick="document.getElementById('row-${rowIndex}').remove(); calculateTotal();"
                    class="text-red-500 hover:text-red-700 text-sm px-2">✕</button>
            `;

            container.appendChild(row);
            rowIndex++;
        }

        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('#items-container > div').forEach(row => {
                const select = row.querySelector('select');
                const qty = row.querySelector('input[type="number"]');
                const selectedOption = select.options[select.selectedIndex];
                const harga = selectedOption ? parseFloat(selectedOption.dataset.harga || 0) : 0;
                total += harga * (parseInt(qty.value) || 0);
            });
            document.getElementById('total-display').textContent = total.toLocaleString('id-ID');
        }

        // Mulai dengan 1 baris item
        addItemRow();
    </script>

@endsection