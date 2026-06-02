@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <div class="rounded-[2rem] overflow-hidden bg-gradient-to-br from-sky-700 via-indigo-700 to-fuchsia-600 text-white shadow-2xl shadow-slate-950/30">
        <div class="relative">
            @if($place->image)
                <img src="{{ $place->image }}" alt="{{ $place->name }}" class="h-96 w-full object-cover object-center" />
            @else
                <div class="h-96 w-full bg-slate-900"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-transparent to-transparent"></div>
            <div class="absolute inset-x-0 bottom-0 p-8">
                <span class="inline-flex rounded-full bg-amber-400 px-4 py-2 text-sm font-semibold text-slate-950">Destinasi Favorit</span>
                <h1 class="mt-4 text-4xl font-semibold">{{ $place->name }}</h1>
                <p class="mt-4 max-w-3xl text-slate-100/90">{{ $place->description }}</p>
                <div class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm uppercase tracking-[0.3em] text-white/70">Harga per paket</p>
                        <p class="mt-2 text-3xl font-semibold">Rp {{ number_format($place->price, 0, ',', '.') }}</p>
                    </div>
                    @auth
                        <form action="{{ route('places.order', $place) }}" method="POST" class="w-full sm:w-auto">
                            @csrf
                            <button type="submit" class="w-full rounded-full bg-cyan-400 px-6 py-4 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300">Pesan Sekarang</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex w-full items-center justify-center rounded-full border border-white/20 bg-white/10 px-6 py-4 text-sm font-semibold text-white transition hover:border-amber-300 hover:bg-white/20 sm:w-auto">Login untuk Pesan</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-[1.15fr_0.85fr]">
        <div class="rounded-[2rem] bg-white/10 p-8 text-slate-950 shadow-2xl shadow-slate-950/20 ring-1 ring-white/10 backdrop-blur">
            <h2 class="text-3xl font-semibold text-white">Detail Destinasi</h2>
            <p class="mt-4 text-white/80">{{ $place->description }}</p>
            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                <div class="rounded-[1.75rem] bg-slate-950/80 p-5 text-white">
                    <h3 class="font-semibold">Lokasi</h3>
                    <p class="mt-2 text-sm text-white/70">Destinasi unggulan untuk liburan, foto, dan pengalaman lokal.</p>
                </div>
                <div class="rounded-[1.75rem] bg-slate-950/80 p-5 text-white">
                    <h3 class="font-semibold">Termasuk</h3>
                    <p class="mt-2 text-sm text-white/70">Tiket masuk, guide lokal, dan aktivitas menarik sesuai paket.</p>
                </div>
            </div>
        </div>

        <div class="rounded-[2rem] bg-slate-950/90 p-8 text-white shadow-2xl shadow-slate-950/30 ring-1 ring-white/10">
            <h2 class="text-3xl font-semibold">Cara Pesan</h2>
            <ol class="mt-6 space-y-3 text-sm text-white/80">
                <li>1. Klik tombol “Pesan Sekarang”.</li>
                <li>2. Sistem akan memproses pesanan dan mengirim ke admin.</li>
                <li>3. Cek status pesanan di halaman Pesanan.</li>
            </ol>
        </div>
    </div>
</div>
@endsection
