<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid container">
        <a class="navbar-brand" href="#">{{ $setting->company_name }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Feature</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">FAQs</a>
                </li>
                <li class="nav-item">
                  @if (Auth::check())
                  <a  class="nav-link" href="@route('dashboard')">Dashboard</a>
                  @else
                    <a class="nav-link" href="@route('login')">Login</a>
                  @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
