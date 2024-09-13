@extends('layout.v_template')

@section('title', 'Informasi Data Akun User')
@section('content')

<link rel="stylesheet" href="{{ asset('style/dataAkun/dataAkun.css') }}">

<div class="container">
    <div class="header">
        <h1>Data User</h1>
    </div>

    <a href="{{ route('users.create') }}" class="btn-tambah fa fa-plus-square"> Akun Baru</a>

    <div class="filters">
        <form method="GET" action="{{ route('users.index') }}" style="display: flex; flex-wrap: wrap; align-items: center;">

            <label for="name">Cari Nama:</label>
            <input type="text" id="name" name="name" placeholder="Masukkan Nama ..." value="{{ request('name') }}" class="full-width">

            <label for="month">Cari Peran:</label>
            <select name="role" class="full-width">
                <option value="">Semua Peran</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
            </select>

            <button type="submit" class="filter-button">Tampilkan</button>
        </form>
    </div>


    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Hak Akses Sebagai</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getRoleNames()->first() }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning fa fa-pencil-square-o"> Edit</a>
                        @if (!$user->hasRole('admin'))
                            <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger fa fa-trash" onclick="confirmDelete('{{ $user->id }}')"> Hapus</button>
                            </form>
                        @else
                            <button type="button" class="btn btn-secondary fa fa-trash" disabled> Hapus</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data ini akan dihapus secara permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#28a745',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    }
</script>

@endsection
