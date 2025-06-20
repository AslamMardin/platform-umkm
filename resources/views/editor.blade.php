<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor Desain Kemasan</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .top-toolbar {
            background: #fff;
            padding: 10px 15px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .top-toolbar input[type="text"],
        .top-toolbar input[type="file"],
        .top-toolbar button {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 0.9rem;
        }

        .layout {
            flex: 1;
            display: flex;
            overflow: hidden;
        }

        .sidebar {
            width: 240px;
            background: #f9f9f9;
            padding: 15px;
            overflow-y: auto;
            border-right: 1px solid #ddd;
        }

        .sidebar h3 {
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .template-gallery img {
            width: 100%;
            margin-bottom: 10px;
            border-radius: 5px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: border 0.3s;
        }

        .template-gallery img:hover {
            border-color: #4ecdc4;
        }

        .main-canvas {
            flex: 1;
            background: #e9ecef;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .canvas-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .export-options {
            text-align: center;
            padding: 10px;
            background: #fff;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.05);
        }

        .btn {
            padding: 10px 15px;
            background: #4ecdc4;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #3dbab0;
        }

        .layout {
            flex: 1;
            display: flex;
            overflow: hidden;
        }

        .sidebar-left,
        .sidebar-right {
            width: 220px;
            background: #f9f9f9;
            padding: 15px;
            overflow-y: auto;
            border-right: 1px solid #ddd;
        }

        .sidebar-right {
            border-left: 1px solid #ddd;
            border-right: none;
        }

        .main-canvas {
            flex: 1;
            background: #e9ecef;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Input Group */
        .input-group,
        .slider-group {
            margin-bottom: 15px;
        }

        /* Label Styling */
        .input-group label,
        .slider-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }

        /* Select Font */
        #fontFamily {
            width: 100%;
            padding: 6px;
            font-size: 14px;
        }

        /* Slider */
        .slider {
            width: 100%;
        }

        .template-gallery {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .template-card {
            border: 1px solid #ddd;
            border-radius: 6px;
            background: #fff;
            overflow: hidden;
        }

        .template-thumb-wrapper {
            position: relative;
        }

        .template-thumb {
            width: 100%;
            height: auto;
            object-fit: cover;
            display: block;
            cursor: pointer;
        }

        .badge-position {
            position: absolute;
            font-size: 11px;
            padding: 3px 6px;
            color: #fff;
            background: rgba(0, 0, 0, 0.6);
            border-radius: 4px;
            z-index: 2;
        }

        .left-bottom {
            bottom: 6px;
            left: 6px;
        }

        .right-bottom {
            bottom: 6px;
            right: 6px;
        }

        .template-info {
            text-align: center;
            padding: 6px 0;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <!-- TOP TOOLBAR -->
    <div class="top-toolbar">
        <input type="text" id="textInput" placeholder="Tulis teks di sini">
        <button class="btn" onclick="addText()">📝 Teks</button>
        <button class="btn" onclick="addRect()">▢ Kotak</button>
        <button class="btn" onclick="addCircle()">⭕ Lingkaran</button>
        <button class="btn" onclick="addTriangle()">🔺 Segitiga</button>
        <div class="mb-3">
            <label for="imageUpload" class="form-label fw-semibold">Tambah Gambar:</label>

            <div class="input-group shadow-sm">

                <input type="file" class="form-control" id="imageUpload" accept="image/*" onchange="addImage(event)">
            </div>

            <small class="text-muted">Format: JPG, PNG | Maks: 2MB</small>
        </div>

    </div>

    <!-- MAIN LAYOUT: 3 KOLON -->
    <div class="layout">
        <div class="sidebar sidebar-left">
            <h3>Pilih Template</h3>
            <div class="template-gallery">
                @foreach ($templates as $template)
                    <div class="template-card">
                        <div class="template-thumb-wrapper">
                            <img src="{{ asset('storage/img/MOCKUP/' . $template->image_path) }}"
                                alt="{{ $template->name }}" class="template-thumb"
                                onclick="setAsBackground('{{ asset('storage/img/MOCKUP/' . $template->image_path) }}')">
                            <!-- Gambar kecil kanan bawah -->
                            <img src="{{ asset('storage/img/MOCKUP/' . $template->image_cover) }}" alt="thumb"
                                style="position: absolute; right: 10px; top: 10px; width: 60px;
                                   border-radius: 6px; background: rgba(255,255,255,0.8); padding: 3px;">
                            <!-- Keterangan Premium / Gratis -->
                            <span class="badge-position left-bottom"
                                style="background-color: {{ $template->is_paid ? '#dc3545' : '#28a745' }}">
                                {{ $template->is_paid ? 'Premium' : 'Gratis' }}
                            </span>

                            <!-- Jumlah Pemakaian -->
                            <span class="badge-position right-bottom">
                                {{ $template->usage_count }}x digunakan
                            </span>
                        </div>
                        <div class="template-info">
                            <strong>{{ $template->name }}</strong>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>



        <!-- TENGAH: Canvas -->
        <div class="main-canvas">
            <div class="canvas-container">
                <canvas id="canvas" width="600" height="400"></canvas>
            </div>
        </div>

        <!-- KANAN: Tools Lanjutan -->
        <div class="sidebar sidebar-right">
            <!-- Colors -->
            <div class="tool-group">
                <h3>Warna</h3>
                <div class="color-palette">
                    <input type="color" class="color-picker" value="#ff6b6b" onchange="changeColor(this.value)">

                </div>
            </div>

            <!-- Text Properties -->
            <div class="tool-group" id="textProperties">
                <h3>Properti Teks</h3>
                <div class="input-group">
                    <label>Font Family:</label>
                    <select id="fontFamily" onchange="changeFontFamily()">
                        <option value="Arial">Arial</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Helvetica">Helvetica</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Verdana">Verdana</option>
                        <option value="Pacifico">Pacifico</option>
                        <option value="Roboto">Roboto</option>
                    </select>
                </div>
                <div class="slider-group">
                    <label>Ukuran Font: <span id="fontSizeValue">20</span></label>
                    <input type="range" class="slider" id="fontSize" min="10" max="100" value="20"
                        onchange="changeFontSize()">
                </div>
                <div class="toolbar">
                    <button class="btn" onclick="toggleBold()">𝐁</button>
                    <button class="btn" onclick="toggleItalic()">𝐼</button>
                    <button class="btn" onclick="toggleUnderline()">U̲</button>
                </div>
            </div>

            <!-- Object Properties -->
            <div class="properties-panel">
                <h4>Properti Objek</h4>
                <div class="toolbar">
                    <button class="btn btn-secondary" onclick="bringToFront()">↑</button>
                    <button class="btn btn-secondary" onclick="sendToBack()">↓</button>
                    <button class="btn btn-secondary" onclick="deleteSelected()">🗑️</button>
                </div>
                <div class="slider-group">
                    <label>Opacity: <span id="opacityValue">100</span>%</label>
                    <input type="range" class="slider" id="opacity" min="0" max="100" value="100"
                        onchange="changeOpacity()">
                </div>
            </div>

            <div class="tool-group">
                <h4>Orientasi Halaman</h4>
                <div class="toolbar">
                    <button class="btn btn-secondary" onclick="setPageOrientation('horizontal')">Horizontal</button>
                    <button class="btn btn-secondary" onclick="setPageOrientation('vertical')">Vertikal</button>
                </div>
            </div>

        </div>
    </div>



    <div class="export-options">
        <button class="btn" onclick="downloadPNG()">📥 PNG</button>
        <button class="btn" onclick="downloadSVG()">📥 SVG</button>
        <button class="btn" onclick="downloadJPG()">📥 JPG</button>
        <button class="btn" onclick="saveProject()">💾 Simpan</button>
    </div>


    <form id="projectForm" method="POST" action="{{ route('project.store') }}">
        @csrf
        <input type="hidden" id="project_id" name="project_id" value="{{ $project->id ?? '' }}">
        <input type="hidden" name="template_id" value="{{ $template_id ?? 1 }}">
        <input type="hidden" name="canvas_json" id="canvas_json">
        <input type="hidden" name="image_path" id="image_path">
    </form>

    <!-- Script Fabric -->
    <script>
        const canvas = new fabric.Canvas('canvas');

        @if (isset($project))
            const savedJson = {!! json_encode($project->canvas_json) !!};
            canvas.loadFromJSON(savedJson, canvas.renderAll.bind(canvas));
        @endif

        function setPageOrientation(mode) {
            let width, height;

            if (mode === 'horizontal') {
                width = 600;
                height = 400;
            } else if (mode === 'vertical') {
                width = 400;
                height = 600;
            }

            // Ubah ukuran canvas HTML dan Fabric
            const canvasEl = document.getElementById('canvas');
            canvasEl.width = width;
            canvasEl.height = height;

            canvas.setWidth(width);
            canvas.setHeight(height);


        }

        function setAsBackground(imageUrl) {
            fabric.Image.fromURL(imageUrl, function(img) {
                canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
                    scaleX: canvas.width / img.width,
                    scaleY: canvas.height / img.height
                });
            });
        }

        function addText() {
            const text = document.getElementById("textInput").value;
            const textbox = new fabric.Textbox(text, {
                left: 50,
                top: 50,
                fontSize: 20,
                fill: '#333',
                fontFamily: 'Arial',
            });
            canvas.add(textbox);
        }

        function addRect() {
            const rect = new fabric.Rect({
                left: 100,
                top: 100,
                width: 100,
                height: 60,
                fill: '#4ecdc4'
            });
            canvas.add(rect);
        }

        function addCircle() {
            const circle = new fabric.Circle({
                left: 150,
                top: 150,
                radius: 50,
                fill: '#f9ca24'
            });
            canvas.add(circle);
        }

        function addTriangle() {
            const triangle = new fabric.Triangle({
                left: 200,
                top: 200,
                width: 80,
                height: 80,
                fill: '#6c5ce7'
            });
            canvas.add(triangle);
        }

        function addImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(f) {
                fabric.Image.fromURL(f.target.result, function(img) {
                    img.set({
                        left: 50,
                        top: 50,
                        scaleX: 0.5,
                        scaleY: 0.5
                    });
                    canvas.add(img);
                });
            };
            reader.readAsDataURL(file);
        }

        function setBackground(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(f) {
                fabric.Image.fromURL(f.target.result, function(img) {
                    canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
                        scaleX: canvas.width / img.width,
                        scaleY: canvas.height / img.height
                    });
                });
            };
            reader.readAsDataURL(file);
        }

        // Style functions
        function changeColor(color) {
            const activeObject = canvas.getActiveObject();
            console.log('Active Object:', activeObject);

            if (activeObject) {
                activeObject.set('fill', color);
                canvas.renderAll();
            } else {
                alert("pilih warna kemudian Tidak ada objek yang dipilih.");
            }
        }


        function changeFontFamily() {
            const activeObject = canvas.getActiveObject();
            const fontFamily = document.getElementById('fontFamily').value;
            if (activeObject && activeObject.text) {
                activeObject.set('fontFamily', fontFamily);
                fabric.util.clearFabricFontCache();
                canvas.renderAll();
            }
        }

        function changeFontSize() {
            const activeObject = canvas.getActiveObject();
            const fontSize = document.getElementById('fontSize').value;
            document.getElementById('fontSizeValue').textContent = fontSize;
            if (activeObject && activeObject.text) {
                activeObject.set('fontSize', parseInt(fontSize));
                canvas.renderAll();
            }
        }

        function toggleBold() {
            const activeObject = canvas.getActiveObject();
            if (activeObject && activeObject.text) {
                const isBold = activeObject.fontWeight === 'bold';
                activeObject.set('fontWeight', isBold ? 'normal' : 'bold');
                canvas.renderAll();
            }
        }

        function toggleItalic() {
            const activeObject = canvas.getActiveObject();
            if (activeObject && activeObject.text) {
                const isItalic = activeObject.fontStyle === 'italic';
                activeObject.set('fontStyle', isItalic ? 'normal' : 'italic');
                canvas.renderAll();
            }
        }

        function toggleUnderline() {
            const activeObject = canvas.getActiveObject();
            if (activeObject && activeObject.text) {
                const isUnderlined = activeObject.underline === true;
                activeObject.set('underline', !isUnderlined);
                canvas.renderAll();
            }
        }

        // Object manipulation functions
        function bringToFront() {
            const activeObject = canvas.getActiveObject();
            if (activeObject) {
                canvas.bringToFront(activeObject);
            }
        }

        function sendToBack() {
            const activeObject = canvas.getActiveObject();
            if (activeObject) {
                canvas.sendToBack(activeObject);
            }
        }

        function deleteSelected() {
            const activeObject = canvas.getActiveObject();
            if (activeObject) {
                canvas.remove(activeObject);
            }
        }

        function changeOpacity() {
            const activeObject = canvas.getActiveObject();
            const opacity = document.getElementById('opacity').value;
            document.getElementById('opacityValue').textContent = opacity;
            if (activeObject) {
                activeObject.set('opacity', opacity / 100);
                canvas.renderAll();
            }
        }

        function downloadPNG() {
            const link = document.createElement('a');
            link.href = canvas.toDataURL({
                format: 'png'
            });
            link.download = 'desain.png';
            link.click();
        }

        function downloadSVG() {
            const link = document.createElement('a');
            const svg = canvas.toSVG();
            const blob = new Blob([svg], {
                type: 'image/svg+xml'
            });
            link.href = URL.createObjectURL(blob);
            link.download = 'desain.svg';
            link.click();
        }

        function downloadJPG() {
            // Simpan background sebelumnya (jika ada)
            const originalBgColor = canvas.backgroundColor;
            const originalBgImage = canvas.backgroundImage;

            // Set background jadi putih sementara
            canvas.setBackgroundColor('white', canvas.renderAll.bind(canvas));

            // Tunggu sebentar lalu ekspor
            setTimeout(() => {
                const dataURL = canvas.toDataURL({
                    format: 'jpeg',
                    quality: 1.0
                });

                // Kembalikan background ke semula
                canvas.setBackgroundColor(originalBgColor || null, () => {
                    canvas.setBackgroundImage(originalBgImage || null, canvas.renderAll.bind(canvas));
                });

                // Unduh file JPG
                const link = document.createElement('a');
                link.href = dataURL;
                link.download = 'desain.jpg';
                link.click();
            }, 100); // Delay kecil agar render background putih sempat selesai
        }

        function saveProject() {
            // 1. Simpan canvas ke JSON
            const json = JSON.stringify(canvas.toJSON());
            document.getElementById('canvas_json').value = json;

            // 2. Simpan sebagai base64 image
            const dataURL = canvas.toDataURL({
                format: 'png',
                quality: 1
            });
            document.getElementById('image_path').value = dataURL;

            // 3. Submit form
            document.getElementById('projectForm').submit();
        }
    </script>

</body>

</html>
