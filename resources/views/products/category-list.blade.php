<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori Produk</title>
</head>
<body>
    <h1>Product Categories</h1>
    <ul>
        <li><a href="{{ route('products.foodBeverage') }}">Food & Beverage</a></li>
        <li><a href="{{ route('products.beautyHealth') }}">Beauty & Health</a></li>
        <li><a href="{{ route('products.homeCare') }}">Home Care</a></li>
        <li><a href="{{ route('products.babyKid') }}">Baby & Kid</a></li>
    </ul>
</body>
</html>
