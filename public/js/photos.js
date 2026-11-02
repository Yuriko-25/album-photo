// Affiche une photo en grand quand on clique dessus
const grandePhoto = document.getElementById('grande-photo');
const grandeImage = document.getElementById('grande-image');

document.querySelectorAll('.photo img').forEach(function (image) {
    image.addEventListener('click', function () {
        grandeImage.src = image.src;
        grandeImage.alt = image.alt;
        grandePhoto.hidden = false;
    });
});

// On ferme avec la croix ou en cliquant à côté de la photo
grandePhoto.addEventListener('click', function (event) {
    if (event.target !== grandeImage) {
        grandePhoto.hidden = true;
    }
});
