<!DOCTYPE html>
<html>
<head>
    <title>Data Tambah User</title>
</head>
<body>
    <h1>Form Tambah Data User</h1>
    <form method="post" action="/PWL_2024/jobsheet4/PWL_POS/public/user/tambah_simpan">
        {{ csrf_field() }}
        <label>Username</label>
        <input type="text" id="username" name="username" placeholder="Masukkan Username">
        <br>
        <label>Nama</label>
        <input type="text" name="nama" placeholder="Masukkan Nama">
        <br>
        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan Password">
        <br>
        <label>Level ID</label>
        <input type="number" name="level_id" placeholder="Masukkan ID Level">
        <br>
        <input type="submit" class="btn btn-success" value="Simpan">
    </form>
</body>
</html>
