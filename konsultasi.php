<?php
$judulHalaman = "Konsultasi";
$pesanSukses = false;
$error = "";
$nama = $email = $telepon = $pesan = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $telepon = trim($_POST["telepon"] ?? "");
    $pesan = trim($_POST["pesan"] ?? "");
    if ($nama && filter_var($email, FILTER_VALIDATE_EMAIL) && $telepon && $pesan) {
        $pesanSukses = true;
    } else {
        $error = "Mohon periksa kembali data Anda. Pastikan semua kolom telah diisi dengan benar.";
    }
}
include "header.php";
?>
<section class="page-banner"><div class="container"><span class="eyebrow">KONSULTASI</span><h1>Sampaikan Pertanyaan Anda</h1><p align="justify">Punya pertanyaan seputar Hepatitis B? Kami menyediakan formulir konsultasi sebagai sarana untuk menyampaikan pertanyaan dan meminta informasi. Silakan lengkapi formulir berikut agar Anda dapat memperoleh informasi edukatif yang bermanfaat untuk meningkatkan pemahaman mengenai Hepatitis B.</p>
</div></section>
<section class="container form-section">
<div class="form-intro"><h2>Kami Siap Membantu Anda</h2>
<p align="justify">Jangan ragu untuk mencari tahu lebih banyak tentang Hepatitis B. Tuliskan pertanyaan atau informasi yang ingin Anda ketahui melalui formulir berikut. Setiap pertanyaan merupakan langkah awal untuk meningkatkan kepedulian dan pemahaman terhadap kesehatan hati.</p>
<div class="form-tip">Informasi dalam website ini bersifat edukatif dan bukan pengganti konsultasi medis. Untuk mendapatkan diagnosis, pemeriksaan, maupun pengobatan yang tepat, silakan kunjungi puskesmas, klinik, atau rumah sakit terdekat dan konsultasikan langsung dengan tenaga kesehatan.</div>
</div>
<div class="form-card">
<?php if ($pesanSukses): ?>
    <div class="success-message">
        <div class="email-notice"><strong>Formulir berhasil dikirim!</strong><br>Data dan pertanyaan Anda berhasil diproses oleh halaman website ini.</div>
        <h2>Terima kasih, <?php echo htmlspecialchars($nama); ?>!</h2>
        <p>Terima kasih telah menggunakan layanan konsultasi ini.</p>
        <a class="btn" href="konsultasi.php">Isi formulir kembali</a>
    </div>
<?php else: ?>
    <?php if ($error): ?><div class="alert"><?php echo $error; ?></div><?php endif; ?>
    <form id="consultForm" method="POST" action="konsultasi.php" novalidate>
        <label for="nama">Nama lengkap</label>
        <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap Anda" value="<?php echo htmlspecialchars($nama); ?>" required />
        <label for="email">Alamat email</label><input type="email" id="email" name="email" placeholder="Contoh: nama@email.com" value="<?php echo htmlspecialchars($email); ?>" required>
        <label for="telepon">Nomor telepon</label><input type="tel" id="telepon" name="telepon" placeholder="Masukkan nomor telepon Anda" value="<?php echo htmlspecialchars($telepon); ?>" required>
        <label for="pesan">Pesan atau pertanyaan</label><textarea id="pesan" name="pesan" rows="5" placeholder="Tuliskan pertanyaan atau informasi yang ingin Anda ketahui..." required><?php echo htmlspecialchars($pesan); ?></textarea>
        <p class="form-error" id="formError"></p>
        <button class="btn submit-btn" type="submit">Kirim Pertanyaan</button>
    </form>
<?php endif; ?>
</div>
</section>
<?php include "footer.php"; ?>
