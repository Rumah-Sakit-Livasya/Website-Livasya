# Panduan Hide Server Version di CyberPanel

Karena Anda menggunakan **CyberPanel**, kemungkinan besar server utama Anda adalah **OpenLiteSpeed**, bukan murni Nginx (kecuali Anda install Nginx Reverse Proxy).

Berikut cara menghilangkannya di CyberPanel:

## Cara 1: OpenLiteSpeed (Default CyberPanel)

Jika header server Anda terbaca `LiteSpeed` atau `OpenLiteSpeed`, ikuti ini:

1.  **Login ke CyberPanel** (biasanya port 8090).
2.  Di menu sebelah kiri, cari menu **"OpenLiteSpeed"** -> **"Server Configuration"**.
    -   _Atau jika tidak ada, klik tombol "WebAdmin Console" di dashboard (biasanya port 7080)._
3.  Login ke OpenLiteSpeed WebAdmin (username/pass biasanya sama atau default admin/123456).
4.  Masuk ke **Server Configuration** -> Tab **General**.
5.  Cari opsi **"Server Signature"**.
6.  Ubah menjadi **"Hide"** atau **"Hide Full Header"**.
7.  Klik tombol **Save** (Simpan).
8.  Klik tombol **Graceful Restart** (ikon hijau di pojok kanan atas) untuk menerapkan perubahan.

## Cara 2: Nginx Config (Jika Pakai Nginx Proxy)

Jika Anda yakin menggunakan Nginx, caranya:

1.  Login ke CyberPanel.
2.  Masuk ke menu **Websites** -> **List Websites**.
3.  Klik **Manage** pada website `livasya.com`.
4.  Cari tombol **"vHost Conf"** atau **"Rewrite Rules"** (tergantung versi).
    -   _Catatan: Konfigurasi global Nginx biasanya tidak bisa diedit per website untuk `server_tokens`._
5.  Untuk edit global (Root Admin only):
    -   Masuk menu **Server Status** -> **Container** (jika docker) ATAU
    -   Lebih mudah gunakan **Terminal** di dalam CyberPanel:
    ```bash
    nano /etc/nginx/nginx.conf
    ```
6.  Tambahkan `server_tokens off;` di blok `http`.
7.  Restart Nginx via terminal: `systemctl restart nginx`.

## Cara 3: Edit via File Manager (Paling Mudah untuk User Biasa)

1.  Buka **File Manager** di CyberPanel.
2.  Masuk ke folder `/usr/local/lsws/conf/` (Ini config OpenLiteSpeed).
3.  Edit file `httpd_config.conf` (Hati-hati!).
4.  Tambahkan/Ubah baris:
    ```
    serverSignature 0
    ```
    _(0 = Hide, 1 = Show)_.
5.  Restart OpenLiteSpeed via dashboard.

---

**Tip Tambahan**:
Jika scanner masih mendeteksi, kemungkinan itu adalah header dari **Cloudflare** (jika pakai). Cloudflare tidak bisa dihilangkan, tapi biasanya dianggap aman (Low Risk).
