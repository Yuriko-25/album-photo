@extends("template")

@section("titre", $album->titre)

@section("content")
    <p><a href="/">&larr; Tous les albums</a></p>

    <h1>{{ $album->titre }}</h1>

    <p class="tri">
        Trier par :
        <a href="{{ request()->fullUrlWithQuery(['tri' => 'titre']) }}" class="{{ $tri == 'titre' ? 'actif' : '' }}">Titre</a>
        <a href="{{ request()->fullUrlWithQuery(['tri' => 'note']) }}" class="{{ $tri == 'note' ? 'actif' : '' }}">Note</a>
    </p>

    <form method="GET" action="/album/{{ $album->id }}" class="filtres">
        <input type="hidden" name="tri" value="{{ $tri }}">

        <label for="recherche">Titre</label>
        <input type="search" id="recherche" name="recherche" value="{{ $recherche }}">

        <label for="tag">Étiquette</label>
        <select id="tag" name="tag">
            <option value="">Toutes</option>
            @foreach($tags as $t)
                <option value="{{ $t->id }}" @selected($tag == $t->id)>{{ $t->nom }}</option>
            @endforeach
        </select>

        <button type="submit">Filtrer</button>
        <a href="/album/{{ $album->id }}">Tout afficher</a>
    </form>

    @if(count($photos) == 0)
        <p>Aucune photo ne correspond.</p>
    @endif

    <div class="photos">
        @foreach($photos as $photo)
            <div class="photo">
                <img src="{{ $photo->url }}" alt="{{ $photo->titre }}">
                <h2>{{ $photo->titre }}</h2>
                <p>Note : {{ $photo->note }}/5</p>
                <p class="etiquettes">
                    @foreach($photo->tags as $t)
                        <span>{{ $t->nom }}</span>
                    @endforeach
                </p>
            </div>
        @endforeach
    </div>

    <div id="grande-photo" class="grande-photo" hidden>
        <button id="fermer" type="button" aria-label="Fermer">&times;</button>
        <img id="grande-image" src="" alt="">
    </div>

    <script src="/js/photos.js"></script>
@endsection
