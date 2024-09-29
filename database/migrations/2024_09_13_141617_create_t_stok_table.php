<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('t_stok', function (Blueprint $table) {
            $table->id('stok_id');
            $table->unsignedBigInteger('barang_id')->index(); // Foreign key ke tabel m_barang
            $table->unsignedBigInteger('supplier_id')->index(); // Foreign key ke tabel supplier
            $table->unsignedBigInteger('user_id')->index(); // Foreign key ke tabel m_user
            $table->dateTime('stok_tanggal');
            $table->integer('stok_jumlah');
            $table->timestamps();

            // Mendefinisikan Foreign Key
            $table->foreign('barang_id')->references('barang_id')->on('m_barang');
            $table->foreign('supplier_id')->references('supplier_id')->on('m_supplier'); // Sesuaikan nama tabel supplier Anda
            $table->foreign('user_id')->references('user_id')->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_stok');
    }
};
