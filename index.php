<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>🏫 Perpustakaan Ceria</title>
    <style>
        @keyframes rainbow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        body {
            margin: 0;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            background: linear-gradient(270deg, #ff6ec4, #7873f5, #66ffff, #f9f871);
            background-size: 800% 800%;
            animation: rainbow 10s ease infinite;
            text-align: center;
            color: #333;
        }

        h1 {
            margin-top: 40px;
            font-size: 40px;
        }

        .menu-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 60px;
            gap: 30px;
        }

        .menu-card {
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            padding: 30px 20px;
            width: 230px;
            text-decoration: none;
            color: #444;
            transition: transform 0.3s ease;
        }

        .menu-card:hover {
            transform: scale(1.05);
            background-color: #fff2cc;
        }

        .menu-card span {
            font-size: 48px;
            display: block;
            margin-bottom: 15px;
        }

        footer {
            margin-top: 60px;
            padding: 20px;
            color: #555;
        }

        @media (max-width: 600px) {
            .menu-card {
                width: 80%;
            }
        }
    </style>
</head>
<body>

    <h1>📚 Sistem Perpustakaan Ceria</h1>
    <p style="font-size: 18px; margin-top: -10px;">Selamat datang! Pilih menu di bawah ini ⬇️</p>

    <div class="menu-container">
        <a href="anggota.php" class="menu-card">
            <span>👩‍🎓</span>
            <strong>Manajemen Anggota</strong>
        </a>

        <a href="buku.php" class="menu-card">
            <span>📖</span>
            <strong>Manajemen Buku</strong>
        </a>

        <a href="peminjaman.php" class="menu-card">
            <span>📦</span>
            <strong>Transaksi Peminjaman</strong>
        </a>
    </div>

    <footer>
        💡 Dibuat dengan semangat dan penuh senyuman 😄<br>
        &copy; <?= date('Y') ?> - Sistem Perpustakaan Sederhana
    </footer>

</body>
</html>
