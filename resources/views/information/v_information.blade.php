@extends('layout.v_template')

@section('title', 'Information')
@section('content')

<link rel="stylesheet" href="{{ asset('style/information/information.css') }}">

<div class="container">
    <div class="header">
        <h1>Informasi</h1>
    </div>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pelatih'))
        <a href="{{ route('information.create') }}" class="btn-add fa fa-plus-square"> Tambah Informasi</a>
    @endif

    <div id="informationTable" class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Judul</th>
                    <th class="text-center">Deskripsi</th>
                    @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pelatih'))
                        <th class="text-center">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($information as $index => $info)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $info->heading }}</td> <!-- Display the heading/title -->
                        <td>{{ $info->description }}</td>
                        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pelatih'))
                            <td class="text-center action-buttons">
                                <a href="{{ route('information.edit', $info->id) }}" class="btn-edit fa fa-pencil-square-o"> Edit</a>
                                <form id="delete-form-{{ $info->id }}" action="{{ route('information.destroy', $info->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-delete fa fa-trash" onclick="confirmDelete('{{ $info->id }}')"> Hapus</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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
