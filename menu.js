document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".toggle-submenu").forEach(function (toggle) {
        toggle.addEventListener("click", function () {
            let submenu = this.nextElementSibling;
            let allSubmenus = document.querySelectorAll(".sub-menu");
            let allToggles = document.querySelectorAll(".toggle-submenu");
            let isAlreadyOpen = submenu.classList.contains("open");

            // Close all submenus except the one being toggled
            allSubmenus.forEach(function (menu) {
                if (menu !== submenu) {
                    menu.classList.remove("open");
                    menu.style.maxHeight = null; // Reset max-height
                }
            });

            // Reset all toggle signs except the one being toggled
            allToggles.forEach(function (tog) {
                if (tog !== toggle) {
                    tog.textContent = "+";
                }
            });

            // Toggle the clicked submenu
            if (isAlreadyOpen) {
                submenu.classList.remove("open");
                submenu.style.maxHeight = null; // Reset max-height
                this.textContent = "+";
            } else {
                submenu.classList.add("open");
                submenu.style.maxHeight = submenu.scrollHeight + "px"; // Dynamically set height
                this.textContent = "-";

                // Ensure the newly opened submenu stays in view
                submenu.scrollIntoView({ behavior: "smooth", block: "nearest" });
            }
        });
    });
});