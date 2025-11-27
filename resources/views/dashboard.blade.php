<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets/') }}"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>AsetFlow</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/aset.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <body>
  <body>
  <div id="loader" style="
  position: fixed;
  z-index: 9999;
  background: transparent; /* Menggunakan transparansi */
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  transition: opacity 0.5s ease;
">
  <img src="{{ asset('images/Asetku.gif') }}" alt="Loading..." width="800">
</div>

<script>
  window.addEventListener('load', function () {
    const loader = document.getElementById('loader');
    const main = document.querySelector('.layout-wrapper');

    // Tahan loader selama 1 detik
    setTimeout(() => {
      loader.style.opacity = 0; // Mulai fade-out efek

      // Setelah animasi fade-out selesai (0.5 detik), sembunyikan loader dan tampilkan konten utama
      setTimeout(() => {
        loader.style.display = 'none'; // Sembunyikan loader
        main.style.opacity = 1; // Tampilkan konten utama
      }, 500); // Durasi fade-out 0.5 detik
    }, 1000); // Loader tetap tampil selama 1 detik
  });
</script>


  {{-- Wrapper layout utama --}}
  <div class="layout-wrapper layout-content-navbar" style="opacity: 0;">
    <div class="layout-container">
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="dashboard" class="app-brand-link">
            <span class="app-brand-logo demo">
              <img src="{{ asset('images/Asetme.png') }}" alt="Logo" width="150" height="50">
            </span>
          </a>
        </div>
        <ul class="menu-inner py-1">
          @can('is-admin')
            @include('layouts.sidebar')
          @endcan
          @can('is-instansi')
            @include('layouts.sidebar')
          @endcan
        </ul>
      </aside>

      @include('layouts.navbar')

      <div class="content-wrapper">
        @yield('content')
        @if(Request::is('dashboard') || Request::is('/'))
          @include('layouts.content')
        @endif
        <div class="content-backdrop fade"></div>
      </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>

  {{-- Script untuk hilangkan loader --}}



    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    
  </body>
</html>