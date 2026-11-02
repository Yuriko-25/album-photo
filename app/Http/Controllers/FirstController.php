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
}
