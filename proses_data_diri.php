<?php
// Hanya terima request POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: form_data_diri.html');
    exit;
}

$bulan = [
    1 => 'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
];

// Ambil data nama
$nama = trim($_POST['nama'] ?? '');

$tanggal_input = $_POST['tanggal_lahir'] ?? '';
$tanggal_lahir = '-';
$d = DateTime::createFromFormat('Y-m-d', $tanggal_input);
if ($d && $d->format('Y-m-d') === $tanggal_input) {
    $tanggal_lahir = (int) $d->format('j') . ' ' . $bulan[(int) $d->format('n')] . ' ' . $d->format('Y');
}

// Gabungkan hobi dengan koma dan spasi
$hobi_dipilih = $_POST['hobi'] ?? [];
if (!is_array($hobi_dipilih)) {
    $hobi_dipilih = [];
}
$hobi_valid = ['Membaca', 'Olahraga', 'Musik', 'Lainnya'];
$hobi_dipilih = array_values(array_intersect($hobi_valid, $hobi_dipilih));
$hobi = count($hobi_dipilih) > 0 ? implode(', ', $hobi_dipilih) : 'Tidak ada hobi yang dipilih';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampilan Data Anda</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 40px 16px;
        }

        .card {
            max-width: 500px;
            margin: 0 auto;
            background: #fff;
            padding: 24px 28px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 26px;
            margin: 0 0 16px;
            padding-bottom: 14px;
            border-bottom: 1px solid #eee;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            vertical-align: top;
            padding: 12px 0;
            font-size: 16px;
        }

        th {
            width: 140px;
            padding-right: 8px;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Tampilan Data Anda</h1>
        <table>
            <tr>
                <th>Nama Lengkap:</th>
                <td><?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
            <tr>
                <th>Tanggal Lahir:</th>
                <td><?= htmlspecialchars($tanggal_lahir, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
            <tr>
                <th>Hobi:</th>
                <td><?= htmlspecialchars($hobi, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
        </table>
        <a href="form_data_diri.html">&laquo; Kembali ke Form</a>
    </div>
</body>

</html>