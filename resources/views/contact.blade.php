@extends('dashboard')

@section('content')
<!-- resources/views/contact.blade.php -->

<div class="contact-container">
    <div class="contact-info">
        <h3>Kontak Kami</h3>
        <p>Jika Anda memiliki pertanyaan atau membutuhkan bantuan, silakan hubungi kami melalui salah satu cara berikut:</p>


        <div class="contact-detail">
            <h4>Nomor Telepon</h4>
            <p>+62 123 456 789</p>
        </div>

        <div class="contact-detail">
            <h4>Email</h4>
<<<<<<< HEAD
            <p>asetku@company.com</p>
=======
            <p>flowaset@gmail.com</p>
>>>>>>> eeb912e (Tambah semua file awal project)
        </div>


        <div class="contact-detail">
            <h4>Hubungi Kami</h4>
            <p><a href="tel:+62xxxxxxxxxx" class="contact-link">Hubungi Kami via Telepon</a></p>
            <p><a href="https://wa.me/628998261409" class="contact-link">Chat via WhatsApp</a></p>
        </div>
    </div>
</div>
<style>
    /* resources/css/contact.css */

    /* Styling untuk container utama */
    .contact-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 50px;
        background-color: #f9f9f9;
    }

    .contact-info {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
        width: 100%;
        max-width: 800px;
    }

    /* Styling untuk judul */
    .contact-info h3 {
        font-size: 28px;
        color: #333;
        margin-bottom: 20px;
        text-align: center;
    }

    /* Styling untuk paragraf deskripsi */
    .contact-info p {
        font-size: 16px;
        color: #555;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    /* Styling untuk setiap detail kontak */
    .contact-detail {
        margin-bottom: 20px;
    }

    .contact-detail h4 {
        font-size: 18px;
        color: #007BFF;
        margin-bottom: 10px;
    }

    .contact-detail p {
        font-size: 16px;
        color: #333;
    }

    /* Styling untuk link */
    .contact-link {
        color: #007BFF;
        text-decoration: none;
        font-weight: bold;
    }

    .contact-link:hover {
        text-decoration: underline;
    }
</style>

@endsection