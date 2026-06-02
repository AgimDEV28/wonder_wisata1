@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <section class="rounded-[2rem] bg-gradient-to-br from-cyan-500 via-blue-600 to-slate-950 p-8 text-white shadow-2xl shadow-cyan-500/20">
        <p class="text-sm uppercase tracking-[0.3em] text-white/75">Pesanan Kamu</p>
        <h1 class="mt-4 text-3xl font-semibold">Pesanan Wisata Saya</h1>
        <p class="mt-3 max-w-2xl text-white/80">Lihat status pesanan dan ketahui apakah admin sudah menyetujui destinasi yang kamu pilih.</p>
        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <a href="{{ route('places.index') }}" class="inline-flex items-center justify-center rounded-full bg-white px-6 py-3 text-sm font-semibold text-slate-950 shadow-lg shadow-slate-950/20 transition hover:bg-slate-100">Cari Tempat Lagi</a>
            <p class="text-sm text-white/70">Atau kembali ke <a href="{{ route('home') }}" class="font-semibold text-cyan-200">Beranda</a> untuk melihat highlight destinasi.</p>
        </div>
    </section>

    <div class="grid gap-6 lg:grid-cols-2">
        @forelse($orders as $order)
            <div class="overflow-hidden rounded-[2rem] bg-slate-950/95 shadow-2xl shadow-slate-950/40 ring-1 ring-white/10 transition hover:-translate-y-1 hover:shadow-cyan-500/30">
                <div class="bg-gradient-to-br from-amber-400 via-fuchsia-500 to-cyan-500 px-6 py-5 text-slate-950">
                    <h2 class="text-2xl font-semibold">{{ $order->place->name }}</h2>
                    <p class="mt-2 text-sm text-slate-700">{{ $order->place->description }}</p>
                </div>
                <div class="space-y-4 p-6">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm text-slate-400">Harga</p>
                            <p class="mt-1 text-lg font-semibold text-white">Rp {{ number_format($order->place->price, 0, ',', '.') }}</p>
                        </div>
                        <span class="inline-flex rounded-full px-4 py-2 text-sm font-semibold {{ $order->status === 'approved' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">{{ $order->status === 'approved' ? 'DISETUJUI' : 'MENUNGGU' }}</span>
                    </div>
                    <p class="text-sm leading-7 text-slate-300">Tanggal pemesanan: {{ $order->created_at->format('d M Y') }}</p>
                </div>
            </div>
        @empty
            <div class="rounded-[2rem] bg-slate-950/90 p-8 text-slate-100 shadow-2xl shadow-slate-950/40 ring-1 ring-white/10">
                <p class="text-base">Belum ada pesanan. Kunjungi halaman <a href="{{ route('places.index') }}" class="font-semibold text-cyan-300">Tempat Wisata</a> untuk memesan destinasi.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
