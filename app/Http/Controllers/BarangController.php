<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index(){
        $activeMenu = 'barang';
        $breadcrumb = (object)[
            'title' => 'Data Barang',
            'list'  => ['Home', 'Barang']
        ];

        $kategori = KategoriModel::select('kategori_id', 'kategori_nama')->get();
        return view('barang.index', [
            'activeMenu'  => $activeMenu,
            'breadcrumb'  => $breadcrumb,
            'kategori'    => $kategori
        ]);    }
    public function list(Request $request){
        $barang = barangmodel::select('barang_id','kategori_id','barang_kode','barang_nama','harga_beli','harga_jual')
        ->with('kategori');

        // if($request->kategori_id){
        //     $barang->where('kategori_id',$request->kategori_id);
        // }
        // return DataTables::of($barang)
        //     // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        //     ->addIndexColumn()
        //     ->addColumn('aksi', function ($barang) { // menambahkan kolom aksi
        //         $btn = '<a href="' . url('/barang/' . $barang->barang_id) . '" class="btn btn-info btnsm">Detail</a> ';
        //         $btn .= '<a href="' . url('/barang/' . $barang->barang_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
        //         $btn .= '<form class="d-inline-block" method="POST" action="' . url('/barang/' . $barang->barang_id) . '">'
        //             . csrf_field() . method_field('DELETE') .
        //             '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
        //         return $btn;
        //     })
        //     ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        //     ->make(true);

        return DataTables::of($barang)
            ->addIndexColumn() // Menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($barang) { // Menambahkan kolom aksi
                $btn = '<a href="' . url('/barang/' . $barang->barang_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // Memberitahu bahwa kolom aksi adalah HTML
            ->make(true);
    }

    public function create(){
        $breadcrumb =(object)[
            'title'=>'Tambah Barang',
            'list'=>['Home','data barang']
        ];
        $page =(object)[
            'title'=>'Tambah Barang baru'
        ];
        $kategori = kategorimodel::all();
        $activeMenu = 'kategori';
        return view('barang.create',['breadcrumb'=>$breadcrumb,'page'=>$page,'activeMenu'=>$activeMenu,'kategori'=>$kategori]);
    }

    public function store(Request $request){
        $request->validate([
            'kategori_id'=>'required|integer',
            'barang_kode'=>'required|string|min:3|unique:m_barang,barang_kode',
            'barang_nama'=>'required|string|max:100',
            'harga_jual'=>'required|integer',
            'harga_beli'=>'required|integer',
        ]);
        barangmodel::create([
            'kategori_id'=>$request->kategori_id,
            'barang_kode'=>$request->barang_kode,
            'barang_nama'=>$request->barang_nama,
            'harga_jual'=>$request->harga_jual,
            'harga_beli'=>$request->harga_beli,
        ]);

        return redirect('/barang',)->with('success','Data barang berhasil disimpan');
    }

    public function show(string $barang_id){
        $barang = barangmodel::with('kategori')->find($barang_id);
        $breadcrumb = (object)[
            'title'=>'Detail barang',
            'list'=>['Home','Data barang','Detail'],
        ];
        $page = (object)[
            'title'=>'Detail data barang'
        ];
        $activeMenu='barang';
        return view('barang.show',['breadcrumb'=>$breadcrumb,'page'=>$page,'activeMenu'=>$activeMenu, 'barang'=>$barang]);
    }

    public function edit(string $barang_id){
        $barang = barangmodel::find($barang_id);
        $kategori = kategorimodel::all();

        $breadcrumb = (object)[
            'title' =>'Edit data barang',
            'list' =>['Home','data barang','edit']
        ];
        $page = (object)[
            'title'=>'Edit data barang'
        ];
        $activeMenu = 'barang';
        return view('barang.edit',['breadcrumb'=>$breadcrumb,'page'=>$page,'barang'=>$barang,'kategori'=>$kategori, 'activeMenu'=>$activeMenu]);
    }

    public function update(Request $request, string $barang_id){
        $request->validate([
            'kategori_id'=>'required|integer',
            'barang_kode'=>'required|string|min:3|unique:m_barang,barang_kode',
            'barang_nama'=>'required|string|max:100',
            'harga_jual'=>'required|integer',
            'harga_beli'=>'required|integer',
        ]);

        $barang = barangmodel::find($barang_id);
        $barang->update([
            'kategori_id'=>$request->kategori_id,
            'barang_kode'=>$request->barang_kode,
            'barang_nama'=>$request->barang_nama,
            'harga_jual'=>$request->harga_jual,
            'harga_beli'=>$request->harga_beli,
        ]);
        return redirect('/barang')->with('success','Data barang berhasil diubah');
    }

    public function destroy(string $barang_id){
        $check = barangmodel::find($barang_id);
        if(!$check){
            return redirect('/barang')->with('error','Data user tidak ditemukan');
        }

        try{
            barangmodel::destroy($barang_id);
            return redirect('/barang')->with('success', 'Data user berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e){
            return redirect('/barang')->with('error','Data user gagal dhapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function create_ajax()
    {
        $kategori = KategoriModel::select('kategori_id', 'kategori_nama')->get();
        return view('barang.create_ajax')
        ->with('kategori', $kategori);
    }

    public function store_ajax(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
            'barang_kode' => 'required|numeric|unique:m_barang,barang_kode', // barang_kode harus unik dan numeric
            'kategori_id' => 'required|numeric|max:20', // kategori_id harus diisi, numeric, dan maksimal 20 karakter
            'barang_nama' => 'required|string|max:100', // barang_nama harus diisi dan maksimal 100 karakter
            'harga_beli' => 'required|numeric', // harga_beli harus diisi dan berupa angka
            'harga_jual' => 'required|numeric', // harga_jual harus diisi dan berupa angka
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'    => false, // response status, false: error/gagal, true: berhasil
                    'message'   => 'Validasi Gagal',
                    'msgField'  => $validator->errors(), // pesan error validasi
                ]);
            }
            BarangModel::create($request->all());
            return response()->json([
                'status'    => true,
                'message'   => 'Data Kategori berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $barang = BarangModel::find($id);
        $kategori = KategoriModel::all(); // Untuk dropdown kategori
        return view('barang.edit_ajax', ['barang' => $barang, 'kategori' => $kategori]);
    }

    public function update_ajax(Request $request, string $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_id' => 'required|integer',
                'barang_kode' => 'required|max:20|unique:m_barang,barang_kode,' . $id . ',barang_id',
                'barang_nama' => 'required|max:100',
                'harga_beli' => 'required|integer',
                'harga_jual' => 'required|integer'
            ];

            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }

            $barang = BarangModel::find($id);
            if ($barang) {
                $barang->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data barang berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data barang tidak ditemukan'
                ]);
            }
        }

        return redirect('/'); // Jika bukan Ajax, redirect ke halaman utama
    }

    // Fungsi untuk mengonfirmasi penghapusan barang melalui Ajax
    public function confirm_ajax(string $id)
    {
        $barang = BarangModel::find($id);
        return view('barang.confirm_ajax', ['barang' => $barang]);
    }

    // Fungsi untuk menghapus barang melalui Ajax
    public function delete_ajax(Request $request, $id)
    {
        // Cek apakah request berasal dari Ajax atau request JSON
        if ($request->ajax() || $request->wantsJson()) {
            $barang = BarangModel::find($id);
            if ($barang) {
                $barang->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
}
