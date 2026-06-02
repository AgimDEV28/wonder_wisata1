@extends('layouts.app')

@section('content')
<div class="space-y-10">
    <section class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-sky-500 via-fuchsia-500 to-orange-400 text-slate-950 shadow-2xl shadow-slate-950/20">
        <div class="absolute inset-0 opacity-80 bg-[radial-gradient(circle_at_top_left,_rgba(255,255,255,0.45),_transparent_15%)]"></div>
        <div class="relative mx-auto flex max-w-7xl flex-col gap-8 px-6 py-16 sm:px-10 lg:px-12 lg:py-24">
            <div class="flex flex-col gap-4 lg:max-w-2xl">
                <span class="inline-flex items-center gap-2 rounded-full bg-white/25 px-4 py-2 text-xs uppercase tracking-[0.25em] text-white shadow-sm backdrop-blur">Destinasi Pilihan</span>
                                <h1 class="text-4xl font-semibold tracking-tight text-white sm:text-5xl">Rasakan keajaiban alam dan pesona budaya Indonesia terbaik.</h1>
                <p class="max-w-2xl text-base leading-8 text-white/90">Temukan pengalaman liburan tak terlupakan dengan beragam pilihan destinasi mulai dari pantai eksotis, pegunungan yang asri, hingga danau bersejarah.</p>

                <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap animate-fade-in-up">
                    <a href="{{ route('places.index') }}" class="inline-flex items-center justify-center rounded-full bg-white px-6 py-3 text-sm font-semibold text-slate-950 shadow-lg shadow-slate-950/20 transition duration-300 hover:-translate-y-1 hover:bg-slate-100 animate-float">Jelajahi Sekarang</a>
                    @guest
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full border border-white/40 bg-white/10 px-6 py-3 text-sm font-semibold text-white transition duration-300 hover:border-white hover:bg-white/25 animate-float" style="animation-delay: 0.2s">Daftar Gratis</a>
                    @endguest
                </div>
            </div>

            @php
                $heroGalleryImages = [
                    ['src' => asset('images/labuhan-bajo.jpg'), 'label' => 'Labuan Bajo', 'description' => 'Pemandangan pulau dan laut yang memukau.'],
                    ['src' => asset('images/bali.jpg'), 'label' => 'Bali', 'description' => 'Pantai dan budaya yang kaya dalam satu perjalanan.'],
                    ['src' => asset('images/danau-toba.jpg'), 'label' => 'Danau Toba', 'description' => 'Danau terbesar di Asia Tenggara dengan suasana tenang.'],
                    ['src' => asset('images/alahan-panjang.jpg'), 'label' => 'Alahan Panjang', 'description' => 'Pegunungan hijau dan alam yang masih alami.'],
                ];

                $heroGallerySlides = collect($heroGalleryImages);
                foreach ($places as $place) {
                    if ($place->image) {
                        $heroGallerySlides->push([
                            'src' => $place->image,
                            'label' => $place->name,
                            'description' => mb_strimwidth($place->description, 0, 80, '...'),
                        ]);
                    }
                }
            @endphp

            <div class="mt-10 rounded-[2rem] bg-white/10 p-4 shadow-2xl shadow-slate-950/30 ring-1 ring-white/10 backdrop-blur sm:p-6">
                <div class="flex items-center justify-between gap-4 px-3 pb-4">
                    <div>
                        <p class="text-sm uppercase tracking-[0.24em] text-white/70">Jelajahi Sekarang</p>
                        <h2 class="mt-2 text-2xl font-semibold text-white">Galeri Destinasi Favorit</h2>
                    </div>
                </div>

                <div class="relative">
                    <div class="relative overflow-hidden rounded-[2rem]" style="touch-action: pan-y;">
                        <button id="hero-gallery-prev" type="button" class="absolute left-4 top-1/2 z-40 -translate-y-1/2 inline-flex h-16 w-16 items-center justify-center rounded-full bg-slate-950/80 text-white text-3xl font-semibold ring-1 ring-white/25 shadow-2xl shadow-slate-950/40 transition duration-300 hover:scale-105 hover:bg-slate-950/90 focus:outline-none">‹</button>
                        <button id="hero-gallery-next" type="button" class="absolute right-4 top-1/2 z-40 -translate-y-1/2 inline-flex h-16 w-16 items-center justify-center rounded-full bg-slate-950/80 text-white text-3xl font-semibold ring-1 ring-white/25 shadow-2xl shadow-slate-950/40 transition duration-300 hover:scale-105 hover:bg-slate-950/90 focus:outline-none">›</button>
                        <div class="flex cursor-grab" id="hero-gallery-track" style="transform: translateX(0%); will-change: transform, filter;">
                        @foreach($heroGallerySlides as $slide)
                            <div class="min-w-full relative">
                                <img src="{{ $slide['src'] }}" alt="{{ $slide['label'] }}" class="h-[28rem] w-full object-cover" />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                                <div class="absolute bottom-8 left-8 right-8 rounded-[1.5rem] border border-white/10 bg-slate-950/60 p-6 shadow-xl shadow-slate-950/40 backdrop-blur">
                                    <p class="text-sm uppercase tracking-[0.28em] text-amber-300">Destinasi Favorit</p>
                                    <h3 class="mt-3 text-3xl font-semibold text-white">{{ $slide['label'] }}</h3>
                                    <p class="mt-3 text-sm leading-6 text-white/80">{{ $slide['description'] }}</p>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-4 flex items-center justify-center gap-2">
                    @foreach($heroGallerySlides as $idx => $slide)
                        <button type="button" class="hero-gallery-dot w-2.5 h-2.5 rounded-full bg-white/30 hover:bg-white/60 transition" data-index="{{ $idx }}" aria-label="Slide {{ $idx + 1 }}"></button>
                    @endforeach
                </div>
            </div>

            <script>
                (function() {
                    const track = document.getElementById('hero-gallery-track');
                    const prevButton = document.getElementById('hero-gallery-prev');
                    const nextButton = document.getElementById('hero-gallery-next');
                    const dots = Array.from(document.querySelectorAll('.hero-gallery-dot'));
                    if (!track) return;

                    let index = 0;
                    const total = {{ $heroGallerySlides->count() }};

                    function updateGallery(animate = true) {
                        if (animate) {
                            track.style.transition = 'transform 0.6s ease, filter 0.6s ease';
                            track.style.filter = 'blur(12px)';
                            requestAnimationFrame(() => {
                                track.style.transform = 'translateX(' + (-index * 100) + '%)';
                                track.style.filter = 'blur(0px)';
                            });
                        } else {
                            track.style.transition = 'none';
                            track.style.filter = 'none';
                            track.style.transform = 'translateX(' + (-index * 100) + '%)';
                        }

                        dots.forEach((dot, dotIndex) => {
                            dot.style.backgroundColor = dotIndex === index ? 'rgba(255,255,255,0.9)' : 'rgba(255,255,255,0.3)';
                        });
                    }

                    if (prevButton) {
                        prevButton.addEventListener('click', () => {
                            index = (index - 1 + total) % total;
                            updateGallery();
                        });
                    }

                    if (nextButton) {
                        nextButton.addEventListener('click', () => {
                            index = (index + 1) % total;
                            updateGallery();
                        });
                    }

                    const slider = track.parentElement;
                    let startX = 0;
                    let isDragging = false;
                    const swipeThreshold = 40;

                    function endDrag(event) {
                        if (!isDragging) return;
                        isDragging = false;
                        slider.style.cursor = 'grab';
                        const diff = event.clientX - startX;

                        if (Math.abs(diff) > swipeThreshold) {
                            index = diff < 0 ? (index + 1) % total : (index - 1 + total) % total;
                        }

                        updateGallery();
                    }

                    function startDrag(event) {
                        if (event.target.closest('button')) return;
                        isDragging = true;
                        startX = event.clientX;
                        track.style.transition = 'none';
                        slider.setPointerCapture(event.pointerId);
                        slider.style.cursor = 'grabbing';
                    }

                    function moveDrag(event) {
                        if (!isDragging) return;
                        const diff = event.clientX - startX;
                        const percent = (diff / slider.clientWidth) * 100;
                        track.style.transform = 'translateX(' + (-index * 100 + percent) + '%)';
                    }

                    slider.style.cursor = 'grab';
                    slider.addEventListener('pointerdown', startDrag);
                    slider.addEventListener('pointermove', moveDrag);
                    slider.addEventListener('pointerup', endDrag);
                    slider.addEventListener('pointercancel', endDrag);
                    slider.addEventListener('pointerleave', endDrag);

                    let wheelAccumulator = 0;
                    let wheelTimeoutId = null;
                    const wheelThreshold = 100;
                    const wheelDelay = 180;

                    slider.addEventListener('wheel', (event) => {
                        const horizontalMove = Math.abs(event.deltaX) > Math.abs(event.deltaY);
                        const delta = horizontalMove ? event.deltaX : event.deltaY;

                        if (Math.abs(delta) < 10) {
                            return;
                        }

                        event.preventDefault();
                        wheelAccumulator += delta;

                        if (Math.abs(wheelAccumulator) >= wheelThreshold && !wheelTimeoutId) {
                            index = wheelAccumulator > 0 ? (index + 1) % total : (index - 1 + total) % total;
                            wheelAccumulator = 0;
                            updateGallery();

                            wheelTimeoutId = setTimeout(() => {
                                wheelTimeoutId = null;
                                wheelAccumulator = 0;
                            }, wheelDelay);
                        }
                    }, { passive: false });

                    dots.forEach((dot) => {
                        dot.addEventListener('click', () => {
                            index = parseInt(dot.getAttribute('data-index'), 10);
                            updateGallery();
                        });
                    });

                    updateGallery(false);
                })();
            </script>

            @if($places->count())
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($places as $place)
                        <div data-href="{{ route('places.show', $place) }}" class="group overflow-hidden rounded-[1.75rem] bg-white/10 shadow-lg shadow-slate-950/20 backdrop-blur transition duration-500 hover:-translate-y-2 hover:bg-white/20 animate-fade-in-up cursor-pointer" style="animation-delay: {{ $loop->index * 100 }}ms" onclick="if (!event.target.closest('button') && !event.target.closest('a')) window.location = this.dataset.href;">
                            @if($place->image)
                                <div class="overflow-hidden">
                                    <img src="{{ $place->image }}" alt="{{ $place->name }}" class="h-44 w-full object-cover transition duration-500 group-hover:scale-105" />
                                </div>
                            @endif
                            <div class="space-y-4 p-6">
                                <div class="flex items-center justify-between gap-3">
                                    <h2 class="text-lg font-semibold text-white">{{ $place->name }}</h2>
                                    <span class="rounded-full bg-amber-400 px-3 py-1 text-sm font-semibold text-slate-950">Best</span>
                                </div>
                                <p class="text-sm text-slate-200">{{ mb_strimwidth($place->description, 0, 90, '...') }}</p>
                                <div class="flex flex-col gap-4 text-sm text-white/90 sm:flex-row sm:items-center sm:justify-between">
                                    <span class="rounded-full bg-slate-950/70 px-3 py-1">Rp {{ number_format($place->price, 0, ',', '.') }}</span>
                                    @auth
                                        <form action="{{ route('places.order', $place) }}" method="POST" class="inline-flex">
                                            @csrf
                                            <button type="submit" class="rounded-full bg-cyan-400 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300">Pesan Sekarang</button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-semibold text-white transition hover:border-amber-300 hover:bg-white/20">Pesan Sekarang</a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="grid gap-6 lg:grid-cols-[1.15fr_0.85fr]">
        <div class="rounded-[2rem] bg-slate-950 p-8 shadow-2xl shadow-slate-950/40 ring-1 ring-white/10">
            <p class="text-sm uppercase tracking-[0.24em] text-cyan-300">Fitur Utama</p>
            <h2 class="mt-3 text-3xl font-semibold text-white">Semua kebutuhan booking wisata ada di sini.</h2>
            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                <div class="rounded-[1.75rem] bg-slate-900/80 p-6 transition hover:bg-slate-900">
                    <h3 class="font-semibold text-white">Cari Destinasi</h3>
                    <p class="mt-3 text-sm text-slate-300">Temukan tempat wisata populer dengan cepat dan mudah.</p>
                </div>
                <div class="rounded-[1.75rem] bg-slate-900/80 p-6 transition hover:bg-slate-900">
                    <h3 class="font-semibold text-white">Pesan Cepat</h3>
                    <p class="mt-3 text-sm text-slate-300">Proses pemesanan yang simpel dan intuitif hanya beberapa klik.</p>
                </div>
                <div class="rounded-[1.75rem] bg-slate-900/80 p-6 transition hover:bg-slate-900">
                    <h3 class="font-semibold text-white">Cek Status</h3>
                    <p class="mt-3 text-sm text-slate-300">Lihat status approval pesanan secara real-time dari dashboard.</p>
                </div>
                <div class="rounded-[1.75rem] bg-slate-900/80 p-6 transition hover:bg-slate-900">
                    <h3 class="font-semibold text-white">Responsif</h3>
                    <p class="mt-3 text-sm text-slate-300">Tampilan optimal di mobile, tablet, dan desktop semua device.</p>
                </div>
            </div>
        </div>

        <div class="rounded-[2rem] bg-gradient-to-br from-fuchsia-600 via-cyan-400 to-orange-400 p-8 text-slate-950 shadow-2xl shadow-slate-950/30">
            <p class="text-sm uppercase tracking-[0.24em] text-white/80">Destinasi Pilihan</p>
            <h2 class="mt-3 text-3xl font-semibold text-white">Tempat wisata terbaik</h2>
            <p class="mt-4 max-w-xl text-sm leading-7 text-white/80">Berikut daftar destinasi favorit yang bisa kamu pesan langsung dari halaman depan.</p>
            <div class="mt-8 space-y-4">
                @foreach($places as $place)
                    <div class="rounded-[1.75rem] bg-white/20 p-5 text-white transition duration-300 hover:bg-white/30">
                        <h3 class="font-semibold">{{ $place->name }}</h3>
                        <p class="mt-2 text-sm text-white/70">Rp {{ number_format($place->price, 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
