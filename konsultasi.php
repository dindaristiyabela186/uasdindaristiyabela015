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
        $error = "Mohon periksa kembali data yang diisi.";
    }
}
include "header.php";
?>
<section class="page-banner"><div class="container"><span class="eyebrow">KONSULTASI</span><h1>Ajukan pertanyaan</h1><p align="justify">Silakan isi formulir berikut untuk mengajukan pertanyaan atau mendapatkan informasi seputar Hepatitis B. Kami menyediakan informasi edukatif untuk membantu meningkatkan pemahaman Anda mengenai penyakit Hepatitis B.</p>
</div></section>
<section class="container form-section">
<div class="form-intro"><h2>Kami Siap Membantu Anda</h2>
<p align="justify">Masih ingin mengetahui lebih banyak tentang Hepatitis B? Jangan ragu untuk menyampaikan pertanyaan Anda melalui formulir konsultasi ini. Kami siap membantu memberikan informasi yang bermanfaat agar Anda semakin memahami Hepatitis B.</p>
<div class="form-tip">
  <div align="justify">Jika Anda mengalami keluhan kesehatan atau membutuhkan pemeriksaan maupun pengobatan, silakan kunjungi fasilitas pelayanan kesehatan terdekat atau konsultasikan langsung dengan tenaga kesehatan.</div>
</div>
</div>
<div class="form-card">
<?php if ($pesanSukses): ?>
    <div class="success-message">
      <div class="email-notice">
        <div align="justify"><strong>Permintaan konsultasi berhasil dikirim!</strong><br>
          Terima kasih telah menghubungi kami. Pertanyaan Anda telah kami terima. Informasi atau jawaban selanjutnya dapat disampaikan melalui email yang Anda cantumkan.</div>
      </div>
        <h2>Terima kasih, <?php echo htmlspecialchars($nama); ?>!</h2>
        <p>Data formulir berhasil diterima oleh halaman website ini.</p>
        <a class="btn" href="konsultasi.php">Isi formulir lagi</a>
    </div>
<?php else: ?>
    <?php if ($error): ?><div class="alert"><?php echo $error; ?></div><?php endif; ?>
    <form id="consultForm" method="POST" action="konsultasi.php" novalidate>
        <label for="nama">Nama lengkap</label>
        <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda" value="<?php echo htmlspecialchars($nama); ?>" required />
        <label for="email">Email</label><input type="email" id="email" name="email" placeholder="nama@email.com" value="<?php echo htmlspecialchars($email); ?>" required>
        <label for="telepon">Nomor telepon</label><input type="tel" id="telepon" name="telepon" placeholder="08xxxxxxxxxx" value="<?php echo htmlspecialchars($telepon); ?>" required>
        <label for="pesan">Pesan atau pertanyaan</label><textarea id="pesan" name="pesan" rows="5" placeholder="Tuliskan pertanyaan Anda..." required><?php echo htmlspecialchars($pesan); ?></textarea>
        <p class="form-error" id="formError"></p>
        <button class="btn submit-btn" type="submit">Kirim pertanyaan</button>
    </form>
<?php endif; ?>
</div>
</section>
<?php include "footer.php"; ?>
