<!DOCTYPE html>
<html>
<head>
    <title>Peringatan Masa Manfaat Aset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-top: 6px solid #007bff;
        }
        .header {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            color: #333;
            padding-bottom: 10px;
            border-bottom: 2px solid #ddd;
        }
        .content {
            padding: 20px 0;
            color: #555;
            font-size: 16px;
            line-height: 1.6;
        }
        .content p {
            margin: 10px 0;
        }
        .highlight {
            font-weight: bold;
            color: #d9534f;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background: #007bff;
            color: #ffffff;
            font-size: 16px;
            text-decoration: none;
            border-radius: 6px;
            transition: 0.3s ease-in-out;
        }
        .button:hover {
            background: #0056b3;
        }
        .footer {
            text-align: center;
            padding-top: 15px;
            font-size: 14px;
            color: #777;
            border-top: 1px solid #ddd;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">⚠️ Peringatan Masa Manfaat Aset</div>
    
    <div class="content">
        <p>Halo,</p>
        <p>Aset <span class="highlight">{{ $aset->NamaAset }}</span> dengan kode <span class="highlight">{{ $aset->KodeAset }}</span> akan segera habis masa manfaatnya.</p>
        <p><strong>Sisa waktu: <span class="highlight">{{ \Carbon\Carbon::parse($aset->TanggalPerolehan)->addMonths($aset->MasaManfaat)->diffInDays(now()) }} hari</span></strong></p>
        <p>Silakan lakukan tindakan yang diperlukan agar aset tetap terkelola dengan baik.</p>
        
      
    </div>
    
    <div class="footer">
        &copy; 2025 - Sistem Manajemen Aset | Email ini dikirim otomatis, jangan dibalas.
    </div>
</div>

</body>
</html>
