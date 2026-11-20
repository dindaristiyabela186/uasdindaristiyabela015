<?php
require_once __DIR__ . "/config.php";
$halamanAktif = basename($_SERVER["PHP_SELF"]);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($judulHalaman) ? $judulHalaman : $namaWebsite; ?> | Kenali Hepatitis B</title>
    <link rel="stylesheet" href="css/style.css">
    <style type="text/css">
<!--
.style3 {font-size: xx-large}
.style4 {font-size: large}
-->
    </style>
</head>
<body>
<header class="header">
    <div class="container nav-wrap">
        <a class="brand" href="index.php"><img class="udb-logo" src="images/udb-logo.jpg" alt="Logo Universitas Duta Bangsa"><span><span class="style3">PREVENT</span><span class="brand-green style4">HEPATITIS B!</span></span></a>
        <button class="menu-toggle" id="menuToggle" aria-label="Buka menu">☰</button>
        <nav class="nav" id="navMenu">
            <?php foreach ($menu as $link => $nama): ?>
                <a href="<?php echo $link; ?>" class="<?php echo $halamanAktif == $link ? 'active' : ''; ?>"><?php echo $nama; ?></a>
            <?php endforeach; ?>
        </nav>
  </div>
</header>
<main>