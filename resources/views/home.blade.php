{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>

    <h1>Welcome to Our Homepage</h1>
    <h2>Owner Anaradi Octa Lavechia</h2>
    <p>Please choose a menu below:</p>

    <div class="menu">
        <a href="{{ route('products.categoryList') }}">Products</a><br>
        <a href="{{ route('sales.index') }}">Sales</a><br>
        <a href="{{ route('user.profile', ['id' => 1, 'name' => 'JohnDoe']) }}">User</a>
    </div>

</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Supermarket</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .navbar {
            display: flex;
            padding: 15px;
            background-color: #0554F2;
            justify-content: space-between;
            align-items: center;
            color: white;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
        .welcome {
            text-align: center;
            margin: 20px 0;
        }
        .content {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin: 20px;
        }
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px;
            text-align: center;
            width: 200px;
        }
        .card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        footer {
            background-color: #0554F2;
            color: white;
            text-align: center;
            padding: 20px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="{{ route('home') }}"><img src="logo.png" alt="Logo" width="100"></a>
        <div>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('admin.login') }}">Login Administrator</a>
        </div>
    </div>
    <div class="welcome">
        <h1>Selamat Datang di Supermarket Kami!</h1>
        <p>Temukan produk terbaik hanya untuk Anda.</p>
    </div>
    <div class="content">
        <div class="card">
            <img src="product1.jpg" alt="Product 1">
            <h2>Produk 1</h2>
            <p>Deskripsi produk 1.</p>
        </div>
        <div class="card">
            <img src="product2.jpg" alt="Product 2">
            <h2>Produk 2</h2>
            <p>Deskripsi produk 2.</p>
        </div>
        <!-- Tambahkan lebih banyak produk sesuai kebutuhan -->
    </div>
    <footer>
        <p>&copy; 2024 Supermarket. All rights reserved.</p>
    </footer>
</body>
</html>

