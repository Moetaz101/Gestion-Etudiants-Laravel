<?php

namespace App\Http\Controllers;

use App\Models\Chapitre;
use App\Models\Matiere;
use Illuminate\Http\Request;

class ChapitreController extends Controller
{
    /**
     * Affiche la liste des chapitres (filtrés par matière si spécifié)
     */
    public function index(Request $request)
    {
        $query = Chapitre::with('matiere');
        
        // Initialisation des variables
        $matiereId = null;
        $matiere = null;
        
        // Filtre par matière
        if ($request->has('matiere_id')) {
            $query->where('matiere_id', $request->matiere_id);
            $matiere = Matiere::findOrFail($request->matiere_id);
            $matiereId = $request->matiere_id;
        }

        // Recherche par titre
        if ($request->has('search')) {
            $query->where('titre', 'like', '%' . $request->search . '%');
        }

        // Tri
        $sortField = $request->get('sort', 'titre');
        $sortDirection = $request->get('direction', 'asc');
        
        if (in_array($sortField, ['titre', 'created_at'])) {
            $query->orderBy($sortField, $sortDirection);
        }

        // Pagination
        $chapitres = $query->paginate(10);
        $chapitres->appends($request->all());

        return view('chapitres.index', compact(
            'chapitres', 
            'sortField', 
            'sortDirection',
            'matiereId',
            'matiere'
        ));
    }

    /**
     * Affiche le formulaire de création d'un chapitre
     */
    public function create(Request $request)
    {
        $matieres = Matiere::all();
        $matiere_id = $request->matiere_id;
        
        return view('chapitres.create', compact('matieres', 'matiere_id'));
    }

    /**
     * Enregistre un nouveau chapitre
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'matiere_id' => 'required|exists:matieres,id',
        ]);

        Chapitre::create($validated);

        if ($request->has('redirect_to_matiere') && $request->redirect_to_matiere) {
            return redirect()->route('matieres.show', $request->matiere_id)
                ->with('success', 'Chapitre créé avec succès');
        }

        return redirect()->route('chapitres.index', ['matiere_id' => $request->matiere_id])
            ->with('success', 'Chapitre créé avec succès');
    }

    /**
     * Affiche les détails d'un chapitre
     */
    public function show(Chapitre $chapitre)
    {
        return view('chapitres.show', compact('chapitre'));
    }

    /**
     * Affiche le formulaire de modification d'un chapitre
     */
    public function edit(Chapitre $chapitre)
    {
        $matieres = Matiere::all();
        return view('chapitres.edit', compact('chapitre', 'matieres'));
    }

    /**
     * Met à jour le chapitre spécifié
     */
    public function update(Request $request, Chapitre $chapitre)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'matiere_id' => 'required|exists:matieres,id',
        ]);

        $chapitre->update($validated);

        if ($request->has('redirect_to_matiere') && $request->redirect_to_matiere) {
            return redirect()->route('matieres.show', $chapitre->matiere_id)
                ->with('success', 'Chapitre mis à jour avec succès');
        }

        return redirect()->route('chapitres.index', ['matiere_id' => $chapitre->matiere_id])
            ->with('success', 'Chapitre mis à jour avec succès');
    }

    /**
     * Supprime le chapitre spécifié
     */
    public function destroy(Chapitre $chapitre)
    {
        $matiere_id = $chapitre->matiere_id;
        $chapitre->delete();

        return redirect()->route('chapitres.index', ['matiere_id' => $matiere_id])
            ->with('success', 'Chapitre supprimé avec succès');
    }
}