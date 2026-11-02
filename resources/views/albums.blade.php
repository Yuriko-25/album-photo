@extends("template")

@section("titre", "Mes albums")

@section("content")
    <h1>Mes albums</h1>

    <p class="tri">
        Trier par :
        <a href="/?tri=creation" class="{{ $tri == 'creation' ? 'actif' : '' }}">Date de création</a>
        <a href="/?tri=titre" class="{{ $tri == 'titre' ? 'actif' : '' }}">Titre</a>
    </p>

    <div class="albums">
        @foreach($albums as $album)
            <div class="album">
                <h2>{{ $album->titre }}</h2>
                <p>Créé le {{ \Carbon\Carbon::parse($album->creation)->format('d/m/Y') }}</p>
            </div>
        @endforeach
    </div>
@endsection
