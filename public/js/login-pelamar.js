function reloadCaptcha() {
    let img = document.querySelector(".captcha-image img");
    if (img) {
        img.src = "/captcha/flat?" + Math.random();
    }
}

function initTermsCheckbox() {
    const termsCheckbox = document.getElementById("agreeTerms");
    const googleLoginBtn = document.getElementById("googleLoginBtn");

    if (termsCheckbox && googleLoginBtn) {
        // Set initial state on page load (e.g. if browser cached checked state)
        if (termsCheckbox.checked) {
            googleLoginBtn.classList.remove("disabled");
            googleLoginBtn.removeAttribute("aria-disabled");
            googleLoginBtn.removeAttribute("tabindex");
        } else {
            googleLoginBtn.classList.add("disabled");
            googleLoginBtn.setAttribute("aria-disabled", "true");
            googleLoginBtn.setAttribute("tabindex", "-1");
        }

        termsCheckbox.addEventListener("change", function () {
            if (this.checked) {
                googleLoginBtn.classList.remove("disabled");
                googleLoginBtn.removeAttribute("aria-disabled");
                googleLoginBtn.removeAttribute("tabindex");
            } else {
                googleLoginBtn.classList.add("disabled");
                googleLoginBtn.setAttribute("aria-disabled", "true");
                googleLoginBtn.setAttribute("tabindex", "-1");
            }
        });
    }
}

if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initTermsCheckbox);
} else {
    initTermsCheckbox();
}
