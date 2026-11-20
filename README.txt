WEBSITE INFORMASI HEPATITIS B
================================

Isi folder:
- index.php          : halaman Home
- profil.php         : profil penyakit
- gejala.php         : gejala penyakit
- penyebab.php       : penyebab dan penularan
- pencegahan.php     : pencegahan
- penanganan.php     : pemeriksaan dan penanganan
- konsultasi.php     : formulir konsultasi (validasi JavaScript dan PHP)
- kontak.php         : kontak dan referensi
- header.php         : bagian kepala dan menu
- footer.php         : bagian bawah website
- config.php         : pengaturan nama website dan menu
- css/style.css      : tampilan website
- js/script.js       : menu HP dan validasi formulir

CARA MENJALANKAN DI KOMPUTER:
1. Install XAMPP.
2. Salin folder website_hepatitis_b ke dalam folder htdocs.
3. Jalankan Apache dari XAMPP.
4. Buka browser dan ketik: http://localhost/website_hepatitis_b/

CARA HOSTING:
1. Siapkan hosting yang mendukung PHP.
2. Upload seluruh isi folder ini ke public_html (atau folder domain).
3. Pastikan file index.php berada di folder utama website.
4. Buka domain untuk mengecek semua menu.
5. Ubah alamat, nomor telepon, dan email di kontak.php sesuai data mahasiswa.

CATATAN:
- Form konsultasi hanya simulasi. Form memvalidasi data dan menampilkan pesan berhasil,
  tetapi belum mengirim email atau menyimpan data ke database.
- Isi website adalah edukasi umum, bukan pengganti pemeriksaan dokter.
- Periksa kembali tautan sumber dan materi sebelum pengumpulan.

PENYESUAIAN LOGO DAN WARNA:
- Logo UDB berada di images/udb-logo.jpg dan tampil melalui header.php pada semua halaman.
- Watermark logo UDB dibuat transparan melalui CSS pada semua halaman.
- Warna tampilan menggunakan gradasi biru-merah.
- Setelah formulir konsultasi valid dikirim, halaman menampilkan notifikasi bahwa jawaban selanjutnya akan disampaikan melalui email.
