 @extends('layouts.app')

 @section('title', 'Dashboard')

 @section('content')

     <!-- Dashboard Section -->
     <div id="dashboard" class="content-section">
         <!-- Welcome Card -->
         <div class="welcome-card p-4 mb-4">
             <div class="row align-items-center">
                 <div class="col-md-8">
                     <h3 class="fw-bold mb-2">Selamat Datang di Platform UMKM!</h3>
                     <p class="mb-3">Mulai buat desain kemasan nasi kotak yang menarik untuk produk UMKM
                         Anda</p>
                     <a class="btn btn-light btn-lg" href="{{ route('editor') }}">
                         <i class="fas fa-plus me-2"></i>Buat Desain Baru
                     </a>
                 </div>
                 <div class="col-md-4 text-center">
                     <i class="fas fa-box fa-5x opacity-25"></i>
                 </div>
             </div>
         </div>
         @if (session('success'))
             <div class="alert alert-success alert-dismissible fade show" role="alert">
                 <i class="fas fa-check-circle me-2"></i>
                 {{ session('success') }}
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
             </div>
         @endif
         <!-- My Projects Section -->
         <div id="my-projects" class="content-section">
             <div class="d-flex justify-content-between align-items-center mb-4">
                 <h3 class="fw-bold">Project Saya</h3>

             </div>

             <div class="row">
                 @foreach ($projects as $project)
                     <div class="col-md-4 mb-4">
                         <div class="card project-card">
                             <div class="card-body">
                                 <div class="mockup-preview mb-3 text-center">
                                     <img src="{{ asset('storage/' . $project->image_path) }}" alt="Preview"
                                         class="img-fluid rounded" style="max-height: 150px;">
                                     <p class="text-muted mt-2 small">{{ $project->template->name ?? 'Tanpa Nama' }}</p>
                                 </div>

                                 <h6 class="fw-bold">{{ $project->template->name ?? 'Tanpa Nama' }}</h6>
                                 <p class="text-muted small">Dibuat: {{ $project->created_at->diffForHumans() }}</p>
                                 <p class="text-muted small">Status: <span class="badge bg-success">Selesai</span></p>

                                 <div class="d-flex gap-2">
                                     <a href="{{ route('editor', ['id' => $project->id]) }}"
                                         class="btn btn-sm btn-outline-primary flex-fill">Edit</a>


                                     <a href="{{ asset('storage/' . $project->image_path) }}" download
                                         class="btn btn-sm btn-outline-success flex-fill">Download</a>

                                     <form method="POST" action="{{ route('project.delete', $project->id) }}"
                                         onsubmit="return confirm('Hapus project ini?')">
                                         @csrf
                                         @method('DELETE')
                                         <button class="btn btn-sm btn-outline-danger">
                                             <i class="fas fa-trash"></i>
                                         </button>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>
                 @endforeach
             </div>


         </div>







     </div>


 @endsection
