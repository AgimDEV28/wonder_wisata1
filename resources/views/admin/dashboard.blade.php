@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <section class="rounded-[2rem] bg-gradient-to-r from-fuchsia-500 via-cyan-500 to-amber-400 p-8 text-slate-950 shadow-2xl shadow-fuchsia-500/20">
        <p class="text-sm uppercase tracking-[0.3em] text-slate-950/70">Panel Admin</p>
        <h1 class="mt-4 text-3xl font-semibold">Kelola Pesanan Wisata</h1>
        <p class="mt-3 max-w-2xl text-slate-950/80">Lihat semua pesanan user dan ACC destinasi secara cepat untuk menjaga kenyamanan traveler.</p>
    </section>

    <div class="overflow-hidden rounded-[2rem] bg-slate-950/95 shadow-2xl shadow-slate-950/40 ring-1 ring-white/10">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-700 text-sm text-slate-100">
                <thead class="bg-slate-900 text-left text-sm text-slate-200">
                    <tr>
                        <th class="px-5 py-4 font-semibold uppercase tracking-[0.16em]">Pengguna</th>
                        <th class="px-5 py-4 font-semibold uppercase tracking-[0.16em]">Tempat Wisata</th>
                        <th class="px-5 py-4 font-semibold uppercase tracking-[0.16em]">Harga</th>
                        <th class="px-5 py-4 font-semibold uppercase tracking-[0.16em]">Status</th>
                        <th class="px-5 py-4 font-semibold uppercase tracking-[0.16em]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 bg-slate-950/80">
                    @forelse($orders as $order)
                        <tr class="hover:bg-slate-900/80">
                            <td class="px-5 py-4 text-slate-100">
                                <div class="font-semibold">{{ $order->user->name }}</div>
                                <div class="mt-1 text-xs text-slate-400">{{ $order->user->email }}</div>
                            </td>
                            <td class="px-5 py-4 text-slate-100">{{ $order->place->name }}</td>
                            <td class="px-5 py-4 text-slate-100">Rp {{ number_format($order->place->price, 0, ',', '.') }}</td>
                            <td class="px-5 py-4">
                                <span class="inline-flex rounded-full px-4 py-2 text-xs font-semibold {{ $order->status === 'approved' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">{{ $order->status === 'approved' ? 'DISETUJUI' : 'MENUNGGU' }}</span>
                            </td>
                            <td class="px-5 py-4">
                                @if($order->status === 'pending')
                                    <form action="{{ route('admin.orders.approve', $order) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="rounded-full bg-amber-400 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-amber-300">Setujui</button>
                                    </form>
                                @else
                                    <span class="text-sm text-slate-400">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-8 text-center text-slate-400">Tidak ada pesanan saat ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
