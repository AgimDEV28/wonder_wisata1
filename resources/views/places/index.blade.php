@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <div class="rounded-[2rem] bg-gradient-to-br from-amber-400 via-fuchsia-500 to-sky-500 p-8 text-slate-950 shadow-2xl shadow-slate-950/20">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div class="max-w-2xl">
                <p class="text-sm uppercase tracking-[0.3em] text-slate-900/70">Destinasi Wisata</p>
                <h1 class="mt-3 text-3xl font-semibold text-slate-950 sm:text-4xl">Jelajahi liburan impian mulai dari Labuhan Bajo hingga Bali.</h1>
                <p class="mt-4 text-slate-950/80">Rasakan pilihan wisata lengkap: pantai eksotis, danau megah, pegunungan hijau, dan budaya pulau Dewata.</p>
            </div>
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-950/30 transition hover:bg-slate-900">Kembali ke Utama</a>
        </div>
    </div>
    @guest
        <div class="rounded-[2rem] border border-white/10 bg-white/10 p-6 text-white shadow-2xl shadow-slate-950/10 backdrop-blur">
            <p class="text-sm text-white/80">Kamu belum login, jadi tombol booking akan tampil sebagai link login.</p>
            <a href="{{ route('login') }}" class="mt-4 inline-flex rounded-full bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300">Masuk untuk Pesan</a>
        </div>
    @else
        <div class="rounded-[2rem] border border-white/10 bg-white/10 p-6 text-white shadow-2xl shadow-slate-950/10 backdrop-blur">
            <p class="text-sm text-white/80">Halo, {{ auth()->user()->name }}. Scroll ke bawah untuk menemukan tombol <span class="font-semibold">Pesan Sekarang</span> di setiap destinasi.</p>
        </div>
    @endguest

    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3 auto-rows-fr">
        @foreach($places as $place)
            <div class="group overflow-hidden rounded-[2rem] bg-white/10 text-white shadow-2xl shadow-slate-950/20 transition duration-500 hover:-translate-y-2 hover:shadow-2xl animate-fade-in-up" style="animation-delay: {{ $loop->index * 100 }}ms">
                @if($place->image)
                    <div class="overflow-hidden rounded-t-[2rem]">
                        <img src="{{ $place->image }}" alt="{{ $place->name }}" class="h-52 w-full object-cover object-center transition duration-500 group-hover:scale-105" />
                    </div>
                @endif

                <div class="flex h-full flex-col">
                    <div class="space-y-4 p-6 flex-1">
                        <div class="flex items-center justify-between gap-3">
                            <h2 class="text-xl font-semibold">{{ $place->name }}</h2>
                            <span class="rounded-full bg-amber-400 px-3 py-1 text-sm font-semibold text-slate-950">Best</span>
                        </div>

                        <p class="text-sm text-slate-200">{{ $place->description }}</p>
                    </div>

                    <div class="mt-6 rounded-b-[2rem] bg-slate-950/80 p-6 pt-0">
                        <div class="flex flex-col gap-4">
                            <span class="text-lg font-semibold">Rp {{ number_format($place->price, 0, ',', '.') }}</span>
                            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                @auth
                                    <form action="{{ route('places.order', $place) }}" method="POST" class="inline-flex w-full sm:w-auto">
                                        @csrf
                                        <button type="submit" class="w-full rounded-full bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300 sm:w-auto">Pesan Sekarang</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="inline-flex w-full items-center justify-center rounded-full border border-white/20 bg-white/10 px-5 py-3 text-sm font-semibold text-white transition hover:border-amber-300 hover:bg-white/20 sm:w-auto">Pesan Sekarang</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
