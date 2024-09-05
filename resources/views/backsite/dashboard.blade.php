@extends('backsite.layouts.app')

@section('content-home')
<div class="sidebar-admin">
    <d  iv class="logo-container">
        <img src="{{ asset('assets/logoCN.png') }}" alt="Logo" class="logo">
        <span class="logo-text">Tefa SMK Citra Negara</span>
    </d>
    <a href=""><span class="material-symbols-outlined" style="display:flex; align-items:center; justify-content:center;">
        Dashboard
        </span></a>
    <a href=""><span class="material-symbols-outlined" style="display:flex; align-items:center; justify-content:center;">
        Inventory
        </span></a>
    <a href=""><span class="material-symbols-outlined" style="display:flex; align-items:center; justify-content:center;">
        account_Circle
        </span></a>
    <a href=""><span class="material-symbols-outlined" style="display:flex; align-items:center; justify-content:center;">
            local_shipping
        </span></a>
    <a href=""><span class="material-symbols-outlined" style="display:flex; align-items:center; justify-content:center;">
            assignment_add
        </span></a>
    <a href=""><span class="material-symbols-outlined" style="display:flex; align-items:center; justify-content:center;">
            Monitoring
        </span></a>

    <a href=""><span class="material-symbols-outlined" style="display:flex; align-items:center; justify-content:center;">
        Login
        </span></a>
  </div>
   <header>
       <div class="page-information">
          <h1>Dashboard</h1>
       </div>
        <div class="profile">
            <img src="{{ asset('assets/logoCN.png') }}" alt="profile picture">
            <h2 id="username"></h2>
        </div>
   </header>
   <main>
       <div class="cards">
        <div class="card">
            <h3>Card 1</h3>
            <p>Deskripsi Card</p>
            <a href="halaman-lain-1.html">Lihat Selengkapnya</a>
        </div>

        <div class="card">
            <h3>Card 2</h3>
            <p>Deskripsi Card 2</p>
            <a href="halaman-lain-2.html">Lihat Selengkapnya</a>
        </div>
       </div>
   </main>






@endsection

