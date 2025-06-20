@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Manajemen Akun User</h3>

        @if (session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered mt-4">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $u)
                    <tr>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>
                            @if ($u->is_premium)
                                <span class="badge bg-success">Premium</span>
                            @else
                                <span class="badge bg-secondary">Gratis</span>
                            @endif
                        </td>
                        <td>
                            @if (!$u->is_premium)
                                <form method="POST" action="{{ route('admin.makePremium', $u->id) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-warning">Ubah jadi Premium</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.makeGratis', $u->id) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-secondary">Ubah jadi Gratis</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
