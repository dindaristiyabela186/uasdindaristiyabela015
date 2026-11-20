<?php
$judulHalaman = "Konsultasi";
$pesanSukses = false;
$emailKonfirmasiTerkirim = false;
$error = "";
$nama = $email = $telepon = $pesan = "";

$apiKey = getenv("RESEND_API_KEY");
$emailAdmin = getenv("ADMIN_EMAIL");
$emailPengirim = getenv("RESEND_FROM") ?: "Website Hepatitis B <onboarding@resend.dev>";

function kirimEmail($data, $apiKey) {
    if (!$apiKey || !function_exists("curl_init")) {
        return false;
    }

    $ch = curl_init("https://api.resend.com/emails");

    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer " . $apiKey,
            "Content-Type: application/json"
        ],
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_TIMEOUT => 20
    ]);

    $hasil = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return ($hasil !== false && $status >= 200 && $status < 300);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $telepon = trim($_POST["telepon"] ?? "");
    $pesan = trim($_POST["pesan"] ?? "");

    if ($nama && filter_var($email, FILTER_VALIDATE_EMAIL) && $telepon && $pesan) {

        if (!$apiKey || !$emailAdmin) {
            $error = "Email belum dikonfigurasi. Silakan coba kembali nanti.";
        } else {

            $namaAman = htmlspecialchars($nama, ENT_QUOTES, "UTF-8");
            $emailAman = htmlspecialchars($email, ENT_QUOTES, "UTF-8");
            $teleponAman = htmlspecialchars($telepon, ENT_QUOTES, "UTF-8");
            $pesanAman = nl2br(htmlspecialchars($pesan, ENT_QUOTES, "UTF-8"));

            // Email notifikasi kepada admin
            $emailAdminData = [
                "from" => $emailPengirim,
                "to" => [$emailAdmin],
                "reply_to" => $email,
                "subject" => "Pertanyaan Konsultasi Hepatitis B",
                "html" => "
                    <h2>Permintaan Konsultasi Baru</h2>
                    <p><strong>Nama:</strong> $namaAman</p>
                    <p><strong>Email:</strong> $emailAman</p>
                    <p><strong>Nomor telepon:</strong> $teleponAman</p>
                    <p><strong>Pesan:</strong></p>
                    <p>$pesanAman</p>
                "
            ];

            if (kirimEmail($emailAdminData, $apiKey)) {
                $pesanSukses = true;

                // Email konfirmasi kepada pengunjung
                $emailPengunjungData = [
                    "from" => $emailPengirim,
                    "to" => [$email],
                    "subject" => "Konfirmasi Pertanyaan Konsultasi Hepatitis B",
                    "html" => "
                        <h2>Terima kasih telah menghubungi kami!</h2>
                        <p>Halo $namaAman,</p>
                        <p>Permintaan konsultasi Anda telah kami terima.</p>
                        <p>Berikut pesan yang telah Anda kirimkan:</p>
                        <p>$pesanAman</p>
                        <p>Kami mengapresiasi Anda telah mengunjungi website edukasi Hepatitis B.</p>
                        <p>Salam,<br>Tim Prevent Hepatitis B</p>
                    "
                ];

                $emailKonfirmasiTerkirim = kirimEmail($emailPengunjungData, $apiKey);

            } else {
                $error = "Email belum berhasil dikirim. Silakan coba kembali.";
            }
        }

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
          Terima kasih telah menghubungi kami. Pertanyaan Anda telah kami terima.
          <?php if ($emailKonfirmasiTerkirim): ?>
          Email konfirmasi telah dikirim ke alamat email yang Anda cantumkan.
          <?php else: ?>
          Pertanyaan Anda berhasil diterima oleh admin, tetapi email konfirmasi belum berhasil dikirim.
          <?php endif; ?>
        </div>
      </div>
        <h2>Terima kasih, <?php echo htmlspecialchars($nama); ?>!</h2>
        <p>Pesan Anda telah diterima oleh pengelola website dan akan ditindaklanjuti.</p>
        <a class="btn" href="konsultasi.php">Isi formulir lagi</a>
    </div>

<?php else: ?>

    <?php if ($error): ?><div class="alert"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>

    <form id="consultForm" method="POST" action="konsultasi.php" novalidate>
        <label for="nama">Nama lengkap</label>
        <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda" value="<?php echo htmlspecialchars($nama); ?>" required />

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="nama@email.com" value="<?php echo htmlspecialchars($email); ?>" required>

        <label for="telepon">Nomor telepon</label>
        <input type="tel" id="telepon" name="telepon" placeholder="08xxxxxxxxxx" value="<?php echo htmlspecialchars($telepon); ?>" required>

        <label for="pesan">Pesan atau pertanyaan</label>
        <textarea id="pesan" name="pesan" rows="5" placeholder="Tuliskan pertanyaan Anda..." required><?php echo htmlspecialchars($pesan); ?></textarea>

        <p class="form-error" id="formError"></p>
        <button class="btn submit-btn" type="submit">Kirim pertanyaan</button>
    </form>

<?php endif; ?>
</div>
</section>

<?php include "footer.php"; ?>