<?php  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;    
use Illuminate\Database\Eloquent\Model;    
  
class LoanRequest extends Model    
{    
    use HasFactory;    
  
    protected $table = 'loan_requests';  
    
    protected $fillable = [    
        'user_id',    
        'durasi_peminjaman',    
        'alasan_peminjaman',    
        'berkas_pendukung',    
        'tanggal_pengajuan',    
        'approval_status',    
        'admin_id',    
        'approval_date',    
        'returned_date',  
    ];    
    
    // Relasi dengan model User untuk pengguna yang mengajukan pinjaman  
    public function user()    
    {    
        return $this->belongsTo(User::class);    
    }    
    
    // Relasi dengan model User untuk admin yang menyetujui pinjaman  
    public function admin()    
    {    
        return $this->belongsTo(User::class, 'admin_id');    
    }    
  
    // Relasi dengan model LoanRequestItem untuk item yang dipinjam  
    public function items()    
    {    
        return $this->hasMany(LoanRequestItem::class, 'loan_request_id');    
    }    
}  
