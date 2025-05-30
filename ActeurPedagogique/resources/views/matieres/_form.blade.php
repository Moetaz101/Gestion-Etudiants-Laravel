<div class="mb-3">
    <label for="nom_matiere" class="form-label">Nom de la matière <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('nom_matiere') is-invalid @enderror" id="nom_matiere" name="nom_matiere" value="{{ old('nom_matiere', $matiere->nom_matiere ?? '') }}" required>
    @error('nom_matiere')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="niveau" class="form-label">Niveau <span class="text-danger">*</span></label>
    <select class="form-select @error('niveau') is-invalid @enderror" id="niveau" name="niveau" required>
        <option value="">Sélectionnez un niveau</option>
        @foreach($niveaux as $niveau)
            <option value="{{ $niveau }}" {{ (old('niveau', $matiere->niveau ?? '') == $niveau) ? 'selected' : '' }}>
                {{ $niveau }}
            </option>
        @endforeach
    </select>
    @error('niveau')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>