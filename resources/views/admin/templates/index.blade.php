 @extends('layouts.app')

 @section('title', 'Dashboard')

 @section('content')
     <div class="template-index">
         <h1>Daftar Template</h1>
         <a href="{{ route('templates-app.create') }}">+ Tambah Template</a>
         <table>
             <thead>
                 <tr>
                     <th>Gambar</th>
                     <th>Nama</th>
                     <th>Jenis</th>
                     <th>Status</th>
                     <th>Aksi</th>
                 </tr>
             </thead>
             <tbody>
                 @foreach ($templates as $t)
                     <tr>
                         <td>
                             @if ($t->image_cover)
                                 <img src="{{ asset('storage/img/MOCKUP/' . $t->image_cover) }}" alt="{{ $t->name }}"
                                     style="width: 80px; height: 80px">
                             @else
                                 <em>Tidak ada gambar</em>
                             @endif
                         </td>
                         <td>{{ $t->name }}</td>
                         <td>{{ ucfirst($t->jenis) }}</td>
                         <td>{{ $t->is_paid ? 'Premium' : 'Gratis' }}</td>
                         <td>
                             <a href="{{ route('templates-app.edit', $t->id) }}">Edit</a> |
                             <form action="{{ route('templates-app.destroy', $t->id) }}" method="POST" style="display:inline">
                                 @csrf @method('DELETE')
                                 <button onclick="return confirm('Hapus template ini?')">Hapus</button>
                             </form>
                         </td>
                     </tr>
                 @endforeach
             </tbody>
         </table>
     </div>
 @endsection

 @push('styles')
     <style>
         .template-index h1 {
             text-align: center;
             font-family: Arial, sans-serif;
             margin-bottom: 20px;
             color: #333;
         }

         .template-index a {
             display: inline-block;
             background-color: #4CAF50;
             color: white;
             padding: 8px 12px;
             text-decoration: none;
             border-radius: 4px;
             font-family: Arial, sans-serif;
             margin-bottom: 20px;
         }

         .template-index a:hover {
             background-color: #45a049;
         }

         .template-index table {
             width: 100%;
             border-collapse: collapse;
             font-family: Arial, sans-serif;
             box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
         }

         .template-index thead {
             background-color: #f2f2f2;
         }

         .template-index th {
             padding: 12px;
             text-align: left;
             border-bottom: 1px solid #ddd;
         }

         .template-index td {
             padding: 12px;
             border-bottom: 1px solid #ddd;
         }

         .template-index tr:hover {
             background-color: #fafafa;
         }

         .template-index button {
             background-color: #e74c3c;
             color: white;
             border: none;
             padding: 6px 12px;
             border-radius: 3px;
             cursor: pointer;
             font-size: 14px;
         }

         .template-index button:hover {
             background-color: #c0392b;
         }
     </style>
 @endpush
