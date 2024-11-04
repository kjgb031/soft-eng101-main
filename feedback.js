document.querySelectorAll('.rating').forEach(ratingSection => {
    const stars = ratingSection.querySelectorAll('.star');
    const ratingInput = ratingSection.querySelector('input');

    stars.forEach((star, idx) => {
        star.addEventListener('click', function () {
            ratingInput.value = idx + 1; // Set the hidden input to the selected rating

            stars.forEach((s, i) => {
                if (i <= idx) {
                    s.classList.replace('bx-star', 'bxs-star');
                } else {
                    s.classList.replace('bxs-star', 'bx-star');
                }
            });
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const cancelButton = document.querySelector(".cancel-btn");

    if (cancelButton) {
        cancelButton.addEventListener("click", function() {
            // Redirect to the homepage without submitting
            window.location.href = "index.html";
        });
    }
});