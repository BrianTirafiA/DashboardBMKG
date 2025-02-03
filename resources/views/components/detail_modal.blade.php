<!-- Modal untuk Menampilkan Detail Permohonan Peminjaman -->  
<div id="detailModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">  
    <div class="bg-white rounded-lg p-6 w-2/3">  
        <h2 class="text-lg font-semibold mb-4">Detail Permohonan Peminjaman</h2>  
        <div id="modalUserDetails">  
            <p><strong>Nama Pemohon:</strong> <span id="modalUserName"></span></p>  
            <p><strong>Email:</strong> <span id="modalUserEmail"></span></p>  
            <p><strong>Telepon:</strong> <span id="modalUserPhone"></span></p>  
        </div>  
        <div id="modalLoanDetails" class="mt-4">  
            <p><strong>Durasi Peminjaman:</strong> <span id="modalDurasiPeminjaman"></span> Hari</p>  
            <p><strong>Alasan Peminjaman:</strong> <span id="modalAlasanPeminjaman"></span></p>  
            <p><strong>Tanggal Pengajuan:</strong> <span id="modalTanggalPengajuan"></span></p>  
            <p><strong>Berkas Pendukung:</strong>   
                <a id="modalBerkasPendukung" href="#" target="_blank" class="text-blue-500">Lihat Berkas</a>  
            </p>  
        </div>  
        <div id="modalItems" class="mt-4">  
            <h3 class="text-md font-semibold">Barang/Item yang Dipinjam:</h3>  
            <ul id="modalItemList"></ul>  
        </div>  
        <div class="flex justify-end mt-4">  
            <form id="acceptForm" method="POST" class="inline">  
                @csrf  
                <input type="hidden" id="acceptLoanRequestId" name="id">  
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mr-2">Terima</button>  
            </form>  
            <form id="rejectForm" method="POST" class="inline">  
                @csrf  
                @method('DELETE')  
                <input type="hidden" id="rejectLoanRequestId" name="id">  
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Tolak</button>  
            </form>  
            <button id="closeDetailModal" class="bg-gray-500 text-white px-4 py-2 rounded">Tutup</button>  
        </div>  
    </div>  
</div>  
  
<script>  
    function openDetailModal(id, user_name, user_email, user_phone, durasi_peminjaman, alasan_peminjaman, tanggal_pengajuan, berkas_pendukung, items) {  
        document.getElementById('modalUserName').textContent = user_name;  
        document.getElementById('modalUserEmail').textContent = user_email;  
        document.getElementById('modalUserPhone').textContent = user_phone;  
        document.getElementById('modalDurasiPeminjaman').textContent = durasi_peminjaman;  
        document.getElementById('modalAlasanPeminjaman').textContent = alasan_peminjaman;  
        document.getElementById('modalTanggalPengajuan').textContent = tanggal_pengajuan;  
        document.getElementById('modalBerkasPendukung').href = berkas_pendukung ? "{{ asset('storage/') }}" + berkas_pendukung : '#';  
        document.getElementById('modalBerkasPendukung').style.display = berkas_pendukung ? 'inline' : 'none';  
  
        const itemList = document.getElementById('modalItemList');  
        itemList.innerHTML = ''; // Clear previous items  
        items.forEach(item => {  
            const li = document.createElement('li');  
            li.textContent = `${item.itemDetail ? item.itemDetail.nama_item : 'Item tidak ditemukan'} (${item.quantity})`;  
            itemList.appendChild(li);  
        });  
  
        document.getElementById('acceptLoanRequestId').value = id;  
        document.getElementById('rejectLoanRequestId').value = id;  
  
        document.getElementById('detailModal').classList.remove('hidden');  
    }  
  
    // Event listener untuk menutup modal    
    document.getElementById('closeDetailModal').addEventListener('click', function () {  
        document.getElementById('detailModal').classList.add('hidden');  
    });  
  
    // Event listener untuk form terima permintaan  
    document.getElementById('acceptForm').addEventListener('submit', function (event) {  
        event.preventDefault();  
        const id = document.getElementById('acceptLoanRequestId').value;  
        fetch(`{{ route('transaksi-pengajuan.accept', '') }}/${id}`, {  
            method: 'POST',  
            headers: {  
                'X-CSRF-TOKEN': '{{ csrf_token() }}',  
                'Content-Type': 'application/json'  
            }  
        })  
        .then(response => response.json())  
        .then(data => {  
            if (data.success) {  
                alert('Permintaan berhasil diterima.');  
                location.reload(); // Refresh halaman  
            } else {  
                alert('Gagal menerima permintaan.');  
            }  
        })  
        .catch(error => {  
            console.error('Error:', error);  
            alert('Terjadi kesalahan.');  
        });  
    });  
  
    // Event listener untuk form tolak permintaan  
    document.getElementById('rejectForm').addEventListener('submit', function (event) {  
        event.preventDefault();  
        const id = document.getElementById('rejectLoanRequestId').value;  
        fetch(`{{ route('transaksi-pengajuan.destroy', '') }}/${id}`, {  
            method: 'DELETE',  
            headers: {  
                'X-CSRF-TOKEN': '{{ csrf_token() }}',  
                'Content-Type': 'application/json'  
            }  
        })  
        .then(response => response.json())  
        .then(data => {  
            if (data.success) {  
                alert('Permintaan berhasil ditolak.');  
                location.reload(); // Refresh halaman  
            } else {  
                alert('Gagal menolak permintaan.');  
            }  
        })  
        .catch(error => {  
            console.error('Error:', error);  
            alert('Terjadi kesalahan.');  
        });  
    });  
</script>  
