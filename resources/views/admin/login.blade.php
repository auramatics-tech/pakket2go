@extends('admin.layouts.master')

@section('content')
    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
        <a href="{{ url('/') }}" class="mb-12">
            <img alt="Logo" src="{{ asset('assets/admin/media/delivery-truck.png') }}" class="h-100px" />
        </a>
        <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="{{ route('admin.login.check') }}" method="POST">
                @csrf
                <div class="text-center mb-10">
                    <h1 class="text-dark mb-3">Sign In to Pakket2Go</h1>
                </div>
                @if (\Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <div class="alert-body">
                            {{ \Session::get('success') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                {{ \Session::forget('success') }}
                @if (\Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="alert-body">
                            {{ \Session::get('error') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="fv-row mb-10">
                    <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                    <input class="form-control form-control-lg form-control-solid" type="text" name="email"
                        autocomplete="off" />
                </div>
                <div class="fv-row mb-10">
                    <div class="d-flex flex-stack mb-2">
                        <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                        <a href="javascript:void(0);" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
                    </div>
                    <input class="form-control form-control-lg form-control-solid" type="password" name="password"
                        autocomplete="off" />
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                        <span class="indicator-label">Continue</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
