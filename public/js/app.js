function loadNavbarLogic() {
    const navbar = document.getElementById('navbar');
    const overlay = document.getElementById('overlay');

    navbar.addEventListener('mouseenter', function() {
        navbar.classList.add('active');
        overlay.classList.add('active');
    });

    overlay.addEventListener('mouseenter', function() {
        setTimeout(() => {
            if(overlay.matches(":hover")) {
                navbar.classList.remove('active');
                overlay.classList.remove('active');
            }
        }, 150);
    });
}
