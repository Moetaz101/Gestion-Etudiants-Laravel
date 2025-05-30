@csrf

<div class="mb-3">
    <label for="nom_cours" class="form-label">Nom du cours</label>
    <select class="form-select @error('nom_cours') is-invalid @enderror" id="nom_cours" name="nom_cours" required>
        <option value="" selected disabled>Choisir un cours</option>
        @foreach($cours as $c)
            <option value="{{ $c }}" {{ (isset($inscription) && $inscription->nom_cours == $c) || old('nom_cours') == $c ? 'selected' : '' }}>
                {{ $c }}
            </option>
        @endforeach
    </select>
    @error('nom_cours')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="date_inscription" class="form-label">Date d'inscription</label>
    <input type="date" class="form-control @error('date_inscription') is-invalid @enderror" id="date_inscription" name="date_inscription" 
           value="{{ isset($inscription) ? $inscription->date_inscription->format('Y-m-d') : old('date_inscription', date('Y-m-d')) }}" required>
    @error('date_inscription')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@if(isset($inscription))
    <div class="mb-3">
        <label for="note" class="form-label">Note</label>
        <input type="number" step="0.01" min="0" max="20" class="form-control @error('note') is-invalid @enderror" id="note" name="note" 
               value="{{ old('note', $inscription->note) }}" required>
        <div class="form-text">Note sur 20</div>
        @error('note')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
@endif