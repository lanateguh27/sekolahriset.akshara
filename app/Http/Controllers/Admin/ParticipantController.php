<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ParticipantController extends Controller
{
    // Menampilkan peserta berdasarkan status
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending');

        if (! in_array($status, ['pending', 'verified'], true)) {
            $status = 'pending';
        }

        $participants = Participant::with('event')
            ->where('status', $status)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.participants.index', compact(
            'participants',
            'status'
        ));
    }

    // Memverifikasi peserta
    public function verify(Participant $participant)
    {
        if ($participant->status !== 'pending') {
            return redirect()
                ->route('admin.participants.index')
                ->with('error', 'Peserta ini sudah diverifikasi.');
        }

        $participant->update([
            'status' => 'verified',
        ]);

        return redirect()
            ->route('admin.participants.index', ['status' => 'pending'])
            ->with('success', 'Peserta berhasil diverifikasi.');
    }

    // Menghapus peserta
    public function destroy(Participant $participant)
    {
        if ($participant->payment_proof) {
            Storage::delete($participant->payment_proof);
        }

        $participant->delete();

        return redirect()
            ->route('admin.participants.index')
            ->with('success', 'Data peserta berhasil dihapus.');
    }
}
