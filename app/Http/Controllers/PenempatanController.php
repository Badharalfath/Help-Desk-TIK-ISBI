<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Departemen;
use App\Models\Lokasi;
use App\Models\Penempatan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class PenempatanController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    // Menggunakan query builder dengan paginate(10) dan mengurutkan data dari yang terbaru
    $penempatan = Penempatan::when($search, function ($query, $search) {
            return $query->where('kd_barang', 'like', '%' . $search . '%')
                ->orWhere('nama_barang', 'like', '%' . $search . '%');
        })
        ->orderBy('tgl_penempatan', 'desc') // Urutkan berdasarkan tanggal penggunaan (atau kolom lain jika diperlukan)
        ->paginate(10); // Pagination dengan 10 item per halaman

    return view('management.penempatan', compact('penempatan'));
}


    public function create()
    {
        $barang = Barang::all();
        $departemen = Departemen::all();
        $lokasi = Lokasi::all();

        // Generate kode penempatan baru
        $lastPenempatan = Penempatan::orderBy('kd_penempatan', 'desc')->first();
        if ($lastPenempatan) {
            $lastNumber = intval(substr($lastPenempatan->kd_penempatan, 2));
            $newNumber = $lastNumber + 1;
            $newKdPenempatan = 'PN' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $newKdPenempatan = 'PN001';
        }

        return view('management.penempatan-tambah', compact('newKdPenempatan', 'barang', 'lokasi', 'departemen'));
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'kd_penempatan' => 'required',
        'tgl_penempatan' => 'required|date',
        'kd_barang' => 'required',
        'nama_barang' => 'required|string|max:255',
        'jumlah' => 'required|integer|min:1',
        'keterangan' => 'required',
        'kd_departemen' => 'required', // Tambahkan validasi untuk departemen
        'kd_lokasi' => 'required', // Tambahkan validasi untuk lokasi
        'foto.*' => 'nullable|image|max:5012',
    ]);

    // Ambil data barang berdasarkan kode barang
    $barang = Barang::where('kd_barang', $request->kd_barang)->first();

    if (!$barang) {
        return redirect()->back()->withErrors(['error' => 'Barang tidak ditemukan.']);
    }

    if ($barang->jumlah < $request->jumlah) {
        return redirect()->back()->withErrors(['error' => 'Jumlah barang tidak mencukupi.']);
    }

    // Kurangi stok barang
    $barang->jumlah -= $request->jumlah;
    $barang->save();

    // Handle multiple foto upload
    $fotoNames = [];
    if ($request->hasFile('foto')) {
        foreach ($request->file('foto') as $foto) {
            $originalFilename = $foto->getClientOriginalName();
            $newFilename = rand(1000000000, 9999999999) . '_' . $originalFilename;

            // Simpan file dengan nama baru di folder 'storage/app/public/penempatan'
            $foto->storeAs('public/fotos', $newFilename);

            // Tambahkan nama file ke array
            $fotoNames[] = $newFilename;
        }
    }

    // Gabungkan nama-nama file yang di-upload menjadi satu string dipisahkan dengan koma
    $fotoNamesString = count($fotoNames) > 0 ? implode(',', $fotoNames) : null;

    // Simpan data penempatan ke database
    Penempatan::create([
        'kd_penempatan' => $request->kd_penempatan,
        'tgl_penempatan' => $request->tgl_penempatan,
        'kd_barang' => $request->kd_barang,
        'nama_barang' => $request->nama_barang,
        'jumlah' => $request->jumlah,
        'keterangan' => $request->keterangan,
        'kd_departemen' => $request->kd_departemen, // Simpan kode departemen
        'kd_lokasi' => $request->kd_lokasi, // Simpan kode lokasi
        'foto_penempatan' => $fotoNamesString,
    ]);

    return redirect()->route('penempatan')->with('success', 'Penempatan berhasil ditambahkan.');
}




    public function getLokasi($departemenId)
{
    // Check if the department exists
    if (!Departemen::where('kd_departemen', $departemenId)->exists()) {
        return response()->json(['error' => 'Departemen tidak valid atau tidak ditemukan.'], 400);
    }

    // Fetch locations associated with the department
    $lokasi = Lokasi::where('kd_departemen', $departemenId)->get(['kd_lokasi', 'nama_lokasi']);

    if ($lokasi->isEmpty()) {
        return response()->json(['error' => 'Lokasi tidak ditemukan untuk departemen ini.'], 404);
    }

    return response()->json($lokasi);
}


public function edit($kd_penempatan)
{
    // Mengambil data penempatan dengan relasi departemen dan lokasi
    $penempatan = Penempatan::with(['departemen', 'lokasi'])
        ->where('kd_penempatan', $kd_penempatan)
        ->first();

    if (!$penempatan) {
        return redirect()->route('penempatan')->with('error', 'Penempatan tidak ditemukan.');
    }

    $barang = Barang::all(); // Ambil data barang
    $departemen = Departemen::all(); // Ambil semua departemen
    $lokasi = Lokasi::where('kd_departemen', $penempatan->kd_departemen)->get(); // Ambil lokasi berdasarkan departemen

    return view('management.penempatan-edit', compact('penempatan', 'barang', 'departemen', 'lokasi'));
}


    public function update(Request $request, $kd_penempatan)
    {
        $request->validate([
            'kd_barang' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'tgl_penempatan' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $penempatan = Penempatan::findOrFail($kd_penempatan);
        $penempatan->update($request->all());

        return redirect()->route('penempatan')->with('success', 'Penempatan berhasil diperbarui.');
    }

    public function destroy($kd_penempatan)
    {
        // Ambil data penempatan yang akan dihapus
        $penempatan = Penempatan::where('kd_penempatan', $kd_penempatan)->first();

        if ($penempatan) {
            // Cari barang yang digunakan dalam penempatan ini berdasarkan kd_barang
            $barang = Barang::where('kd_barang', $penempatan->kd_barang)->first();

            if ($barang) {
                // Tambahkan kembali jumlah barang yang ditempatkan
                $barang->jumlah += $penempatan->jumlah; // Tambah jumlah barang yang dikembalikan
                $barang->save(); // Simpan perubahan pada stok barang
            }

            // Hapus data penempatan
            $penempatan->delete();

            return redirect()->route('penempatan')->with('success', 'Penempatan berhasil dihapus dan stok barang dipulihkan.');
        }

        return redirect()->route('penempatan')->with('error', 'Penempatan tidak ditemukan.');
    }


    public function detail($kd_penempatan)
    {
        $penempatan = Penempatan::with('barang')->findOrFail($kd_penempatan);

        // Mengambil foto dari barang terkait penempatan
        $fotos = explode(',', $penempatan->barang->foto);

        return response()->json([
            'penempatan' => $penempatan,
            'fotos' => $fotos
        ]);
    }

    public function show($kd_penempatan)
    {
        $penempatan = Penempatan::findOrFail($kd_penempatan);
        return view('management.penempatan-detail', compact('penempatan'));
    }



    public function generatePDF(Request $request)
{
    $recipientName = $request->input('recipient_name');

    // Retrieve data for penempatan (adjust the query as per your database structure)
    $penempatan = Penempatan::join('barang', 'penempatan.kd_barang', '=', 'barang.kd_barang')
        ->select('penempatan.kd_penempatan', 'barang.kd_barang', 'barang.nama_barang', 'penempatan.tgl_penempatan', 'penempatan.keterangan')
        ->get();

    // Get the logo image as base64
    $logoPath = public_path('storage/images/logoISBI.png'); // Ensure this path is correct
    $logoBase64 = file_exists($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : null;

    // Load the view and pass data
    $pdf = Pdf::loadView('management.penempatanPDF', compact('penempatan', 'logoBase64', 'recipientName'))
        ->setPaper('a4', 'portrait');

    // Stream the generated PDF
    return $pdf->stream('Bukti_Serah_Terima_Penempatan.pdf');
}

}
