<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop tabel pengadaan jika ada
        Schema::dropIfExists('pengadaan');

        // Membuat tabel transaksi
        Schema::create('transaksi', function (Blueprint $table) {
            $table->string('kd_transaksi', 10)->primary(); // Kolom kode transaksi
            $table->date('tgl_transaksi'); // Kolom tanggal transaksi
            $table->string('keterangan')->nullable(); // Kolom keterangan, opsional
            $table->string('nota')->nullable(); // Kolom nota, opsional
            $table->string('kd_barang', 6); // Foreign key dari tabel barang, tipe varchar(6)
            $table->timestamps(); // Menambahkan created_at dan updated_at
        
            // Menambahkan foreign key ke kolom kd_barang
            $table->foreign('kd_barang')->references('kd_barang')->on('barang')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Hapus tabel transaksi
        Schema::dropIfExists('transaksi');

        // (Opsional) Membuat kembali tabel pengadaan jika rollback
        Schema::create('pengadaan', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_pengadaan');
            $table->string('keterangan')->nullable();
            $table->decimal('harga_unit', 8, 2);
            $table->decimal('total_biaya', 10, 2);
            $table->string('nota')->nullable();
            $table->timestamps();
        });
    }
}
