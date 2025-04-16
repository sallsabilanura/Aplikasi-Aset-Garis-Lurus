<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AsetFlow - Kelola Aset dengan Mudah</title>
    <link rel="icon" type="image/png" href="{{ asset('images/aset.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

    <style>
        /* Global Styles */
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f4f6fc;
            color: #333;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        /* Navbar */
        .navbar {
            position: sticky;
            top: 0;
            background: #ffffff;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .navbar img {
            max-width: 180px;
            height: auto;
        }

        .nav-links {
            display: flex;
            gap: 25px;
        }

        .nav-links a {
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 6px;
            color: #333;
            transition: background 0.3s ease, transform 0.2s;
        }

        .nav-links a:hover {
            background: #e2e6ff;
            transform: translateY(-2px);
        }

        /* Responsive Navbar */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 15px 20px;
            }

            .nav-links {
                flex-direction: column;
                gap: 10px;
                align-items: center;
            }
        }

        /* Hero Section */
        header {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 80px 10%;
            background: linear-gradient(135deg, #d1d8ff, #f4f6fc);
        }

        .hero-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            width: 100%;
            flex-wrap: wrap;
            text-align: center;
        }

        .hero-text {
            max-width: 500px;
        }

        .hero-text h1 {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .hero-text p {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 20px;
        }

        .hero-img img {
            width: 100%;
            max-width: 420px;
            transition: transform 0.5s ease;
        }

        .hero-img img:hover {
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .hero-content {
                flex-direction: column;
                text-align: center;
            }
        }

        /* Features Section */
        .features-section {
            padding: 60px 5%;
            background: #ffffff;
            text-align: center;
        }

        .features-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .feature-box {
            background: #f4f7fc;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 300px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        /* Testimonial Section */
        .container {
            margin-top: 40px;
        }

        .d-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 15px;
            background: #ffffff;
        }

        .card-body {
            padding: 15px;
        }

        /* Footer */
        footer {
            background: #f4f6fc;
            color: rgb(50, 26, 66);
            text-align: center;
            padding: 40px 10%;
            margin-top: 50px;
        }

        @media (max-width: 768px) {
            footer {
                padding: 30px 5%;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <img src="{{ asset('images/asetme.png') }}" alt="Logo">
        <ul class="nav-links">
            <li><a href="#features">Features</a></li>
            <li><a href="#testimonial">Testimonial</a></li>
            <li><a href="login">Sign In</a></li>
            <li><a href="register" style="background: #6c63ff; color: white;">Sign Up</a></li>
        </ul>
    </nav>

    <header>
        <div class="hero-content">
            <div class="hero-text">
                <h1>Kelola Aset Anda Dengan Mudah</h1>
                <p>Kelola Aset dengan Metode Penyusutan Garis Lurus.</p>
                                <div class="mt-3 text-center">
                    <h4>Rating Aplikasi:
                        <span class="text-warning">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <=round($averageRating))
                                &#9733;
                                @else
                                &#9734;
                                @endif
                                @endfor
                                </span>
                                ({{ number_format($averageRating, 1) }}/5)
                    </h4>
                </div>

            </div>
            <div class="hero-img">
                <img src="{{ asset('images/yap.png') }}" alt="Ilustrasi Aset">
            </div>
        </div>
    </header>

    <section id="features" class="features-section">
        <h2>Fitur Unggulan</h2>
        <div class="features-container">
            <div class="feature-box">
                <i class="fas fa-tools"></i>
                <h3>Pengelolaan Mudah</h3>
                <p>Lacak dan kelola aset Anda secara real-time.</p>
            </div>
            <div class="feature-box">
                <i class="fas fa-cogs"></i>
                <h3>Metode Penyusutan yang Mudah</h3>
                <p>Menggunakan metode Penyusutan Garis Lurus</p>
            </div>
            <div class="feature-box">
                <i class="fas fa-bell"></i>
                <h3>Notifikasi Pengguna</h3>
                <p>Pemberitahuan langsung untuk aktivitas penting.</p>
            </div>
        </div>
    </section>
    <section id="testimonial" class="testimonial-section">
        <div class="container mt-4">
            <section id="testimonials" class="features-section">
                <h2>Testimoni Pengguna</h2>
                <div class="features-container">
                    @foreach($testimonials as $index => $testimonial)
                    <div class="feature-box {{ $index >= 8 ? 'hidden-testimonial' : '' }}">
                        {{-- Tambahkan gambar profil pengguna --}}
                        <div class="testimonial-header">
                            <img src="{{ $testimonial->user->Gambar ? asset('storage/' . $testimonial->user->Gambar) : asset('images/default.png') }}"
                                alt="Profile {{ $testimonial->user->name }}"
                                class="testimonial-img rounded-circle border" />

                            <h3>{{ $testimonial->user->name }}</h3>
                        </div>
                        <p class="text-warning">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <=$testimonial->Rating)
                                &#9733;
                                @else
                                &#9734;
                                @endif
                                @endfor
                        </p>
                        <p>"{{ $testimonial->Riview }}"</p>
                    </div>
                    @endforeach
                </div>
                <br>
                @if(count($testimonials) > 8)
                <button id="showMoreBtn" class="btn btn-custom mt-3">
                    <span class="btn-text">Lihat Lebih Banyak</span> <i class="fas fa-chevron-down"></i>
                </button>
                @endif
            </section>
        </div>
    </section>


    </div>
    </section>

    <style>
        .features-section {
            padding: 60px 5%;
            background: #ffffff;
            text-align: center;
        }

        .features-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .feature-box {
            background: #f4f7fc;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: calc(25% - 20px);
            /* Maksimal 4 dalam satu baris */
            max-width: 300px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .text-warning {
            color: #ffc107;
        }

        .hidden-testimonial {
            display: none;
        }

        .btn-custom {
            background: none;
            color: #333;
            /* Warna teks */
            font-size: 16px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: color 0.3s ease-in-out;
        }

        .btn-custom:hover {
            color: #666;
            /* Warna teks sedikit lebih gelap saat hover */
            text-decoration: underline;
        }



        @media (max-width: 1024px) {
            .feature-box {
                width: calc(33.33% - 20px);
                /* 3 per baris di layar medium */
            }
        }

        @media (max-width: 768px) {
            .feature-box {
                width: calc(50% - 20px);
                /* 2 per baris di layar kecil */
            }
        }

        @media (max-width: 480px) {
            .feature-box {
                width: 100%;
                /* 1 per baris di layar sangat kecil */
            }
        }

        .testimonial-img {
            width: 60px;
            /* Sesuaikan ukuran */
            height: 60px;
            border-radius: 50%;
            /* Membuat gambar bulat */
            object-fit: cover;
            /* Supaya gambar tetap proporsional */
            border: 2px solid #ddd;
            /* Opsional: Tambahkan border agar lebih rapi */
        }
     

    </style>

    <script>
        document.getElementById("showMoreBtn")?.addEventListener("click", function() {
            const hiddenTestimonials = document.querySelectorAll(".hidden-testimonial");
            const btnText = this.querySelector(".btn-text");
            const icon = this.querySelector("i");

            if (this.dataset.expanded === "true") {
                hiddenTestimonials.forEach(el => {
                    el.style.opacity = "0";
                    setTimeout(() => (el.style.display = "none"), 500);
                });
                btnText.textContent = "Lihat Lebih Banyak";
                icon.classList.replace("fa-chevron-up", "fa-chevron-down");
                this.dataset.expanded = "false";
            } else {
                hiddenTestimonials.forEach(el => {
                    el.style.display = "block";
                    setTimeout(() => (el.style.opacity = "1"), 50);
                });
                btnText.textContent = "Sembunyikan";
                icon.classList.replace("fa-chevron-down", "fa-chevron-up");
                this.dataset.expanded = "true";
            }
        });
    </script>
<footer class="bg-light text-center py-3 mt-4">
    <p>&copy; 2025 Aset Flow - Semua Hak Dilindungi.</p>

    <p>
        <i class="bx bx-envelope"></i>
        <a href="mailto:support@asetflow.com" class="text-dark text-decoration-none">flowaset@gmail.com</a> |
        <i class="bx bxl-whatsapp"></i>
        <a href="https://wa.me/6281234567890" class="text-dark text-decoration-none">+62 812-3456-7890</a>
    </p>

    <div class="social-icons mt-2">
        <a href="https://facebook.com/asetflow" target="_blank" class="mx-2"><i class="bx bxl-facebook bx-md"></i></a>
        <a href="https://twitter.com/asetflow" target="_blank" class="mx-2"><i class="bx bxl-twitter bx-md"></i></a>
        <a href="https://instagram.com/asetflow" target="_blank" class="mx-2"><i class="bx bxl-instagram bx-md"></i></a>
        <a href="https://linkedin.com/company/asetflow" target="_blank" class="mx-2"><i class="bx bxl-linkedin bx-md"></i></a>
    </div>
</footer>

</body>

</html>