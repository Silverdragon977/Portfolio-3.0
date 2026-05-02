document.addEventListener("DOMContentLoaded", () => {

    const img = document.getElementById("card-image");
    if (!img) return;

    const card = JSON.parse(img.dataset.card);
    const apiBase = document.querySelector('meta[name="api-base"]').content;

    if (card.full_card_image_url) return;

    loadFullImage(card, img, apiBase);
});

async function loadFullImage(card, imgElement, apiBase) {

    try {
        const res = await fetch(
            `https://api.scryfall.com/cards/named?fuzzy=${encodeURIComponent(card.name)}`
        );

        const data = await res.json();

        let full = null;

        if (data.image_uris) {
            full = data.image_uris.normal;
        } else if (data.card_faces) {
            full = data.card_faces[0].image_uris.normal;
        }

        if (!full) return;

        imgElement.src = full;

        await fetch(`${apiBase}/${card.id}/image`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ full_card_image_url: full })
        });

    } catch (e) {
        console.error("Full image error:", e);
    }
}