@extends('layouts.main')

@section('container')
    @php
        $heroImage = $jumbotron->main_image ?? null;
        $heroTitle = trim(strip_tags($jumbotron->title ?? 'Rumah Sakit Livasya Majalengka'));
        $heroDescription = trim(strip_tags($jumbotron->title_description ?? 'Rumah sakit di Majalengka dengan layanan kesehatan keluarga, dokter, fasilitas medis, dan pelayanan yang mudah diakses.'));
        $jumlahPasienPuas = $identity->jml_pasien_puas ?? 0;
        $jumlahFasilitasKamar = $identity->jml_fasilitas_kamar ?? 0;
        $youtubeEmbed = $identity->youtube_link_video ?? '';
        $youtubeUrl = $identity->youtube ?? '#';
        $featuredPosts = $post->take(3);
        $quickMenus = [
            [
                'title' => 'Pelayanan',
                'text' => 'Lihat layanan medis RS Livasya.',
                'url' => '/pelayanan',
                'icon' => 'fas fa-heartbeat',
                'gradient' => 'linear-gradient(135deg, #ef4444, #f97316)',
                'shadow' => 'rgba(239, 68, 68, 0.25)'
            ],
            [
                'title' => 'Cari Dokter',
                'text' => 'Temukan dokter dan jadwal praktik.',
                'url' => '/dokter',
                'icon' => 'fas fa-user-md',
                'gradient' => 'linear-gradient(135deg, #3b82f6, #6366f1)',
                'shadow' => 'rgba(59, 130, 246, 0.25)'
            ],
            [
                'title' => 'Jadwal Dokter',
                'text' => 'Cek jadwal sebelum berkunjung.',
                'url' => '/jadwal-dokter',
                'icon' => 'fas fa-calendar-check',
                'gradient' => 'linear-gradient(135deg, #10b981, #059669)',
                'shadow' => 'rgba(16, 185, 129, 0.25)'
            ],
            [
                'title' => 'Fasilitas',
                'text' => 'Kenali fasilitas rumah sakit.',
                'url' => '/fasilitas-unggulan',
                'icon' => 'fas fa-hospital',
                'gradient' => 'linear-gradient(135deg, #f59e0b, #d97706)',
                'shadow' => 'rgba(245, 158, 11, 0.25)'
            ],
            [
                'title' => 'Berita',
                'text' => 'Baca edukasi dan kabar terbaru.',
                'url' => '/posts',
                'icon' => 'fas fa-newspaper',
                'gradient' => 'linear-gradient(135deg, #8b5cf6, #ec4899)',
                'shadow' => 'rgba(139, 92, 246, 0.25)'
            ],
            [
                'title' => 'Karir',
                'text' => 'Lihat lowongan RS Livasya.',
                'url' => '/career',
                'icon' => 'fas fa-briefcase-medical',
                'gradient' => 'linear-gradient(135deg, #06b6d4, #0891b2)',
                'shadow' => 'rgba(6, 182, 212, 0.25)'
            ],
        ];
        $homeFaqs = [
            [
                'question' => 'Apakah RS Livasya melayani pasien di Majalengka dan sekitarnya?',
                'answer' => 'Ya. RS Livasya berada di Majalengka dan menyediakan informasi layanan kesehatan, dokter, fasilitas medis, dan jadwal dokter untuk masyarakat Majalengka dan sekitarnya.',
            ],
            [
                'question' => 'Bagaimana cara melihat jadwal dokter RS Livasya?',
                'answer' => 'Pengunjung dapat membuka menu Jadwal Dokter atau Cari Dokter untuk melihat informasi dokter dan jadwal praktik yang tersedia.',
            ],
            [
                'question' => 'Apakah pendaftaran online tersedia?',
                'answer' => 'Tersedia. Tombol Daftar Sekarang mengarahkan pengunjung ke kanal pendaftaran online resmi RS Livasya.',
            ],
        ];
    @endphp

    <style>
        .home-page {
            background: #ffffff;
        }

        .home-hero {
            position: relative;
            min-height: 680px;
            display: flex;
            align-items: center;
            padding: 14rem 9% 7rem;
            background:
                linear-gradient(90deg, rgba(255, 255, 255, .97) 0%, rgba(255, 255, 255, .86) 48%, rgba(255, 255, 255, .42) 100%),
                url("{{ $heroImage ? asset('storage/' . $heroImage) : asset('img/rsialivasya.webp') }}") center right / cover no-repeat;
            overflow: hidden;
        }

        .hero-layout {
            position: relative;
            z-index: 1;
            width: 100%;
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(300px, .72fr);
            gap: 42px;
            align-items: center;
        }

        .home-hero::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 90px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0), #ffffff);
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            max-width: 720px;
        }

        .hero-spotlight {
            justify-self: end;
            width: min(420px, 100%);
        }

        .spotlight-card {
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.08);
            backdrop-filter: blur(14px);
            transition: all 0.3s ease;
        }

        .spotlight-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 40px 75px rgba(0, 0, 0, 0.12);
        }

        .spotlight-image {
            min-height: 220px;
            background: url("{{ asset('img/rsialivasya.webp') }}") center / cover no-repeat;
        }

        .spotlight-body {
            padding: 26px;
        }

        .spotlight-body h2 {
            margin: 0;
            color: #1f2937;
            font-size: 1.8rem;
            font-weight: 800;
            line-height: 1.35;
        }

        .spotlight-body p {
            margin: 12px 0 0;
            color: #4b5563;
            font-size: 13.5px;
            line-height: 1.6;
        }

        .spotlight-list {
            display: grid;
            gap: 10px;
            margin: 18px 0 0;
            padding: 0;
            list-style: none;
        }

        .spotlight-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #29455d;
            font-size: 1.42rem;
            font-weight: 600;
        }

        .spotlight-list i {
            color: var(--secondary);
        }

        .hero-kicker,
        .section-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
            color: var(--primary);
            font-size: 1.35rem;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .hero-kicker::before,
        .section-kicker::before {
            content: "";
            width: 36px;
            height: 3px;
            border-radius: 999px;
            background: var(--secondary);
        }

        .hero-title {
            margin: 0;
            max-width: 680px;
            color: #17324d;
            font-size: clamp(3.2rem, 5vw, 6.4rem);
            line-height: 1.08;
            font-weight: 800;
            letter-spacing: 0;
            text-shadow: none;
            text-transform: none;
        }

        .hero-copy {
            max-width: 620px;
            margin: 22px 0 0;
            color: #43566b;
            font-size: 1.8rem;
            line-height: 1.8;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 30px;
        }

        .home-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 1.55rem;
            font-weight: 700;
            text-decoration: none;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .home-btn:hover {
            transform: translateY(-2px);
            text-decoration: none;
        }

        .home-btn-primary {
            color: #ffffff;
            background: var(--primary);
            box-shadow: 0 12px 28px rgba(0, 108, 191, .22);
        }

        .home-btn-secondary {
            color: var(--primary);
            background: #ffffff;
            border: 1px solid #d8e7f2;
        }

        .hero-trust {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            max-width: 760px;
            margin-top: 38px;
        }

        .trust-item {
            padding: 18px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: rgba(255, 255, 255, .9);
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
            transition: all 0.2s ease;
        }

        .trust-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            border-color: #cbd5e1;
        }

        .trust-item i {
            color: var(--primary);
            font-size: 2.4rem;
        }

        .trust-item strong {
            display: block;
            margin-top: 10px;
            color: #17324d;
            font-size: 2.6rem;
            line-height: 1;
        }

        .trust-item span {
            display: block;
            margin-top: 6px;
            color: #6a7b8c;
            font-size: 1.35rem;
        }

        .seo-intro,
        .home-section {
            padding: 7rem 9%;
        }

        .quick-access {
            position: relative;
            z-index: 2;
            margin-top: -54px;
            padding: 0 9% 6rem;
        }

        .quick-grid {
            display: grid;
            grid-template-columns: repeat(6, minmax(0, 1fr));
            gap: 14px;
        }

        .quick-card {
            min-height: 150px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            color: #17324d;
            text-decoration: none;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }

        .quick-card:hover {
            color: #17324d;
            text-decoration: none;
            transform: translateY(-5px);
            box-shadow: 0 16px 30px rgba(0, 0, 0, 0.08);
            border-color: #bfdbfe;
        }

        .quick-card:hover .quick-icon {
            transform: scale(1.1) rotate(3deg);
        }

        .quick-icon {
            width: 44px;
            height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            border-radius: 8px;
            color: #ffffff;
            background: linear-gradient(135deg, var(--primary), #16a085);
            box-shadow: 0 10px 22px rgba(0, 108, 191, .18);
            transition: all 0.3s ease;
        }

        .quick-icon i,
        .service-icon i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 2rem;
            line-height: 1;
            width: 1em;
            height: 1em;
        }

        .quick-card strong {
            display: block;
            font-size: 1.55rem;
            line-height: 1.25;
        }

        .quick-card .quick-text {
            display: block;
            margin-top: 8px;
            color: #617487;
            font-size: 1.25rem;
            line-height: 1.55;
        }

        .seo-intro {
            background: #ffffff;
        }

        .intro-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(280px, .9fr);
            gap: 36px;
            align-items: center;
        }

        .section-title {
            margin: 0;
            color: #17324d;
            font-size: clamp(2.8rem, 3vw, 4.2rem);
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: 0;
            text-transform: none;
            text-shadow: none;
        }

        .section-copy {
            margin: 18px 0 0;
            color: #52677b;
            font-size: 1.65rem;
            line-height: 1.8;
        }

        .intro-list {
            display: grid;
            gap: 12px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .intro-list li {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 16px;
            border: 1px solid #e0edf4;
            border-radius: 8px;
            background: #f8fcff;
            color: #2f455a;
            font-size: 1.5rem;
            line-height: 1.6;
        }

        .intro-list i {
            margin-top: 4px;
            color: var(--secondary);
        }

        .service-section {
            background: #f5f9fc;
        }

        .service-section-refined {
            position: relative;
            overflow: hidden;
        }

        .service-section-refined::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(135deg, rgba(0, 108, 191, .08), rgba(22, 160, 133, .05)),
                radial-gradient(circle at 90% 10%, rgba(233, 127, 13, .10), transparent 34%);
            pointer-events: none;
        }

        .service-section-refined > * {
            position: relative;
            z-index: 1;
        }

        .service-header {
            display: flex;
            justify-content: space-between;
            gap: 24px;
            align-items: end;
            margin-bottom: 34px;
        }

        .service-showcase {
            display: grid;
            grid-template-columns: minmax(280px, .72fr) minmax(0, 1.28fr);
            gap: 22px;
            margin-bottom: 26px;
        }

        .service-feature {
            min-height: 310px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 30px;
            border-radius: 8px;
            color: #ffffff;
            background:
                linear-gradient(135deg, rgba(0, 108, 191, .95), rgba(22, 160, 133, .92)),
                url("{{ asset('img/rsialivasya.webp') }}") center / cover no-repeat;
            box-shadow: 0 24px 58px rgba(0, 108, 191, .20);
        }

        .service-feature .service-icon {
            background: rgba(255, 255, 255, .18);
            border: 1px solid rgba(255, 255, 255, .30);
        }

        .service-feature h3 {
            margin: 22px 0 12px;
            font-size: 2.7rem;
            font-weight: 800;
            line-height: 1.18;
        }

        .service-feature p {
            margin: 0;
            color: rgba(255, 255, 255, .88);
            font-size: 1.5rem;
            line-height: 1.75;
        }

        .service-feature-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            width: fit-content;
            margin-top: 24px;
            color: #ffffff;
            font-size: 1.45rem;
            font-weight: 800;
            text-decoration: none;
        }

        .service-feature-link:hover {
            color: #ffffff;
            text-decoration: none;
            transform: translateX(4px);
        }

        .polyclinic-strip {
            min-height: 310px;
            padding: 22px;
            border-radius: 8px;
            background: #ffffff;
            border: 1px solid #e0edf4;
            box-shadow: 0 18px 42px rgba(16, 58, 90, .08);
        }

        .polyclinic-strip h3 {
            margin: 0 0 16px;
            color: #17324d;
            font-size: 1.9rem;
            font-weight: 800;
        }

        .polyclinic-list {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .polyclinic-empty {
            min-height: 220px;
            display: grid;
            place-items: center;
            border-radius: 8px;
            color: #617487;
            background: #f8fcff;
            font-size: 1.45rem;
        }

        .polyclinic-card {
            min-height: 124px;
            display: grid;
            place-items: center;
            padding: 16px;
            border-radius: 12px;
            background: #f8fcff;
            text-align: center;
            border: 1px solid #e9f1f6;
            transition: all 0.2s ease;
        }

        .polyclinic-card:hover {
            transform: translateY(-2px);
            border-color: #bfdbfe;
            box-shadow: 0 6px 15px rgba(37, 99, 235, 0.06);
        }

        .polyclinic-card img {
            width: 48px;
            height: 48px;
            object-fit: contain;
        }

        .polyclinic-card span {
            display: block;
            margin-top: 12px;
            color: #17324d;
            font-size: 1.45rem;
            font-weight: 700;
        }

        .service-grid,
        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .service-card {
            height: 100%;
            display: flex;
            flex-direction: column;
            padding: 26px;
            border-radius: 16px;
            background: #ffffff;
            color: #17324d;
            text-decoration: none;
            border: 1px solid #e0edf4;
            box-shadow: 0 14px 34px rgba(16, 58, 90, .07);
            transition: all 0.3s ease;
        }

        .service-card::after {
            content: "Lihat detail";
            display: inline-flex;
            align-items: center;
            width: fit-content;
            margin-top: auto;
            padding-top: 18px;
            color: var(--primary);
            font-size: 1.35rem;
            font-weight: 800;
        }

        .service-card:hover {
            color: #17324d;
            text-decoration: none;
            transform: translateY(-4px);
            box-shadow: 0 20px 42px rgba(16, 58, 90, .12);
        }

        .service-card:hover .service-icon {
            transform: scale(1.1) rotate(3deg);
        }

        .service-icon {
            width: 58px;
            height: 58px;
            display: grid;
            place-items: center;
            border-radius: 8px;
            color: #ffffff;
            background: linear-gradient(135deg, var(--primary), #16a085);
            transition: all 0.3s ease;
            font-size: 2.5rem;
        }

        .service-feature .service-icon i {
            font-size: 2.2rem;
        }

        .service-card h3 {
            margin: 22px 0 10px;
            font-size: 2rem;
            font-weight: 800;
        }

        .service-card p {
            margin: 0;
            color: #617487;
            font-size: 1.45rem;
            line-height: 1.7;
        }

        .schedule-card {
            display: grid;
            grid-template-columns: minmax(0, .9fr) minmax(280px, 1.1fr);
            gap: 34px;
            align-items: center;
            padding: 34px;
            border-radius: 16px;
            background: #ffffff;
            border: 1px solid #e0edf4;
            box-shadow: 0 18px 44px rgba(16, 58, 90, .08);
        }

        .schedule-image img,
        .schedule-image .schedule-placeholder {
            width: 100%;
            border-radius: 12px;
        }

        .schedule-placeholder {
            min-height: 280px;
            display: grid;
            place-items: center;
            color: #6d7d8c;
            background: #f2f7fa;
            font-size: 1.6rem;
        }

        .news-card {
            overflow: hidden;
            border-radius: 16px;
            background: #ffffff;
            border: 1px solid #e0edf4;
            box-shadow: 0 14px 34px rgba(16, 58, 90, .07);
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        .instagram-embed-wrapper {
            max-height: 480px;
            overflow-y: auto;
            overflow-x: hidden;
            border-radius: 16px;
            background: #ffffff;
            border: 1px solid #e0edf4;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
            width: 100%;
            height: 100%;
            padding: 8px;
        }

        /* Customize scrollbar inside instagram embed wrapper */
        .instagram-embed-wrapper::-webkit-scrollbar {
            width: 6px;
        }
        .instagram-embed-wrapper::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 16px;
        }
        .instagram-embed-wrapper::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 16px;
        }
        .instagram-embed-wrapper::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .news-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 42px rgba(16, 58, 90, .12);
        }

        .news-thumb {
            display: block;
            height: 240px;
            background-size: cover;
            background-position: center;
        }

        .news-body {
            padding: 22px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .news-body h3 {
            margin: 0 0 12px;
            color: #1f2937;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.45;
        }

        .news-body h3 a {
            color: #1f2937 !important;
            transition: color 0.2s;
        }

        .news-body h3 a:hover {
            color: #2563eb !important;
            text-decoration: none !important;
        }

        .news-body p {
            margin: 0;
            color: #4b5563;
            font-size: 13px;
            line-height: 1.6;
        }

        .btn-read-more {
            display: inline-flex;
            align-items: center;
            color: #2563eb;
            font-weight: 700;
            font-size: 13px;
            text-decoration: none !important;
            transition: all 0.2s;
        }

        .btn-read-more:hover {
            color: #1d4ed8;
        }

        .btn-read-more i {
            transition: transform 0.2s;
        }

        .btn-read-more:hover i {
            transform: translateX(4px);
        }

        .media-section {
            background: #f5f9fc;
        }

        .media-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(280px, .85fr);
            gap: 30px;
            align-items: center;
        }

        .video-shell,
        .map-shell {
            overflow: hidden;
            border-radius: 8px;
            background: #ffffff;
            border: 1px solid #e0edf4;
            box-shadow: 0 18px 44px rgba(16, 58, 90, .08);
        }

        .video-shell iframe,
        .map-shell iframe {
            width: 100%;
            border: 0;
        }

        .video-shell iframe {
            min-height: 420px;
        }

        .map-shell iframe {
            min-height: 440px;
        }

        .faq-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-top: 30px;
        }

        .faq-card {
            padding: 24px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
            height: 100%;
            transition: all 0.2s ease;
        }

        .faq-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            border-color: #cbd5e1;
        }



        @media (max-width: 991px) {
            .home-hero {
                min-height: auto;
                padding-top: 13rem;
                background:
                    linear-gradient(180deg, rgba(255, 255, 255, .96), rgba(255, 255, 255, .84)),
                    url("{{ $heroImage ? asset('storage/' . $heroImage) : asset('img/rsialivasya.webp') }}") center / cover no-repeat;
            }

            .hero-trust,
            .hero-layout,
            .quick-grid,
            .intro-grid,
            .service-showcase,
            .service-grid,
            .news-grid,
            .schedule-card,
            .media-grid,
            .faq-grid {
                grid-template-columns: 1fr;
            }

            .service-header {
                display: block;
            }

            .polyclinic-list {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 575px) {
            .home-hero,
            .quick-access,
            .seo-intro,
            .home-section {
                padding-left: 18px;
                padding-right: 18px;
            }

            .hero-spotlight {
                display: none;
            }

            .hero-actions {
                display: grid;
            }

            .home-btn {
                width: 100%;
            }

            .schedule-card {
                padding: 22px;
            }

            .polyclinic-list {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <main class="home-page">
        <section class="home-hero" id="home" aria-labelledby="home-title">
            <div class="hero-layout">
                <div class="hero-content">
                    <span class="hero-kicker">Rumah Sakit Livasya Majalengka</span>
                    <h1 class="hero-title" id="home-title">{!! $heroTitle !!}</h1>
                    <p class="hero-copy">
                        {{ $heroDescription }} RS Livasya hadir untuk membantu keluarga Majalengka mendapatkan informasi dokter, layanan medis, jadwal praktik, dan fasilitas rumah sakit dengan lebih mudah.
                    </p>

                    <div class="hero-actions">
                        <a href="https://dafol.livasya.com" target="_blank" rel="noopener" class="home-btn home-btn-primary">
                            Daftar Sekarang <span class="fas fa-chevron-right ml-2"></span>
                        </a>
                        <a href="/dokter" class="home-btn home-btn-secondary">
                            Cari Dokter <span class="fas fa-user-md ml-2"></span>
                        </a>
                    </div>

                    <div class="hero-trust" aria-label="Ringkasan Rumah Sakit Livasya">
                        <div class="trust-item">
                            <i class="fas fa-user-md" aria-hidden="true"></i>
                            <strong>{{ count($dokter) }}+</strong>
                            <span>Dokter aktif</span>
                        </div>
                        <div class="trust-item">
                            <i class="fas fa-users" aria-hidden="true"></i>
                            <strong>{{ $jumlahPasienPuas }}+</strong>
                            <span>Pasien puas</span>
                        </div>
                        <div class="trust-item">
                            <i class="fas fa-procedures" aria-hidden="true"></i>
                            <strong>{{ $jumlahFasilitasKamar }}+</strong>
                            <span>Tempat tidur</span>
                        </div>
                    </div>
                </div>

                <aside class="hero-spotlight" aria-label="Keunggulan Rumah Sakit Livasya">
                    <div class="spotlight-card">
                        <div class="spotlight-image"></div>
                        <div class="spotlight-body">
                            <h2>Akses layanan RS lebih cepat dari halaman depan.</h2>
                            <p>Pengunjung bisa langsung menuju pendaftaran, dokter, jadwal, pelayanan, dan fasilitas.</p>
                        </div>
                    </div>
                </aside>
            </div>
        </section>

        <nav class="quick-access" aria-label="Akses cepat Rumah Sakit Livasya">
            <div class="quick-grid">
                @foreach ($quickMenus as $menu)
                    <a href="{{ $menu['url'] }}" class="quick-card">
                        <span class="quick-icon" style="background: {{ $menu['gradient'] }}; box-shadow: 0 10px 22px {{ $menu['shadow'] }};"><i class="{{ $menu['icon'] }}" aria-hidden="true"></i></span>
                        <strong>{{ $menu['title'] }}</strong>
                        <span class="quick-text">{{ $menu['text'] }}</span>
                    </a>
                @endforeach
            </div>
        </nav>

        <section class="seo-intro" aria-labelledby="intro-title">
            <div class="intro-grid">
                <div>
                    <span class="section-kicker">Layanan Kesehatan Keluarga</span>
                    <h2 class="section-title" id="intro-title">RS Livasya, pilihan rumah sakit di Majalengka untuk layanan kesehatan yang mudah dijangkau.</h2>
                    <p class="section-copy">
                        Rumah Sakit Livasya Majalengka menyediakan informasi layanan medis, jadwal dokter, fasilitas rumah sakit, berita kesehatan, dan akses pendaftaran online dalam satu halaman yang ringkas.
                    </p>
                </div>
                <ul class="intro-list">
                    <li><i class="fas fa-check-circle" aria-hidden="true"></i><span>Informasi dokter dan jadwal praktik dapat ditemukan lebih cepat.</span></li>
                    <li><i class="fas fa-check-circle" aria-hidden="true"></i><span>Layanan rumah sakit disusun jelas untuk pasien Majalengka dan sekitarnya.</span></li>
                    <li><i class="fas fa-check-circle" aria-hidden="true"></i><span>Fasilitas, berita, dan lokasi tersedia untuk membantu pengunjung mengambil keputusan.</span></li>
                </ul>
            </div>
        </section>

        <section class="home-section service-section service-section-refined" aria-labelledby="service-title">
            <div class="service-header">
                <div>
                    <span class="section-kicker">Pelayanan</span>
                    <h2 class="section-title" id="service-title">Pelayanan RS Livasya</h2>
                    <p class="section-copy">Temukan layanan dan poliklinik Rumah Sakit Livasya Majalengka sesuai kebutuhan kesehatan Anda.</p>
                </div>
                <a href="/pelayanan" class="home-btn home-btn-secondary">Lihat Semua Pelayanan</a>
            </div>

            <div class="service-showcase">
                <article class="service-feature">
                    <div>
                        <span class="service-icon"><i class="fas fa-heartbeat" aria-hidden="true"></i></span>
                        <h3>Layanan RS yang lebih mudah dipilih dari depan halaman.</h3>
                        <p>Pengunjung bisa langsung melihat layanan utama, poliklinik, dan akses ke detail pelayanan tanpa harus scroll jauh.</p>
                    </div>
                    <a href="/pelayanan" class="service-feature-link">
                        Telusuri semua pelayanan <span class="fas fa-arrow-right"></span>
                    </a>
                </article>

                <div class="polyclinic-strip">
                    <h3>Poliklinik Unggulan</h3>
                    @if ($polikliniks->isNotEmpty())
                        <div class="polyclinic-list">
                            @foreach ($polikliniks->take(6) as $poliklinik)
                                <div class="polyclinic-card">
                                    <img src="{{ asset('storage/' . $poliklinik->image) }}" alt="Poliklinik {{ $poliklinik->name }} RS Livasya" width="48" height="48" loading="lazy" decoding="async">
                                    <span>{{ $poliklinik->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="polyclinic-empty">Data poliklinik belum tersedia.</div>
                    @endif
                </div>
            </div>

            @php
                $serviceColors = [
                    ['gradient' => 'linear-gradient(135deg, #ef4444, #f97316)', 'shadow' => 'rgba(239, 68, 68, 0.25)'], // Red/Orange
                    ['gradient' => 'linear-gradient(135deg, #3b82f6, #6366f1)', 'shadow' => 'rgba(59, 130, 246, 0.25)'], // Blue/Indigo
                    ['gradient' => 'linear-gradient(135deg, #10b981, #059669)', 'shadow' => 'rgba(16, 185, 129, 0.25)'], // Green
                    ['gradient' => 'linear-gradient(135deg, #06b6d4, #0891b2)', 'shadow' => 'rgba(6, 182, 212, 0.25)'], // Cyan/Teal
                    ['gradient' => 'linear-gradient(135deg, #8b5cf6, #ec4899)', 'shadow' => 'rgba(139, 92, 246, 0.25)'], // Purple/Pink
                    ['gradient' => 'linear-gradient(135deg, #f59e0b, #d97706)', 'shadow' => 'rgba(245, 158, 11, 0.25)']  // Amber/Orange
                ];
            @endphp

            <div class="service-grid">
                @foreach ($pelayanan->take(6) as $index => $p)
                    @php
                        $color = $serviceColors[$index % count($serviceColors)];
                    @endphp
                    <a href="/pelayanan/{{ $p->slug }}" class="service-card">
                        <span class="service-icon" style="background: {{ $color['gradient'] }}; box-shadow: 0 10px 22px {{ $color['shadow'] }};"><i class="{{ $p->icon }}" aria-hidden="true"></i></span>
                        <h3>{{ $p->title }}</h3>
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($p->excerpt ?? $p->body), 90) }}</p>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="home-section" aria-labelledby="schedule-title">
            <div class="schedule-card">
                <div>
                    <span class="section-kicker">Jadwal Dokter</span>
                    <h2 class="section-title" id="schedule-title">Cek jadwal dokter RS Livasya sebelum berkunjung.</h2>
                    <p class="section-copy">
                        Jadwal dokter membantu pasien memilih waktu kunjungan yang tepat. Gunakan halaman dokter untuk melihat informasi dokter dan pelayanan terkait.
                    </p>
                    <div class="hero-actions">
                        <a href="/jadwal-dokter" class="home-btn home-btn-primary">Lihat Jadwal Dokter</a>
                        <a href="/dokter" class="home-btn home-btn-secondary">Daftar Dokter</a>
                    </div>
                </div>
                <div class="schedule-image">
                    @if (isset($jadwal) && $jadwal && $jadwal->image)
                        <a href="{{ asset('/storage/' . $jadwal->image) }}" data-fancybox="group" data-caption="{{ $jadwal->caption }}">
                            <img src="{{ asset('/storage/' . $jadwal->image) }}" alt="Jadwal dokter Rumah Sakit Livasya Majalengka" loading="lazy" decoding="async">
                        </a>
                    @else
                        <div class="schedule-placeholder">Jadwal dokter belum tersedia.</div>
                    @endif
                </div>
            </div>
        </section>

        <section class="home-section service-section" aria-labelledby="news-title">
            <div class="service-header">
                <div>
                    <span class="section-kicker">Berita Kesehatan</span>
                    <h2 class="section-title" id="news-title">Informasi terbaru dari RS Livasya</h2>
                    <p class="section-copy">Baca berita dan edukasi kesehatan terbaru dari Rumah Sakit Livasya Majalengka.</p>
                </div>
                <a href="/posts" class="home-btn home-btn-secondary">Lihat Semua Berita</a>
            </div>

            <div class="news-grid">
                @forelse ($featuredPosts as $p)
                    @if ($p->is_embeded)
                        <article class="news-card p-0" style="border: none; background: transparent; box-shadow: none;">
                            <div class="instagram-embed-wrapper">
                                {!! str_replace('//www.instagram.com/embed.js', 'https://www.instagram.com/embed.js', $p->body) !!}
                            </div>
                        </article>
                    @else
                        <article class="news-card">
                            <a href="/posts/{{ $p->slug }}" class="news-thumb" aria-label="{{ $p->title }}"
                                style="background-image: url({{ $p->image ? asset('/storage/' . $p->image) : asset('img/rsialivasya.webp') }});"></a>
                            <div class="news-body">
                                <div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="badge bg-light text-primary font-weight-bold" style="font-size: 10px; text-transform: uppercase;">{{ $p->category->name ?? 'Berita' }}</span>
                                        <span class="text-muted" style="font-size: 11px;"><i class="far fa-calendar-alt mr-1"></i> {{ $p->created_at->format('d M Y') }}</span>
                                    </div>
                                    <h3><a href="/posts/{{ $p->slug }}">{{ $p->title }}</a></h3>
                                    <p class="text-muted" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; height: 60px;">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($p->body), 118) }}
                                    </p>
                                </div>
                                <div class="pt-3 border-top mt-3">
                                    <a href="/posts/{{ $p->slug }}" class="btn-read-more">
                                        Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endif
                @empty
                    <p class="section-copy">Berita terbaru belum tersedia.</p>
                @endforelse
            </div>
        </section>

        <section class="home-section media-section" aria-labelledby="media-title">
            <div class="media-grid">
                <div>
                    <span class="section-kicker">Profil & Lokasi</span>
                    <h2 class="section-title" id="media-title">Kenali RS Livasya dan temukan lokasi kami.</h2>
                    <p class="section-copy">
                        Livasya berlokasi di Majalengka dan terus mengembangkan layanan untuk mendukung kebutuhan kesehatan masyarakat. Kunjungi kanal resmi kami untuk informasi terbaru.
                    </p>
                    @if ($youtubeUrl && $youtubeUrl !== '#')
                        <div class="hero-actions">
                            <a href="{{ $youtubeUrl }}" target="_blank" rel="noopener" class="home-btn home-btn-primary">Kunjungi YouTube</a>
                        </div>
                    @endif
                </div>
                <div class="video-shell">
                    <div class="embed-responsive embed-responsive-16by9">
                        {!! $youtubeEmbed !!}
                    </div>
                </div>
            </div>
        </section>

        <section class="home-section service-section" aria-labelledby="faq-title">
            <div class="service-header">
                <div>
                    <span class="section-kicker">Pertanyaan Umum</span>
                    <h2 class="section-title" id="faq-title">Informasi penting sebelum berkunjung ke RS Livasya</h2>
                    <p class="section-copy">Jawaban singkat untuk membantu pengunjung menemukan layanan rumah sakit di Majalengka dengan lebih cepat.</p>
                </div>
                <a href="/faq" class="home-btn home-btn-secondary">FAQ Lengkap</a>
            </div>
            <div class="faq-grid">
                @foreach ($homeFaqs as $index => $faq)
                    @php
                        $faqIcons = [
                            'fas fa-hospital-user',      // Hospital/Services
                            'fas fa-user-md',            // Doctor Schedule
                            'fas fa-laptop-medical'      // Online registration
                        ];
                        $faqColors = [
                            ['primary' => '#2563eb', 'bg' => '#eff6ff', 'border' => '#3b82f6'],
                            ['primary' => '#10b981', 'bg' => '#ecfdf5', 'border' => '#10b981'],
                            ['primary' => '#f59e0b', 'bg' => '#fffbeb', 'border' => '#f59e0b']
                        ];
                        $color = $faqColors[$index % count($faqColors)];
                        $icon = $faqIcons[$index % count($faqIcons)];
                    @endphp
                    <article class="faq-card" style="border-left: 4px solid {{ $color['border'] }};">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mr-3" 
                                 style="width: 40px; height: 40px; background-color: {{ $color['bg'] }}; color: {{ $color['primary'] }}; font-size: 16px; flex-shrink: 0;">
                                <i class="{{ $icon }}" aria-hidden="true"></i>
                            </div>
                            <h3 class="mb-0" style="font-size: 14.5px; font-weight: 700; color: #1f2937; line-height: 1.4;">{{ $faq['question'] }}</h3>
                        </div>
                        <p class="text-muted mb-0" style="font-size: 13px; line-height: 1.65; text-align: justify; padding-left: 56px;">{{ $faq['answer'] }}</p>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="home-section" aria-labelledby="location-title">
            <div class="service-header">
                <div>
                    <span class="section-kicker">Lokasi</span>
                    <h2 class="section-title" id="location-title">Temukan Rumah Sakit Livasya Majalengka</h2>
                    <p class="section-copy">Gunakan peta untuk melihat lokasi RS Livasya dan merencanakan kunjungan Anda.</p>
                </div>
            </div>
            <div class="map-shell">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.0386969407605!2d108.17566195081062!3d-6.765136368012836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f29b82be5b779%3A0xfc24e001da3669f9!2sRSIA%20Livasya%20Majalengka!5e0!3m2!1sid!2sid!4v1667793553251!5m2!1sid!2sid"
                    title="Lokasi Rumah Sakit Livasya Majalengka"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>
    </main>
@endsection
