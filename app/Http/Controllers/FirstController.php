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

        $photos = DB::select("SELECT * FROM photos WHERE album_id=? ORDER BY $ordre", [$id]);

        return view('album', ['album' => $album, 'photos' => $photos, 'tri' => $tri]);
    }
}
