@extends("template")

@section("titre", $album->titre)

@section("content")
    <p><a href="/">&larr; Tous les albums</a></p>

    <h1>{{ $album->titre }}</h1>

    <p class="tri">
        Trier par :
        <a href="/album/{{ $album->id }}?tri=titre" class="{{ $tri == 'titre' ? 'actif' : '' }}">Titre</a>
        <a href="/album/{{ $album->id }}?tri=note" class="{{ $tri == 'note' ? 'actif' : '' }}">Note</a>
    </p>

    <div class="photos">
        @foreach($photos as $photo)
            <div class="photo">
                <img src="{{ $photo->url }}" alt="{{ $photo->titre }}">
                <h2>{{ $photo->titre }}</h2>
                <p>Note : {{ $photo->note }}/5</p>
            </div>
        @endforeach
    </div>
@endsection
