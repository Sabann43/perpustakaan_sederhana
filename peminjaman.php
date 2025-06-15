<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi Peminjaman</title>
    <style>
        @keyframes rainbow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(270deg, #ff6ec4, #7873f5, #66ffff, #f9f871);
            background-size: 800% 800%;
            animation: rainbow 10s ease infinite;
            color: #1e293b;
            padding: 40px;
        }
        h2 {
            color: #333;
            border-left: 6px solid #333;
            padding-left: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 18px;
            border-bottom: 1px solid #e5e7eb;
        }
        th {
            background: #4f46e5;
            color: white;
            text-align: left;
        }
        tr:hover { background-color: #fef9c3; }
        form {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            max-width: 600px;
            margin-bottom: 40px;
        }
        label {
            font-weight: bold;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }
        button {
            background: #4f46e5;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #4338ca;
        }
        .aksi a {
            color: #dc2626;
            text-decoration: none;
            font-weight: bold;
        }
        .aksi a:hover {
            text-decoration: underline;
        }
        .kembali {
            text-align: center;
            margin-top: 30px;
        }
        .kembali a {
            background-color: #4f46e5;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        .kembali a:hover {
            background-color: #4338ca;
        }
    </style>
</head>
<body>
    <h2>Form Peminjaman</h2>
    <form method="post">
        <label>Anggota</label>
        <select name="id_anggota">
            <?php
            $a = $koneksi->query("SELECT * FROM anggota");
            while ($row = $a->fetch_assoc()) {
                echo "<option value='{$row['id_anggota']}'>{$row['nama']}</option>";
            }
            ?>
        </select>

        <label>Buku</label>
        <select name="id_buku">
            <?php
            $b = $koneksi->query("SELECT * FROM buku WHERE stok > 0");
            while ($row = $b->fetch_assoc()) {
                echo "<option value='{$row['id_buku']}'>{$row['judul']}</option>";
            }
            ?>
        </select>

        <label>Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" required>

        <label>Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" required>

        <button type="submit" name="pinjam">Pinjam</button>
    </form>

    <h2>Data Peminjaman</h2>
    <table>
        <tr>
            <th>Anggota</th>
            <th>Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Aksi</th>
        </tr>
        <?php
        $data = $koneksi->query("SELECT p.*, a.nama, b.judul FROM peminjaman p JOIN anggota a ON p.id_anggota = a.id_anggota JOIN buku b ON p.id_buku = b.id_buku");
        while ($row = $data->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['nama']}</td>
                    <td>{$row['judul']}</td>
                    <td>{$row['tanggal_pinjam']}</td>
                    <td>{$row['tanggal_kembali']}</td>
                    <td class='aksi'><a href='peminjaman.php?hapus={$row['id_peminjaman']}&buku={$row['id_buku']}' onclick=\"return confirm('Yakin ingin menghapus peminjaman ini?');\">Hapus</a></td>
                  </tr>";
        }
        ?>
    </table>

    <div class="kembali">
        <a href="index.php">⬅ Kembali ke Menu Utama</a>
    </div>
</body>
</html>

<?php
// Proses insert peminjaman
if (isset($_POST['pinjam'])) {
    $id_anggota = $_POST['id_anggota'];
    $id_buku = $_POST['id_buku'];
    $tgl_pinjam = $_POST['tanggal_pinjam'];
    $tgl_kembali = $_POST['tanggal_kembali'];
    $koneksi->query("INSERT INTO peminjaman (id_anggota, id_buku, tanggal_pinjam, tanggal_kembali) VALUES ('$id_anggota', '$id_buku', '$tgl_pinjam', '$tgl_kembali')");
    header("Location: peminjaman.php");
}

// Proses hapus peminjaman
if (isset($_GET['hapus'])) {
    $id_peminjaman = $_GET['hapus'];
    $id_buku = $_GET['buku'];

    $koneksi->query("DELETE FROM peminjaman WHERE id_peminjaman = $id_peminjaman");
    $koneksi->query("UPDATE buku SET stok = stok + 1 WHERE id_buku = $id_buku");

    header("Location: peminjaman.php");
}
?>
