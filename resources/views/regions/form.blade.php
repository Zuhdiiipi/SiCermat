@csrf
<div class="mb-3">
    <label for="name" class="form-label">Nama Wilayah</label>
    <input type="text" class="form-control" name="name" value="{{ old('name', $region->name ?? '') }}" required>
</div>
<button type="submit" class="btn btn-primary">Simpan</button>
