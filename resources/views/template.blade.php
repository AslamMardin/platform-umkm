<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Gallery - Platform Desain Kemasan UMKM</title>
    <link rel="stylesheet" href="{{ asset('css/templateStyle.css') }}">
    <style>
        /* .template-card {
            max-width: 900px;
            margin: 0 auto;
        }

        .template-side-image img {
            border: 1px solid #ddd;
            padding: 4px;
            background-color: #f9f9f9;
            border-radius: 8px;
        } */

        body {
            background: linear-gradient(135deg, #800000 0%, #4b0000 100%);
        }
    </style>
</head>

<body>
    <div style="text-align: left; margin-bottom: 20px;">
        <a href="{{ route('home') }}" class="btn btn-secondary"
            style="
        display: inline-block;
        padding: 10px 20px;
        border-radius: 25px;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        text-decoration: none;
        border: 2px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    "
            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)'"
            onmouseout="this.style.transform='none'; this.style.boxShadow='none'">
            ← Kembali
        </a>
    </div>

    <div class="header">

        <h1>Kumpulan template</h1>
        <p>Pilih template desain kemasan terbaik untuk produk UMKM Anda</p>
    </div>

    <div class="search-box">
        <input type="text" class="search-input" placeholder="Cari template..." id="searchInput">
    </div>

    <div class="filter-section">
        <button class="filter-btn active" data-category="all">Semua Template</button>
        <button class="filter-btn" data-category="kotak">Kotak</button>
        <button class="filter-btn" data-category="stiker">Stiker</button>
    </div>

    <div class="stats-bar">
        <span id="templateCount">{{ $templates->count() }}</span> template tersedia

    </div>



    <div class="gallery-container">
        @foreach ($templates as $template)
            <div class="template-card" data-name="{{ strtolower($template->name) }}"
                data-category="{{ strtolower($template->jenis) }}">

                <!-- Gambar Utama + Label Posisi -->
                <div class="template-image" style="position: relative;">
                    <img src="{{ asset('storage/img/MOCKUP/' . $template->image_cover) }}" alt="{{ $template->name }}"
                        style="width: 100%; height: 200px; object-fit: cover; border-radius: 20px 20px 0 0;">

                    <!-- Label Berbayar/Gratis (kiri atas) -->
                    <div
                        style="
                    position: absolute;
                    top: 10px;
                    left: 10px;
                    background-color: {{ $template->is_paid ? '#ffc107' : '#28a745' }};
                    color: {{ $template->is_paid ? '#212529' : 'white' }};
                    padding: 5px 10px;
                    font-size: 0.8rem;
                    border-radius: 8px;
                    font-weight: bold;
                    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
                ">
                        {{ $template->is_paid ? 'Berbayar' : 'Gratis' }}
                    </div>

                    <!-- Label Kategori (kiri bawah) -->
                    <div
                        style="
                    position: absolute;
                    bottom: 10px;
                    left: 10px;
                    background: linear-gradient(45deg, #667eea, #764ba2);
                    color: white;
                    padding: 4px 10px;
                    font-size: 0.75rem;
                    border-radius: 12px;
                    font-weight: 500;
                    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
                ">
                        {{ ucfirst($template->jenis) }}
                    </div>

                    <!-- Gambar tambahan pojok kanan bawah -->
                    <img src="{{ asset('storage/img/MOCKUP/' . $template->image_path) }}" alt="{{ $template->name }}"
                        style="
                    position: absolute;
                    right: 10px;
                    bottom: 10px;
                    width: 80px;
                    border-radius: 8px;
                    background: rgba(255,255,255,0.8);
                    padding: 4px;
                    object-fit: contain;
                ">
                </div>

                <!-- Informasi Template -->
                <div class="template-info">
                    <h3 class="template-title">{{ $template->name }}</h3>

                    <p class="template-description">
                        Telah digunakan <strong>{{ $template->usage_count }}</strong> kali.
                    </p>


                </div>
            </div>
        @endforeach
    </div>
</body>
<script>
    const filterButtons = document.querySelectorAll('.filter-btn');
    const templateCards = document.querySelectorAll('.template-card');
    const searchInput = document.getElementById('searchInput');

    let activeCategory = 'all';

    function filterTemplates() {
        const searchValue = searchInput ? searchInput.value.toLowerCase() : ''; // aman kalau input kosong

        templateCards.forEach(card => {
            const name = card.dataset.name;
            const category = card.dataset.category;

            const matchesSearch = name.includes(searchValue);
            const matchesCategory = (activeCategory === 'all' || category === activeCategory);

            if (matchesSearch && matchesCategory) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Event pencarian real-time
    if (searchInput) {
        searchInput.addEventListener('input', filterTemplates);
    }

    // Event klik filter kategori
    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            filterButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            activeCategory = btn.dataset.category;
            filterTemplates();
        });
    });
</script>



</html>
