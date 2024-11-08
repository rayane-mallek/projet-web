document.addEventListener('DOMContentLoaded', () => {
    document.getElementById("burger").addEventListener("click", function () {
        document.getElementById("navLinks").classList.toggle("show");
    });
});
