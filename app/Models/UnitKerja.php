<?php  
  
  namespace App\Models;  
  
  use Illuminate\Database\Eloquent\Factories\HasFactory;  
  use Illuminate\Database\Eloquent\Model;  
    
  class UnitKerja extends Model  
  {  
      use HasFactory;  
    
      // Tentukan nama tabel jika tidak sesuai dengan konvensi Laravel  
      protected $table = 'unitkerjas'; // Ini opsional jika nama tabel sesuai dengan konvensi  
    
      // Tentukan kolom yang dapat diisi  
      protected $fillable = ['nama_unit_kerja', 'alamat'];  
  }  
  