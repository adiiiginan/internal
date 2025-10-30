<!-- Vendor JS Files -->
<script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

<!-- Main JS File -->
<script src="{{ asset('frontend/assets/js/main.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const confirmBtn = document.getElementById('confirmSubmit');
        const confirmModalEl = document.getElementById('confirmModal');

        // When modal is shown, capture which form triggered it (via data-form-id on the trigger button)
        if (confirmModalEl) {
            confirmModalEl.addEventListener('show.bs.modal', function(e) {
                const trigger = e.relatedTarget;
                if (trigger && trigger.getAttribute) {
                    const formId = trigger.getAttribute('data-form-id') || '';
                    if (confirmBtn) confirmBtn.dataset.formId = formId;
                } else {
                    if (confirmBtn) confirmBtn.dataset.formId = '';
                }
            });
        }

        if (confirmBtn) {
            confirmBtn.addEventListener('click', function() {
                const modalEl = document.getElementById('confirmModal');
                const modal = (modalEl && window.bootstrap && bootstrap.Modal) ? (bootstrap.Modal
                    .getInstance(modalEl) || bootstrap.Modal.getOrCreateInstance(modalEl)) : null;
                if (modal) modal.hide();

                const formId = confirmBtn.dataset.formId || 'permintaanForm';
                const form = document.getElementById(formId);
                if (form) form.submit();
            });
        }

        // Script untuk menghitung dimensi otomatis
        function calculateDimension() {
            const panjangEl = document.getElementById('panjang');
            const lebarEl = document.getElementById('lebar');
            const tinggiEl = document.getElementById('tinggi');
            const dimensiEl = document.getElementById('dimensi');

            const panjang = parseFloat(panjangEl && panjangEl.value) || 0;
            const lebar = parseFloat(lebarEl && lebarEl.value) || 0;
            const tinggi = parseFloat(tinggiEl && tinggiEl.value) || 0;

            const dimension = (panjang * lebar * tinggi) / 5000;
            if (dimensiEl) dimensiEl.value = dimension.toFixed(2);
        }

        ['panjang', 'lebar', 'tinggi'].forEach(function(id) {
            const el = document.getElementById(id);
            if (el) el.addEventListener('input', calculateDimension);
        });
    });
</script>

<script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const photo = document.getElementById('photo');
    const startCameraButton = document.getElementById('startCamera');
    const takePhotoButton = document.getElementById('takePhoto');

    let stream;

    startCameraButton.onclick = async () => {
        try {
            stream = await navigator.mediaDevices.getUserMedia({
                video: true
            });
            video.srcObject = stream;
            takePhotoButton.disabled = false;
        } catch (err) {
            alert("Gagal mengakses kamera: " + err.message);
        }
    };

    takePhotoButton.onclick = () => {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0);
        const dataUrl = canvas.toDataURL('image/png');
        photo.src = dataUrl;
        photo.style.display = 'block';
    };
</script>
