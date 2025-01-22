<?php  
  
namespace App\Http\Controllers;  
  
use App\Models\LoanRequest;  
use App\Models\LoanRequestItem;  
use Illuminate\Http\Request;  
  
class LoanRequestController extends Controller  
{  
    // Menampilkan daftar permohonan peminjaman  
    public function index(Request $request)  
    {  
        // Mengambil data permohonan dengan relasi item  
        $loan_requests = LoanRequest::with('items.itemDetail', 'user')  
            ->when($request->search, function ($query) use ($request) {  
                $query->whereHas('user', function ($q) use ($request) {  
                    $q->where('name', 'like', '%' . $request->search . '%');  
                });  
            })  
            ->paginate(10);  
  
        return view('lending-asset.admin.transaksi-pengajuan', compact('loan_requests'));  
    }  
  
    // Menyimpan permohonan peminjaman baru  
    public function store(Request $request)  
    {  
        // Validasi data  
        $request->validate([  
            'user_id' => 'required|exists:users,id',  
            'durasi_peminjaman' => 'required|integer',  
            'alasan_peminjaman' => 'required|string',  
            'tanggal_pengajuan' => 'required|date',  
            'berkas_pendukung' => 'nullable|file',  
            'items' => 'required|array',  
            'items.*.item_details_id' => 'required|exists:item_details,id',  
            'items.*.quantity' => 'required|integer|min:1',  
        ]);  
  
        // Menyimpan permohonan peminjaman  
        $loanRequest = LoanRequest::create([  
            'user_id' => $request->user_id,  
            'durasi_peminjaman' => $request->durasi_peminjaman,  
            'alasan_peminjaman' => $request->alasan_peminjaman,  
            'tanggal_pengajuan' => $request->tanggal_pengajuan,  
            'berkas_pendukung' => $request->file('berkas_pendukung') ? $request->file('berkas_pendukung')->store('uploads') : null,  
            'approval_status' => 'pending',  
        ]);  
  
        // Menyimpan item peminjaman  
        foreach ($request->items as $item) {  
            LoanRequestItem::create([  
                'loan_request_id' => $loanRequest->id,  
                'item_details_id' => $item['item_details_id'],  
                'quantity' => $item['quantity'],  
            ]);  
        }  
  
        return redirect()->route('pengajuan.index')->with('success', 'Permohonan peminjaman berhasil ditambahkan.');  
    }  
  
    // Mengupdate permohonan peminjaman  
    public function update(Request $request, $id)  
    {  
        // Validasi data  
        $request->validate([  
            'durasi_peminjaman' => 'required|integer',  
            'alasan_peminjaman' => 'required|string',  
            'tanggal_pengajuan' => 'required|date',  
            'berkas_pendukung' => 'nullable|file',  
        ]);  
  
        // Mencari permohonan peminjaman  
        $loanRequest = LoanRequest::findOrFail($id);  
        $loanRequest->update([  
            'durasi_peminjaman' => $request->durasi_peminjaman,  
            'alasan_peminjaman' => $request->alasan_peminjaman,  
            'tanggal_pengajuan' => $request->tanggal_pengajuan,  
            'berkas_pendukung' => $request->file('berkas_pendukung') ? $request->file('berkas_pendukung')->store('uploads') : $loanRequest->berkas_pendukung,  
        ]);  
  
        return redirect()->route('pengajuan.index')->with('success', 'Permohonan peminjaman berhasil diperbarui.');  
    }  
  
    // Menghapus permohonan peminjaman  
    public function destroy($id)  
    {  
        $loanRequest = LoanRequest::findOrFail($id);  
        $loanRequest->items()->delete(); // Hapus item terkait  
        $loanRequest->delete(); // Hapus permohonan  
  
        return redirect()->route('pengajuan.index')->with('success', 'Permohonan peminjaman berhasil dihapus.');  
    }  
}  
