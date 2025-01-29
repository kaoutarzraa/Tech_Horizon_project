document.addEventListener("DOMContentLoaded", function () {
    // Gérer le menu de navigation actif
    let links = document.querySelectorAll("nav ul li a");
    links.forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add("active");
        }
    });

    // Effet de survol sur les thèmes
    let themeButtons = document.querySelectorAll(".theme button");
    themeButtons.forEach(button => {
        button.addEventListener("mouseover", function () {
            this.style.transform = "scale(1.05)";
            this.style.transition = "transform 0.3s ease";
        });
        button.addEventListener("mouseout", function () {
            this.style.transform = "scale(1)";
        });
    });
});
