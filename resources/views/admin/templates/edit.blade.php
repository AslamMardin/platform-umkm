@extends('layouts.app')
@section('title', 'Edit Template')
@section('content')
    <div class="form-wrapper">
        <h2>Edit Template</h2>

        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('templates.update', $template->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Template</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $template->name) }}" required>
            </div>

            <div class="form-group">
                <label>Jenis Template</label>
                <select name="jenis" class="form-control" required>
                    <option value="kotak" {{ old('jenis', $template->jenis) == 'kotak' ? 'selected' : '' }}>Kotak</option>
                    <option value="stiker" {{ old('jenis', $template->jenis) == 'stiker' ? 'selected' : '' }}>Stiker
                    </option>
                </select>
            </div>

            <div class="form-group-row">
                <div class="form-input">
                    <label>Gambar Utama (biarkan kosong jika tidak ganti)</label>
                    <input type="file" name="image_path" class="form-control"
                        onchange="previewImage(this, '#mainPreview')">
                </div>
                <div class="form-preview">
                    <label>Preview:</label><br>
                    <img id="mainPreview" src="{{ asset('storage/img/MOCKUP/' . $template->image_path) }}"
                        style="max-height: 160px; border: 1px solid #ccc; padding: 6px; border-radius: 6px;">
                </div>
            </div>

            <div class="form-group-row">
                <div class="form-input">
                    <label>Gambar Cover (biarkan kosong jika tidak ganti)</label>
                    <input type="file" name="image_cover" class="form-control"
                        onchange="previewImage(this, '#coverPreview')">
                </div>
                <div class="form-preview">
                    <label>Preview:</label><br>
                    <img id="coverPreview"
                        src="{{ $template->image_cover ? asset('storage/img/MOCKUP/' . $template->image_cover) : '' }}"
                        style="max-height: 160px; {{ $template->image_cover ? '' : 'display:none;' }} border: 1px solid #ccc; padding: 6px; border-radius: 6px;">
                </div>
            </div>

            <div class="form-group">
                <input type="hidden" name="is_paid" value="0">

                <label>
                    <input type="checkbox" name="is_paid" value="1"
                        {{ old('is_paid', $template->is_paid ?? false) ? 'checked' : '' }}>
                    Template Premium?
                </label>
            </div>

            <button type="submit" class="btn btn-success">Update Template</button>
            <a href="{{ route('templates.index') }}" class="btn">Batal</a>
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
