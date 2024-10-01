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
            <label for="role">Hak Akses</label> <br>
            @if (!Auth::user()->hasRole('admin'))
                <small class="form-text text-muted" style="color: red;">Hak Akses Tidak Dapat DiUbah.</small>
            @endif
            <input type="text" id="role" name="role" value="{{ Auth::user()->getRoleNames()->first() }}" class="input-readonly" readonly>
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
    <label for="proofType">Pilih Tipe Bukti</label>
    <select id="proofType" class="form-control">
        <option value="camera">Ambil Foto dari Kamera</option>
        <option value="file">Unggah File (PDF/Word)</option>
    </select>
</div>

<!-- Camera input section -->
<div id="cameraSection" style="display: block;">
    <label for="proof">Ambil Foto Bukti (Langsung dari Kamera)</label>

    <!-- Button to access the camera -->
    <button type="button" id="startCamera" class="btn btn-primary mb-2" style="margin-bottom: 10px;">Akses Kamera</button>

    <!-- Video element to show the live camera feed -->
    <video id="camera" autoplay style="width: 100%; height: auto; border: 1px solid #ccc; display: none; "></video>

    <!-- Button to capture the photo -->
    <button type="button" id="capture" class="btn btn-success mt-2" style="display: none; margin: 10px 0 10px 0;">Ambil Foto</button>

    <!-- Canvas to hold the captured image -->
    <canvas id="canvas" style="display: none;"></canvas>

    <!-- Display the captured image -->
    <img id="capturedImage" style="display: none; margin-top: 10px; width: 100%; height: auto; border: 1px solid #ccc;">

    <!-- Hidden input to hold the captured image data for form submission -->
    <input type="hidden" id="proofData" name="proof">
</div>

<!-- File input section for PDF/Word uploads -->
<div id="fileSection" style="display: none;">
    <label for="fileProof">Unggah Bukti (PDF atau Word)</label>
    <input type="file" id="fileProof" name="fileProof" accept=".pdf,.doc,.docx" class="form-control-file">

    <div class="text-danger">
        @error('fileProof')
            {{ $message }}
        @enderror
    </div>
</div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Kirim Pengajuan</button>
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
<script src="{{ asset('js/camera.js') }}"></script>

@endsection
