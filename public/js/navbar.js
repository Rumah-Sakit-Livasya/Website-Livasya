document.addEventListener("DOMContentLoaded", function () {
    const topbar = document.querySelector(".topbar");
    const navbar = document.querySelector(".navbar");

    if (topbar && navbar) {
        window.addEventListener("scroll", function () {
            let scrollTop =
                window.pageYOffset || document.documentElement.scrollTop;
            if (scrollTop > 250) {
                topbar.style.top = "-100px"; // Hide the topbar
                navbar.style.marginTop = "0"; // Set margin-top to 0 when topbar is hidden
            } else {
                topbar.style.top = "0"; // Show the topbar
                navbar.style.marginTop = "4.5rem"; // Set margin-top to 3rem when topbar is visible
            }
        });
    }

    // Remove 'me-5' class for mobile devices
    function adjustNavLinks() {
        const navLinks = document.querySelectorAll(
            ".left-group .nav-link, .right-group .nav-link"
        );
        if (window.innerWidth <= 576) {
            navLinks.forEach((link) => {
                link.classList.remove("me-5");
            });
        } else {
            navLinks.forEach((link) => {
                link.classList.add("me-5");
            });
        }
    }

    // Initial adjustment
    adjustNavLinks();

    // Adjust on window resize
    window.addEventListener("resize", adjustNavLinks);
});
