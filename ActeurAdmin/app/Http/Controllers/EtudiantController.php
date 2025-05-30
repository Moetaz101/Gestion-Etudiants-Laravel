<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    /**
     * Afficher une liste des étudiants avec tri et recherche.
     */
    public function index(Request $request)
    {
        $query = Etudiant::query();
        
        // Recherche
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('matricule', 'like', "%$search%")
                  ->orWhere('nom', 'like', "%$search%")
                  ->orWhere('prenom', 'like', "%$search%");
            });
        }
        
        // Tri
        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'asc');
        
        // Vérifier si le champ de tri est valide
        $validSortFields = ['id', 'matricule', 'nom', 'prenom'];
        if (in_array($sortField, $validSortFields)) {
            $query->orderBy($sortField, $sortDirection);
        }
        
        $etudiants = $query->paginate(10);
        
        return view('etudiants.index', compact('etudiants'))
                ->with('sortField', $sortField)
                ->with('sortDirection', $sortDirection)
                ->with('search', $request->get('search', ''));
    }

    /**
     * Afficher le formulaire de création d'un étudiant.
     */
    public function create()
    {
        $classeOptions = Etudiant::getClasseOptions();
        $specialiteOptions = Etudiant::getSpecialiteOptions();
        $sexeOptions = Etudiant::getSexeOptions();
        
        return view('etudiants.create', compact('classeOptions', 'specialiteOptions', 'sexeOptions'));
    }

    /**
     * Enregistrer un nouvel étudiant dans la base de données.
     */
    public function store(Request $request)
    {
        $this->validateEtudiant($request);
        
        Etudiant::create($request->all());
        
        return redirect()->route('etudiants.index')
                        ->with('success', 'Étudiant ajouté avec succès');
    }

    /**
     * Afficher les détails d'un étudiant spécifique.
     */
    public function show(Etudiant $etudiant)
    {
        return view('etudiants.show', compact('etudiant'));
    }

    /**
     * Afficher le formulaire d'édition d'un étudiant.
     */
    public function edit(Etudiant $etudiant)
    {
        $classeOptions = Etudiant::getClasseOptions();
        $specialiteOptions = Etudiant::getSpecialiteOptions();
        $sexeOptions = Etudiant::getSexeOptions();
        
        return view('etudiants.edit', compact('etudiant', 'classeOptions', 'specialiteOptions', 'sexeOptions'));
    }

    /**
     * Mettre à jour un étudiant dans la base de données.
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $this->validateEtudiant($request, $etudiant->id);
        
        $etudiant->update($request->all());
        
        return redirect()->route('etudiants.index')
                        ->with('success', 'Étudiant mis à jour avec succès');
    }

    /**
     * Supprimer un étudiant de la base de données.
     */
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();
        
        return redirect()->route('etudiants.index')
                        ->with('success', 'Étudiant supprimé avec succès');
    }
    
    /**
     * Valider les données de l'étudiant.
     */
    private function validateEtudiant(Request $request, $id = null)
    {
        $uniqueRule = 'unique:etudiants,matricule';
        
        if ($id) {
            $uniqueRule .= ',' . $id;
        }
        
        return $request->validate([
            'matricule' => ['required', 'string', 'max:255', $uniqueRule],
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'classe' => 'required|string|max:255',
            'sexe' => 'required|in:Homme,Femme',
            'specialite' => 'required|string|max:255',
        ]);
    }
}