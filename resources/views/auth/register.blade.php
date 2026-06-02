@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-xl overflow-hidden rounded-[2rem] bg-gradient-to-br from-violet-500 via-fuchsia-500 to-cyan-500 text-slate-950 shadow-2xl shadow-slate-950/30">
    <div class="p-10">
        <p class="text-sm uppercase tracking-[0.32em] text-white/80">Daftar Akun</p>
        <h1 class="mt-4 text-3xl font-semibold text-white">Bergabung dengan komunitas traveler.</h1>
        <p class="mt-3 max-w-xl text-sm leading-7 text-white/80">Buat akun untuk memesan tujuan wisata dan cek status reservasi kapan saja.</p>
    </div>
    <div class="space-y-6 p-8 bg-slate-950/95">
        <form action="{{ route('register.post') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-200">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="mt-2 w-full rounded-3xl border border-pink-500/20 bg-slate-900 px-4 py-3 text-sm text-white outline-none transition focus:border-pink-400 focus:ring-2 focus:ring-pink-500/20" />
                @error('name')<p class="mt-2 text-sm text-rose-400">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-200">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="mt-2 w-full rounded-3xl border border-pink-500/20 bg-slate-900 px-4 py-3 text-sm text-white outline-none transition focus:border-pink-400 focus:ring-2 focus:ring-pink-500/20" />
                @error('email')<p class="mt-2 text-sm text-rose-400">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-200">Password</label>
                <input type="password" name="password" required class="mt-2 w-full rounded-3xl border border-pink-500/20 bg-slate-900 px-4 py-3 text-sm text-white outline-none transition focus:border-pink-400 focus:ring-2 focus:ring-pink-500/20" />
                @error('password')<p class="mt-2 text-sm text-rose-400">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-200">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="mt-2 w-full rounded-3xl border border-pink-500/20 bg-slate-900 px-4 py-3 text-sm text-white outline-none transition focus:border-pink-400 focus:ring-2 focus:ring-pink-500/20" />
            </div>
            <button type="submit" class="w-full rounded-full bg-amber-400 px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-amber-300 animate-float">Daftar Sekarang</button>
        </form>

        <p class="text-center text-sm text-slate-400">Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-white underline decoration-amber-300">Masuk</a>.</p>
    </div>
</div>
@endsection
