<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Wisata') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(255,255,255,0.16),_transparent_25%),linear-gradient(180deg,#0b2d67_0%,#7b2ff7_100%)] text-slate-100">
    <div class="min-h-screen flex flex-col">
        <header class="sticky top-0 z-20 bg-slate-950/70 backdrop-blur-xl border-b border-white/10 shadow-2xl shadow-slate-950/40">
            <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-3 px-4 py-4 sm:px-6 lg:px-8">
                <a href="{{ route('home') }}" class="flex items-center gap-3 text-white">
                    <span class="inline-flex h-11 w-11 items-center justify-center rounded-3xl bg-amber-400 text-lg font-bold text-slate-950 shadow-lg shadow-amber-500/20">W</span>
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.22em]">WonderTrip</p>
                        <p class="text-xs text-white/70">Wisata Ceria</p>
                    </div>
                </a>

                <nav class="hidden items-center gap-7 text-sm font-medium text-white/80 lg:flex">
                    <a href="{{ route('home') }}" class="transition hover:text-amber-300">Beranda</a>
                    <a href="{{ route('places.index') }}" class="transition hover:text-amber-300">Destinasi</a>
                    <a href="{{ route('orders.index') }}" class="transition hover:text-amber-300">Pesanan</a>
                    <a href="#" class="transition hover:text-amber-300">Tentang</a>
                </nav>

                <div class="ml-auto flex flex-wrap items-center gap-3">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="rounded-full bg-amber-400 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-amber-300">Admin</a>
                        @endif
                        <a href="{{ route('orders.index') }}" class="rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-semibold text-white transition hover:border-amber-300 hover:text-amber-200">Pesanan</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="rounded-full bg-cyan-400 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-semibold text-white transition hover:border-amber-300 hover:text-amber-200">Masuk</a>
                        <a href="{{ route('register') }}" class="rounded-full bg-amber-400 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-amber-300">Daftar</a>
                    @endauth
                </div>
            </div>
        </header>

        <main class="flex-1">
            <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="mb-6 rounded-3xl bg-emerald-500/10 p-4 text-sm text-emerald-100 ring-1 ring-emerald-300/30">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('message'))
                    <div class="mb-6 rounded-3xl bg-sky-500/10 p-4 text-sm text-sky-100 ring-1 ring-sky-300/30">
                        {{ session('message') }}
                    </div>
                @endif
                @yield('content')
            </div>
        </main>

        <footer class="border-t border-white/10 bg-slate-950/80 py-6 text-white/70">
            <div class="mx-auto max-w-7xl px-4 text-center text-sm sm:px-6 lg:px-8">
                © {{ date('Y') }} Wonderful Wisata. Tema penuh warna dan semangat perjalanan.
            </div>
        </footer>
    </div>
</body>
</html>
