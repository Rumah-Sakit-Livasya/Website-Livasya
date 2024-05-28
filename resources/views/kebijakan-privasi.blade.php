@extends('layouts.main')

@section('container')
    <section class="gallery bg-white py-5">
        <div class="container" style="margin-top: 8rem;">
            <h1 class="heading my-5 text-center"><span>Kebijakan</span> Privasi</h1>
            <div class="row justify-content-center align-items-start">
                <div class="col-lg-10">
                    <h3 class="mt-5">KEBIJAKAN PRIVASI</h3>
                    <p class="mt-3">
                        Kebijakan Privasi ini akan melingkupi penjelasan mengenai bagaimana informasi pengguna WEBSITE
                        ("PENGGUNA") dikumpulkan, digunakan, dan dijaga kerahasiaannya oleh PT LIVASYA SUDJONO
                        BERSAUDARA dan/atau beserta anak perusahaan ("KAMI") dengan tetap menghormati Hak PENGGUNA dalam
                        menggunakan situs www.livasya.com ("WEBSITE") KAMI.
                    </p>
                    <h5 class="mt-5" id="lingkup-kebijakan-privasi">A. Lingkup Kebijakan Privasi</h5>
                    <ol class="mt-3">
                        <li>Kebijakan Privasi ini mengatur penggunaan dan perlindungan informasi yang diberikan oleh
                            PENGGUNA ketika menggunakan Layanan pada WEBSITE.</li>
                        <li>Dengan menggunakan WEBSITE, maka PENGGUNA dianggap telah membaca Kebijakan Privasi ini
                            dan menyetujui mekanisme pengumpulan, penyimpanan, dan penggunaan Data Pribadi PENGGUNA
                            sebagaimana diatur dalam Kebijakan Privasi ini.</li>
                        <li>Apabila KAMI meminta PENGGUNA untuk memberikan informasi ketika menggunakan WEBSITE,
                            maka informasi tersebut itu hanya akan digunakan sesuai dengan Kebijakan Privasi ini.
                        </li>
                        <li>KAMI berhak untuk sewaktu-waktu mengubah, menghapus dan untuk menerapkan ketentuan baru
                            Kebijakan Privasi ini. PENGGUNA diharapkan untuk memeriksa halaman ini secara berkala
                            untuk mengetahui perubahan tersebut. Dengan menggunakan layanan WEBSITE setelah
                            terjadinya perubahan tersebut, PENGGUNA dianggap telah mengetahui dan menyetujui
                            perubahan-perubahan ketentuan pada Kebijakan Privasi ini.</li>
                    </ol>
                    <h5 class="mt-5" id="registrasi-layanan-janji-pertemuan-dan-atau-layanan-pemeriksaan-kesehatan">B.
                        Registrasi
                        Layanan Janji Pertemuan dan/atau Layanan Pemeriksaan Kesehatan</h5>
                    <ol class="mt-3">
                        <li>PENGGUNA akan melakukan pendaftaran untuk mendapatkan Layanan Janji Pertemuan dan/atau
                            Layanan Pemeriksaan Kesehatan pada WEBSITE.</li>
                        <li>Untuk melakukan pendaftaran Layanan Janji Pertemuan dan/atau Layanan Pemeriksaan
                            Kesehatan dalam WEBSITE, PENGGUNA harus memberikan informasi yang KAMI perlukan
                            sebagaimana tercantum pada Butir C di bawah ini.</li>
                    </ol>
                    <h5 class="mt-5" id="data-pribadi">C. Data Pribadi</h5>
                    <ol class="mt-3">
                        <li>KAMI mengumpulkan informasi yang diberikan PENGGUNA saat PENGGUNA membuat , mengirimkan
                            surat elektronik / surel / e-mail kepada KAMI atau meletakkan informasi atau konten lain
                            di WEBSITE</li>
                        <li>Informasi mengenai Data Pribadi yang wajib diisi oleh PENGGUNA saat melakukan Registrasi
                            Layanan Janji Pertemuan dan/atau Layanan Pemeriksaan Kesehatan di WEBSITE adalah sebagai
                            berikut:
                            <ol style="list-style-type: upper-alpha;">
                                <li>Layanan Janji Pertemuan
                                    <ol style="list-style-type: lower-alpha;">
                                        <li>Untuk Orang Lain atau untuk diri sendiri dan sudah pernah melakukan
                                            pendaftaran Layanan Janji Pertemuan sebelumnya:
                                            <ul>
                                                <li>Nama lengkap sesuai KTP</li>
                                                <li>Tanggal lahir</li>
                                                <li>Email</li>
                                                <li>Nomor Handphone</li>
                                            </ul>
                                        </li>
                                        <li>Untuk diri sendiri dan belum pernah melakukan pendaftaran Layanan Janji
                                            Pertemuan sebelumnya:
                                            <ul>
                                                <li>Jenis kartu identitas (KTP, KITAS, KITAP, Passport)</li>
                                                <li>Nomor kartu identitas</li>
                                                <li>Foto kartu identitas</li>
                                                <li>Nama lengkap sesuai KTP</li>
                                                <li>Jenis Kelamin</li>
                                                <li>Tanggal lahir</li>
                                                <li>Email</li>
                                                <li>Nomor Handphone</li>
                                            </ul>
                                        </li>
                                    </ol>
                                </li>
                                <li>Preregistrasi Layanan Pemeriksaan Kesehatan<br>Untuk PENGGUNA yang mendaftar
                                    untuk dirinya sendiri dan belum pernah melakukan pendaftaran sebelumnya (Form
                                    ini bersifat opsional):
                                    <ul>
                                        <li>Jenis kartu identitas (KTP, KITAS, KITAP, Passport)</li>
                                        <li>Nomor kartu identitas</li>
                                        <li>Foto kartu identitas</li>
                                        <li>Nama lengkap sesuai KTP</li>
                                        <li>Jenis Kelamin</li>
                                        <li>Kewarganegaraan</li>
                                        <li>Status pernikahan</li>
                                        <li>Agama</li>
                                        <li>Tempat lahir</li>
                                        <li>Tanggal lahir</li>
                                        <li>Email</li>
                                        <li>Nomor Handphone</li>
                                        <li>Informasi Alamat (Alamat, Kabupaten/kota, kecamatan, dan kelurahan)</li>
                                        <li>Nama Kerabat</li>
                                        <li>Nomor Handphone Kerabat</li>
                                    </ul>
                                </li>
                                <li>Registrasi Layanan Pemeriksaan Kesehatan
                                    <ul>
                                        <li>Nama lengkap sesuai KTP</li>
                                        <li>Jenis Kelamin</li>
                                        <li>Tanggal lahir</li>
                                        <li>Email</li>
                                        <li>Nomor Handphone</li>
                                    </ul>
                                </li>
                                <li>Data Akun Layanan Pemeriksaan Kesehatan
                                    <ul>
                                        <li>Nama Lengkap</li>
                                        <li>Tanggal Lahir</li>
                                        <li>Email</li>
                                    </ul>
                                </li>
                                <li>Pra Pemeriksaan Kesehatan
                                    <ol style="list-style-type: lower-alpha;">
                                        <li><em>Medical History Form</em>
                                            <ul>
                                                <li>Riwayat Pengobatan</li>
                                                <li>Riwayat Penyakit Dahulu</li>
                                                <li>Riwayat Vaksinasi</li>
                                                <li>Riwayat Penyakit Keluarga</li>
                                                <li>Riwayat Kebiasaan Merokok</li>
                                                <li>Riwayat Kebiasaan Berolahraga</li>
                                                <li>Riwayat Mengonsumsi Alkohol</li>
                                                <li>Khusus Wanita â€“ Riwayat Kesehatan Reproduksi</li>
                                            </ul>
                                        </li>
                                        <li><em>Occupational Hazards Form</em>
                                            <ul>
                                                <li>Bahaya Potensial Tempat Kerja</li>
                                                <li>Faktor Fisik</li>
                                                <li>Faktor Kimia</li>
                                                <li>Faktor Ergonomi</li>
                                                <li>Faktor Biologis</li>
                                                <li>Faktor Psikososial</li>
                                            </ul>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                        </li>
                        <li>KAMI juga berhak mengumpulkan informasi ketika PENGGUNA menggunakan WEBSITE, termasuk
                            tetapi tidak terbatas pada: , alamat WEBSITE yang merujuk dan aktivitas PENGGUNA di
                            WEBSITE. PENGGUNA dapat mengaktifkan atau menonaktifkan layanan pengenalan lokasi saat
                            PENGGUNA menggunakan WEBSITE.</li>
                        <li>KAMI berhak untuk melakukan verifikasi langsung kepada PENGGUNA atas informasi mengenai
                            data diri yang telah disampaikan PENGGUNA melalui WEBSITE.</li>
                        <li>Dengan menggunakan WEBSITE, PENGGUNA menjamin bahwa informasi yang PENGGUNA berikan
                            adalah akurat dan benar.</li>
                        <li>Apabila informasi yang PENGGUNA berikan tersebut ternyata tidak benar, maka KAMI tidak
                            bertanggung jawab atas segala akibat yang dapat terjadi sehubungan dengan pemberian dan
                            penggunaan informasi tidak benar tersebut.</li>
                    </ol>
                    <h5 class="mt-5"
                        id="tanggung-jawab-penggunaan-layanan-janji-pertemuan-dan-layanan-pemeriksaan-kesehatan">D.
                        Tanggung Jawab Penggunaan Layanan Janji Pertemuan dan Layanan Pemeriksaan Kesehatan</h5>
                    <p class="mt-3">
                        Bahwa dalam penggunaan Layanan Janji Pertemuan dan/atau Layanan Pemeriksaan Kesehatan, maka
                        PENGGUNA bertanggung jawab untuk:
                    </p>
                    <ol class="mt-3">
                        <li>Memberikan informasi dan data yang benar dan akurat pada saat melakukan registrasi di
                            WEBSITE;</li>
                        <li>Mengubah informasi dan data yang sudah tidak benar;</li>
                        <li>Menjaga kerahasiaan dan keamanan informasi dan data PENGGUNA yang ada di akun WEBSITE
                            PENGGUNA;</li>
                        <li>Mengaktifkan fitur keamanan tambahan apabila tersedia pada perangkat PENGGUNA;</li>
                        <li>Melaporkan kepada KAMI apabila terjadi penyalahgunaan akun atau pelanggaran keamanan
                            lainnya melalui layanan yang tersedia di WEBSITE;</li>
                        <li>Tidak menggunakan Layanan Janji Pertemuan dan Layanan Pemeriksaan Kesehatan untuk tujuan
                            yang bertentangan dengan ketentuan yang berlaku dalam Kebijakan Privasi ini atau
                            peraturan perundang-undangan yang berlaku.</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection
