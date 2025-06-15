<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Buku</title>
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
        input, textarea, button {
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
    <h2>Data Buku</h2>
    <table>
        <tr>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php
        $data = $koneksi->query("SELECT * FROM buku");
        while ($row = $data->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['judul']}</td>
                    <td>{$row['penulis']}</td>
                    <td>{$row['stok']}</td>
                    <td class='aksi'><a href='buku.php?hapus={$row['id_buku']}' onclick=\"return confirm('Yakin ingin menghapus buku ini?');\">Hapus</a></td>
                  </tr>";
        }
        ?>
    </table>

    <h2>Tambah Buku</h2>
    <form method="post" action="">
        <label>Judul</label>
        <input type="text" name="judul" required>

        <label>Penulis</label>
        <input type="text" name="penulis" required>

        <label>Stok</label>
        <input type="number" name="stok" required>

        <button type="submit" name="tambah">Simpan</button>
    </form>

    <div class="kembali">
        <a href="index.php">⬅ Kembali ke Menu Utama</a>
    </div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $stok = $_POST['stok'];
    $koneksi->query("INSERT INTO buku (judul, penulis, stok) VALUES ('$judul', '$penulis', '$stok')");
    header("Location: buku.php");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $koneksi->query("DELETE FROM buku WHERE id_buku = $id");
    header("Location: buku.php");
}
?>
