@extends('layouts.app')
@section('content')
    {{-- banner section --}}
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
                        <img src="{{ asset('assets/banner.png') }}" width="100%" alt="af">
                    </div>
                </div>

                {{-- card details --}}
                <div class="row mt-5">
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                        <h3 class="card-heading">Effortless Invoicing</h3>
                        <p class="card-content">Simplify your billing process with ITM Billing's intuitive interface,
                            allowing you to create and send invoices seamlessly.</p>
                    </div>

                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                        <h3 class="card-heading">Tailored for Your Business</h3>
                        <p class="card-content">Our software is designed to meet the specific needs of your business,
                            ensuring a personalized and efficient invoicing experience.</p>
                    </div>

                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                        <h3 class="card-heading">Precision and Accuracy</h3>
                        <p class="card-content">
                            Experience unparalleled accuracy in your financial transactions, reducing errors and enhancing
                            the overall reliability of your invoicing system.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </section>

    {{-- unless  --}}
    <section class="container my-5  ">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mx-auto">
                <img src="{{ asset('assets/section1.png') }}" class="unless-img" alt="">
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <h3 class="unless-title">Unleash Seamless Invoicing Excellence</h3>
                <p class="unless-content my-4">Welcome to ITM Billing, where innovation meets simplicity in the world of
                    invoicing. Our powerful yet user-friendly software is meticulously crafted to fit the unique needs of
                    your business, ensuring a seamless and efficient billing experience. From effortlessly creating invoices
                    to achieving unparalleled precision, ITM Billing is your trusted partner in transforming financial
                    operations. Elevate your business to new heights – start your journey with ITM Billing today!</p>
            </div>
        </div>
    </section>

    {{-- invoice --}}
    <section class="container my-5">
        <h3 class="text-center invoice-heaading">Transform Your Invoicing Experience</h3>
        <p class="text-center invoice-content">Discover the essential features that redefine efficiency and effectiveness,
            <br> making ITM Billing your indispensable tool for streamlined invoicing.
        </p>
        {{-- content --}}
        <section class="row my-5">
            <div class="d-flex col-12 col-sm-12 col-md-6 col-lg-6">
                <span class="material-symbols-outlined mt-1">
                    new_releases
                </span>
                <p class="px-2 text-muted">Time-Saving Automation: Effortlessly automate repetitive tasks, freeing up
                    valuable time for strategic business activities.</p>
            </div>

            <div class="d-flex col-12 col-sm-12 col-md-6 col-lg-6">
                <span class="material-symbols-outlined mt-1">
                    new_releases
                </span>
                <p class="px-2 text-muted">Faster Payment Processing: Expedite your cash flow by providing clients with prompt and professional invoices.</p>
            </div>

             <div class="d-flex col-12 col-sm-12 col-md-6 col-lg-6">
                <span class="material-symbols-outlined mt-1">
                    new_releases
                </span>
                <p class="px-2 text-muted">Error Reduction: Minimize the risk of manual errors with our precision-focused invoicing system.</p>
            </div>

            <div class="d-flex col-12 col-sm-12 col-md-6 col-lg-6">
                <span class="material-symbols-outlined mt-1">
                    new_releases
                </span>
                <p class="px-2 text-muted">Data Security: Ensure the confidentiality and security of your financial data with our advanced encryption measures.</p>
            </div>

            <div class="d-flex col-12 col-sm-12 col-md-6 col-lg-6">
                <span class="material-symbols-outlined mt-1">
                    new_releases
                </span>
                <p class="px-2 text-muted">Compliance Assurance: Stay compliant with tax regulations and financial standards through our robust invoicing software.</p>
            </div>

            <div class="d-flex col-12 col-sm-12 col-md-6 col-lg-6">
                
                <span class="material-symbols-outlined mt-1">
                    new_releases
                </span>
                <p class="px-2 text-muted">Compliance Assurance: Stay compliant with tax regulations and financial standards through our robust invoicing software.</p>
            </div></p>
            </div>

        </section>
    </section>
@endsection
