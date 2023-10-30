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
1. login ke halaman Admin 
	http://localhost/ci-e_absensi/admin-login
.. image:: https://github.com/chairulazmi13/ci-e_absensi/blob/master/screenshot/admin-login.jpg
   :height: 500px

2. masuk ke Master Data -> Pegawai -> tambah
	 - isi data pagawai
	 - untuk IP Address, isi sesuai dengan ip di terdaftar di router
	 - lalu simpan
.. image:: https://github.com/chairulazmi13/ci-e_absensi/blob/master/screenshot/pegawai-master.jpg
   :height: 500px

3. coba login sebagai pegawai (password default gunakan NIP)
	http://localhost/ci-e_absensi/pegawai-login
.. image:: https://github.com/chairulazmi13/ci-e_absensi/blob/master/screenshot/pegawai-login.jpg

4. di dashboard lalu klik Generate QR Code

.. image:: https://github.com/chairulazmi13/ci-e_absensi/blob/master/screenshot/dashboard-pegawai.jpg

5. gunakan barcode tersebut untuk di scan di halaman absensi
	http://localhost/ci-e_absensi/
.. image:: https://github.com/chairulazmi13/ci-e_absensi/blob/master/screenshot/landing-page.jpg
   :height: 500px

6. jika IP di address tidak sama dengan IP yang terdaftar makan absensi akan gagal

Terima kasih :)

