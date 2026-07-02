Undangan Wawancara Kerja - RS Livasya

Halo {{ $applier->first_name }} {{ $applier->last_name }},

Terima kasih atas minat Anda untuk bergabung bersama kami. Kami dengan senang hati mengumumkan bahwa berkas administrasi Anda untuk posisi {{ $applier->career->title }} dinyatakan lolos seleksi.

Untuk tahap selanjutnya, kami mengundang Anda untuk menghadiri sesi wawancara yang telah dijadwalkan dengan detail sebagai berikut:

- Hari / Tanggal: {{ \Carbon\Carbon::parse($applier->interview_date)->locale('id')->translatedFormat('l, d F Y') }}
- Waktu: Pukul {{ $applier->interview_time }} WIB
- Metode: {{ $applier->interview_type == 'online' ? 'Online (Video Conference)' : 'Offline (Tatap Muka)' }}
@if($applier->interview_type == 'offline' && $applier->interview_location)
- Lokasi: {{ $applier->interview_location }}
@endif

@if($applier->interview_type == 'online')
Wawancara akan dilaksanakan secara online. Untuk mengakses tautan video conference dan bergabung ke sesi wawancara, silakan masuk ke dashboard akun pelamar Anda di portal karir kami pada waktu yang dijadwalkan.
@else
Mohon hadir di lokasi wawancara 15 menit sebelum jadwal dimulai dengan mengenakan pakaian formal dan membawa dokumen pendukung (CV cetak, portofolio, dsb.).
@endif

Apabila Anda berhalangan hadir atau memiliki pertanyaan lebih lanjut, silakan hubungi tim rekrutmen kami sesegera mungkin.

Salam hangat,
Tim HRD Rumah Sakit Livasya

---
RS Livasya Majalengka
Jl. Raya Barat No. 2, Majalengka, Jawa Barat, Indonesia
