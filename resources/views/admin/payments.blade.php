@extends('layouts.adminlayout')

@section('content')
    <div class="container my-4">
        <h1 class="text-2xl font-bold mb-3">Transactions</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse">
                <thead class="bg-gray-100">
                <tr class="text-left text-sm font-semibold">
                    <th class="px-3 py-2 border">Trans-ID</th>
                    <th class="px-3 py-2 border">User</th>
                    <th class="px-3 py-2 border">Vendor</th>
                    <th class="px-3 py-2 border">Item</th>
                    <th class="px-3 py-2 border">Amount (Tk)</th>
                    <th class="px-3 py-2 border">Profit&nbsp;30 %</th>
                    <th class="px-3 py-2 border">Status</th>
                    <th class="px-3 py-2 border">Date</th>
                    <th class="px-3 py-2 border">Action</th>
                </tr>
                </thead>

                <tbody id="data">
                @forelse ($orders as $order)
                    <tr class="text-sm hover:bg-gray-50">
                        <td class="px-3 py-2 border">{{ $order->id }}</td>
                        <td class="px-3 py-2 border">
                            {{ optional($order->user)->firstname ?? '—' }}
                        </td>
                        <td class="px-3 py-2 border">
                            {{ optional($order->vendor)->firstname ?? '—' }}
                        </td>
                        <td class="px-3 py-2 border">
                            {{ class_basename($order->bookable_type) }}
                            #{{ $order->bookable_id }}
                        </td>
                        <td class="px-3 py-2 border">
                            {{ number_format($order->total_price,2) }}
                        </td>
                        <td class="px-3 py-2 border font-semibold text-green-700">
                            {{ number_format($order->total_price * 0.30, 2) }}
                        </td>
                        <td class="px-3 py-2 border capitalize">{{ $order->status }}</td>
                        <td class="px-3 py-2 border">
                            {{ $order->created_at->format('Y-m-d') }}
                        </td>
                        <td class="px-3 py-2 border whitespace-nowrap">
                            <button class="text-green-600 mr-2"><i class="uil uil-check"></i></button>
                            <button class="text-red-600 mr-2"><i class="uil uil-times"></i></button>
                            <button class="text-blue-600"><i class="uil uil-eye"></i></button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-3 py-4 text-center text-gray-500">
                            No transactions found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
