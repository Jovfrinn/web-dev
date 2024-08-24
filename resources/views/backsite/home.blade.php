@extends('backsite.layouts.app')

@section('content-home')
<div class="sidebar">
    <a class="logo" {{ Route::currentRouteName() == 'category-air-mineral' ? 'active' : '' }} href=""><span class="material-symbols-outlined">
        home
        </span></a>
    <a class="logo" href="">Minuman botol</a>
    <a class="logo" href="">Minuman Jus</a>
    <a class="logo" href="">Minuman Kopi</a>
    <a class="logo" href="">Minuman Ringan</a>
    <a class="logo" href="">Minuman Sirup</a>
    <a class="logo" href="">Minuman Susu</a>
    <a class="logo" href="">Minuman Teh</a>
  </div>
@endsection

