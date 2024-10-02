<?php

namespace App\Observers;

use App\Models\Barang;
use App\Models\Kategori;


class BarangObserver
{
    /**
     * Handle the Barang "created" event.
     *
     * @param  \App\Models\Barang  $barang
     * @return void
     */
    public function created(Barang $barang)
    {
        // Tambahkan qty_barang di kategori terkait
        Kategori::where('kd_kategori', $barang->kd_kategori)->increment('qty_barang');
    }

    /**
     * Handle the Barang "updated" event.
     *
     * @param  \App\Models\Barang  $barang
     * @return void
     */
    public function updated(Barang $barang)
    {
        // Jika kategori berubah, kurangi dari kategori lama dan tambahkan ke kategori baru
        if ($barang->isDirty('kd_kategori')) {
            Kategori::where('kd_kategori', $barang->getOriginal('kd_kategori'))->decrement('qty_barang');
            Kategori::where('kd_kategori', $barang->kd_kategori)->increment('qty_barang');
        }
    }

    /**
     * Handle the Barang "deleted" event.
     *
     * @param  \App\Models\Barang  $barang
     * @return void
     */
    public function deleted(Barang $barang)
    {
        // Kurangi qty_barang dari kategori terkait
        Kategori::where('kd_kategori', $barang->kd_kategori)->decrement('qty_barang');
    }
}
