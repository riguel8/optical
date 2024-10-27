
const togglePasswordIcons = document.querySelectorAll(".input-icon i");

togglePasswordIcons.forEach(icon => {
    icon.addEventListener("click", function () {
        const passwordField = this.previousElementSibling;
        
        const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);

        this.classList.toggle("fa-eye");
        this.classList.toggle("fa-eye-slash");
    });
});
