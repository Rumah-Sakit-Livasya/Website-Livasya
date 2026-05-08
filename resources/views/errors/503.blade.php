@php
    $headers = isset($exception) && method_exists($exception, 'getHeaders') ? $exception->getHeaders() : [];
    $retryAfter = $headers['Retry-After'] ?? null;
    $retrySeconds = is_numeric($retryAfter) ? (int) $retryAfter : 120;
    $retrySeconds = $retrySeconds > 0 ? min($retrySeconds, 600) : 120;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <meta http-equiv="refresh" content="{{ $retrySeconds }}">
    <title>Website Sedang Dalam Pemeliharaan | Rumah Sakit Livasya</title>
    <style>
        :root {
            color-scheme: light;
            --primary: #087ca7;
            --primary-dark: #075d7e;
            --accent: #16a085;
            --text: #17324d;
            --muted: #607287;
            --line: #dce8ef;
            --surface: #ffffff;
            --soft: #f5fbfd;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100%;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: var(--text);
            background:
                linear-gradient(135deg, rgba(8, 124, 167, .10), rgba(22, 160, 133, .08)),
                #ffffff;
        }

        .page {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 32px 16px;
        }

        .maintenance {
            width: min(980px, 100%);
            display: grid;
            grid-template-columns: minmax(0, 1fr) 330px;
            gap: 0;
            overflow: hidden;
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 8px;
            box-shadow: 0 24px 70px rgba(7, 35, 54, .13);
        }

        .content {
            padding: clamp(28px, 6vw, 56px);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 34px;
        }

        .brand img {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }

        .brand-name {
            margin: 0;
            font-size: 18px;
            line-height: 1.35;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .status {
            display: inline-flex;
            align-items: center;
            min-height: 32px;
            padding: 6px 12px;
            border: 1px solid rgba(8, 124, 167, .18);
            border-radius: 999px;
            background: rgba(8, 124, 167, .08);
            color: var(--primary-dark);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        h1 {
            margin: 20px 0 14px;
            max-width: 680px;
            font-size: clamp(32px, 6vw, 54px);
            line-height: 1.05;
            letter-spacing: 0;
        }

        .lead {
            max-width: 650px;
            margin: 0 0 24px;
            color: var(--muted);
            font-size: clamp(16px, 2vw, 18px);
            line-height: 1.7;
        }

        .notice {
            max-width: 650px;
            padding: 18px 20px;
            margin: 0 0 26px;
            border-left: 4px solid var(--accent);
            background: var(--soft);
            color: #29445c;
            line-height: 1.65;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 28px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 12px 18px;
            border-radius: 6px;
            border: 1px solid transparent;
            font-weight: 700;
            text-decoration: none;
        }

        .button-primary {
            background: var(--primary);
            color: #ffffff;
        }

        .button-secondary {
            background: #ffffff;
            border-color: var(--line);
            color: var(--primary-dark);
        }

        .contact {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            max-width: 650px;
        }

        .contact-item {
            padding: 14px 16px;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: #ffffff;
        }

        .contact-label {
            display: block;
            margin-bottom: 4px;
            color: var(--muted);
            font-size: 13px;
        }

        .contact-value {
            color: var(--text);
            font-size: 16px;
            font-weight: 700;
            text-decoration: none;
            word-break: break-word;
        }

        .visual {
            position: relative;
            min-height: 100%;
            background:
                linear-gradient(180deg, rgba(7, 93, 126, .34), rgba(7, 93, 126, .74)),
                url("/img/rsialivasya.webp") center / cover;
        }

        .visual-panel {
            position: absolute;
            right: 22px;
            bottom: 22px;
            left: 22px;
            padding: 18px;
            border-radius: 8px;
            background: rgba(255, 255, 255, .94);
            color: var(--text);
        }

        .visual-panel strong {
            display: block;
            margin-bottom: 6px;
            color: var(--primary-dark);
            font-size: 20px;
        }

        .visual-panel span {
            color: var(--muted);
            line-height: 1.55;
        }

        @media (max-width: 820px) {
            .maintenance {
                grid-template-columns: 1fr;
            }

            .visual {
                min-height: 220px;
                order: -1;
            }

            .brand {
                margin-bottom: 24px;
            }
        }

        @media (max-width: 560px) {
            .page {
                align-items: start;
                padding: 18px 12px;
            }

            .content {
                padding: 24px 18px;
            }

            .contact {
                grid-template-columns: 1fr;
            }

            .actions {
                display: grid;
            }

            .button {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <main class="page">
        <section class="maintenance" aria-labelledby="maintenance-title">
            <div class="content">
                <div class="brand">
                    <img src="/img/logo.png" alt="Logo Rumah Sakit Livasya">
                    <p class="brand-name">Rumah Sakit Livasya</p>
                </div>

                <span class="status">503 Service Unavailable</span>
                <h1 id="maintenance-title">Website Sedang Dalam Pemeliharaan</h1>
                <p class="lead">
                    Website Rumah Sakit Livasya sedang dalam perawatan sistem. Kami sedang meningkatkan layanan agar informasi dokter, pelayanan, fasilitas, dan berita dapat diakses lebih baik.
                </p>

                <p class="notice">
                    Silakan coba kembali beberapa saat lagi. Halaman ini akan mencoba memuat ulang otomatis dalam {{ $retrySeconds }} detik.
                </p>

                <div class="actions" aria-label="Aksi cepat">
                    <a class="button button-primary" href="/">Coba Lagi</a>
                    <a class="button button-secondary" href="https://wa.me/6281211151300">Hubungi WhatsApp</a>
                </div>

                <div class="contact" aria-label="Kontak Rumah Sakit Livasya">
                    <div class="contact-item">
                        <span class="contact-label">Telepon</span>
                        <a class="contact-value" href="tel:02338668019">(0233) 8668019</a>
                    </div>
                    <div class="contact-item">
                        <span class="contact-label">WhatsApp</span>
                        <a class="contact-value" href="https://wa.me/6281211151300">0812 1115 1300</a>
                    </div>
                </div>
            </div>

            <aside class="visual" aria-label="Gedung Rumah Sakit Livasya">
                <div class="visual-panel">
                    <strong>Layanan Tetap Diprioritaskan</strong>
                    <span>Untuk kebutuhan mendesak, silakan hubungi nomor resmi Rumah Sakit Livasya.</span>
                </div>
            </aside>
        </section>
    </main>
</body>

</html>
