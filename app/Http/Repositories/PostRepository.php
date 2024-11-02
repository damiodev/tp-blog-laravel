<?php

namespace App\Http\Repositories;

use App\Models\Post;

class PostRepository
{
    // Cette fonction renvoie une requête de base pour les articles actifs
    // On utilise ici un SELECT pour n'obtenir que les colonnes essentielles (id, slug, image, title, etc.)
    // On charge également le nom de l'auteur pour l'afficher sans charger le reste des informations de l'article
    protected function queryActive()
    {
        return Post::select(
            'id',
            'slug',
            'image',
            'title',
            'excerpt',
            'user_id'
        )
            ->with('user:id,name')
            ->whereActive(true); // Seuls les articles actifs
    }

    // Fonction qui ajoute un tri par date à la requête de base des articles actifs
    protected function queryActiveOrderByDate()
    {
        return $this->queryActive()->latest();
    }

    // Fonction principale pour récupérer les articles actifs, triés par date et paginés
    // $nbrPages permet de définir le nombre de résultats par page
    public function getActiveOrderByDate($nbrPages)
    {
        return $this->queryActiveOrderByDate()->paginate($nbrPages);
    }

    // Fonction pour obtenir les articles récents (les héros)
    // Elle renvoie les 5 derniers articles actifs créés ou modifiés, incluant leurs catégories
    public function getHeros()
    {
        return $this->queryActive()
            ->with('categories') // On ajoute les catégories pour les afficher
            ->latest('updated_at') // Tri en fonction de la date de mise à jour
            ->take(5) // Limite à 5 articles
            ->get();
    }
}
