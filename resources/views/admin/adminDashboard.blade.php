@extends('layout.adminlayout')
@section('konten')
    <div class="p-4 sm:ml-64">
        <h1 class="text-white mx-6 font-bold text-2xl">Welcome Admin {{ Auth::user()->name }}!</h1>


        <div class="p-6 rounded-lg shadow bg-white border-amber-600 m-5">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-slate-900">Kelola Akun User</h5>
            </a>
            <p class="mb-3 font-normal text-neutral-900">Kelola akun yang terdaftar di Adelsten</p>
            <a href="{{ route('admin-kelola-akun') }}"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-amber-600 hover:bg-amber-900 focus:ring-amber-800">
                Go
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>

        <div class="p-6 rounded-lg shadow bg-white border-amber-600 m-5">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-slate-900">Kelola Achievement</h5>
            </a>
            <p class="mb-3 font-normal text-neutral-900">Kelola achievement yang ada di Adelsten</p>
            <a href="{{ route('admin-kelola-achievement') }}"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-amber-600 hover:bg-amber-900 focus:ring-amber-800">
                Go
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>
    </div>
@endsection
