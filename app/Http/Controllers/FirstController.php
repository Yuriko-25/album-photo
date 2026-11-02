<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FirstController extends Controller
{
    // Liste des albums, triés par titre ou par date de création
    function albums(Request $request)
    {
        // Le tri vient de l'URL : on n'accepte que ces deux colonnes
        $tri = $request->query('tri');
        if ($tri != 'titre' && $tri != 'creation') {
            $tri = 'creation';
        }

        $albums = DB::select("SELECT * FROM albums ORDER BY $tri");

        return view('albums', ['albums' => $albums, 'tri' => $tri]);
    }

    // Photos d'un album, triées par titre ou par note
    function album($id, Request $request)
    {
        $album = DB::select("SELECT * FROM albums WHERE id=?", [$id]);
        if (count($album) == 0)
            abort(404); // Il n'y a pas d'album avec cet id

        $album = $album[0];

        // Le tri vient de l'URL : on n'accepte que ces deux choix
        $tri = $request->query('tri');
        if ($tri == 'note') {
            $ordre = 'note DESC'; // les mieux notées d'abord
        } else {
            $tri = 'titre';
            $ordre = 'titre';
        }

        // Filtres choisis dans le formulaire (vides si on n'a rien choisi)
        $tag = $request->query('tag');
        $recherche = $request->query('recherche');

        // On construit la requête petit à petit, selon les filtres utilisés
        $sql = "SELECT DISTINCT p.* FROM photos p";
        $parametres = [];

        if (!empty($tag)) {
            $sql .= " INNER JOIN possede_tag pt ON pt.photo_id = p.id AND pt.tag_id = ?";
            $parametres[] = $tag;
        }

        $sql .= " WHERE p.album_id = ?";
        $parametres[] = $id;

        if (!empty($recherche)) {
            $sql .= " AND p.titre LIKE ?";
            $parametres[] = "%" . $recherche . "%";
        }

        $photos = DB::select("$sql ORDER BY $ordre", $parametres);

        // Les étiquettes de chaque photo, pour les afficher sur sa carte
        foreach ($photos as $photo) {
            $photo->tags = DB::select(
                "SELECT t.* FROM tags t
                 INNER JOIN possede_tag pt ON pt.tag_id = t.id
                 WHERE pt.photo_id = ?",
                [$photo->id]
            );
        }

        // Les étiquettes proposées dans le filtre : celles des photos de l'album
        $tags = DB::select(
            "SELECT DISTINCT t.* FROM tags t
             INNER JOIN possede_tag pt ON pt.tag_id = t.id
             INNER JOIN photos p ON p.id = pt.photo_id
             WHERE p.album_id = ?
             ORDER BY t.nom",
            [$id]
        );

        return view('album', [
            'album' => $album,
            'photos' => $photos,
            'tags' => $tags,
            'tri' => $tri,
            'tag' => $tag,
            'recherche' => $recherche,
        ]);
    }
}
