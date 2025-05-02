{{-- resources/views/user/checkout.blade.php --}}
@extends('layouts.customerlayout')

@section('title','Checkout')

@section('content')
    <div class="max-w-2xl mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">

        <h1 class="text-4xl font-bold text-green-800 mb-4 text-center">
            Check&nbsp;Out
        </h1>
        <p class="text-gray-600 mb-6 text-center">
            Please provide all the required information to book!
        </p>

        @if($errors->any())
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                </ul>
            </div>
        @endif

        {{-- NOTE: $bookable comes from controller; we also get $rate --}}
        @php
            $typeSlug = strtolower(class_basename($bookable)); // "room" or "car"
        @endphp

        <form
            action="{{ route('user.checkout.submit', ['type'=>$typeSlug, 'id'=>$bookable->id]) }}"
            method="POST"
            class="space-y-6">
            @csrf

            {{-- Payment method select unchanged --}}
            <div>
                <label for="payment_method" class="block text-sm font-medium text-gray-700">
                    Payment Method
                </label>
                <select name="payment_method" id="payment_method"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                     focus:ring-green-500 focus:border-green-500"
                        required>
                    <option value="">Select a method…</option>
                    <option value="card"  @selected(old('payment_method')==='card')>Credit Card</option>
                    <option value="bkash" @selected(old('payment_method')==='bkash')>Bkash</option>
                    <option value="nagad" @selected(old('payment_method')==='nagad')>Nagad</option>
                </select>
            </div>

            {{-- Card / phone fields --}}
            <div id="card_field"  class="hidden">
                <label for="card_number" class="block text-sm font-medium text-gray-700">Card Number</label>
                <input type="text" name="card_number" id="card_number"
                       value="{{ old('card_number') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                    focus:ring-green-500 focus:border-green-500"
                       placeholder="XXXX-XXXX-XXXX-XXXX">
            </div>

            <div id="phone_field" class="hidden">
                <label for="payment_phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="tel" name="payment_phone" id="payment_phone"
                       value="{{ old('payment_phone') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                    focus:ring-green-500 focus:border-green-500"
                       placeholder="01XXXXXXXXX">
            </div>

            {{-- Dates --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="check_in_time" class="block text-sm font-medium text-gray-700">
                        {{ $typeSlug === 'room' ? 'Check-in Date' : 'Pick-up Date' }}
                    </label>
                    <input type="date" name="check_in_time" id="check_in_time"
                           value="{{ old('check_in_time') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                      focus:ring-green-500 focus:border-green-500"
                           required>
                </div>
                <div>
                    <label for="check_out_time" class="block text-sm font-medium text-gray-700">
                        {{ $typeSlug === 'room' ? 'Check-out Date' : 'Return Date' }}
                    </label>
                    <input type="date" name="check_out_time" id="check_out_time"
                           value="{{ old('check_out_time') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                      focus:ring-green-500 focus:border-green-500">
                </div>
            </div>

            {{-- Total --}}
            <div class="text-center">
                <p class="text-2xl font-semibold text-gray-800">
                    Total:
                    <span id="total_price" class="text-3xl">
          {{ number_format($totalPrice, 2) }} BDT
        </span>
                </p>
                <button type="submit"
                        class="mt-4 inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700
                     text-white font-medium rounded-md shadow">
                    Proceed to Pay
                </button>
            </div>

            {{-- Hidden daily/nightly rate for JS --}}
            <input type="hidden" id="rate_per_unit" value="{{ $rate }}">
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const pm      = document.getElementById('payment_method');
            const cardF   = document.getElementById('card_field');
            const phoneF  = document.getElementById('phone_field');
            const inDate  = document.getElementById('check_in_time');
            const outDate = document.getElementById('check_out_time');
            const totalEl = document.getElementById('total_price');
            const rate    = parseFloat(document.getElementById('rate_per_unit').value);

            function toggleFields() {
                if (pm.value === 'card') {
                    cardF.classList.remove('hidden');
                    phoneF.classList.add('hidden');
                } else if (pm.value === 'bkash' || pm.value === 'nagad') {
                    cardF.classList.add('hidden');
                    phoneF.classList.remove('hidden');
                } else {
                    cardF.classList.add('hidden');
                    phoneF.classList.add('hidden');
                }
            }

            function recalcTotal() {
                if (!inDate.value) { totalEl.textContent = '0.00 BDT'; return; }
                const d1 = new Date(inDate.value);
                const d2 = outDate.value ? new Date(outDate.value) : d1;
                let days = Math.round((d2 - d1) / 864e5);   // ms→days
                if (isNaN(days) || days < 1) days = 1;
                totalEl.textContent = (rate * days).toFixed(2) + ' BDT';
            }

            pm.addEventListener('change', () => { toggleFields(); recalcTotal(); });
            inDate.addEventListener('change', recalcTotal);
            outDate.addEventListener('change', recalcTotal);

            toggleFields();
            recalcTotal();
        });
    </script>
@endpush
