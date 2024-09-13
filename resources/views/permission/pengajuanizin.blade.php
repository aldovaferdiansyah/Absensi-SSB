@extends('layout.v_template')

@section('title', 'Pengajuan Izin')
@section('content')

<link rel="stylesheet" href="{{ asset('style/pengajuanIzin.css') }}">

<div class="form-container">

    <form action="{{ route('izin.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <h2>Form Pengajuan Izin</h2>

        <div class="form-group">
            <label for="name">Nama</label> <br>
            @if (!Auth::user()->hasRole('admin'))
                <small class="form-text text-muted" style="color: red;">Nama Tidak Dapat DiUbah.</small>
            @endif
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="{{ Auth::user()->hasRole('admin') ? '' : 'input-readonly' }}" {{ Auth::user()->hasRole('admin') ? '' : 'readonly' }}>
        </div>

        <div class="form-group">
            <label for="start_date">Tanggal Mulai Izin</label>
            <input type="date" id="start_date" name="start_date">
            <div class="text-danger">
                @error('start_date')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="end_date">Tanggal Akhir Izin</label>
            <input type="date" id="end_date" name="end_date">
            <div class="text-danger">
                @error('end_date')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="type">Jenis Izin</label>
            <select id="type" name="type">
                <option value=" ">Pilih Jenis Izin</option>
                <option value="sakit">Sakit</option>
                <option value="pribadi">Keperluan Pribadi</option>
                <option value="lainnya">Lainnya</option>
            </select>
            <div class="text-danger">
                @error('type')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="reason">Alasan Izin</label>
            <textarea class="form-control" id="reason" name="reason" rows="4"></textarea>
            <div class="text-danger">
                @error('reason')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="proof">Unggah Bukti (Format Foto)</label>
            <input type="file" id="proof" name="proof" accept="image/*">
            <div class="text-danger">
                @error('proof')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
        </div>

        <div class="button-container">
            <a href="{{ route('rekapizin.index') }}" class="btn btn-secondary">Status Pengajuan Izin</a>
        </div>
    </form>
</div>

<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    @endif
</script>
@endsection
