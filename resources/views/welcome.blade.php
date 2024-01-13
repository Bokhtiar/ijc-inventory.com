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



                        <!-- Button trigger modal -->
                        <button class="d-flex text-gray banner-button rounded-pill px-4 py-2 border border-warning mt-2"
                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <span class="material-symbols-outlined text-muted" style="font-size: 29px;">play_circle</span>
                            <span class="ml-3 mt-1" style="font-size: 16px">Watch Video</span>
                        </button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content" style="background: #7E7A7A;">
                                    <iframe style="border-radius: 10px" width="100%" height="400"
                                        src="https://www.youtube.com/embed/tRH_UxfhQ0I"
                                        title="ক্যারিয়ার ম্যানেজমেন্টের আধুনিক আইডিয়া নিয়ে জব মিডিয়ার আলোচনা সভা |   Job Media | Jamuna TV"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>




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
                <p class="px-2 text-muted">Faster Payment Processing: Expedite your cash flow by providing clients with
                    prompt and professional invoices.</p>
            </div>

            <div class="d-flex col-12 col-sm-12 col-md-6 col-lg-6">
                <span class="material-symbols-outlined mt-1">
                    new_releases
                </span>
                <p class="px-2 text-muted">Error Reduction: Minimize the risk of manual errors with our precision-focused
                    invoicing system.</p>
            </div>

            <div class="d-flex col-12 col-sm-12 col-md-6 col-lg-6">
                <span class="material-symbols-outlined mt-1">
                    new_releases
                </span>
                <p class="px-2 text-muted">Data Security: Ensure the confidentiality and security of your financial data
                    with our advanced encryption measures.</p>
            </div>

            <div class="d-flex col-12 col-sm-12 col-md-6 col-lg-6">
                <span class="material-symbols-outlined mt-1">
                    new_releases
                </span>
                <p class="px-2 text-muted">Compliance Assurance: Stay compliant with tax regulations and financial standards
                    through our robust invoicing software.</p>
            </div>

            <div class="d-flex col-12 col-sm-12 col-md-6 col-lg-6">

                <span class="material-symbols-outlined mt-1">
                    new_releases
                </span>
                <p class="px-2 text-muted">Compliance Assurance: Stay compliant with tax regulations and financial standards
                    through our robust invoicing software.</p>
            </div>
            </p>
            </div>

        </section>
    </section>

    {{-- productivity  --}}
    <section class="container my-5  ">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mx-auto">
                <img src="{{ asset('assets/banner2.png') }}" class="unless-img" alt="">
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <h3 class="unless-title">Effortless Productivity Boost</h3>
                <p class="unless-content my-4">Experience a revolutionary shift in efficiency with ITM Billing. Our
                    intuitive software empowers you to achieve more in less time, ensuring a hassle-free invoicing
                    experience that maximizes productivity.</p>

                <div class="d-flex">
                    <span class="material-symbols-outlined mt-1">
                        layers
                    </span>
                    <p class="px-2 text-muted">Automated Workflows: Effortlessly streamline tasks with automation.</p>
                </div>

                <div class="d-flex">
                    <span class="material-symbols-outlined mt-1">
                        layers
                    </span>
                    <p class="px-2 text-muted">User-Friendly Interface: Navigate seamlessly with an intuitive design.</p>
                </div>

                <div class="d-flex">
                    <span class="material-symbols-outlined mt-1">
                        layers
                    </span>
                    <p class="px-2 text-muted">Swift Reporting: Gain instant insights for quicker decision-making.</p>
                </div>


            </div>
        </div>
    </section>

    {{-- question --}}
    <section class="container my-5">
        <h3 class="text-center invoice-heaading">Have Questions? Look Here.</h3>
        <p class="text-center invoice-content">Aliquam a augue suscipit, luctus neque purus ipsum neque undo dolor primis
            <br>
            libero tempus, blandit a cursus varius at magna tempor.
        </p>
        {{-- content --}}
        <section>
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseOne">
                            <div class="d-flex">
                                <span class="material-symbols-outlined">
                                    psychology_alt
                                </span>
                                <span class="question-title">How to get ITM - Billing</span>
                            </div>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                        <div class="accordion-body question-content text-muted">
                            Connect to us and we will make sure to send you the
                            desired billing software.
                        </div>
                    </div>
                </div>


                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseTwo">
                            <div class="d-flex">
                                <span class="material-symbols-outlined">
                                    psychology_alt
                                </span>
                                <span class="question-title">Do I need an expert to operate?</span>
                            </div>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                        <div class="accordion-body question-content text-muted">
                            Not at all. Anyone with basic computer knowledge can
                            manage our software.
                        </div>
                    </div>
                </div>


                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseThree">
                            <div class="d-flex">
                                <span class="material-symbols-outlined">
                                    psychology_alt
                                </span>
                                <span class="question-title">Can I print the invoices ?</span>
                            </div>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                        <div class="accordion-body question-content text-muted">
                            Of Course you can. That’s pretty basic. You will get both
                            on screen invoice as well as the printed.
                        </div>
                    </div>
                </div>


                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapse4" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapse4">
                            <div class="d-flex">
                                <span class="material-symbols-outlined">
                                    psychology_alt
                                </span>
                                <span class="question-title">Can I store the invoices ?</span>
                            </div>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapse4" class="accordion-collapse collapse">
                        <div class="accordion-body question-content text-muted">
                            Of Course you can. That’s alsp a basic. You will get both
                            printed and saved to your local databases.
                        </div>
                    </div>
                </div>


                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapse5" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapse5">
                            <div class="d-flex">
                                <span class="material-symbols-outlined">
                                    psychology_alt
                                </span>
                                <span class="question-title">Will it expire ?</span>
                            </div>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapse5" class="accordion-collapse collapse">
                        <div class="accordion-body question-content text-muted">
                            No. One time pay for the system and you will be able to use it for the rest of your life.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapse6" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapse6">
                            <div class="d-flex">
                                <span class="material-symbols-outlined">
                                    psychology_alt
                                </span>
                                <span class="question-title">Can I use it in mobiles?</span>
                            </div>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapse6" class="accordion-collapse collapse">
                        <div class="accordion-body question-content text-muted">
                            No our software doesn’t come with a smartphone app.
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

    {{-- theme  --}}
    <section class="container my-5">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mx-auto">
                <img src="{{ asset('assets/section3.png') }}" class="unless-img" alt="">
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <h3 class="unless-title">Effortless Productivity Boost</h3>
                <p class="unless-content my-4">Experience a revolutionary shift in efficiency with ITM Billing. Our
                    intuitive software empowers you to achieve more in less time, ensuring a hassle-free invoicing
                    experience that maximizes productivity.</p>

                <section>
                    <div class="d-flex">
                        <span class="material-symbols-outlined mt-1">
                            layers
                        </span>
                        <p class="px-2 theme-heading">Lightweight Themes</p>
                    </div>
                    <p class="text-muted px-4 theme-content">Elevate your invoicing aesthetics with our lightweight,
                        visually pleasing themes for a professional
                        and modern touch.</p>
                </section>

                <section>
                    <div class="d-flex">
                        <span class="material-symbols-outlined mt-1">
                            layers
                        </span>
                        <p class="px-2 theme-heading">Friendly UI</p>
                    </div>
                    <p class="text-muted px-4 theme-content">Enjoy a smooth and intuitive user interface that simplifies
                        navigation, making your invoicing experience effortless.</p>
                </section>
                <section>
                    <div class="d-flex">
                        <span class="material-symbols-outlined mt-1">
                            layers
                        </span>
                        <p class="px-2 theme-heading">Accuracy</p>
                    </div>
                    <p class="text-muted px-4 theme-content">Trust in precision with ITM Billing—where accuracy is
                        paramount, ensuring your
                        financial transactions are flawlessly executed.</p>
                </section>
    </section>

    {{-- contact form --}}
    <section class="container my-5">
        <h3 class="text-center invoice-heaading">Reach out to us</h3>

        <section class="row my-5">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <section>
                    <div class="d-flex">
                        <span class="material-symbols-outlined mt-1">
                            location_on
                        </span>
                        <p class="px-2 theme-heading">Our Location</p>
                    </div>
                    <p class="text-muted px-4 theme-content">{{ $setting->location }}</p>
                </section>


                <section class="my-3">
                    <div class="d-flex">
                        <span class="material-symbols-outlined mt-1">
                            phone_in_talk
                        </span>
                        <p class="px-2 theme-heading">Contact Phones</p>
                    </div>
                    <p class="text-muted px-4 theme-content">Phone : {{ $setting->phone }}</p>
                </section>


                <section>
                    <div class="d-flex">
                        <span class="material-symbols-outlined mt-1">
                            work
                        </span>
                        <p class="px-2 theme-heading">Working Hours</p>
                    </div>
                    <p class="text-muted px-4 theme-content">{{ $setting->work_time }}</p>
                </section>
            </div>

            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                <form action="">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <input type="text" class="form-control" placeholder="Name" name="name" required
                                id="">
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <input type="email" class="form-control" placeholder="Email" name="email" required
                                id="">
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-4">    
                            <input type="text" class="form-control" required name="subject" placeholder="Subject" id="">
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <textarea name="" id="" cols="10" rows="4" class="form-control" placeholder="Message" required></textarea>
                        </div>
                    </div>
                    <div class="text-end">
                        <input type="submit" value="Send Message" class="btn-submit py-1 rounded-pill mt-2" name="" id="">
                    </div>
                </form>
            </div>
        </section>
    </section>

    {{-- footer --}}
    <hr>
    <p class="text-center text-muted">© 2023 - 2024 IT Media. All Rights Reserved</p>
@endsection
