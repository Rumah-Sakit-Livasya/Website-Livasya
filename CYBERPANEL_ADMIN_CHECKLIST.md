# Checklist Admin CyberPanel (Final Security Hardening)

Karena Anda sudah menjadi Admin, lakukan 3 langkah krusial ini langsung di CyberPanel untuk mencapai skor 90+/100.

## 1. Hide Server Version (Wajib)

Lakukan KEDUANYA untuk memastikan, baik Anda pakai OpenLiteSpeed murni atau Nginx Proxy.

### A. Konfigurasi OpenLiteSpeed (OLS)

1.  Buka **Root File Manager**.
2.  Edit: `/usr/local/lsws/conf/httpd_config.conf`
3.  Tambahkan atau ubah baris ini (biasanya di blok `server`):
    ```
    serverSignature 0
    ```
4.  Save.

### B. Konfigurasi Nginx (Jika pakai Proxy)

1.  Masih di **Root File Manager**.
2.  Edit: `/etc/nginx/nginx.conf` (Jika file ini tidak ada, berarti Anda murni OLS, abaikan langkah B).
3.  Cari blok `http { ... }`.
4.  Tambahkan:
    ```nginx
    server_tokens off;
    ```
5.  Save.

### C. Restart Service (PENTING)

1.  Buka menu **Manage Services** -> **Services Status**.
2.  Restart **OpenLiteSpeed**.
3.  Restart **Nginx** (Jika ada).

---

## 2. Aktifkan DNSSEC (Untuk Skor DNS)

1.  Di menu CyberPanel, pilih **DNS** -> **Cloudflare** (jika pakai integrasi) atau **DNSSEC**.
2.  Jika pakai DNS Server CyberPanel sendiri:
    -   Pilih **DNS** -> **DNSSEC**.
    -   Pilih domain `livasya.com`.
    -   Klik **Install**.
    -   Anda akan mendapat `DS Record`. Cukup copy record ini dan masukkan ke panel domain manager (tempat beli domain).
3.  **Catatan**: Jika Anda menggunakan **Cloudflare** sebagai DNS manager (bukan di CyberPanel), Anda harus aktifkan DNSSEC langsung di dashboard website Cloudflare.com, bukan di CyberPanel.

---

## 3. Bot Protection (ModSecurity)

Untuk mencegah scraping dan serangan bot:

1.  Di CyberPanel, menu **Security** -> **ModSecurity Conf**.
2.  Pastikan status **Installed**.
3.  Pastikan **SecRuleEngine** diset ke `On` (atau `DetectionOnly` jika takut blocking user asli).
4.  Aktifkan "Comodo Config" atau "OWASP Core Rules" di menu **ModSecurity Rules**.

---

## Verifikasi Akhir

Setelah melakukan langkah di atas, skor security headers dan server banner harusnya sudah sempurna (Hijau semua).
