<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Wawancara Kerja - RS Livasya</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .wrapper {
            width: 100%;
            background-color: #f4f6f8;
            padding: 30px 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }
        .header {
            background-color: #1b4ba1; /* Livasya Deep Blue */
            padding: 35px 30px;
            text-align: center;
            color: #ffffff;
            border-bottom: 4px solid #ea580c; /* Livasya Orange Accent Line */
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .content {
            padding: 40px 30px;
            color: #334155;
            line-height: 1.6;
        }
        .content p {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .schedule-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 25px;
            margin-bottom: 30px;
        }
        .schedule-title {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin-top: 0;
            margin-bottom: 15px;
            border-bottom: 2px solid #1b4ba1; /* Blue accent border */
            padding-bottom: 8px;
        }
        .schedule-item {
            margin-bottom: 12px;
            font-size: 15px;
        }
        .schedule-item:last-child {
            margin-bottom: 0;
        }
        .schedule-label {
            font-weight: 600;
            color: #64748b;
            display: inline-block;
            width: 130px;
        }
        .schedule-value {
            color: #0f172a;
            font-weight: 500;
        }
        .btn-container {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        .btn {
            display: inline-block;
            background-color: #ea580c; /* Livasya Orange */
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: 700;
            border-radius: 50px;
            box-shadow: 0 4px 6px rgba(234, 88, 12, 0.25);
            transition: background-color 0.2s;
        }
        .btn:hover {
            background-color: #c2410c; /* Livasya Darker Orange on hover */
        }
        .footer {
            background-color: #f1f5f9;
            padding: 25px 30px;
            text-align: center;
            font-size: 13px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
        }
        .footer p {
            margin: 0 0 10px 0;
        }
        .footer p:last-child {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1>Undangan Wawancara Kerja</h1>
            </div>
            
            <div class="content">
                <p>Halo <strong>{{ $applier->first_name }} {{ $applier->last_name }}</strong>,</p>
                
                <p>Terima kasih atas minat Anda untuk bergabung bersama kami. Kami dengan senang hati mengumumkan bahwa berkas administrasi Anda untuk posisi <strong>{{ $applier->career->title }}</strong> dinyatakan lolos seleksi.</p>
                
                <p>Untuk tahap selanjutnya, kami mengundang Anda untuk menghadiri sesi wawancara yang telah dijadwalkan dengan detail sebagai berikut:</p>
                
                <div class="schedule-card">
                    <h3 class="schedule-title">Detail Jadwal Wawancara</h3>
                    <div class="schedule-item">
                        <span class="schedule-label">Hari / Tanggal</span>
                        <span class="schedule-value">: {{ \Carbon\Carbon::parse($applier->interview_date)->locale('id')->translatedFormat('l, d F Y') }}</span>
                    </div>
                    <div class="schedule-item">
                        <span class="schedule-label">Waktu</span>
                        <span class="schedule-value">: Pukul {{ $applier->interview_time }} WIB</span>
                    </div>
                    <div class="schedule-item">
                        <span class="schedule-label">Metode</span>
                        <span class="schedule-value">: {{ $applier->interview_type == 'online' ? 'Online (Video Conference)' : 'Offline (Tatap Muka)' }}</span>
                    </div>
                    @if($applier->interview_type == 'offline' && $applier->interview_location)
                        <div class="schedule-item">
                            <span class="schedule-label">Lokasi</span>
                            <span class="schedule-value">: {{ $applier->interview_location }}</span>
                        </div>
                    @endif
                </div>
                
                @if($applier->interview_type == 'online' && $vconLink)
                    <p>Wawancara akan dilaksanakan secara online. Silakan bergabung menggunakan tombol video conference di bawah ini tepat pada waktu yang dijadwalkan:</p>
                    <div class="btn-container">
                        <a href="{{ $vconLink }}" target="_blank" class="btn">Gabung Video Conference</a>
                    </div>
                @else
                    <p>Mohon hadir di lokasi wawancara 15 menit sebelum jadwal dimulai dengan mengenakan pakaian formal dan membawa dokumen pendukung (CV cetak, portofolio, dsb.).</p>
                @endif
                
                <p style="margin-top: 30px;">Apabila Anda berhalangan hadir atau memiliki pertanyaan lebih lanjut, silakan hubungi tim rekrutmen kami sesegera mungkin.</p>
                
                <p>Salam hangat,<br><strong>Tim HRD Rumah Sakit Livasya</strong></p>
            </div>
            
            <div class="footer">
                <p>&copy; {{ date('Y') }} RS Livasya Majalengka. All rights reserved.</p>
                <p>Jl. Raya Barat No. 2, Majalengka, Jawa Barat, Indonesia</p>
            </div>
        </div>
    </div>
</body>
</html>
