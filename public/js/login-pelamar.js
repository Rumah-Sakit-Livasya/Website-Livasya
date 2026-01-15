function reloadCaptcha() {
    let img = document.querySelector(".captcha-image img");
    if (img) {
        img.src = "/captcha/flat?" + Math.random();
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const termsCheckbox = document.getElementById("agreeTerms");
    const googleLoginBtn = document.getElementById("googleLoginBtn");

    if (termsCheckbox && googleLoginBtn) {
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
});
