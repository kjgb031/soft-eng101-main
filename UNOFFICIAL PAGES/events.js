function openModal() {
    document.getElementById("modalOverlay").style.display = "flex";
}

// JavaScript to close the modal
function closeModal() {
    document.getElementById("modalOverlay").style.display = "none";
}

// Close modal on outside click
window.onclick = function(event) {
    const modalOverlay = document.getElementById("modalOverlay");
    if (event.target === modalOverlay) {
        modalOverlay.style.display = "none";
    }
};