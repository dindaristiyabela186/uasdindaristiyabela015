// Menu untuk tampilan HP
const menuToggle = document.getElementById("menuToggle");
const navMenu = document.getElementById("navMenu");

if (menuToggle && navMenu) {
    menuToggle.addEventListener("click", function () {
        navMenu.classList.toggle("show");
    });
}

// Validasi sederhana formulir konsultasi
const consultForm = document.getElementById("consultForm");

if (consultForm) {
    consultForm.addEventListener("submit", function (event) {
        const nama = document.getElementById("nama").value.trim();
        const email = document.getElementById("email").value.trim();
        const telepon = document.getElementById("telepon").value.trim();
        const pesan = document.getElementById("pesan").value.trim();
        const formError = document.getElementById("formError");

        formError.textContent = "";

        if (nama === "" || email === "" || telepon === "" || pesan === "") {
            event.preventDefault();
            formError.textContent = "Semua kolom wajib diisi.";
            return;
        }

        const polaEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!polaEmail.test(email)) {
            event.preventDefault();
            formError.textContent = "Masukkan alamat email yang benar.";
            return;
        }

        if (!/^[0-9+\-\s]{8,15}$/.test(telepon)) {
            event.preventDefault();
            formError.textContent = "Nomor telepon harus 8 sampai 15 angka.";
            return;
        }
    });
}
