@csrf
<div class="mb-3">
    <label for="name" class="form-label">Nama Komoditas</label>
    <input type="text" class="form-control" name="name" value="{{ old('name', $commodity->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label for="unit" class="form-label">Satuan</label>
    <input type="text" class="form-control" name="unit" value="{{ old('unit', $commodity->unit ?? '') }}" required>
</div>
<button type="submit" class="btn btn-primary">Simpan</button>
