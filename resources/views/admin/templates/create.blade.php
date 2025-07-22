@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="form-wrapper">
        <h2>Tambah Template Baru</h2>

        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('templates-app.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Nama Template</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label>Jenis Template</label>
                <select name="jenis" class="form-control" required>
                    <option value="kotak" {{ old('jenis') == 'kotak' ? 'selected' : '' }}>Kotak</option>
                    <option value="stiker" {{ old('jenis') == 'stiker' ? 'selected' : '' }}>Stiker</option>
                </select>
            </div>

            <div class="form-group-row">
                <div class="form-input">
                    <label>Gambar Utama (.jpg/.png)</label>
                    <input type="file" name="image_path" class="form-control"
                        onchange="previewImage(this, '#mainPreview')" {{ isset($template) ? '' : 'required' }}>
                </div>
                <div class="form-preview">
                    <label>Preview:</label><br>
                    <img id="mainPreview"
                        src="{{ isset($template) && $template->image_path ? asset('storage/' . $template->image_path) : '' }}"
                        style="max-height: 160px; {{ isset($template) ? '' : 'display:none;' }} border: 1px solid #ccc; padding: 6px; border-radius: 6px;">
                </div>
            </div>

            <div class="form-group-row">
                <div class="form-input">
                    <label>Gambar Cover</label>
                    <input type="file" name="image_cover" class="form-control"
                        onchange="previewImage(this, '#coverPreview')">
                </div>
                <div class="form-preview">
                    <label>Preview:</label><br>
                    <img id="coverPreview"
                        src="{{ isset($template) && $template->image_cover ? asset('storage/' . $template->image_cover) : '' }}"
                        style="max-height: 160px; {{ isset($template) ? '' : 'display:none;' }} border: 1px solid #ccc; padding: 6px; border-radius: 6px;">
                </div>
            </div>


            <div class="form-group">
                <label>
                    <input type="checkbox" name="is_paid" {{ old('is_paid') ? 'checked' : '' }}>
                    Template Premium?
                </label>
            </div>

            <button type="submit" class="btn btn-success">Simpan Template</button>
            <a href="{{ route('templates-app.index') }}" class="btn">Kembali</a>
        </form>
    </div>
@endsection

@push('styles')
    <style>
        .form-wrapper {
            background: #fff;
            padding: 24px;
            border-radius: 8px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .form-wrapper h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .btn {
            padding: 8px 14px;
            border-radius: 6px;
            border: none;
            text-decoration: none;
            cursor: pointer;
            color: white;
            background-color: #007bff;
            margin-right: 8px;
        }

        .btn-success {
            background-color: #28a745;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
        }

        .alert-error ul {
            margin: 0;
            padding-left: 20px;
        }

        .form-group-row {
            display: flex;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .form-input {
            flex: 1;
            min-width: 200px;
        }

        .form-preview {
            flex: 1;
            min-width: 200px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .form-preview img {
            background: #f8f8f8;
            max-width: 100%;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function previewImage(input, targetId) {
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.querySelector(targetId);
                img.src = e.target.result;
                img.style.display = 'block';
            }
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
