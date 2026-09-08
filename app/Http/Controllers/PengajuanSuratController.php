<?php

namespace App\Http\Controllers;

use App\Models\LampiranSurat;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;

class PengajuanSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole('Mahasiswa')) {
            $mahasiswaId = auth()->user()->mahasiswa->id;
            $pengajuan_surat = PengajuanSurat::with('lampiranSurat')->where('mahasiswa_id', $mahasiswaId)->latest()->get();
        } else if (auth()->user()->hasRole('Admin')) {
            $pengajuan_surat = PengajuanSurat::with(['mahasiswa', 'lampiranSurat'])->orderByRaw("FIELD(status, 'menunggu', 'diproses', 'ditolak', 'selesai')")
                ->orderBy('created_at', 'desc')->get();
        } else {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('pengajuan_surat.index', compact('pengajuan_surat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->hasRole('Mahasiswa')) {
            abort(403, 'Halaman ini hanya untuk pengajuan surat dari mahasiswa.');
        }
        return view('pengajuan_surat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('Mahasiswa')) {
            abort(403, 'Halaman ini untuk role mahasiswa');
        }

        $request->validate([
            'jenis_surat'     => 'required|string',
            'keperluan'       => 'required|string',
            'file_lampiran'   => 'nullable|array|min:1',
            'file_lampiran.*' => 'file|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'jenis_surat.required'   => 'Silakan pilih jenis surat.',
            'keperluan.required'     => 'Keperluan surat wajib diisi.',
            'file_lampiran.required' => 'Dokumen bukti lampiran wajib diunggah.',
            'file_lampiran.*.mimes'  => 'Format setiap lampiran harus berupa PDF, JPG, atau PNG.',
            'file_lampiran.*.max'    => 'Ukuran setiap file lampiran maksimal 2MB.',
        ]);

        $mahasiswaId = auth()->user()->mahasiswa->id;

        // Langkah 1: Simpan data ke tabel utama pengajuan_surats
        $suratBaru = PengajuanSurat::create([
            'mahasiswa_id' => $mahasiswaId,
            'jenis_surat'  => $request->jenis_surat,
            'keperluan'    => $request->keperluan,
            'status'       => 'menunggu',
        ]);

        // Langkah 2: Upload fisik berkas & simpan baris data ke tabel lampiran_surats
        if ($request->hasFile('file_lampiran')) {
            foreach ($request->file('file_lampiran') as $index => $file) {
                $fileName = time() . '_lampiran_' . ($index + 1) . '_mhs_' . $mahasiswaId . '.' . $file->extension();
                $file->move(public_path('uploads/lampiran_surat'), $fileName);

                LampiranSurat::create([
                    'pengajuan_surat_id' => $suratBaru->id,
                    'nama_file'          => $fileName,
                ]);
            }
        }

        return redirect()->route('pengajuan-surat.index')->with('success', 'Pengajuan surat berhasil dikirim!');
    }

    public function updateStatus(Request $request, int $id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(403, 'Hanya admin yang berhak memproses pengajuan surat');
        }

        $request->validate([
            'status'            => 'required|in:menunggu,diproses,selesai,ditolak',
            'keterangan_admin'  => 'nullable|string',
            'file_surat_keluar' => 'nullable|file|max:2048',
        ], [
            'status.required'        => 'Status surat wajib dipilih.'
        ]);

        $surat = PengajuanSurat::findOrFail($id);
        $dataUpdate = [
            'status'           => $request->status,
            'keterangan_admin' => $request->keterangan_admin,
        ];

        if ($request->hasFile('file_surat_keluar')) {
            // Hapus file surat keluar lama di folder jika admin melakukan upload ulang (revisi)
            if ($surat->file_surat_keluar && file_exists(public_path('uploads/surat_keluar/' . $surat->file_surat_keluar))) {
                unlink(public_path('uploads/surat_keluar/' . $surat->file_surat_keluar));
            }

            $fileName = time() . '_surat_resmi_mhs_' . $surat->mahasiswa_id . '.pdf';
            $request->file_surat_keluar->move(public_path('uploads/surat_keluar'), $fileName);
            $dataUpdate['file_surat_keluar'] = $fileName;
        }

        $surat->update($dataUpdate);

        return redirect()->back()->with('success', 'Status pengajuan surat berhasil diperbarui!');
    }
}
