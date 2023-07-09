% functional structure
= beranda
- tata cara penilaian << 
- pedoman penilaian << 
- profil pengguna << 
- tentang aplikasi << 
- grafik penilaian 

= penilaian
> pilih pegawai (pilih_pegawai) (list pegawai)
> penilaian kinerja (nilai_pegawai) (form penilaian)
  - txtCode
  - txtValue
> result

= riwayat penilaian (riwayat_penilaian) (list_penilaian by current pegawai)
= tentang
= keluar

% table structure
= user_roles
  - id
  - name
= users
  - id
  - email
  - password
  - name
  - avatar
= jabatan_registers
  - id
  - name
= dinas_registers
  - id
  - name
= pegawais
  - user_id
  - nip
  - jabatan_id
  - dinas_id
= faktor_penilaians
  - code, name
= nilai_registers
  - id
  - name
= penilaians
  - pegawai_penilai
  - pegawai_dinilai
  - penilaian (json array)
    ['faktor_name':'nilai_id','faktor_name':'nilai_id',]



TODOS
# database migration #
# making model
- user_model #
- auth_model #
- pegawai_model #
- penilaian_model #
# integration
# admin features
## pengaturan organisasi
### Dinas
### Jabatan
## pengaturan algo
### faktor penilaian
