<?php


use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;

Route::pattern('id', '[0-9]+'); //artinya ketika ada parameter (id), maka harus berupa angka

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function () { //artinya semua route di dalam group ini harus login dulu

    Route::get('/', [WelcomeController::class, 'index']);

//TABEL USER
Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);          // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);      // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']);   // menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']);         // menyimpan data user baru
    Route::get('/create_ajax',[UserController::class, 'create_ajax']);   // menampilkan halaman form tambah user Ajax
    Route::post('/ajax',[UserController::class, 'store_ajax']);         // menyimpan data user baru Ajax
    Route::get('/{id}', [UserController::class, 'show']);       // menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']); // menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']);     // menyimpan perubahan data user
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // menampilkan halaman form edit user
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);     // menyimpan perubahan data user
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // untuk tampilkan form confirm delete user ajax
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // untuk hapus data user ajax
    Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
});

//untuk M_LEVEL
Route::middleware(['authorize:ADM'])->group(function () {
    Route::get('/level', [LevelController::class, 'index']);          // menampilkan halaman awal level
    Route::post('/level/list', [LevelController::class, 'list']);      // menampilkan data level dalam bentuk json untuk datatables
    Route::get('/level/create', [LevelController::class, 'create']);   // menampilkan halaman form tambah level
    Route::get('/level/create_ajax', [LevelController::class, 'create_ajax']);
    Route::post('/level', [LevelController::class, 'store']);         // menyimpan data level baru
    Route::post('/level/ajax', [LevelController::class, 'store_ajax']);
    Route::get('/level/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);
    Route::put('/level/{id}/update_ajax', [LevelController::class, 'update_ajax']);
    Route::get('/level/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);
    Route::delete('/level/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);
    Route::get('/level/{id}', [LevelController::class, 'show']);       // menampilkan detail level
    Route::get('/level/{id}/edit', [LevelController::class, 'edit']);  // menampilkan halaman form edit level
    Route::put('/level/{id}', [LevelController::class, 'update']);     // menyimpan perubahan data level
    Route::delete('/level/{id}', [LevelController::class, 'destroy']); // menghapus data level
});

// TABEL LEVEL
// Route::group(['prefix' => 'level'], function () {
//     Route::get('/', [LevelController::class, 'index']);          // menampilkan halaman awal level
//     Route::post('/list', [LevelController::class, 'list']);      // menampilkan data level dalam bentuk json untuk datatables
//     Route::get('/create', [LevelController::class, 'create']);   // menampilkan halaman form tambah level
//     Route::post('/', [LevelController::class, 'store']);         // menyimpan data level baru
//     Route::get('/create_ajax', [LevelController::class, 'create_ajax']);   // menampilkan halaman form tambah user
//     Route::post('/ajax', [LevelController::class, 'store_ajax']);         // menyimpan data user baru
//     Route::get('/{id}', [LevelController::class, 'show']);       // menampilkan detail level
//     Route::get('/{id}/edit', [LevelController::class, 'edit']);  // menampilkan halaman form edit level
//     Route::put('/{id}', [LevelController::class, 'update']);     // menyimpan perubahan data level
//     Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // menampilkan halaman form edit level ajax
//     Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // menyimpan perubahan data level ajax
//     Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // untuk tampilkan form confirm delete level ajax
//     Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // untuk hapus data level ajax
//     Route::delete('/{id}', [LevelController::class, 'destroy']); // menghapus data level
// });

// TABEL KATEGORI
Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [KategoriController::class, 'index']);          // menampilkan halaman awal kategori
    Route::post('/list', [KategoriController::class, 'list']);      // menampilkan data level dalam bentuk json untuk datatables
    Route::get('/create', [KategoriController::class, 'create']);   // menampilkan halaman form tambah kategori
    Route::post('/', [KategoriController::class, 'store']);         // menyimpan data kategori baru
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);   // menampilkan halaman form tambah user
    Route::post('/ajax', [KategoriController::class, 'store_ajax']);         // menyimpan data user baru
    Route::get('/{id}', [KategoriController::class, 'show']);       // menampilkan detail kategori
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);  // menampilkan halaman form edit kategori
    Route::put('/{id}', [KategoriController::class, 'update']);     // menyimpan perubahan data kategori
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); // menampilkan halaman form edit kategori ajax
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // menyimpan perubahan data kategori ajax
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); // untuk tampilkan form confirm delete kategori ajax
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // untuk hapus data kategori ajax
    Route::delete('/{id}', [KategoriController::class, 'destroy']); // menghapus data kategori
});

// TABEL SUPPLIER
Route::group(['prefix' => 'supplier'], function () {
    Route::get('/', [SupplierController::class, 'index']);          // menampilkan halaman awal supplier
    Route::post('/list', [SupplierController::class, 'list']);      // menampilkan data supplier dalam bentuk json untuk datatables
    Route::get('/create', [SupplierController::class, 'create']);   // menampilkan halaman form tambah supplier
    Route::post('/', [SupplierController::class, 'store']);         // menyimpan data supplier baru
    Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);   // menampilkan halaman form tambah supplier
    Route::post('/ajax', [SupplierController::class, 'store_ajax']);         // menyimpan data supplier baru
    Route::get('/{id}', [SupplierController::class, 'show']);       // menampilkan detail supplier
    Route::get('/{id}/edit', [SupplierController::class, 'edit']);  // menampilkan halaman form edit supplier
    Route::put('/{id}', [SupplierController::class, 'update']);     // menyimpan perubahan data supplier
    Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); // menampilkan halaman form edit supplier ajax
    Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // menyimpan perubahan data supplier ajax
    Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); // untuk tampilkan form confirm delete supplier ajax
    Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // untuk hapus data supplier ajax
    Route::delete('/{id}', [SupplierController::class, 'destroy']); // menghapus data supplier
});

// TABEL BARANG
Route::group(['prefix' => 'barang'], function () {
    Route::get('/', [BarangController::class, 'index']);          // menampilkan halaman awal supplier
    Route::post('/list', [BarangController::class, 'list']);      // menampilkan data supplier dalam bentuk json untuk datatables
    Route::get('/create', [BarangController::class, 'create']);   // menampilkan halaman form tambah supplier
    Route::post('/', [BarangController::class, 'store']);         // menyimpan data supplier baru
    Route::get('/create_ajax', [BarangController::class, 'create_ajax']);   // menampilkan halaman form tambah supplier
    Route::post('/ajax', [BarangController::class, 'store_ajax']);         // menyimpan data supplier baru
    Route::get('/{id}', [BarangController::class, 'show']);       // menampilkan detail supplier
    Route::get('/{id}/edit', [BarangController::class, 'edit']);  // menampilkan halaman form edit supplier
    Route::put('/{id}', [BarangController::class, 'update']);     // menyimpan perubahan data supplier
    Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // menampilkan halaman form edit supplier ajax
    Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']); // menyimpan perubahan data supplier ajax
    Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // untuk tampilkan form confirm delete supplier ajax
    Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // untuk hapus data supplier ajax
    Route::delete('/{id}', [BarangController::class, 'destroy']); // menghapus data supplier
});
});
?>
