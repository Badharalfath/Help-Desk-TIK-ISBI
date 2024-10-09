<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengadaansTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengadaans', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_pengadaan'); // Tanggal pengadaan
            $table->string('supplier'); // Supplier asal barang
            $table->string('keterangan')->nullable(); // Keterangan tambahan
            $table->string('kwitansi')->nullable(); // Kwitansi (file gambar)
            $table->decimal('harga_unit', 15, 2); // Harga unit dalam bentuk mata uang
            $table->decimal('total_biaya', 15, 2); // Total biaya dalam bentuk mata uang
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengadaans');
    }
}
