@can('is-admin')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <!-- Card 1 - Welcome Section -->
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <!-- Card 1 - Welcome Section -->
        <div class="col-lg-12 mb-4 order-0">
          <div class="card shadow-lg">
            <div class="d-flex align-items-end row">
              <div class="col-sm-8">
                <div class="card-body">
                  <h5 class="card-title text-primary text-end">Halo {{ auth()->user()->name }}! Selamat datang di Aplikasi Manajemen Aset Kamu 🎉</h5>
                  <p class="mb-4 text-end">Lihatlah perkembangan <span class="fw-bold">AsetMu</span> Disini</p>
                  <div class="text-end">
                    <a href="{{ route('asets.index') }}" class="btn btn-sm btn-outline-primary">Lihat Aset</a>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img src="../assets/img/illustrations/man-ya.png" height="180" alt="View Badge User">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-12 mb-4">
      <div class="row">
        <!-- Card Total Aset -->
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card shadow-lg border-start border-primary">
            <div class="card-body">
              <div class="d-flex align-items-center mb-3">
                <div class="icon-container bg-primary text-white p-2 rounded-circle me-3">
                  <i class="fas fa-cogs"></i>
                </div>
                <span class="fw-semibold text-muted">Total Aset</span>
              </div>
              <h3 class="card-title text-primary mb-2">{{ $asetCount }}</h3>
              <a href="{{ ('asets') }}" class="btn btn-primary btn-sm mt-3">Lihat Detail</a>
            </div>
          </div>
        </div>

        <!-- Card Total Penyusutan Aset -->
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card shadow-lg border-start border-warning">
            <div class="card-body">
              <div class="d-flex align-items-center mb-3">
                <div class="icon-container bg-warning text-white p-2 rounded-circle me-3">
                  <i class="fas fa-chart-line"></i>
                </div>
                <span class="text-muted">Total Penyusutan Aset</span>
              </div>
              <h3 class="card-title text-warning mb-1">{{ $penyusutanCount }}</h3>
              <a href="{{ ('penyusutans') }}" class="btn btn-warning btn-sm mt-3">Lihat Detail</a>
            </div>
          </div>
        </div>

        <!-- Card Total User -->
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card shadow-lg border-start border-success">
            <div class="card-body">
              <div class="d-flex align-items-center mb-3">
                <div class="icon-container bg-success text-white p-2 rounded-circle me-3">
                  <i class="fas fa-users"></i>
                </div>
                <span class="text-muted">Total User</span>
              </div>
              <h3 class="card-title text-success mb-2">{{ $userCount }}</h3>
              <a href="{{ ('users') }}" class="btn btn-success btn-sm mt-3">Lihat Detail</a>
            </div>
          </div>
        </div>

        <!-- Card Total Penghapusan Aset -->
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card shadow-lg border-start border-danger">
            <div class="card-body">
              <div class="d-flex align-items-center mb-3">
                <div class="icon-container bg-danger text-white p-2 rounded-circle me-3">
                  <i class="fas fa-trash-alt"></i>
                </div>
                <span class="fw-semibold text-muted">Total Testimoni Pengguna</span>
              </div>
              <h3 class="card-title text-danger mb-2">{{ $testimonialCount }}</h3>
              <a href="{{ ('testimonials') }}" class="btn btn-danger btn-sm mt-3">Lihat Detail</a>
            </div>
          </div>
        </div>
      </div>
    </div>



    <style>
      .card {
        border-radius: 15px;
      }

      .shadow-lg {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      }

      .shadow-sm {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }

      .rounded-circle {
        border-radius: 50%;
      }

      .avatar img {
        width: 40px;
        height: 40px;
      }

      .card-body {
        padding: 20px;
      }

      .text-center {
        text-align: center;
      }

      @media (max-width: 768px) {
        .col-lg-3 {
          margin-bottom: 20px;
        }
      }
    </style>
    @endcan
    @can('is-instansi')
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <!-- Welcome Section -->
        <div class="col-lg-12 mb-4">
          <div class="card shadow-lg">
            <div class="d-flex align-items-center row">
              <div class="col-sm-8">
                <div class="card-body">
                  <h5 class="card-title text-primary text-end">
                    Halo {{ auth()->user()->name }}! Selamat datang di Aplikasi Manajemen Aset Kamu 🎉
                  </h5>
                  <p class="mb-4 text-end">Kelola <span class="fw-bold">AsetMu</span> dengan lebih mudah.</p>
                  <div class="text-end">
                    <a href="{{ route('asets.index') }}" class="btn btn-sm btn-outline-primary">Lihat Aset</a>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 text-center">
                <img src="../assets/img/illustrations/man-ya.png" height="180" alt="View Badge User">
              </div>
            </div>
          </div>
        </div>

        <!-- Aset Terbaru & Statistik Aset -->
        <div class="col-lg-6">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Aset Terbaru</h5>
              <ul class="list-group">
                @foreach ($latestAsets as $aset)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <span class="fw-semibold">{{ $aset->NamaAset }}</span>
                  <span class="badge bg-primary">{{ $aset->TanggalPerolehan }}</span>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Statistik Aset</h5>
              <canvas id="chartAset"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        let ctx = document.getElementById('chartAset').getContext('2d');
        let chartAset = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: @json($asetStats -> keys()),
            datasets: [{
              label: 'Jumlah Aset',
              data: @json($asetStats -> values()),
              backgroundColor: 'rgb(122, 130, 241)',
              borderColor: 'rgb(102, 111, 233)',
              borderWidth: 2
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: {
                display: false
              }
            },
            scales: {
              x: {
                ticks: {
                  color: '#555',
                  font: {
                    size: 13
                  }
                },
                grid: {
                  color: 'rgba(200, 200, 200, 0.2)'
                }
              },
              y: {
                beginAtZero: true,
                ticks: {
                  color: '#555',
                  font: {
                    size: 13
                  }
                },
                grid: {
                  color: 'rgba(200, 200, 200, 0.2)'
                }
              }
            }
          }
        });

        // Update data setiap 5 detik
        setInterval(() => {
          fetch("{{ route('api.aset.stats') }}")
            .then(response => response.json())
            .then(data => {
              chartAset.data.labels = data.labels;
              chartAset.data.datasets[0].data = data.values;
              chartAset.update();
            });
        }, 5000);
      });
    </script>
    @endcan