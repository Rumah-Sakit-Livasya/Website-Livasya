# Panduan Menambahkan `server_tokens off;` (Nginx)

Pengaturan ini **Wajib** dilakukan di level server (VPS/Hosting Access) dan tidak bisa dari kodingan Laravel.

## Opsi 1: Jika Punya Akses Root / SSH (VPS)

1.  **Login ke Server**
    Buka terminal dan SSH ke server Anda.

2.  **Edit Konfigurasi Nginx**
    Buka file konfigurasi utama Nginx.

    ```bash
    sudo nano /etc/nginx/nginx.conf
    ```

3.  **Tambahkan Kode**
    Cari blok `http { ... }`. Tambahkan `server_tokens off;` di dalamnya.

    ```nginx
    http {
        ...
        sendfile on;
        tcp_nopush on;
        tcp_nodelay on;
        keepalive_timeout 65;
        types_hash_max_size 2048;

        # TAMBAHKAN BARIS INI
        server_tokens off;
        ...
    }
    ```

4.  **Simpan & Keluar**

    -   Tekan `CTRL + X`
    -   Tekan `Y` (Yes)
    -   Tekan `Enter`

5.  **Test Konfigurasi** (Penting!)
    Pastikan tidak ada error typo.

    ```bash
    sudo nginx -t
    ```

    _Output harus: "syntax is ok" dan "test is successful"_

6.  **Restart Nginx**
    ```bash
    sudo systemctl reload nginx
    ```

---

## Opsi 2: Jika Menggunakan Panel (cPanel / Plesk / CyberPanel)

Jika tidak punya akses terminal / SSH, biasanya ada menu konfigurasi Nginx di panel hosting.

### cPanel / WHM

1.  Login ke **WHM** (sebagai root).
2.  Cari menu **"Apache Configuration"** -> **"Include Editor"**.
3.  (cPanel biasanya pakai Apache sebagai utama, tapi jika pakai Nginx Reverse Proxy, cari pengaturan **Nginx Manager**).
4.  Jika murni Nginx, cari file config user di `/etc/nginx/conf.d/`.

### CyberPanel / AApanel

1.  Buka menu **Web Server Conf** atau **Nginx Config**.
2.  Paste `server_tokens off;` di bagian `http` block.
3.  Klik **Save & Restart**.

---

## Verifikasi

Setelah melakukan restart, cek header website Anda:

```bash
curl -I https://livasya.com/
```

**Hasil Sukses**:
`Server: nginx` (Tanpa angka versi)
ATAU (karena kita sudah inject header di index.php):
`Server: LivasyaSecure`
