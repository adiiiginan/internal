@extends('layouts.app')

@section('title', 'PT JAYA NIAGA SEMESTA')
@section('site_title', 'INTERNAL JAYA NIAGA SEMESTA')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
                    <h1>Elegant and creative solutions</h1>
                    <p>PT. JAYA NIAGA SEMESTA is a profesional company formedin 2016. Its headquarters in the city
                        of Bandung in West Java, Indonesia. Our focuses is to develop products and services in 3
                        segments that entrusted by our partners, that are Security, Tubing and insulation tape
                        products for industry, as well as IT products and services.</p>

                    <div class="d-flex">
                        <a href="#about" class="btn-get-started">Get Started</a>

                    </div>
                </div>

                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
                    <img src="{{ asset('frontend/assets/img/hero-img.png') }}" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

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
    </section><!-- /Hero Section -->

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">
        <div class="container"></div>
    </section><!-- /Featured Services Section -->
@endsection
