<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
{
    /**
     * Liste des matières disponibles (statique, pas de table en BD)
     */
    private $matieres = ['Math', 'Physique', 'Informatique', 'Anglais', 'Français'];
    
    /**
     * Afficher une liste des évaluations avec recherche, tri et pagination.
     */
    public function index(Request $request)
    {
        // Récupérer les paramètres de recherche
        $search = $request->input('search');
        $matiere = $request->input('matiere');
        
        // Récupérer le paramètre de tri (colonne et direction)
        $sortColumn = $request->input('sort', 'etudiant_nom');
        $sortDirection = $request->input('direction', 'asc');
        
        // Valider les paramètres de tri pour éviter les injections SQL
        $allowedColumns = ['etudiant_nom', 'etudiant_prenom', 'matiere', 'note', 'date'];
        $sortColumn = in_array($sortColumn, $allowedColumns) ? $sortColumn : 'etudiant_nom';
        $sortDirection = in_array($sortDirection, ['asc', 'desc']) ? $sortDirection : 'asc';
        
        // Construire la requête
        $query = Evaluation::query();
        
        // Appliquer les filtres de recherche si présents
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('etudiant_nom', 'like', "%{$search}%")
                  ->orWhere('etudiant_prenom', 'like', "%{$search}%");
            });
        }
        
        if ($matiere) {
            $query->where('matiere', $matiere);
        }
        
        // Appliquer le tri
        $query->orderBy($sortColumn, $sortDirection);
        
        // Paginer les résultats (10 par page)
        $evaluations = $query->paginate(10)->withQueryString();
        
        // Passer les données à la vue
        return view('evaluations.index', [
            'evaluations' => $evaluations,
            'matieres' => $this->matieres,
            'search' => $search,
            'matiere' => $matiere,
            'sortColumn' => $sortColumn,
            'sortDirection' => $sortDirection
        ]);
    }

    /**
     * Afficher le formulaire de création d'une évaluation.
     */
    public function create()
    {
        return view('evaluations.create', [
            'matieres' => $this->matieres
        ]);
    }

    /**
     * Stocker une nouvelle évaluation dans la base de données.
     */
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'etudiant_nom' => 'required|string|max:255',
            'etudiant_prenom' => 'required|string|max:255',
            'matiere' => 'required|string|in:' . implode(',', $this->matieres),
            'note' => 'required|numeric|min:0|max:20',
            'date' => 'required|date',
            'message' => 'nullable|string',
        ]);
        
        // Créer l'évaluation
        Evaluation::create($validated);
        
        // Rediriger avec un message de succès
        return redirect()->route('evaluations.index')
            ->with('success', 'L\'évaluation a été ajoutée avec succès.');
    }

    /**
     * Afficher les détails d'une évaluation spécifique.
     */
    public function show(Evaluation $evaluation)
    {
        return view('evaluations.show', [
            'evaluation' => $evaluation
        ]);
    }

    /**
     * Afficher le formulaire de modification d'une évaluation.
     */
    public function edit(Evaluation $evaluation)
    {
        return view('evaluations.edit', [
            'evaluation' => $evaluation,
            'matieres' => $this->matieres
        ]);
    }

    /**
     * Mettre à jour l'évaluation spécifiée dans la base de données.
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        // Validation des données
        $validated = $request->validate([
            'etudiant_nom' => 'required|string|max:255',
            'etudiant_prenom' => 'required|string|max:255',
            'matiere' => 'required|string|in:' . implode(',', $this->matieres),
            'note' => 'required|numeric|min:0|max:20',
            'date' => 'required|date',
            'message' => 'nullable|string',
        ]);
        
        // Mettre à jour l'évaluation
        $evaluation->update($validated);
        
        // Rediriger avec un message de succès
        return redirect()->route('evaluations.index')
            ->with('success', 'L\'évaluation a été mise à jour avec succès.');
    }

    /**
     * Supprimer l'évaluation spécifiée de la base de données.
     */
    public function destroy(Evaluation $evaluation)
    {
        $evaluation->delete();
        
        return redirect()->route('evaluations.index')
            ->with('success', 'L\'évaluation a été supprimée avec succès.');
    }
}