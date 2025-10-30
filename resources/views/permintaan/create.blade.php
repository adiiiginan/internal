@extends('layouts.app')

@section('Aplikasi Pencarian Barang')
@section('site_title', 'APLIKASI PENCARIAN BARANG')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section" style="margin-top:-75px;">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-up">
                    {{-- Validation errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="permintaanForm" action="{{ route('permintaan.store') }}" method="POST"
                        enctype="multipart/form-data" class="mt-3">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Pengaju</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Divisi</label>
                                <input type="text" name="divisi" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Jenis Barang</label>
                                <textarea name="jenis_permintaan" class="form-control" required></textarea>
                            </div>



                            <div class="col-md-6">
                                <label class="form-label">Annual Ussage</label>
                                <textarea name="use" class="form-control" required></textarea>
                            </div>


                            <div class="col-md-6">
                                <label class="form-label">Jumlah</label>
                                <input type="text" name="qty" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Supplier</label>
                                <input type="text" name="supplier" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Customer</label>
                                <input type="text" name="customer" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Deadline</label>
                                <input type="date" name="etd" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="formFile" class="form-label">Upload Gambar</label>
                                <input class="form-control" type="file" id="formFile" name="gambar">
                            </div>





                            <div class="col-12">
                                <label class="form-label">Penjelasan Detail</label>
                                <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="button" class="btn btn-primary btn-lg rounded-3" data-bs-toggle="modal"
                                data-bs-target="#confirmModal">
                                Kirim
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
                    <img src="{{ asset('frontend/assets/img/hero-img.png') }}" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

        <!-- Confirm Modal -->
        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header bg-primary text-white rounded-top-4">
                        <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Pengajuan</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin mengirim pengajuan permintaan barang ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary rounded-3" id="confirmSubmit">Ya, Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Elements
                const openCameraModalBtn = document.getElementById('openCameraModalBtn');
                const cameraInput = document.getElementById('cameraInput');
                const cameraPreview = document.getElementById('cameraPreview');
                const cameraModalEl = document.getElementById('cameraModal');
                const cameraVideo = document.getElementById('cameraVideo');
                const cameraCanvas = document.getElementById('cameraCanvas');
                const captureBtn = document.getElementById('captureBtn');
                const uploadCapturedBtn = document.getElementById('uploadCapturedBtn');
                const formFileInput = document.getElementById('formFile');

                let stream = null;
                let capturedBlob = null;
                const uploadUrl = "{{ route('permintaan.upload_photo') }}";
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                    '{{ csrf_token() }}';

                // When a file is selected in the main file input, disable camera
                formFileInput.addEventListener('change', function() {
                    if (formFileInput.files.length > 0) {
                        openCameraModalBtn.disabled = true;
                    } else {
                        openCameraModalBtn.disabled = false;
                    }
                });

                // Open modal and start camera
                openCameraModalBtn.addEventListener('click', async () => {
                    const modal = new bootstrap.Modal(cameraModalEl);
                    modal.show();

                    try {
                        stream = await navigator.mediaDevices.getUserMedia({
                            video: {
                                facingMode: 'environment'
                            },
                            audio: false
                        });
                        cameraVideo.srcObject = stream;
                        cameraVideo.play();
                        uploadCapturedBtn.style.display = 'none';
                    } catch (err) {
                        console.error('Camera error', err);
                        alert('Tidak dapat mengakses kamera. Coba gunakan input file.');
                    }
                });

                // Capture photo
                captureBtn.addEventListener('click', () => {
                    if (!stream) return;
                    const videoTrack = stream.getVideoTracks()[0];
                    const settings = videoTrack.getSettings();
                    const width = cameraVideo.videoWidth || settings.width || 640;
                    const height = cameraVideo.videoHeight || settings.height || 480;
                    cameraCanvas.width = width;
                    cameraCanvas.height = height;
                    const ctx = cameraCanvas.getContext('2d');
                    ctx.drawImage(cameraVideo, 0, 0, width, height);
                    cameraCanvas.toBlob((blob) => {
                        capturedBlob = blob;
                        // show preview
                        const img = document.createElement('img');
                        img.style.maxWidth = '140px';
                        img.src = URL.createObjectURL(blob);
                        cameraPreview.innerHTML = '';
                        cameraPreview.appendChild(img);
                        uploadCapturedBtn.style.display = 'inline-block';

                        // When camera is used, disable file input
                        formFileInput.disabled = true;
                    }, 'image/jpeg', 0.9);
                });

                // Upload captured image
                uploadCapturedBtn.addEventListener('click', async () => {
                    if (!capturedBlob) return;
                    const formData = new FormData();
                    formData.append('photo', capturedBlob, 'capture.jpg');

                    try {
                        const res = await fetch(uploadUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: formData
                        });
                        const data = await res.json();
                        if (data.success) {
                            // store URL in hidden input for later use if needed
                            let existing = document.querySelector('input[name="uploaded_photo_url"]');
                            if (!existing) {
                                existing = document.createElement('input');
                                existing.type = 'hidden';
                                existing.name = 'uploaded_photo_url';
                                document.getElementById('permintaanForm').appendChild(existing);
                            }
                            existing.value = data.url;
                            alert('Upload berhasil');
                        } else {
                            alert('Upload gagal');
                        }
                    } catch (err) {
                        console.error(err);
                        alert('Upload error');
                    } finally {
                        // stop stream and close modal
                        if (stream) {
                            stream.getTracks().forEach(t => t.stop());
                            stream = null;
                        }
                        const modal = bootstrap.Modal.getInstance(cameraModalEl);
                        if (modal) modal.hide();
                    }
                });

                // Fallback: file input (if user chooses file)
                cameraInput.addEventListener('change', async (event) => {
                    const file = event.target.files[0];
                    if (!file) return;
                    const img = document.createElement('img');
                    img.style.maxWidth = '140px';
                    img.src = URL.createObjectURL(file);
                    cameraPreview.innerHTML = '';
                    cameraPreview.appendChild(img);

                    // upload file
                    const formData = new FormData();
                    formData.append('photo', file);
                    try {
                        const res = await fetch(uploadUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: formData
                        });
                        const data = await res.json();
                        if (data.success) {
                            let existing = document.querySelector('input[name="uploaded_photo_url"]');
                            if (!existing) {
                                existing = document.createElement('input');
                                existing.type = 'hidden';
                                existing.name = 'uploaded_photo_url';
                                document.getElementById('permintaanForm').appendChild(existing);
                            }
                            existing.value = data.url;
                        } else {
                            alert('Upload gagal');
                        }
                    } catch (err) {
                        console.error(err);
                        alert('Upload error');
                    }
                });
            });
        </script>
    @endpush

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">
        <div class="container"></div>
    </section>
@endsection
