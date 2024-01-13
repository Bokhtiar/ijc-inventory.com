@extends('layouts.app')
@section('content')
    <section class="bg-banner text-white">
        <section class="container">
            <div class="py-5">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-5 col-lg-5">
                        <p class="heading-banner">
                            ITM Billing - is perfect solutions to your invoicing
                        </p>
                        <p class="content-banner">
                            Streamline your billing process effortlessly with our user-friendly software, designed to meet
                            the unique needs of businesses like yours.
                        </p>
                        <button class="banner-button rounded-pill px-4 py-2 border border-warning mt-2 ">Find out
                            more</button>
                    </div>
                    <div class="col-12 col-sm-12 col-md-7 col-lg-7">
                        <img src="{{ asset('assets/banner.png') }}" alt="af">
                    </div>
                </div>

                {{-- card details --}}
                <div class="row my-5">
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                            <h3 class="card-heading">Effortless Invoicing</h3>
                            <p class="card-content">Simplify your billing process with ITM Billing's intuitive interface, allowing you to create and send invoices seamlessly.</p>
                    </div>

                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                        <h3 class="card-heading">Tailored for Your Business</h3>
                        <p class="card-content">Our software is designed to meet the specific needs of your business, ensuring a personalized and efficient invoicing experience.</p>
                    </div>

                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                        <h3 class="card-heading">Precision and Accuracy</h3>
                        <p class="card-content">
                            Experience unparalleled accuracy in your financial transactions, reducing errors and enhancing the overall reliability of your invoicing system.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
