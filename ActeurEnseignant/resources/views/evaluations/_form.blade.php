<!-- Champ Nom -->
<div class="mb-3">
    <label for="etudiant_nom" class="form-label">Nom de l'étudiant <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('etudiant_nom') is-invalid @enderror" id="etudiant_nom" name="etudiant_nom" 
           value="{{ old('etudiant_nom', $evaluation->etudiant_nom ?? '') }}" required>
    @error('etudiant_nom')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Champ Prénom -->
<div class="mb-3">
    <label for="etudiant_prenom" class="form-label">Prénom de l'étudiant <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('etudiant_prenom') is-invalid @enderror" id="etudiant_prenom" name="etudiant_prenom" 
           value="{{ old('etudiant_prenom', $evaluation->etudiant_prenom ?? '') }}" required>
    @error('etudiant_prenom')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Champ Matière -->
<div class="mb-3">
    <label for="matiere" class="form-label">Matière <span class="text-danger">*</span></label>
    <select class="form-select @error('matiere') is-invalid @enderror" id="matiere" name="matiere" required>
        <option value="">Sélectionner une matière</option>
        @foreach($matieres as $matiere)
            <option value="{{ $matiere }}" {{ (old('matiere', $evaluation->matiere ?? '') == $matiere) ? 'selected' : '' }}>
                {{ $matiere }}
            </option>
        @endforeach
    </select>
    @error('matiere')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Champ Note -->
<div class="mb-3">
    <label for="note" class="form-label">Note (sur 20) <span class="text-danger">*</span></label>
    <input type="number" step="0.01" min="0" max="20" class="form-control @error('note') is-invalid @enderror" id="note" name="note" 
           value="{{ old('note', $evaluation->note ?? '') }}" required>
    @error('note')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Champ Date -->
<div class="mb-3">
    <label for="date" class="form-label">Date de l'évaluation <span class="text-danger">*</span></label>
    <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" 
           value="{{ old('date', isset($evaluation) ? $evaluation->date->format('Y-m-d') : date('Y-m-d')) }}" required>
    @error('date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Champ Message (facultatif) -->
<div class="mb-3">
    <label for="message" class="form-label">Commentaire (facultatif)</label>
    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="3">{{ old('message', $evaluation->message ?? '') }}</textarea>
    @error('message')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Champs obligatoires -->
<div class="mb-3">
    <small class="text-muted"><span class="text-danger">*</span> Champs obligatoires</small>
</div>