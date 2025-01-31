@extends('user.layouts.master')
@section('title','sign Up')


@section('main')
    <!--============= Hero Section Starts Here =============-->
    <div class="hero-section">
        <div class="container">
            <ul class="breadcrumb">
                <li>
                    <a href="{{route('user.dashboard')}}">Home</a>
                </li>
                <li>
                    <a href="#0">Pages</a>
                </li>
                <li>
                    <span>Sign Up</span>
                </li>
            </ul>
        </div>
        <div class="bg_img hero-bg bottom_center" data-background="{{asset('/user/images/banner/hero-bg.png')}}"></div>
    </div>
    <!--============= Hero Section Ends Here =============-->


    <!--=============   Account Section Starts Here =============-->
    <section class="account-section padding-bottom">
        <div class="container">
            <div class="account-wrapper mt--100 mt-lg--440">
                <div class="left-side">
                    <div class="section-header" data-aos="zoom-out-down" data-aos-duration="1200">
                        <h2 class="title">SIGN UP</h2>
                        <p>We're happy you're here!</p>
                    </div>
                    <ul class="login-with">
                        <li>
                            <a href="#0"><i class="fab fa-facebook"></i>Log in with Facebook</a>
                        </li>
                        <li>
                            <a href="#0"><i class="fab fa-google-plus"></i>Log in with Google</a>
                        </li>
                    </ul>
                    @if(session('error'))
                    <div class="text text-danger text-center">{{session('error')}}</div>
                    @endif
                    <div class="or">
                        <span>Or</span>
                    </div>
                    <form class="login-form" method="post" action="">
                        @csrf
                        <div class="form-group mb-30">
                            <label for="name"><i class="far fa-user"></i></label>
                            <input name="name" type="text" id="name" placeholder=" Full name" value="{{old('name')}}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-30">
                            <label for="mobile"><i class="far fa-contact"></i></label>
                            <input name="mobile" type="number" id="mobile" value="{{old('mobile')}}"  placeholder="Mobile No." required>
                            @error('mobile')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-30">
                            <label for="login-email"><i class="far fa-envelope"></i></label>
                            <input name="email" type="text" value="{{old('email')}}" id="login-email" placeholder="Email Address" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-30">
                            <label for="login-pass"><i class="fas fa-lock"></i></label>
                            <input name="password" type="password" minlength='6' id="login-pass" placeholder="Password" required>
                            <span class="pass-type"><i class="fas fa-eye"></i></span>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror                          
                        </div>
                        <div class="form-group mb-30">
                            <label for="password_confirmation"><i class="fas fa-lock"></i></label>
                            <input name="password_confirmation" type="password" minlength='6' id="password_confirmation" placeholder="confirm-password" required>
                            <span class="pass-type2"><i class="fas fa-eye"></i></span>
                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror                          
                        </div>
                        <div class="form-group checkgroup mb-30">
                            <input type="checkbox" name="terms" id="check" required><label for="check">The Sbidu Terms of Use apply</label>
                            @error('terms')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror    
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="custom-button">LOG IN</button>
                        </div>
                    </form>
                </div>
                <div class="right-side cl-white">
                    <div class="section-header mb-0">
                        <h3 class="title mt-0">ALREADY HAVE AN ACCOUNT?</h3>
                        <p>Log in and go to your Dashboard.</p>
                        <a href="{{route('loginPage')}}" class="custom-button transparent">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============= Account Section Ends Here =============-->

@endsection