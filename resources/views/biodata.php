<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Biodata Nazifah</title>

    <style>
        @page {
            size: A4;
            margin: 20mm;
            background-color: #f5f1eb;
        }

        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f1eb;
            color: #333;
            line-height: 1.6;
        }

        .card {
            background: white;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 800px;
            margin: 30px auto;
        }

        .header-banner {
            background: linear-gradient(135deg, #7f5a83 0%, #b48ead 100%);
            color: white;
            padding: 45px;
            text-align: center;
        }

        .header-banner h1 {
            margin: 0;
            font-size: 28pt;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .header-banner p {
            margin: 12px 0 0;
            font-size: 14pt;
            opacity: 0.95;
            font-weight: 300;
        }

        .main-content {
            padding: 40px;
        }

        .section {
            margin-bottom: 35px;
        }

        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 18px;
            border-left: 6px solid #b48ead;
            padding-left: 15px;
        }

        .section-header h2 {
            margin: 0;
            font-size: 17pt;
            color: #7f5a83;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .data-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #eeeeee;
        }

        .label {
            width: 170px;
            font-weight: 700;
            color: #555;
        }

        .value {
            flex: 1;
            color: #333;
        }

        .bio-text {
            background: #faf7fb;
            padding: 22px;
            border-radius: 12px;
            font-style: italic;
            color: #444;
            border: 1px solid #eadff0;
            text-align: justify;
        }

        .hobbies-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 10px;
        }

        .tag {
            background: #f1e4f4;
            color: #7f5a83;
            padding: 8px 18px;
            border-radius: 25px;
            font-size: 10pt;
            font-weight: 600;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 9pt;
            color: #999;
            background: #fafafa;
        }
    </style>
</head>

<body>

    <div class="card">

        <div class="header-banner">
            <h1>Tengku Syarifah Nur Nazhiifah</h1>
            <p>Data Analyst • Tech Enthusiast • Creativepreneur</p>
        </div>

        <div class="main-content">

            <div class="section">
                <div class="section-header">
                    <h2>Profil Utama</h2>
                </div>

                <div class="data-row">
                    <div class="label">Status</div>
                    <div class="value">Mahasiswa Teknik Informatika</div>
                </div>

                <div class="data-row">
                    <div class="label">Kampus</div>
                    <div class="value">Universitas Esa Unggul</div>
                </div>

                <div class="data-row">
                    <div class="label">Lokasi</div>
                    <div class="value">Bekasi, Jawa Barat</div>
                </div>

                <div class="data-row">
                    <div class="label">Bidang Minat</div>
                    <div class="value">
                        Data Analytics, Python Programming, UI/UX Design,
                        Fashion Technology, dan Business Development
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="section-header">
                    <h2>Kegemaran</h2>
                </div>

                <div class="hobbies-tags">
                    <span class="tag">Data Analytics</span>
                    <span class="tag">Python Programming</span>
                    <span class="tag">UI/UX Design</span>
                    <span class="tag">Fashion & Clothing Design</span>
                    <span class="tag">Eksplorasi Teknologi</span>
                    <span class="tag">Backend Development</span>
                    <span class="tag">Membaca Manhwa & Manga</span>
                    <span class="tag">Belajar Pengembangan Bisnis</span>
                </div>
            </div>

            <div class="section">
                <div class="section-header">
                    <h2>Biografi Singkat</h2>
                </div>

                <div class="bio-text">
                    Saya adalah mahasiswa Teknik Informatika yang memiliki
                    ketertarikan besar di bidang teknologi, data, dan desain kreatif.
                    Saat ini saya sedang fokus mengembangkan kemampuan dalam
                    Data Analytics, Python Programming, UI/UX Design, serta
                    pengembangan bisnis clothing brand berbasis teknologi.

                    Saya memiliki minat untuk membangun karier yang fleksibel
                    dan dapat berkembang seiring kemajuan teknologi digital.
                    Selain itu, saya juga senang mengeksplorasi ide kreatif dalam
                    dunia fashion dan desain untuk menciptakan produk yang unik
                    dan memiliki identitas tersendiri.

                    Bagi saya, belajar adalah proses yang tidak pernah berhenti.
                    Saya selalu berusaha menjadi pribadi yang terus berkembang,
                    memiliki karakter yang baik, dan mampu menyeimbangkan
                    antara pencapaian karier, kreativitas, serta kehidupan pribadi.
                </div>
            </div>

        </div>

        <div class="footer">
            Personal Profile Page | 2026
        </div>

    </div>

</body>
</html>