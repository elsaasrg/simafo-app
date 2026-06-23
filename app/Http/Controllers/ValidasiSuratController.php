<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use Illuminate\Http\Request;

class ValidasiSuratController extends Controller
{
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
