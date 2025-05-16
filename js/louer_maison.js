document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("addModal");
    const openBtn = document.getElementById("openModal");
    const closeBtn = document.querySelector(".close");

    openBtn.addEventListener("click", () => {
        modal.classList.add("show");
    });

    closeBtn.addEventListener("click", () => {
        modal.classList.remove("show");
    });

    window.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.classList.remove("show");
        }
    });
});
