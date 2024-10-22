<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];
        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];
        $activeMenu = 'user'; // set menu yang sedang aktif
        $level = LevelModel::all(); // ambil data level untuk filter level


        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

   // Ambil data user dalam bentuk json untuk datatables
   public function list(Request $request)
   {
    $users = UserModel::select('user_id', 'username', 'nama', 'avatar', 'level_id')
                    ->with('level');

        // Filter data user berdasarkan level_id
        if ($request->level_id){
            $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)
        // Menambahkan kolom index / no urut
        ->addIndexColumn()
        // Menampilkan gambar avatar atau logo default
        ->editColumn('avatar', function ($user) {
            $avatarUrl = $user->avatar
                ? asset('gambar/' . $user->avatar)
                : asset('adminlte/dist/img/AdminLTELogo.png'); // Gambar default

                // return '<img src="' . $avatarUrl . '" style="width: 70px; height: 70px; object-fit: cover;" />';

                return '<img src="' . asset('gambar/' . $user->avatar) . '"  style="width: 70px; height: 70px;" />';
        })
        // Menambahkan kolom aksi
        ->addColumn('aksi', function ($user) {
            $btn = '<button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/') . '\')" class="btn btn-info btn-sm">Detail</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
            return $btn;
        })
        ->rawColumns(['avatar', 'aksi']) // Menandakan bahwa kolom 'avatar' dan 'aksi' mengandung HTML
        ->make(true);
    }

    // Menampilkan halaman form tambah user
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah User Baru'
        ];

        $level = LevelModel::all(); // ambil data level untuk ditampilkan di form
        $activeMenu = 'user'; // set menu yang sedang aktif

        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan data user baru
    public function store(Request $request)
    {

        $request->validate(
            [
                // username harus diisi, berupa string, min 3 karakter, dan bernilai unik di tabel m_user kolom username
                'username' => 'required|string|min:3|unique:m_user,username',
                'nama' => 'required|string|max:100',
                'password' => 'required|min:5',
                'level_id' => 'required|integer',
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]
        );

        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password), // Pastikan password di-hash
            'level_id' => $request->level_id
        ]);


        return redirect('/user')->with('success', 'Data user berhasil disimpan');

    }

    // Menampilkan detail user
    public function show(string $id)
    {

        $user = UserModel::with('level')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail'],
        ];

        $page = (object) [
            'title' => 'Detail User',
        ];

        $activeMenu = 'user'; //set menu yang sedang aktif

        return view('user.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'activeMenu' => $activeMenu,
        ]);

    }

    // Menampilkan detail user untuk AJAX
    public function show_ajax(string $id)
    {
        // Fetch the user with level relation
        $user = UserModel::with('level')->find($id);

        // Check if the user exists
        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        // Return the view as a response for the modal
        return view('user.show_ajax', ['user' => $user]);
    }

    // Menampilkan halaman form edit user
    public function edit(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object) [
            "title" => 'Edit user'
        ];

        $activeMenu = 'user'; // set menu yang sedang aktif
        return view('user.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan perubahan data user
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                // username harus diisi, berupa string, min 3 karakter, dan bernilai unik di tabel m_user kolom username
                'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
                'nama' => 'required|string|max:100',
                'password' => 'nullable|min:5',
                'level_id' => 'required|integer',
            ]
        );

        UserModel::find($id)->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $request->filled('password') ? bcrypt($request->password) : UserModel::find($id)->password,
            'level_id' => $request->level_id,
        ]);


        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }

    // Menghapus data user
    public function destroy(string $id)
    {
        $check = UserModel::find($id);
        if (!$check) {      // untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }

        try {
            UserModel::destroy($id); // Hapus data level
            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error

            return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    // Menampilkan halaman form tambah user Ajax
    public function create_ajax(){
        $level = LevelModel::select('level_id','level_nama')->get();
        return view('user.create_ajax')
            ->with('level',$level);
    }

    // Ajax menyimpan data user baru
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|string|min:3|unique:m_user,username',
                'nama' => 'required|string|max:100',
                'password' => 'required|min:5',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ];

            // use iluminate/support/facades/validator
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            $input = $request->all();

            // Jika avatar ada, simpan gambar, jika tidak ada gunakan default
            if ($request->hasFile('avatar')) {
                $fileName = 'profile_' . Auth::user()->user_id . '.' . $request->avatar->getClientOriginalExtension();

                // Check if an existing profile picture exists and delete it
                $oldFile = 'profile_pictures/' . $fileName;
                if (Storage::disk('public')->exists($oldFile)) {
                    Storage::disk('public')->delete($oldFile);
                }

                $request->avatar->move(public_path('gambar'), $fileName);
            } else {
                $fileName = 'profil-pic.png'; // default avatar
            }

            UserModel::create([
                'level_id' => $input['level_id'],
                'username' => $input['username'],
                'nama' => $input['nama'],
                'password' => bcrypt($input['password']),
                'avatar' => $fileName, // Simpan nama file gambar
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data User berhasil disimpan',
            ]);

        }
        redirect('/');
    }

    // Ajax menampilkan halaman form edit user ajax
    public function edit_ajax(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('user.edit_ajax', ['user' => $user, 'level' => $level]);
    }

     //  Ajax menyimpan update
     public function update_ajax(Request $request, $id) {
        // Periksa jika request berasal dari AJAX atau JSON
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|max:20|unique:m_user,username,' . $id . ',user_id',
                'nama' => 'required|max:100',
                'password' => 'nullable|min:5|max:20',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Avatar tidak wajib
            ];

            // Validator untuk validasi data yang dikirim
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // Respon JSON, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors(), // Menunjukkan field mana yang error
                ]);
            }

            // Cari user berdasarkan ID
            $user = UserModel::find($id);
            if ($user) {
                // Jika password tidak diisi, hapus dari request agar tidak di-update
                if (!$request->filled('password')) {
                    $request->request->remove('password');
                }

                if (!$request->filled('avatar')) {
                    $request->request->remove('avatar');
                }

                // Cek jika ada file avatar yang diunggah
                if ($request->hasFile('avatar')) {
                    // Dapatkan file avatar
                    $file = $request->file('avatar');
                    // Buat nama unik untuk file avatar tersebut
                    $filename = 'profile_' . Auth::user()->user_id . '.' . $request->avatar->getClientOriginalExtension();
                    // Tentukan path penyimpanan
                    $path = public_path('gambar');
                    // Simpan file di direktori 'gambar'
                    $file->move($path, $filename);

                    // Simpan nama file avatar baru di database
                    $user->avatar = $filename;
                }

                // Update data user kecuali avatar (avatar sudah di-handle di atas)
                $user->update($request->except('avatar'));

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                ]);
            }
        }

        return redirect('/');
    }

    // Ajax hapus data
    public function confirm_ajax(String $id)
    {
        $user = UserModel::find($id);

        return view('user.confirm_ajax', ['user' => $user]);
    }
    // delete ajax
    public function delete_ajax(Request $request, $id){
    //cek apakah request dari AJAX
    if ($request->ajax() || $request->wantsJson()) {
        $user = UserModel::find($id);

        if ($user) {
            $user->delete();
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil dihapus',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }
    }

    return redirect('/');
    }

    public function import()
    {
        return view('user.import');
    }
    public function import_ajax(Request $request)
    {
        if($request->ajax() || $request->wantsJson()){
            $rules = [
                // validasi file harus xls atau xlsx, max 1MB
                'file_user' => ['required', 'mimes:xlsx', 'max:1024']
            ];

            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $file = $request->file('file_user');  // ambil file dari request

            $reader = IOFactory::createReader('Xlsx');  // load reader file excel
            $reader->setReadDataOnly(true);             // hanya membaca data
            $spreadsheet = $reader->load($file->getRealPath()); // load file excel
            $sheet = $spreadsheet->getActiveSheet();    // ambil sheet yang aktif

            $data = $sheet->toArray(null, false, true, true);   // ambil data excel

            $insert = [];
            if(count($data) > 1){ // jika data lebih dari 1 baris
                foreach ($data as $baris => $value) {
                    if($baris > 1){ // baris ke 1 adalah header, maka lewati
                        $insert[] = [
                            'level_id' => $value['A'],
                            'username' => $value['B'],
                            'nama' => $value['C'],
                            'password' => $value['D'],
                            'created_at' => now(),
                        ];
                    }
                }

                if(count($insert) > 0){
                    // insert data ke database, jika data sudah ada, maka diabaikan
                    UserModel::insertOrIgnore($insert);
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diimport'
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang diimport'
                ]);
            }
        }
        return redirect('/');
    }

    public function export_excel()
    {
        //ambil data user yang akan di export
        $user = UserModel::select('level_id', 'username', 'nama', 'password')
            ->orderBy('level_id')
            ->with('level')
            ->get();
        // load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Username');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Level Pengguna');
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);  //bold header
        $no = 1;    //nomor data dimulai dari 1
        $baris = 2; //baris data dimulai dari baris 2
        foreach ($user as $key => $value){
            $sheet->setCellValue('A'.$baris, $no);
            $sheet->setCellValue('B'.$baris, $value->username);
            $sheet->setCellValue('C'.$baris, $value->nama);
            $sheet->setCellValue('D'.$baris, $value->level->level_nama);
            $baris++;
            $no++;
        }
        foreach(range('A','D') as $columnID){
            $sheet->getColumnDimension($columnID)->setAutoSize(true);   //set auto size untuk kolom
        }

    }

    public function export_pdf()
    {
        $user = UserModel::select('level_id', 'username', 'nama', 'password')
        ->orderBy('level_id')
        ->with('level')
        ->get();
        // use Barryvdh\DomPDF\Facade\Pdf
        $pdf = Pdf::loadView('user.export_pdf', ['user' => $user]);
        $pdf->setPaper('a4', 'portrait'); //set ukuran kertas dan orientasi
        $pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari url
        $pdf->render();
        return $pdf->stream('Data User '.date('Y-m-d H:i:s').'.pdf');
    }
}
?>
