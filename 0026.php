<?php
// Inisialisasi variabel
$total_belanja = 0;
$member = false;
$diskon = 0;
$harga_akhir = 0;

// Cek jika form telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $total_belanja = $_POST['total_belanja'];
    $member = $_POST['member']; // Mengambil nilai dari radio button

    // Logika diskon
    $diskon = 0; // Inisialisasi diskon ke 0
    if ($member == "ya") {
        $diskon += 0.10; // Diskon awal 10% untuk member
        if ($total_belanja >= 500000) {
            $diskon += 0.05; // Tambahan diskon 5% jika total belanja ≥ 500.000
        }
        if ($total_belanja >= 300000) {
            $diskon += 0.05; // Tambahan diskon 5% jika total belanja ≥ 300.000
        }
    } else {
        if ($total_belanja >= 500000) {
            $diskon = 0.10; // Diskon 10% untuk non-member jika total belanja ≥ 500.000
        }
    }

    // Hitung harga akhir
    $harga_akhir = $total_belanja - ($total_belanja * $diskon);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jumlah Total Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            background-color: white;
            padding: 20px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="number"], input[type="submit"], input[type="radio"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        input[type="radio"] {
            width: auto;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .result {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Jumlah Total Pembelian</h1>
        <form method="post" action="">
            <label for="total_belanja">Masukkan Total Pembelian</label>
            <input type="number" name="total_belanja" id="total_belanja" required>

            <label>Apakah Anda Member?</label>
            <label>
                <input type="radio" name="member" value="ya" required> Ya
            </label>
            <label>
                <input type="radio" name="member" value="tidak" required> Tidak
            </label>

            <input type="submit" value="Hitung">
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <div class="result">
                <p>Total Belanja: Rp<?= number_format($total_belanja, 0, ',', '.') ?></p>
                <p>Diskon: <?= $diskon * 100 ?>%</p>
                <p>Harga Akhir: Rp<?= number_format($harga_akhir, 0, ',', '.') ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
