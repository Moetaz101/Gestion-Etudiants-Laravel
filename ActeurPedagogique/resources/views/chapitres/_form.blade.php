<div class="mb-3">
    <label for="titre" class="form-label">Titre du chapitre <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre" value="{{ old('titre', $chapitre->titre ?? '') }}" required>
    @error('titre')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="matiere_id" class="form-label">Matière <span class="text-danger">*</span></label>
    <select class="form-select @error('matiere_id') is-invalid @enderror" id="matiere_id" name="matiere_id" required>
        <option value="">Sélectionnez une matière</option>
        @foreach($matieres as $matiere)
            <option value="{{ $matiere->id }}" {{ (old('matiere_id', $chapitre->matiere_id ?? $matiere_id ?? '') == $matiere->id) ? 'selected' : '' }}>
                {{ $matiere->nom_matiere }} ({{ $matiere->niveau }})
            </option>
        @endforeach
    </select>
    @error('matiere_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="contenu" class="form-label">Contenu du chapitre <span class="text-danger">*</span></label>
    <textarea class="form-control @error('contenu') is-invalid @enderror" id="contenu" name="contenu" rows="10" required>{{ old('contenu', $chapitre->contenu ?? '') }}</textarea>
    @error('contenu')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@if(isset($matiere_id))
    <input type="hidden" name="redirect_to_matiere" value="1">
@endif