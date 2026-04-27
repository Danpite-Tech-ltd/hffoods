@extends('webview.master')

@section('maincontent')
    @section('title')
        {{ env('APP_NAME') }}-Forgot Password
    @endsection

    <div class="container">
        <div class="row login-wrapper">

            <div class="col-lg-7 col-12 left-img">
                <img src="{{ asset('public/login-register-page-side-imag.png') }}">
            </div>

            <div class="col-lg-5 col-12 login-area">

                <h2 class="m-0 login-title">Forgot Password</h2>

                <form method="POST" action="{{ route('forgot.send.otp') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <input type="text" name="email" class="form-control" placeholder="Enter Email" required>
                    </div>

                    <button type="submit" class="p-3 text-white btn login-btn w-100">Send Otp</button>

                </form>

            </div>

        </div>

    </div><!-- /.row -->
    <style>
        .login-wrapper {
            background: #fff;
            align-items: center;
        }

        .left-img img {
            width: 100%;
        }

        .login-area {
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }

        .login-title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .login-sub {
            font-size: 14px;
            color: #777;
            margin-bottom: 30px;
        }

        .form-control {
            border: none !important;
            border-bottom: 1px solid #ccc !important;
            border-radius: 0 !important;
            padding-left: 0;
            background: transparent;
            box-shadow: none !important;
            outline: none;
        }

        .form-control:focus {
            border-bottom: 1px solid #000 !important;
            box-shadow: none !important;
            outline: none;
        }

        .login-btn {
            background: #e74c3c;
            border: none;
            padding: 8px 25px;
        }

        .login-btn:hover {
            background: #e74c3c;
            border: none;
            padding: 8px 25px;
        }

        .forgot {
            font-size: 14px;
            color: #000;
            text-decoration: none;
            margin-left: 15px;
            margin-top: -30px;
        }

        @media(max-width:768px) {

            .login-area {
                padding: 40px 25px;
            }

            .left-img {
                padding: 20px;
            }

        }
    </style>
@endsection
