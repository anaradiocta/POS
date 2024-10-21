<?php


use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use PharIo\Manifest\Author;

Route::pattern('id', '[0-9]+'); //artinya ketika ada parameter (id), maka harus berupa angka

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('register',[AuthController::class,'register']);
Route::post('register',[AuthController::class,'store']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function () {

    Route::get('/', [WelcomeController::class, 'index']);

    Route::middleware(['auth'])->group(function(){

        Route::get('/', [WelcomeController::class, 'index']);

        Route::middleware(['authorize:ADM'])->group(function(){
            Route::get('/user', [UserController::class, 'index']);  // menampilkan halaman user
            Route::post('/user/list', [UserController::class, 'list'] );    //menampilkan data user dalam bentuk json datatables
            Route::get('/user/create', [UserController::class, 'create']);  //menampilkan halaman tambah user
            Route::get('/user/create_ajax', [UserController::class, 'create_ajax']); //Menampilkan halaman form tambah user Ajax
            Route::post('/user/ajax', [UserController::class, 'store_ajax']); // Menyimpan data user baru Ajax
            Route::post('/user', [UserController::class,'store']);      //menyimpan data user baru
            Route::get('/user/{id}', [UserController::class, 'show']);       //menampilkan detai user
            Route::get('/user/{id}/show_ajax', [UserController::class, 'show_ajax']);
            Route::get('/user/{id}/edit', [UserController::class, 'edit']);        //menampilkan halaman form user edit
            Route::put('/user/{id}', [UserController::class, 'update']);         //menyimpan perubahan data user
            Route::get('/user/{id}/edit_ajax', [UserController::class,'edit_ajax']); //menampilkan halaman form edit user ajax
            Route::put('/user/{id}/update_ajax', [UserController::class,'update_ajax']);   //menyimpan halaman form edit user ajax
            Route::get('/user/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); //tampil form confirm delete user ajax
            Route::delete('/user/{id}/delete_ajax', [UserController::class, 'delete_ajax']);  //hapus data user
            Route::get('/user/import', [UserController::class, 'import']); //ajax form upload excel
            Route::post('/user/import_ajax', [UserController::class, 'import_ajax']); //ajax form upload excel
            Route::delete('/user/{id}', [UserController::class, 'destroy']);     //mengahpus data user

        });

//untuk M_LEVEL
Route::middleware(['authorize:ADM'])->group(function(){ //semua route harus punya role adm baru bisa akses
    Route::get('/level', [LevelController::class, 'index']); //menampilkan halaman awal leevel
    Route::post('/level/list',[LevelController::class,'list']);   //menampilkan data level dalam bentuk json
    Route::get('/level/create', [LevelController::class, 'create']);   // menampilkan halaman form tambah level
    Route::get('/level/create_ajax', [LevelController::class, 'create_ajax']); //Menampilkan halaman form tambah user Ajax
    Route::post('/level/ajax', [LevelController::class, 'store_ajax']); // Menyimpan data user baru Ajax
    Route::post('/level', [LevelController::class, 'store']);         // menyimpan data level baru
    Route::get('/level/{id}/edit', [LevelController::class, 'edit']); // menampilkan halaman form edit level
    Route::put('/level/{id}', [LevelController::class, 'update']);     // menyimpan perubahan data level
    Route::get('/level/{id}/edit_ajax', [LevelController::class,'edit_ajax']); //menampilkan halaman form edit user ajax
    Route::put('/level/{id}/update_ajax', [LevelController::class,'update_ajax']);   //menyimpan halaman form edit user ajax
    Route::get('/level/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); //tampil form confirm delete user ajax
    Route::delete('/level/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);  //hapus data user
    Route::get('/level/{id}/show_ajax', [LevelController::class, 'show_ajax']); // menampilkan detail level
    Route::get('/barang/{id}/show',[LevelController::class,'show']);
    Route::get('/level/import', [LevelController::class, 'import']); //ajax form upload excel
    Route::post('/level/import_ajax', [LevelController::class, 'import_ajax']); //ajax form upload excel
    Route::delete('/level/{id}', [LevelController::class, 'destroy']); // menghapus data level
});

// TABEL KATEGORI
Route::middleware(['authorize:ADM,MNG,STF,CUS'])->group(function(){
    Route::get('/kategori', [KategoriController::class, 'index']); //menampilkan halaman awal leevel
    Route::post('/kategori/list',[KategoriController::class,'list']);   //menampilkan data Kategori dalam bentuk json
    Route::get('/kategori/create', [KategoriController::class, 'create']);   // menampilkan halaman form tambah Kategori
    Route::get('/kategori/create_ajax', [KategoriController::class, 'create_ajax']); //Menampilkan halaman form tambah user Ajax
    Route::post('/kategori/ajax', [KategoriController::class, 'store_ajax']); // Menyimpan data user baru Ajax
    Route::post('/kategori', [KategoriController::class, 'store']);         // menyimpan data Kategori baru
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit']); // menampilkan halaman form edit Kategori
    Route::put('/kategori/{id}', [KategoriController::class, 'update']);     // menyimpan perubahan data Kategori
    Route::get('/kategori/{id}/edit_ajax', [KategoriController::class,'edit_ajax']); //menampilkan halaman form edit user ajax
    Route::put('/kategori/{id}/update_ajax', [KategoriController::class,'update_ajax']);   //menyimpan halaman form edit user ajax
    Route::get('/kategori/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); //tampil form confirm delete user ajax
    Route::delete('/kategori/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);  //hapus data user
    Route::get('/kategori/{id}', [KategoriController::class, 'show']);       // menampilkan detail level
    Route::get('/kategori/{id}/show_ajax', [KategoriController::class, 'show_ajax']);
    Route::get('/kategori/import', [KategoriController::class, 'import']); //ajax form upload excel
    Route::post('/kategori/import_ajax', [KategoriController::class, 'import_ajax']); //ajax form upload excel
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']); // menghapus data Kategori
});

// TABEL SUPPLIER
Route::middleware(['authorize:ADM,MNG'])->group(function(){
    Route::get('/supplier', [SupplierController::class, 'index']); //menampilkan halaman awal leevel
    Route::post('/supplier/list',[SupplierController::class,'list']);   //menampilkan data Supplier dalam bentuk json
    Route::get('/supplier/create', [SupplierController::class, 'create']);   // menampilkan halaman form tambah Supplier
    Route::get('/supplier/create_ajax', [SupplierController::class, 'create_ajax']); // menampilkan halaman form tambah supplier Ajax
    Route::post('/supplier/ajax', [SupplierController::class, 'store_ajax']); // menyimpan data supplier baru Ajax
    Route::post('/supplier', [SupplierController::class, 'store']);         // menyimpan data Supplier baru
    Route::get('/supplier/{id}/edit', [SupplierController::class, 'edit']); // menampilkan halaman form edit Supplier
    Route::put('/supplier/{id}', [SupplierController::class, 'update']);     // menyimpan perubahan data Supplier
    Route::get('/supplier/{id}/edit_ajax', [SupplierController::class,'edit_ajax']); //menampilkan halaman form edit user ajax
    Route::put('/supplier/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // menyimpan perubahan data supplier Ajax
    Route::get('/supplier/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); // untuk tampilkan form confirm delete supplier Ajax
    Route::delete('/supplier/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // untuk hapus data supplier Ajax
    Route::get('/supplier/{id}', [SupplierController::class, 'show']);       // menampilkan detail level
    Route::get('/supplier/{id}/show_ajax', [SupplierController::class, 'show_ajax']);
    Route::delete('/supplier/{id}', [SupplierController::class, 'destroy']); // menghapus data Supplier
});

// TABEL BARANG
Route::middleware(['authorize:ADM,MNG,STF,CUS'])->group(function(){
    Route::get('/barang', [BarangController::class, 'index']); //menampilkan halaman awal leevel
    Route::post('/barang/list',[BarangController::class,'list']);   //menampilkan data Barang dalam bentuk json
    Route::get('/barang/create', [BarangController::class, 'create']);   // menampilkan halaman form tambah Barang
    Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']); // menampilkan halaman form tambah barang Ajax
    Route::post('/barang/ajax', [BarangController::class, 'store_ajax']); // menyimpan data barang baru Ajax
    Route::get('/barang/{id}', [BarangController::class, 'show']);       // menampilkan detail barang
    Route::get('/barang/{id}/show_ajax', [BarangController::class, 'show_ajax']);
    Route::post('/barang', [BarangController::class, 'store']);         // menyimpan data Barang baru
    Route::get('/barang/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // menampilkan halaman form edit barang Ajax
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit']); // menampilkan halaman form edit Barang
    Route::put('/barang/{id}', [BarangController::class, 'update']);     // menyimpan perubahan data Barang
    Route::put('/barang/{id}/update_ajax', [BarangController::class, 'update_ajax']); // menyimpan perubahan data barang Ajax
    Route::get('/barang/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // untuk tampilkan form confirm delete barang Ajax
    Route::delete('/barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // untuk hapus data barang Ajax
    Route::get('/barang/import', [BarangController::class, 'import']); //ajax form upload excel
    Route::post('/barang/import_ajax', [BarangController::class, 'import_ajax']); //ajax form upload excel
    Route::get('/barang/export_excel', [BarangController::class, 'export_excel']); //export_excel
    Route::get('/barang/export_pdf', [BarangController::class, 'export_pdf']); //export_pdf
    Route::delete('/barang/{id}', [BarangController::class, 'destroy']); // menghapus data Supplier
});
});
});

?>
