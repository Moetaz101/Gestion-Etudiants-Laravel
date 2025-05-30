<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use Illuminate\Http\Request;

class MatiereController extends Controller
{
    /**
     * Affiche la liste des matières avec recherche, tri et pagination
     */
    public function index(Request $request)
    {
        $query = Matiere::query();
        
        // Recherche
        if ($request->has('search')) {
            $query->where('nom_matiere', 'like', '%' . $request->search . '%');
        }

        // Tri
        $sortField = $request->get('sort', 'nom_matiere');
        $sortDirection = $request->get('direction', 'asc');
        
        if (in_array($sortField, ['nom_matiere', 'niveau'])) {
            $query->orderBy($sortField, $sortDirection);
        }

        // Pagination
        $matieres = $query->paginate(10);
        $matieres->appends($request->all());

        return view('matieres.index', compact('matieres', 'sortField', 'sortDirection'));
    }

    /**
     * Affiche le formulaire de création d'une matière
     */
    public function create()
    {
        $niveaux = ['Licence 1', 'Licence 2', 'Licence 3', 'Master 1', 'Master 2'];
        return view('matieres.create', compact('niveaux'));
    }

    /**
     * Enregistre une nouvelle matière
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_matiere' => 'required|string|max:255|unique:matieres',
            'niveau' => 'required|string|max:255',
        ]);

        Matiere::create($validated);

        return redirect()->route('matieres.index')
            ->with('success', 'Matière créée avec succès');
    }

    /**
     * Affiche les détails d'une matière
     */
    public function show(Matiere $matiere)
    {
        $chapitres = $matiere->chapitres()->paginate(10);
        return view('matieres.show', compact('matiere', 'chapitres'));
    }

    /**
     * Affiche le formulaire de modification d'une matière
     */
    public function edit(Matiere $matiere)
    {
        $niveaux = ['Licence 1', 'Licence 2', 'Licence 3', 'Master 1', 'Master 2'];
        return view('matieres.edit', compact('matiere', 'niveaux'));
    }

    /**
     * Met à jour la matière spécifiée
     */
    public function update(Request $request, Matiere $matiere)
    {
        $validated = $request->validate([
            'nom_matiere' => 'required|string|max:255|unique:matieres,nom_matiere,' . $matiere->id,
            'niveau' => 'required|string|max:255',
        ]);

        $matiere->update($validated);

        return redirect()->route('matieres.index')
            ->with('success', 'Matière mise à jour avec succès');
    }

    /**
     * Supprime la matière spécifiée
     */
    public function destroy(Matiere $matiere)
    {
        $matiere->delete();

        return redirect()->route('matieres.index')
            ->with('success', 'Matière supprimée avec succès');
    }
}