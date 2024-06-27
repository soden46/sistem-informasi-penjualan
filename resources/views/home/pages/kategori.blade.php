@extends('home.layouts.template')

@section('css')
@endsection

@section('main')
    @include('home.layouts.breadcrumb')
    @include('home.layouts.kategori', ['kategori' => $kategori, 'barang' => $barang])
@endsection

@section('script')
@endsection
