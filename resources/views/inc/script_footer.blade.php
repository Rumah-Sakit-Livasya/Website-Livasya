<!-- base vendor bundle:
DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations
+ pace.js (recommended)
+ jquery.js (core)
+ jquery-ui-cust.js (core)
+ popper.js (core)
+ bootstrap.js (core)
+ slimscroll.js (extension)
+ app.navigation.js (core)
+ ba-throttle-debounce.js (core)
+ waves.js (extension)
+ smartpanels.js (extension)
+ src/../jquery-snippets.js (core) -->
<script src="/js/vendors.bundle.js"></script>
<script src="/js/app.bundle.js"></script>
<script type="text/javascript">
    /* Activate smart panels */
    $('#js-page-content').smartPanel();

    // Fungsi untuk menampilkan notifikasi sukses SweetAlert
    function showSuccessAlert(message) {
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: message,
            showConfirmButton: false,
            timer: 2000 // Durasi notifikasi dalam milidetik (ms)
        });
    }

    // Fungsi untuk menampilkan notifikasi kesalahan SweetAlert 
    function showErrorAlert(message) {
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan!',
            text: message,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    }
</script>

<script src="/js/script.js"></script>

@yield('plugin')
