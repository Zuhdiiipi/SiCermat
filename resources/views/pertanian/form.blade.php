@csrf
<div class="mb-3">
    <label for="name" class="form-label">Nama Komoditas</label>
    <input type="text" class="form-control" name="name" value="{{ old('name', $commodity->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label for="unit" class="form-label">Satuan</label>
    <input type="text" class="form-control" name="unit" value="{{ old('unit', $commodity->unit ?? '') }}"
        required>
</div>
<div class="mb-3">
    <label for="image" class="form-label">Gambar Komoditas</label>
    <input type="file" class="form-control" name="image" id="image" accept="image/*">

    @if (isset($commodity) && $commodity->image)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $commodity->image) }}" alt="Gambar" width="100">
        </div>
    @endif
</div>
<button type="submit" class="btn btn-primary">Simpan</button>
