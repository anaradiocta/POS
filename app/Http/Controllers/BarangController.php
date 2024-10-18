<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Barryvdh\DomPDF\Facade\Pdf;

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


        $barang = BarangModel::select('barang_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual', 'kategori_id') ->with('kategori');

        $kategori_id = $request->input('filter_kategori');
        if (!empty($kategori_id)) {
            $barang->where('kategori_id', $kategori_id);
        }

        return DataTables::of($barang)
            ->addIndexColumn()
            ->addColumn('aksi', function ($barang) {
                $btn  = '<button onclick="modalAction(\''.url('/barang/' . $barang->barang_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/barang/' . $barang->barang_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/barang/' . $barang->barang_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
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
        return view('barang.create_ajax')->with('kategori', $kategori);
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
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('barang.edit_ajax', ['barang' => $barang, 'level' => $level]);
    }

    public function update_ajax(Request $request, string $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_id'  => ['required', 'integer', 'exists:m_kategori,kategori_id'],
                'barang_kode'  => ['required', 'min:1', 'max:20', 'unique:m_barang,barang_kode,' . $id . ',barang_id'],
                'barang_nama'  => ['required', 'string', 'max:100'],
                'harga_beli'   => ['required', 'numeric'],
                'harga_jual'   => ['required', 'numeric'],
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $check = BarangModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
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

    public function import()
    {
            return view('barang.import');
        }

        public function import_ajax(Request $request)
        {
            if ($request->ajax() || $request->wantsJson()) {
                $rules = [
                    'file_barang' => ['required', 'mimes:xlsx', 'max:1024'],
                ];

                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return response()->json([
                        'status'   => false,
                        'message'  => 'Validasi Gagal',
                        'msgField' => $validator->errors()
                    ]);
                }

                $file = $request->file('file_barang'); // ambil file dari request
                $reader = IOFactory::createReader('Xlsx'); //load reader file excel
                $reader->setReadDataOnly(true); // membaca data
                $spreadsheet = $reader->load($file->getRealPath()); // load file excel
                $sheet = $spreadsheet->getActiveSheet(); // amengambil sheet aktif
                $data = $sheet->toArray(null, false, true, true); //ambil data excel

                $insert = [];
                if (count($data) > 1) {
                    foreach ($data as $baris => $value) {
                        if ($baris > 1) {
                            $insert[] = [
                                'kategori_id'  => $value['A'],
                                'barang_kode'  => $value['B'],
                                'barang_nama'  => $value['C'],
                                'harga_beli'   => $value['D'],
                                'harga_jual'   => $value['E'],
                                'created_at'   => now(),
                            ];
                        }
                    }
                }

                if (count($insert) > 0) {
                    BarangModel::insertOrIgnore($insert);
                }

                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil diimport'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Tidak ada data yang diimport'
                ]);
            }
            return redirect('/');
        }

        public function export_excel()
        {
            $barang = BarangModel::select('kategori_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual')
                ->orderBy('kategori_id')
                ->with('kategori')
                ->get();

            // load library excel
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet(); //ambil sheet yang aktif

            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'Kode Barang');
            $sheet->setCellValue('C1', 'Nama Barang');
            $sheet->setCellValue('D1', 'Harga Beli');
            $sheet->setCellValue('E1', 'Harga Jual');
            $sheet->setCellValue('F1', 'Kategori');
            $sheet->getStyle('A1:F1')->getFont()->setBold(true); // Buat header menjadi bold

            $no = 1; // Nomor data dimulai dari 1
            $baris = 2; // Baris data dimulai dari baris ke-2
            foreach ($barang as $key => $value) {
                $sheet->setCellValue('A' . $baris, $no);
                $sheet->setCellValue('B' . $baris, $value->barang_kode);
                $sheet->setCellValue('C' . $baris, $value->barang_nama);
                $sheet->setCellValue('D' . $baris, $value->harga_beli);
                $sheet->setCellValue('E' . $baris, $value->harga_jual);
                $sheet->setCellValue('F' . $baris, $value->kategori->kategori_nama);
                $baris++;
                $no++;
            }

            foreach (range('A', 'F') as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true); // Set autosize untuk kolom
            }

            $sheet->setTitle('Data Barang'); // Set judul sheet

            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $filename = 'Data Barang ' . date('Y-m-d H:i:s') . '.xlsx';

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            header('Cache-Control: max-age=1');
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
            header('Cache-Control: cache, must-revalidate');
            header('Pragma: public');

            // Simpan file dan kirim ke output
            $writer->save('php://output');
            exit;
    }

    public function export_pdf()
    {
        $barang = BarangModel::select('kategori_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual')
                    ->orderBy('kategori_id')
                    ->orderBy('barang_kode')
                    ->with('kategori')
                    ->get();

        // use Barryvdh\DomPDF\Facade\Pdf
        $pdf = Pdf::loadView('barang.export_pdf', ['barang' => $barang]);
        $pdf->setPaper('a4', 'potrait'); //set ukuran kertas dan orientasi
        $pdf->setOption("isRemoteEnaled", true);
        $pdf->render();

        return $pdf->stream('Data Barang '.date('Y-m-d H:i:s').'.pdf');
    }
}
