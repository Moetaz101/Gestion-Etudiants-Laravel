<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class InscriptionController extends Controller
{
    /**
     * Liste des cours disponibles
     */
    private $cours = [
        'Mathématiques',
        'Français',
        'Anglais',
        'Informatique',
        'Histoire',
        'Géographie',
        'Physique-Chimie',
        'SVT',
        'Économie',
        'Philosophie'
    ];

    /**
     * Affiche la liste des inscriptions avec recherche, tri et pagination.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort', 'id');
        $sortDirection = $request->input('direction', 'asc');
        
        // Validation des champs de tri
        $allowedSortFields = ['id', 'nom_cours', 'date_inscription', 'note'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'id';
        }
        
        // Validation de la direction de tri
        $allowedDirections = ['asc', 'desc'];
        if (!in_array($sortDirection, $allowedDirections)) {
            $sortDirection = 'asc';
        }
        
        $inscriptions = Inscription::when($search, function ($query) use ($search) {
                $query->where('nom_cours', 'like', '%' . $search . '%');
            })
            ->orderBy($sortField, $sortDirection)
            ->paginate(10)
            ->withQueryString();
        
        return view('inscriptions.index', compact('inscriptions', 'search', 'sortField', 'sortDirection'));
    }

    /**
     * Affiche le formulaire de création d'une inscription.
     */
    public function create()
    {
        $cours = $this->cours;
        return view('inscriptions.create', compact('cours'));
    }

    /**
     * Enregistre une nouvelle inscription dans la base de données.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_cours' => 'required|string|max:255',
            'date_inscription' => 'required|date',
        ]);
        
        // Génération d'une note aléatoire entre 0 et 20
        $note = round(mt_rand(0, 2000) / 100, 2);
        
        Inscription::create([
            'nom_cours' => $request->nom_cours,
            'date_inscription' => $request->date_inscription,
            'note' => $note,
        ]);
        
        return redirect()->route('inscriptions.index')
            ->with('success', 'Inscription créée avec succès.');
    }

    /**
     * Affiche les détails d'une inscription spécifique.
     */
    public function show(Inscription $inscription)
    {
        return view('inscriptions.show', compact('inscription'));
    }

    /**
     * Affiche le formulaire de modification d'une inscription.
     */
    public function edit(Inscription $inscription)
    {
        $cours = $this->cours;
        return view('inscriptions.edit', compact('inscription', 'cours'));
    }

    /**
     * Met à jour l'inscription spécifiée dans la base de données.
     */
    public function update(Request $request, Inscription $inscription)
    {
        $request->validate([
            'nom_cours' => 'required|string|max:255',
            'date_inscription' => 'required|date',
            'note' => 'required|numeric|min:0|max:20',
        ]);
        
        $inscription->update($request->all());
        
        return redirect()->route('inscriptions.index')
            ->with('success', 'Inscription mise à jour avec succès.');
    }

    /**
     * Supprime l'inscription spécifiée.
     */
    public function destroy(Inscription $inscription)
    {
        $inscription->delete();
        
        return redirect()->route('inscriptions.index')
            ->with('success', 'Inscription supprimée avec succès.');
    }
}