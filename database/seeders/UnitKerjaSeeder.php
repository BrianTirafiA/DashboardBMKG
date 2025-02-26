<?php  
  
namespace Database\Seeders;  
  
use Illuminate\Database\Seeder;  
use App\Models\UnitKerja;  
  
class UnitKerjaSeeder extends Seeder  
{  
    /**  
     * Run the database seeds.  
     *  
     * @return void  
     */  
    public function run()  
    {  
        $data = [  
            ['nama_unit_kerja' => 'Balai Besar Meteorologi Klimatologi dan Geofisika Wil. I - Medan', 'alamat' => 'Jl. Ngumban Surbakti No.15, Sempakata, Kec. Medan Selayang, Kota Medan, Sumatera Utara 20131061-8222877; 082168043653bbmkg1@bmkg.go.id'],  
            ['nama_unit_kerja' => 'Balai Besar Meteorologi Klimatologi dan Geofisika Wil. II - Tangerang Selatan', 'alamat' => 'JL. Abdul Ghani No.5, Cempaka Putih, Ciputat Timur, Tangerang Selatan'],  
            ['nama_unit_kerja' => 'Balai Besar Meteorologi Klimatologi dan Geofisika Wil. III - Badung', 'alamat' => 'Jl.Raya Tuban Badung-Bali 80361'],  
            ['nama_unit_kerja' => 'Balai Besar Meteorologi Klimatologi dan Geofisika Wil. IV - Makassar', 'alamat' => 'Jl. Prof. DR. Abdurrahman Basalamah No. 4 Panakukang Makassar Sulawesi Selatan 90231'],  
            ['nama_unit_kerja' => 'Balai Besar Meteorologi Klimatologi dan Geofisika Wil. V - Jayapura', 'alamat' => 'Jl. Raya Abepura Entrop Kp 1572 Jayapura 99224'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas I Padang Panjang', 'alamat' => 'Jl. Meteorologi, Silaing Bawah, Kec. Padang Panjang Bar., Kota Padang Panjang, Sumatera Barat 271180752-82236stageof.padangpanjang@bmkg.go.id'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas II Sumatera Barat', 'alamat' => 'Jalan Padang-Bukit tinggi Km. 51 Kapalo Hilalang Kec. Kayu Tanam Kab. Padang Pariaman'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas II Minangkabau - Padang Pariaman', 'alamat' => 'Bandara Tabing Padang'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas IV Maritim Teluk Bayur - Padang', 'alamat' => 'Jalan Sutan Syahrir Komplek Pelindo Nomor 26 Rawang, Mata Air, Padang, Prov. Sumatera Barat 25123'],  
            ['nama_unit_kerja' => 'Sta. Pemantau Atmosfer Global Bukit Koto Tabang - Agam', 'alamat' => 'Jalan Raya Bukittinggi - Medan Km. 17, Palupuh, Kabupaten Agam, Provinsi Sumatera Barat'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas I Deli Serdang', 'alamat' => 'Jalan Geofisika No. 1 Tuntungan I, Kec. Pancurbatu, Kab. Deli Serdang, Sumatera Utara, 203530811-6041720; 061-6626975stageof.tuntungan@bmkg.go.id'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas III Gunung Sitoli', 'alamat' => 'Jl. Ke Alasa-Meteoorologi, Duusn III, Ds. Onowaembo, Kota Gunungsitoli, Sumatera Utara stageof.gunungsitoli@bmkg.go.id'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas I Sumatera Utara', 'alamat' => 'Jl. Meteorologi Raya No.17, Sampali, Kec. Percut Sei Tuan, Deli Serdang, 20371061-6623292staklimspl@gmail.com'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas I Kualanamu - Deli Serdang', 'alamat' => 'Jl. Tengku Heran Desa V Kebun Kelapa, Kec. Beringin Deliserdang 20552'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas II Maritim Belawan - Medan', 'alamat' => 'Jl. Raya Pelabuhan III Gabion Belawan Medan'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Binaka - Gunung Sitoli', 'alamat' => 'Jl. Pelabuhan Udara Binaka Km.19,7 Kecamatan Gunungsitoli Idanoi, kota Gunungsitoli - Nias'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III F.L. Tobing - Tapanuli Tengah', 'alamat' => 'Bandara Pinang Sori Sibolga'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas IV Aek Godang - Padang Sidempuan', 'alamat' => 'Bandara Aek Godang Tapanuli Selatan'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas II Silangit - Tapanuli Utara', 'alamat' => 'Jl. Simpang Muara No. 1 Terminal A Bandara Silangit Siborongborong, Tapanuli Utara, Sumatera Utara'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas III Aceh Besar', 'alamat' => 'JL. Raya Mata Ie Kec. Darul Imarah Kab. Aceh Besar Provinsi Aceh, (23352)'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas III Aceh Selatan', 'alamat' => 'Jl. Bandara T. Cut Ali Desa Teupin Gajah, Kec. Pasie Raja, Kab. Aceh Selatan, Aceh (23755)'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas IV Aceh', 'alamat' => 'Jl. Banda Aceh - Medan KM. 27,5 Indrapuri, Aceh Besar'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas I Sultan Iskandar Muda - Banda Aceh', 'alamat' => 'Bandar Udara Sultan Iskandar Muda, Blang Bintang, Banda Aceh'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Maimun Saleh - Sabang', 'alamat' => 'Bandara Maimun Saleh Sabang'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Malikussaleh - Aceh Utara', 'alamat' => 'Jl. Meteorologi Bandar Udara Malikussaleh, Muara Batu, Aceh Utara'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Cut Nyak Dhien - Nagan Raya', 'alamat' => 'Bandara Cut Nyak Dhien Meulaboh Jl. Desa Kubang Gajah Kec. Kuala, Kab. Nagan Raya'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas I Hang Nadim - Batam', 'alamat' => 'Jalan Hang Nadim, Batu Besar, Batam 29466'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Dabo - Lingga', 'alamat' => 'JL. Garuda Po.Box 6 Dabo Singkep'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Raja Haji Fisabilillah - Tanjung Pinang', 'alamat' => 'Jl. Adi Sucipto Km 12,5 Bandara Kijang Tj Pinang'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Ranai - Natuna', 'alamat' => 'Jl. Adi Sucipto No.147 Ranai'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Tarempa - Kepulauan Anambas', 'alamat' => 'Jalan Hang Tuah No.10 Tarempa'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas IV Raja Haji Abdullah - Karimun', 'alamat' => 'Jalan Mayjen Sutoyo Km. 12 Komplek Bandar Udara Raja Haji Abdullah Tangjung Balai Karimun, 29661'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas I Sultan Syarif Kasim II - Pekanbaru', 'alamat' => 'Bandar Udara Sultan Syarif Kasim II Pekanbaru, KP. 28284'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Japura - Indragiri Hulu', 'alamat' => 'Jln. Lintas Timur, Sidomulyo, Kec. Lirik, Kab. Indragiri Hulu, Provinsi Riau'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas IV Riau', 'alamat' => 'Jl. Unggas, Simpang Tiga, Kec. Bukit Raya, Kota Pekanbaru, Riau 28288'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas I Bandung', 'alamat' => 'Jl. Cemara No.66, Pasteur, Kec. Sukajadi, Kota Bandung, Jawa Barat 40161'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas I Jawa Barat', 'alamat' => 'Jl. Alternatif IPB, Setu Gede Bogor Barat'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Kertajati - Majalengka', 'alamat' => 'Jl. Letnan Angkat Arzain No.28 Jatiwangi Majalengka 45454 Jawa Barat'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Citeko - Bogor', 'alamat' => 'Jalan Raya Citeko, Cisarua, RT.002/RW.009 Desa Citeko, Kecamatan CIsarua, Kabupaten Bogor'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas III Sukabumi', 'alamat' => ''],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas I Tangerang', 'alamat' => 'Jl Meteorologi I No 5 Tanah Tinggi Tangerang, Kota Tangerang. Kodepos 15119'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas II Banten', 'alamat' => 'Jl. Raya Kodam Bintaro No 82 Jakarta Selatan'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas I Soekarno Hatta - Tangerang', 'alamat' => 'Bandara Soekarno-Hatta Gedung 611, Pajang, Benda, Kota Tangerang, Banten 15126'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Budiarto - Tangerang', 'alamat' => 'Bandar Udara Budiarto, Komplek STPI Curug, Kec. Legok, Kab. Tangerang'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas I Maritim Serang', 'alamat' => 'Jl Raya Taktakan No 27 Serang Banten'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas II Sultan Mahmud Badaruddin II - Palembang', 'alamat' => 'Jl. Sultan Mahmud Badaruddin II KM.10,5 Palembang, 30154'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas I Sumatera Selatan', 'alamat' => 'Jl. Residen H Amaludin, Sako, Palembang / Jl. Mayjen Yusuf Singadekane RT/RW. 22/05, Palembang'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas III Banjarnegara', 'alamat' => 'Jl. Raya Banjarmangu Km.12, Kalilunjar, Banjarmangu, Banjarnegara'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas I Jawa Tengah', 'alamat' => 'Jl Siliwangi No. 291 Semarang'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas II Ahmad Yani - Semarang', 'alamat' => 'Jln. PUAD Bandar Udara Internasional Jenderal Ahmad Yani Semarang 50145'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Maritim Tegal', 'alamat' => 'Jalan Kolonel Sugiono No. 100 Tegal'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Tunggul Wulung - Cilacap', 'alamat' => 'JL. GATOT SUBROTO NO 20 CILACAP'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas II Maritim Tanjung Emas - Semarang', 'alamat' => 'Komplek Pelabuhan Tanjung Emas Jl.Yos Sudarso 58 Tanjung Emas Semarang'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas III Kepahiang', 'alamat' => 'Jl. Pembangunan No. 156 Pasar Ujung, Kepahiang'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas I Bengkulu', 'alamat' => 'Jl. Ir. Rustandi Sugianto Bengkulu'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Fatmawati Soekarno - Bengkulu', 'alamat' => 'Jl Raya Padang Kemiling, Kelurahan Pekan Sabtu, Kecamatan Selebar, Provinsi Bengkulu'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas III Lampung Utara', 'alamat' => 'Jl.Raden Intan No 219 Kotaalam Kotabumi-Lampung Utara 34519'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas IV Lampung', 'alamat' => 'Jalan Raya Lintas Sumatera KM.35 Tegineneng Pesawaran Lampung 35363'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas I Radin Inten II - Lampung Selatan', 'alamat' => 'Jl. Raya Branti, Bandara Radin Inten II Lampung'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas IV Maritim Panjang - Bandar Lampung', 'alamat' => 'Jl.Yos Sudarso No.64 Way Lunik Panjang Bandar Lampung'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas IV Jambi', 'alamat' => 'Jalan Raya Jambi-Muara Bulian KM 18, Desa Simpang Sungai Duren, Propinsi Jambi-36363'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Depati Parbo - Kerinci', 'alamat' => 'Bandara Depati Parbo Kerinci'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas I Sultan Thaha - Jambi', 'alamat' => 'Jl. Sersan Udara Syawal, Paal Merah, Jambi'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas I Maritim Tanjung Priok - Jakarta Utara', 'alamat' => 'Jalan Padamarang No. 4A Pelabuhan Tanjung Priok Jakarta Utara 14310'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Kemayoran - Jakarta Pusat', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10610'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Pangsuma - Kapuas Hulu', 'alamat' => 'Jalan Adi Sucipto Kedamin Putussibau Selatan'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas I Supadio - Pontianak', 'alamat' => 'Jl. Adi Sucipto KM.17 Kompleks Bandara Supadio Pontianak, Kalimantan Barat 78391'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Paloh - Sambas', 'alamat' => 'Jl. Lingkar PLN Liku, Kec. Paloh Kab. Sambas, Kalimantan Barat'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Nangapinoh - Melawi', 'alamat' => 'Jl. Juang Km 2,5 Komplek Bandar Udara Nangapinoh'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Rahadi Oesman - Ketapang', 'alamat' => 'Jalan Patimura no. 11 Kalinilam, Delta Pawan, Ketapang 78851'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Tebelian Sintang', 'alamat' => 'Jalan Patih Tengn, Tebelian, Sintang'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas IV Maritim Pontianak', 'alamat' => 'Jl. Pelabuhan Laut Pontianak 78112'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas II Kalimantan Barat', 'alamat' => 'Jl. Raya Pontianak-Mempawah Km 20.5 Sei Nipah Kec. Jongkat, Kab. Mempawah, Kalimantan Barat 78351'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas I Sleman', 'alamat' => 'Jln.wates km.8 Jitengan Balecatur Gamping Sleman Yogyakarta'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas IV D.I Yogyakarta', 'alamat' => 'Jl. Kabupaten Km 5,5 Duwet, Sendangadi, Mlati, Sleman, Daerah Istimewa Yogyakarta 55285'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas II Yogyakarta', 'alamat' => 'Jl. Nasional 3, Bandar Udara Yogyakarta Internasional Airport Kulon Progo 55654'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III H.AS. Hanandjoeddin - Belitung', 'alamat' => 'Jln. Bandar Udara H AS.Hanandjoeddin Tanjungpandan'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas I Depati Amir - Pangkal Pinang', 'alamat' => 'Jl. Bandar Udara Depati Amir Pangkalpinang 33171'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas IV Bangka Belitung', 'alamat' => 'Komp. Perkantoran Terpadu Pemkab. Bangka Tengah, Jl. Kartika I, Koba, Kep. Bangka-Belitung, 33681'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas I Kupang', 'alamat' => 'Jl. RW Monginsidi Pasir Panjang, Kota Lama Kupang - NTT 85227'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas III Sumba Timur', 'alamat' => 'Jl. Adi Sucipto I/8, Mauhau, Kab. Sumba Timur, NTT'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas II Nusa Tenggara Timur', 'alamat' => 'Jl Timor Raya KM 10,7 Lasiana Kupang - NTT'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas II El Tari - Kupang', 'alamat' => 'Jl Adi Sucipto Bandar Udara El Tari Kupang'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Gewanyantana - Flores Timur', 'alamat' => 'Jl. Soekarno-Hatta No.76, Kec. Ile Mandiri, Flores Timur, NTT'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III David Constantijn Saudale - Rote Ndao', 'alamat' => 'Jl. Bandar Udara D.C Saudale Rote No. 2'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Mali - Alor', 'alamat' => 'JL. SOEKARNO HATTA, Kel. Kabola kec. Kabola - Alor'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Umbu Mehang Kunda - Sumba Timur', 'alamat' => 'Jl. Adi Sucipto no.3 Mauhau, Kab. Sumba Timur, NTT'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Frans Sales Lega - Manggarai', 'alamat' => 'Jl. Satar Tacik, Ruteng, Kab.Manggarai, Nusa Tenggara Timur 85618'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Tardamu - Sabu Raijua', 'alamat' => 'JL. Tardamu No.12 Seba - Sabu'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Fransiskus Xaverius Seda - Sikka', 'alamat' => 'Jl. Adi Sucipto, Kec. Waioti, Kel. Alok Timur, Kab. Sikka, PROV. NTT, 86111'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas IV Komodo - Manggarai Barat', 'alamat' => 'Jl. Yohanes Sehadun, Labuan Bajo, Komodo, Manggarai Barat, Nusa Tenggara Timur'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas III Alor', 'alamat' => 'Jl. Soekarno-Hatta, Kabola, Kab. Alor - NTT'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas IV Maritim Tenau - Kupang', 'alamat' => 'Jl. M. Praja, Alak - Kupang(0380) 8563027maritimtenau2019@yahoo.com'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas II Denpasar', 'alamat' => 'Jalan Pulau Tarakan No 1 Denpasar Barat'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas II Bali', 'alamat' => 'Jalan Lely No. 9, Baler-bale Agung. Kecamatan Negara'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas I I Gusti Ngurah Rai - Badung', 'alamat' => 'Gedung GOI Lantai II Bandara Ngurah Rai'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas II Pasuruan', 'alamat' => 'Jl. Sedap Malam, Mlaten, Pandaan, Pasuruan 67156, Jawa Timur'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas III Malang', 'alamat' => 'Jl. Raya Bendungan Lahor, No. 40, Karangkates, Sumberpucung, Malang 65165'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas III Nganjuk', 'alamat' => 'Jl. Pesanggrahan Sawahan Nganjuk JATIM 64475'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas II Jawa Timur', 'alamat' => 'Jl. Zentana 33 Karangploso Malang Jawa Timur'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas I Juanda - Sidoarjo', 'alamat' => 'Bandar Udara Juanda Surabaya (Terminal 1), Sedati - Sidoarjo'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas II Maritim Tanjung Perak - Surabaya', 'alamat' => 'Jl. Kalimas Baru 97 B Surabaya 60165'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Banyuwangi', 'alamat' => 'Jl. Jaksa Agung Suprapto, No.152, Banyuwangi, Jawa Timur'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Trunojoyo', 'alamat' => 'Jl. Raya kalianget Barat No. 8, Sumenep 694710328-6762254stamet.kalianget@bmkg.go.id'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Tuban', 'alamat' => 'Jalan Raya Beji Desa Kaliuntu Kecamatan Jenu Kabupaten Tuban'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Sangkapura - Gresik', 'alamat' => 'Jl. Umar Masud Sangkapura - Bawean Gresik 61181'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Dhoho - Kediri', 'alamat' => ''],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas III Balikpapan', 'alamat' => 'Jl. Marsma Iswahyudi No.354, Sepinggan, Balikpapan, Kalimantan Timur'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas I Sultan Aji Muhammad Sulaiman Sepinggan - Balikpapan', 'alamat' => 'Jalan Marsma R. Iswahyudi No.356 Sepinggan Balikpapan 76115'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Kalimarau - Berau', 'alamat' => 'Jl. Bandara Kalimarau - Berau, Kalimantan Timur, 77315'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Aji Pangeran Tumenggung Pranoto Samarinda', 'alamat' => 'Jl.Pipit No.150 Samarinda 75117'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas I Kalimantan Selatan', 'alamat' => 'Jl. Trikora, Sungai Besar, Banjarbaru Selatan, Kota Banjarbaru, Kalimantan Selatan 70714'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas II Syamsudin Noor - Banjarmasin', 'alamat' => 'Jl. Angkasa Bandar Udara Syamsudin Noor Banjarmasin 70724'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Gusti Syamsir Alam  - Kotabaru', 'alamat' => 'Jl. Raya Stagen Km. 10 Pulau Laut Utara, kab. Kotabaru Kalimantan Selatan 72151'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas I Nusa Tenggara Barat', 'alamat' => 'Jl. TGH Ibrahim Khalidy, Kediri-Lombok Barat NTB'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas II Zainuddin Abdul Madjid - Lombok', 'alamat' => 'Jl. Raya Mandalika Penujak, Praya, Lombok Tengah NTB'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Sultan Muhammad Salahuddin - Bima', 'alamat' => 'Jln. Sultan M. Salahuddin Palibelo Bima - NTB'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Sultan Muhammad Kaharuddin - Sumbawa', 'alamat' => 'Jalan Garuda No.43 Sumbawa Besar'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas III Mataram', 'alamat' => 'Jl. Adi Sucipto No. 10 Rembiga Selaparang Mataram NTB'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Beringin - Barito Utara', 'alamat' => 'Jl. Pendreh No 187, Kelurahan Melayu, Kec. Teweh Tengah, Kab. Barito Utara, 73812'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Iskandar - Kotawaringin Barat', 'alamat' => 'Jl. Iskandar Bandara Iskandar Pangkalan Bun kab. Kotawaringin Barat'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas I Tjilik Riwut - Palangka Raya', 'alamat' => 'Jl. Adonis Samad, Kel. Panarung, Kec. Pahandut, Kota Palangka Raya 73111'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas IV Sanggu - Barito Selatan', 'alamat' => 'Jl. Merdeka, Bandar Udara Sanggau, Buntok, PO Box 18, KP. 73701'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas IV H. Asan - Kotawaringin Timur', 'alamat' => 'Jl. Samekto Baamang Hulu, Bandara H.Asan Sampit'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Juwata - Tarakan', 'alamat' => 'Jl. Mulawarman, Bandar Udara Internasional Juwata, Tarakan Barat, Tarakan, Kalimantan Utara 77111'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Tanjung Harapan - Bulungan', 'alamat' => 'jln Ulin No.119 Tanjung Selor, Kabupaten Bulungan, Prov. Kalimantan Utara'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Yuvai Semaring - Nunukan', 'alamat' => 'Long Katung, Krayan, Nunukan, Kalimantan Timur'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas IV Nunukan', 'alamat' => 'Jl.Arief Rahman Hakim No.15 Nunukan Timur, Nunukan, Kalimantan Utara'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas I Ambon', 'alamat' => 'Jl. AIS Nasution No. 8 Ambon, Maluku'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas III Maluku Tenggara Barat', 'alamat' => 'Jl. Harapan Saumlaki, Kecamatan Tanimbar Selatan, Kabupaten Kepulauan Tanimbar, Maluku'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas III Maluku', 'alamat' => 'Jl. Hunitetu, Kairatu, Seram Bagian Barat, Maluku, Kode Pos 97566'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas II Pattimura - Ambon', 'alamat' => 'Jln. Dr. J. Leimena (Komplek Bandara Pattimura), Ambon'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Amahai - Maluku Tengah', 'alamat' => 'Jl. Bandara Amahai, Soahuku, Kecamatan Amahai, Kabupaten Maluku Tengah, Maluku, Kode Pos 97516'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Bandaneira - Maluku Tengah', 'alamat' => 'Jalan Bandara Bandaneira, Desa Kampung Baru, Kecamatan Banda, Maluku Tengah'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Karel Sadsuitubun - Maluku Tenggara', 'alamat' => 'Jl. Bandara Karel Sadsuitubun Ibra Kec. Kei Kecil Timur Kab. Maluku Tenggara 97611'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Kuffar Seram Bagian Timur', 'alamat' => 'Jalan pendidikan Geser Kec. Seram Timur'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Namlea - Buru', 'alamat' => 'Jalan Raya Lala, Desa Lala Kecamatan Namlea Kabupaten Buru 97371'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Mathilda Batlayeri - Maluku Tenggara Barat', 'alamat' => 'Jl. Harapan Saumlaki, Kepulauan Tanimbar'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas IV Maritim Ambon', 'alamat' => 'Jl. Amanlanite, Waimahu, Latuhalat Kec Nusaniwe Ambon 97118'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas I Manado', 'alamat' => 'Jl. Harapan No.42, Winangun Satu, Kec. Malalayang, Kota Manado, Sulawesi Utara 95161'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas II Sulawesi Utara', 'alamat' => 'Jl. Raya Paniki Atas, Kec. Talawaan, Kab. Minahasa Utara. PO BOX 1052, 95001'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas II Maritim Bitung', 'alamat' => 'Jl. Candi No.53 Kadoodan, Madidir, Kota Bitung, Sulawesi Utara, kode pos 95513'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas II Sam Ratulangi - Manado', 'alamat' => 'Jl. AA Maramis Bandara Sam Ratulangi Manado 95374'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Naha - Kepulauan Sangihe', 'alamat' => 'JL. Bandar Udara Naha, Kec. Tabukan Utara, Kab. Kep. Sangihe'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas II Gowa', 'alamat' => 'Jl. Poros Malino, Kel. Tamarunang, Sungguminasa, Kab. Gowa, Prov. Sulawesi Selatan (92112)'],  
            ['nama_unit_kerja' => 'Sta. Klim. Kelas I Sulawesi Selatan', 'alamat' => 'Jl. DR. Ratulangi no. 75A, Kel. Baju Bodoa, Kec. Maros Baru, Kab. Maros - Sulawesi Selatan (90515)'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas I Sultan Hasanuddin - Makassar', 'alamat' => 'Bandara Hasanuddin Mandai - Makassar'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas II Maritim Paotere - Makassar', 'alamat' => 'Jl. Sabutung I No.30, Kelurahan Gusung Kecamat Ujung Tanah 90163'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Andi Djemma - Luwu Utara', 'alamat' => 'Jalan Dirgantara no 3 kec Masamba kab Luwu Utara, Sulawesi Selatan'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas IV Toraja Tana Toraja', 'alamat' => 'Jl. Bandara Pongtiku Tana Toraja Sulawesi Selatan'],  
            ['nama_unit_kerja' => 'Sta. Geof. Kelas I Palu', 'alamat' => 'Jl. Denggune Kotak Pos 48 Palu, Sulawesi'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas II Mutiara SIS Al-Jufrie - Palu', 'alamat' => 'Komplek Bandara Mutiara Palu Jl. Abdurahman Saleh Biroboli - Sulawesi Tengah'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Syukuran Aminuddin Amir - Banggai', 'alamat' => 'Jl. Dr. Moh. Hatta Bandara Bubung Luwuk'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Kasiguncu - Poso', 'alamat' => 'Jl. Bandara Kasiguncu no. 202 Poso'],  
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Sultan Bantilan - Tolitoli', 'alamat' => 'Komplek Bandar Udara Sultan Bantilan, Lalos, Galang, Tolitoli'],
            ['nama_unit_kerja' => 'Sta. Pemantau Atmosfer Global Lore Lindu Bariri - Poso', 'alamat' => 'Jl. Sapta Marga No.01, Birobuli Utara, Kec. Palu Sel., Kota Palu, Sulawesi Tengah 94111'],
            ['nama_unit_kerja' => 'Sta. Geof. Kelas III Ternate', 'alamat' => 'Jl. Balibunga, Kel. Tabona, Kec. Ternate Selatan, Kota Ternate'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas I Sultan Babullah - Ternate', 'alamat' => 'JALAN BANDARA TERNATE 97728, KEL. TAFURE, KEC. TERNATE UTARA, TERNATE PROV. MALUKU UTARA'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Gamarmalamo - Halmahera Utara', 'alamat' => 'Jl. Bandara Udara Gamar Malamo Ds. Dokulamo Kec. Galela Barat Kab. Halmahera Utara'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Oesman Sadik - Halmahera Selatan', 'alamat' => 'Komp. BMG Bandara Oesman Sadik Labuha Bacan Halmahera Selatan 97791'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Emalamo - Kepulauan Sula', 'alamat' => 'Jl. Meteor, Fogi, Sanana, Kepulauan Sula, Maluku Utara. Kode Pos : 97795'],
            ['nama_unit_kerja' => 'Sta. Geof. Kelas IV Kendari', 'alamat' => 'Jln. R.E. Martadinata No. 154 Kel. Purirano Kendari, Sulawesi Tenggara (93129)'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Betoambari - Baubau', 'alamat' => 'Stasiun Meteorologi Betoambari Kompleks Bandar Udara Betoambari Baubau Sulawesi Tenggara'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Sangia Ni Bandera - Kolaka', 'alamat' => 'Jl. Protokol no. 1 Pomalaa Kolaka'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas II Maritim Kendari', 'alamat' => 'Jln. Jendral Sudirman no. 158 Kel. Kampung Salo Kec. Kendari Kota Kendari Sulawesi Tenggara'],
            ['nama_unit_kerja' => 'Sta. Klim. Kelas IV Sulawesi Tenggara', 'alamat' => ''],
            ['nama_unit_kerja' => 'Sta. Met. Kelas I Djalaluddin - Gorontalo', 'alamat' => 'Jl. Bandara Djalaluddin Tantu, Desa Tolotio, Kec. Tibawa, Kabupaten Gorontalo, Gorontalo'],
            ['nama_unit_kerja' => 'Sta. Klim. Kelas IV Gorontalo', 'alamat' => 'Jalan B.J Habibie (desa moutong) Kec. Tilongkabila Kab. Bone Bolango'],
            ['nama_unit_kerja' => 'Sta. Geof. Kelas II Gorontalo', 'alamat' => 'Jl. Hi. Adam Hoesa, Desa Talumelito, Kec. Telaga Biru, Gorontalo 96181'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas II Tampa Padang Mamuju', 'alamat' => 'Jln. Lettu Muh. Yamin No. 13 Majene'],
            ['nama_unit_kerja' => 'Sta. Geof. Kelas I Jayapura', 'alamat' => 'Jalan Drs. Krisna Sunarya No.26, Angkasapura, Kec. Jayapura Utara, Kota Jayapura, Papua 99114'],
            ['nama_unit_kerja' => 'Sta. Geof. Kelas III Sorong', 'alamat' => 'Jl. Danau Siwiki, Puncak Cendrawasih, Kota Sorong, Papua Barat'],
            ['nama_unit_kerja' => 'Sta. Klim. Kelas III Jayapura', 'alamat' => 'JL. Yaring Tabri No.69, Tabri, Nimboran, Kabupaten Jayapura, Papua.'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas I Frans Kaisiepo - Biak Numfor', 'alamat' => 'Jln. Moh. Yamin, Kel. Mandala, Kec. Biak Kota, Kab. Biak Numfor Papua (KP.98511)'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Maritim Dok II - Jayapura', 'alamat' => 'Jl. Soa Siu, Kel. Bhayangkara, Kec. Jayapura Utara, Kota Jayapura, Papua (kantor operasional)'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Enarotali - Paniai', 'alamat' => 'Jl. Titina Yogi, Kompleks Bandar Udara Enarotali, Distrik Paniai Timur Kabupaten Paniai'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Mararena - Sarmi', 'alamat' => 'Jl. Inpres Mararena Kabupaten Sarmi'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Mopah - Merauke', 'alamat' => 'Jl PGT Bandar Udara Mopah Merauke, Rimba Jaya, Merauke Papua Selatan 99615'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Sudjarwo Tjondro Negoro - Kepulauan Yapen', 'alamat' => 'Jalan Jenderal Sudirman, Serui Kota, Yapen Selatan'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Tanah Merah - Boven Digul', 'alamat' => 'Kompleks Perumahan Bandar Udara Tanah Merah'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Mozez Kilangin - Mimika', 'alamat' => 'Jl. Raya Freeport, Bandar Udara Mozes Kilangin Timika,Papua'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Wamena - Jayawijaya', 'alamat' => 'Jln.Gatot Subroto 101 Wamena Papua'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas I Sentani - Jayapura', 'alamat' => 'Jln. Yabaso, Samping hanggar Heli, Komp. Bandar Udara Sentani, Sentani, Kab. Jayapura, Papua'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Nabire', 'alamat' => 'Jln. Sisingamangaraja No. 1 (komplek bandara)'],
            ['nama_unit_kerja' => 'Sta. Klim. Kelas IV Merauke', 'alamat' => 'Jl. Poros Semangga-Tanah Miring, dist. Tanah Miring'],
            ['nama_unit_kerja' => 'Sta. Geof. Kelas III Nabire', 'alamat' => 'Jl. Matoa (Dekat Putaran 1), Kalibobo, Nabire, Nabire - Papua Tengah (98818)'],
            ['nama_unit_kerja' => 'Sta. Klim. Kelas III Papua Barat', 'alamat' => 'Jl. Sujarwo Condronegoro, SH. Ransiki, Kabupaten Manokwari Selatan, Provinsi Papua Barat'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas I Domine Eduard Osok - Sorong', 'alamat' => 'Komplek Bandar Udara Domine Eduard Osok , Sorong - Papua Barat'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Rendani - Manokwari', 'alamat' => 'Jl. Trikora Rendani Manokwari - Papua Barat 98315'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Torea - Fakfak', 'alamat' => 'Jl. Adi Sucipto No.01 Bandar Udara Torea Fakfak'],
            ['nama_unit_kerja' => 'Sta. Met. Kelas III Utarom - Kaimana', 'alamat' => 'Jalan Bandara Utarom (Stasiun Meteorologi Utarom Kaimana), Kaimana, Papua Barat, 98654'],
            ['nama_unit_kerja' => 'Sta. Pemantau Atmosfer Global Puncak Vihara Klademak - Sorong', 'alamat' => 'Jl. Sungai Remu KM.08 Malanu, Malaingkedi, Kota Sorong, Papua Barat'],
            ['nama_unit_kerja' => 'Kepala BMKG', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10610'],
            ['nama_unit_kerja' => 'Sekretariat Utama – Biro Perencanaan', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10611'],
            ['nama_unit_kerja' => 'Sekretariat Utama – Biro Hukum, Hubungan Masyarakat, dan Kerja Sama', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10612'],
            ['nama_unit_kerja' => 'Sekretariat Utama – Biro Umum dan Keuangan', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10613'],
            ['nama_unit_kerja' => 'Sekretariat Utama – Biro Sumber Daya Manusia dan Organisasi', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10614'],
            ['nama_unit_kerja' => 'Inspektorat', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10615'],
            ['nama_unit_kerja' => 'Deputi Bidang Meteorologi – Direktorat Meteorologi Penerbangan', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10616'],
            ['nama_unit_kerja' => 'Deputi Bidang Meteorologi – Direktorat Meteorologi Maritim', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10617'],
            ['nama_unit_kerja' => 'Deputi Bidang Meteorologi – Direktorat Meteorologi Publik', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10618'],
            ['nama_unit_kerja' => 'Deputi Bidang Klimatologi – Direktorat Perubahan Iklim', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10619'],
            ['nama_unit_kerja' => 'Deputi Bidang Klimatologi – Direktorat Layanan Iklim Terapan', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10620'],
            ['nama_unit_kerja' => 'Deputi Bidang Geofisika – Direktorat Gempa Bumi dan Tsunami', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10621'],
            ['nama_unit_kerja' => 'Deputi Bidang Geofisika – Direktorat Sesimologi Teknik, Geofisika Potensial, dan Tanda Waktu', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10622'],
            ['nama_unit_kerja' => 'Deputi Bidang Infrastruktur Meteorologi, Klimatologi, dan Geofisika – Direktorat Instrumentasi dan Kalibrasi', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10623'],
            ['nama_unit_kerja' => 'Deputi Bidang Infrastruktur Meteorologi, Klimatologi, dan Geofisika – Direktorat Data dan Komputasi', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10624'],
            ['nama_unit_kerja' => 'Deputi Bidang Infrastruktur Meteorologi, Klimatologi, dan Geofisika – Direktorat Sistem Jaringan dan Komunikasi', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10625'],
            ['nama_unit_kerja' => 'Deputi Bidang Modifikasi Cuaca – Direktorat Tata Kelola Modifikasi Cuaca', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10626'],
            ['nama_unit_kerja' => 'Deputi Bidang Modifikasi Cuaca – Direktorat Operasional Modifikasi Cuaca', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10627'],
            ['nama_unit_kerja' => 'Pusat Standarisasi Instrumen Meteorologi, Klimatologi, dan Geofisika', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10628'],
            ['nama_unit_kerja' => 'Pusat Pengembangan Sumber Daya Manusia Meteorologi, Klimatologi, dan Geofisika', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10629'],
            ['nama_unit_kerja' => 'Pusat Pembinaan Jabatan Fungsional Meteorologi, Klimatologi, dan Geofisika', 'alamat' => 'Jalan Angkasa I Nomor 2, Kemayoran, Jakarta Pusat, DKI Jakarta, 10630'],
        ];  
  
        foreach ($data as $unit) {  
            UnitKerja::create($unit);  
        }  
    }  
}  
