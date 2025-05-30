<!-- Champ Matricule -->
<div class="mb-3">
    <label for="matricule" class="form-label">Matricule <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('matricule') is-invalid @enderror" id="matricule" name="matricule" 
           value="{{ old('matricule', $etudiant->matricule ?? '') }}" required>
    @error('matricule')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <small class="text-muted">Le matricule doit être unique.</small>
</div>

<!-- Champ Nom -->
<div class="mb-3">
    <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" 
           value="{{ old('nom', $etudiant->nom ?? '') }}" required>
    @error('nom')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Champ Prénom -->
<div class="mb-3">
    <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" 
           value="{{ old('prenom', $etudiant->prenom ?? '') }}" required>
    @error('prenom')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Champ Classe (Liste déroulante) -->
<div class="mb-3">
    <label for="classe" class="form-label">Classe <span class="text-danger">*</span></label>
    <select class="form-select @error('classe') is-invalid @enderror" id="classe" name="classe" required>
        <option value="">Sélectionner une classe</option>
        @foreach($classeOptions as $value => $label)
            <option value="{{ $value }}" {{ (old('classe', $etudiant->classe ?? '') == $value) ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error('classe')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Champ Sexe (Radio buttons) -->
<div class="mb-3">
    <label class="form-label d-block">Sexe <span class="text-danger">*</span></label>
    <div class="form-check form-check-inline">
        <input class="form-check-input @error('sexe') is-invalid @enderror" type="radio" name="sexe" id="sexeHomme" 
               value="Homme" {{ (old('sexe', $etudiant->sexe ?? '') == 'Homme') ? 'checked' : '' }} required>
        <label class="form-check-label" for="sexeHomme">
            <i class="fas fa-male me-1 text-primary"></i>Homme
        </label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input @error('sexe') is-invalid @enderror" type="radio" name="sexe" id="sexeFemme" 
               value="Femme" {{ (old('sexe', $etudiant->sexe ?? '') == 'Femme') ? 'checked' : '' }}>
        <label class="form-check-label" for="sexeFemme">
            <i class="fas fa-female me-1 text-danger"></i>Femme
        </label>
    </div>
    @error('sexe')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

<!-- Champ Spécialité (Liste déroulante) -->
<div class="mb-3">
    <label for="specialite" class="form-label">Spécialité <span class="text-danger">*</span></label>
    <select class="form-select @error('specialite') is-invalid @enderror" id="specialite" name="specialite" required>
        <option value="">Sélectionner une spécialité</option>
        @foreach($specialiteOptions as $value => $label)
            <option value="{{ $value }}" {{ (old('specialite', $etudiant->specialite ?? '') == $value) ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error('specialite')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Champ CSRF Token -->
@csrf