@empty($barang)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/barang') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <h5><i class="icon fas fa-info"></i> Detail Informasi</h5>
                </div>
                <table class="table table-sm table-bordered table-striped">
                    <tr>
                        <th class="text-right col-3">ID Barang :</th>
                        <td class="col-9">{{ $barang->barang_id }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Kode Barang :</th>
                        <td class="col-9">{{ $barang->barang_kode }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Nama Barang :</th>
                        <td class="col-9">{{ $barang->barang_nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Harga Beli :</th>
                        <td class="col-9">Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Harga Jual :</th>
                        <td class="col-9">Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Kategori :</th>
                        <td class="col-9">{{ $barang->kategori->kategori_nama }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
        });
    </script>
@endempty