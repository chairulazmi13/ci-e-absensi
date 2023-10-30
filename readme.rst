###################
Apa itu E-Absensi Borcode
###################

Aplikasi ini dibuat untuk melakukan absensi menggunakan barcode yang di generate by IP Address dan NIP Pegawai
, kemudiian scan barcode tersebut untuk melakukan absensi.

*******************
Persiapan
*******************
1. Set pengaturan ip address router wifi dari DHCP ke Statis
2. catat setiap ip address HP setiap pegawai atau user
3. siapkan barcode scanner.
4. gunakan PHP v.7

*******************
Pemakaian
*******************
1. login ke Admin 
	http://localhost/ci-e_absensi/admin-login
2. masuk ke Master Data -> Pegawai -> tambah
	 - isi data pagawai
	 - untuk IP Address, isi sesuai dengan ip di terdaftar di router
	 - simpan
3. coba login sebagai pegawai (password default gunakan NIP)
	http://localhost/ci-e_absensi/pegawai-login
4. di dashboard lalu klik Generate QR Code
5. gunakan barcode tersebut untuk di scan di halaman absensi
	http://localhost/ci-e_absensi/
6. jika IP di address tidak sama dengan IP yang terdaftar makan absensi akan gagal

Terima kasih :)

