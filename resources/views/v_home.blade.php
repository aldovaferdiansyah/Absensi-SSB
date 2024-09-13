@extends('layout.v_template')

@section('title', 'Home')
@section('content')

<link rel="stylesheet" href="{{ asset('style/home.css') }}">

<div class="container">
    <div class="header-section">
        <div class="logo-and-title">
            <div class="title-and-welcome">
                <div class="welcome-message">
                    <h1>Selamat Datang</h1>
                    <h2>{{ $userName }}</h2>
                </div>
                <div class="separator"></div>
                <div class="title">
                    <h1>{{ $settings->nama_SSB ?? 'Default SSB Name' }}</h1>
                    <h2>{{ $settings->alamat ?? 'Default Address' }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-section">
        <div class="logossb">
            <img src="{{ $settings->logo_SSB ? asset('foto_logo/' . $settings->logo_SSB) : asset('foto_logo/default_logo.png') }}" alt="logo">
        </div>
        <div class="profile-section">
            <h3>{{ $settings->profile_title ?? 'Sejarah Singkat' }}</h3>
            <p>{{ $settings->profile_content ?? 'Deskripsi singkat belum tersedia.' }}</p>
        </div>
    </div>
</div>

@endsection
