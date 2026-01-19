@php
$cartCount = 0;

if (auth('web')->check()) {
$cartCount = \App\Models\Cart::where('user_id', auth('web')->id())->sum('quantity');
}
@endphp
<style>
@media (min-width: 992px) {
    .navbar-nav .nav-link {
        margin-right: 10px;
        margin-left: 10px;
    }
}

/* Between 1200px and 1399px */
@media (min-width: 1200px) and (max-width: 1399.98px) {
    .navbar-nav {
        gap: 6px;
    }

    .navbar-nav .nav-link {
        font-size: 14px;
        padding: 6px 10px;
    }

    .navbar .btn {
        font-size: 13px;
        padding: 5px 10px;
    }

    .navbar-brand img {
        max-width: 120px;
    }

    .navbar-dark .navbar-nav .nav-link {
        font-size: 14px;
        margin-top: -11px;
    }
}

@media (min-width: 1400px) {
    .navbar-nav {
        gap: 20px;
    }
}
</style>
<div class="container-fluid bg-dark px-0">
    <div class="row gx-0">
        <div class="col-lg-2 bg-dark d-none d-lg-block">
            <a href="{{ url('/') }}" class="navbar-brand m-0 p-0 d-flex align-items-center justify-content-center">
                <img src="{{ url('img/logo/logo.png') }}" alt="Wireless home automation" width="100" height="100">
            </a>
        </div>

        <div class="col-lg-10">
            <div class="top-info-bar bg-white d-none d-lg-flex align-items-center justify-content-between px-4 py-2">
                <div class="d-flex align-items-center flex-wrap">
                    <div class="d-flex align-items-center me-4">
                        <i class="fa fa-envelope text-primary me-2"></i>
                        <a href="mailto:info@laganlakshmiinfra.com" class="text-decoration-none text-dark small">
                            info@laganlakshmiinfra.com
                        </a>
                    </div>
                </div>

                <div class="flex-grow-1 mx-3 overflow-hidden text-center">
                    <div class="scrolling-text bg-primary text-white py-1 px-3 rounded-pill">
                        <strong>Register Now</strong> to unlock 
                        <strong>New-Year Special Prices</strong> on 
                        <strong>Lagan Lakshmi Infra</strong> automation solutions for 
                        <strong>End Users</strong>, 
                        <strong>Installers (Special Partners)</strong>, 
                        <strong>Dealers (VIP Partners)</strong>, 
                        and <strong>Distributors</strong>.
                    </div>
                </div>

                <div class="d-flex justify-content-end align-items-center">
                    <a href="{{ route('cart.view') }}" class="position-relative me-3">
                        <i class="fa fa-shopping-cart fa-lg"></i>
                        <span id="cartItemCount"
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            style="font-size: 0.6rem;">
                            {{ $cartCount ?? 0 }}
                        </span>
                    </a>
                    @auth('web')
                    <div class="dropdown">
                        <a class="btn btn-sm btn-outline-primary dropdown-toggle" href="#" role="button"
                            id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::guard('web')->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('my-account') }}">
                                    <i class="fas fa-user"></i>
                                    <span>My Account</span>
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('my-orders') }}">
                                    <i class="fas fa-box"></i>
                                    <span>My Orders</span>
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('cart.view') }}">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span>Cart</span>
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2" href="{{ url('contact-us') }}">
                                    <i class="fas fa-headset"></i>
                                    <span>Support</span>
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 text-danger"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-sm btn-primary">Register</a>
                    @endauth
                </div>
            </div>

            <div class="bg-white d-flex d-lg-none justify-content-between px-3 py-2">
                <a href="mailto:info@laganlakshmiinfra.com" class="text-dark text-decoration-none small">
                    <i class="fa fa-envelope text-primary me-1"></i> Email
                </a>
                <a href="https://chat.whatsapp.com/BCbsV87w3kNGFx5Q36O2zr" class="text-dark text-decoration-none small">
                    <i class="fa fa-phone-alt text-primary me-1"></i> Call
                </a>
                <a href="{{ route('cart.view') }}" class="text-dark position-relative small">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                        style="font-size: 0.6rem;">0</span>
                </a>
            </div>

            <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                <a href="{{ url('/') }}" class="navbar-brand d-lg-none">
                    <img src="{{ url('img/logo/logo.png') }}" alt="Voice controlled home devices" width="60"
                        height="60">
                </a>

                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse w-100 mx-auto" id="navbarCollapse">
                    <div class="navbar-nav d-flex justify-content-between  text-uppercase">

                        <a href="{{ url('/') }}"
                            class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>

                        <div class="nav-item dropdown">
                            <a href="javascript:void(0);"
                                class="nav-link dropdown-toggle {{ request()->is('about', 'company-experience', 'organization-chart-g5', 'our-ceo', 'g5-awards', 'g5-iso-standards', 'g5-patents', 'g5-memberships', 'g5-registrations', 'g5-shares-merge-finland', 'g5-selected-clientele') ? 'active' : '' }}"
                                data-bs-toggle="dropdown">
                                Smart Group
                            </a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="{{ url('/about') }}"
                                    class="dropdown-item {{ request()->is('about') ? 'active' : '' }}">About Company</a>
                                <a href="{{ url('/company-experience') }}"
                                    class="dropdown-item {{ request()->is('company-experience') ? 'active' : '' }}">G5
                                    Expertise</a>
                                <a href="{{ url('/organization-chart-g5') }}"
                                    class="dropdown-item {{ request()->is('organization-chart-g5') ? 'active' : '' }}">G5
                                    Organization Chart</a>
                                <a href="{{ url('/our-ceo') }}"
                                    class="dropdown-item {{ request()->is('our-ceo') ? 'active' : '' }}">About Our CEO
                                    The Inventor</a>
                                <a href="{{ url('/g5-awards') }}"
                                    class="dropdown-item {{ request()->is('g5-awards') ? 'active' : '' }}">G5 Awards</a>
                                <a href="{{ url('/g5-iso-standards') }}"
                                    class="dropdown-item {{ request()->is('g5-iso-standards') ? 'active' : '' }}">G5 ISO
                                    Standards</a>
                                <a href="{{ url('/g5-patents') }}"
                                    class="dropdown-item {{ request()->is('g5-patents') ? 'active' : '' }}">Patents G5
                                    SBUS</a>
                                <a href="{{ url('/g5-memberships') }}"
                                    class="dropdown-item {{ request()->is('g5-memberships') ? 'active' : '' }}">Memberships</a>
                                <a href="{{ url('/g5-registrations') }}"
                                    class="dropdown-item {{ request()->is('g5-registrations') ? 'active' : '' }}">Registrations
                                    TL</a>
                                <a href="{{ url('/g5-shares-merge-finland') }}"
                                    class="dropdown-item {{ request()->is('g5-shares-merge-finland') ? 'active' : '' }}">Smart
                                    Share Merge Finland</a>
                                <a href="{{ url('/g5-selected-clientele') }}"
                                    class="dropdown-item {{ request()->is('g5-selected-clientele') ? 'active' : '' }}">Selected
                                    Clients</a>
                            </div>
                        </div>

                        <div class="nav-item dropdown">
                            <a href="{{ url('/technology') }}" class="nav-link dropdown-toggle {{ request()->is(
                                    'technology',
                                    'g5-sbus-technology',
                                    'ce-mark-certification',
                                    'rohs-certification',
                                    'russian-poct-certification',
                                    'fcc-testing',
                                    'australia-newzealand-certification',
                                    'ul-etl-certification',
                                    'g5-csa-certification',
                                    'iec-certification',
                                    'emc-testing',
                                    'sabs-certification-africa',
                                    'original-g5-product',
                                    'why-choose-g5',
                                    'hai-integration-g5',
                                    'g5-vs-knx'
                                ) ? 'active' : '' }}">
                                Technology
                            </a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="{{ url('/g5-sbus-technology') }}"
                                    class="dropdown-item {{ request()->is('g5-sbus-technology') ? 'active' : '' }}">Our
                                    Owned Technology</a>
                                <a href="{{ url('/ce-mark-certification') }}"
                                    class="dropdown-item {{ request()->is('ce-mark-certification') ? 'active' : '' }}">CE
                                    MARK</a>
                                <a href="{{ url('/rohs-certification') }}"
                                    class="dropdown-item {{ request()->is('rohs-certification') ? 'active' : '' }}">ROHS</a>
                                <a href="{{ url('/russian-poct-certification') }}"
                                    class="dropdown-item {{ request()->is('russian-poct-certification') ? 'active' : '' }}">Russian
                                    POCT</a>
                                <a href="{{ url('/fcc-testing') }}"
                                    class="dropdown-item {{ request()->is('fcc-testing') ? 'active' : '' }}">FCC
                                    Tests</a>
                                <a href="{{ url('/australia-newzealand-certification') }}"
                                    class="dropdown-item {{ request()->is('australia-newzealand-certification') ? 'active' : '' }}">AUS/NZ
                                    Tick | Smart Control & Automation</a>
                                <a href="{{ url('/ul-etl-certification') }}"
                                    class="dropdown-item {{ request()->is('ul-etl-certification') ? 'active' : '' }}">UL
                                    ELT</a>
                                <a href="{{ url('/g5-csa-certification') }}"
                                    class="dropdown-item {{ request()->is('g5-csa-certification') ? 'active' : '' }}">CSA</a>
                                <a href="{{ url('/iec-certification') }}"
                                    class="dropdown-item {{ request()->is('iec-certification') ? 'active' : '' }}">IEC
                                    Certification</a>
                                <a href="{{ url('/emc-testing') }}"
                                    class="dropdown-item {{ request()->is('emc-testing') ? 'active' : '' }}">EMC
                                    Tests</a>
                                <a href="{{ url('/sabs-certification-africa') }}"
                                    class="dropdown-item {{ request()->is('sabs-certification-africa') ? 'active' : '' }}">SABS
                                    Test Africa</a>
                                <a href="{{ url('/original-g5-product') }}"
                                    class="dropdown-item {{ request()->is('original-g5-product') ? 'active' : '' }}">Original
                                    Product</a>
                                <a href="{{ url('/why-choose-g5') }}"
                                    class="dropdown-item {{ request()->is('why-choose-g5') ? 'active' : '' }}">Why
                                    Choose our Technology?</a>
                                <a href="{{ url('/hai-integration-g5') }}"
                                    class="dropdown-item {{ request()->is('hai-integration-g5') ? 'active' : '' }}">HAI
                                    and G5</a>
                                <a href="{{ url('/g5-vs-knx') }}"
                                    class="dropdown-item {{ request()->is('g5-vs-knx') ? 'active' : '' }}">Smart Bus VS
                                    KNX</a>
                            </div>
                        </div>

                        <div class="nav-item dropdown">
                            <a href="javascript:void(0);" class="nav-link dropdown-toggle {{ request()->is(
                                    'hotel-hospitality-bms',
                                    'global-medical',
                                    'luxury-smarthome',
                                    'apartment-building-solutions',
                                    'smart-industrial',
                                    'smart-stadiums',
                                    'smart-marine-motorhomes',
                                    'smart-museums',
                                    'smart-commercial-buildings',
                                    'smart-education-schools',
                                    'religious-buildings',
                                    'smart-office-automation',
                                    'smart-city-solutions',
                                    'g5-retrofit-solutions'
                                ) ? 'active' : '' }}" data-bs-toggle="dropdown">
                                Solutions
                            </a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="{{ url('/hotel-hospitality-bms') }}"
                                    class="dropdown-item {{ request()->is('hotel-hospitality-bms') ? 'active' : '' }}">Hotel,
                                    GRMS & Hospitality</a>
                                <a href="{{ url('/global-medical') }}"
                                    class="dropdown-item {{ request()->is('global-medical') ? 'active' : '' }}">Medical
                                    Solutions Smart G5</a>
                                <a href="{{ url('/luxury-smarthome') }}"
                                    class="dropdown-item {{ request()->is('luxury-smarthome') ? 'active' : '' }}">Luxury
                                    SmartHomes</a>
                                <a href="{{ url('/apartment-building-solutions') }}"
                                    class="dropdown-item {{ request()->is('apartment-building-solutions') ? 'active' : '' }}">Mass
                                    Apartment Solutions</a>
                                <a href="{{ url('/smart-industrial') }}"
                                    class="dropdown-item {{ request()->is('smart-industrial') ? 'active' : '' }}">Smart
                                    G5 Smart Industrial Controls</a>
                                <a href="{{ url('/smart-stadiums') }}"
                                    class="dropdown-item {{ request()->is('smart-stadiums') ? 'active' : '' }}">Smart
                                    Stadium Systems</a>
                                <a href="{{ url('/smart-marine-motorhomes') }}"
                                    class="dropdown-item {{ request()->is('smart-marine-motorhomes') ? 'active' : '' }}">Smart
                                    Marine and Caravan</a>
                                <a href="{{ url('/smart-museums') }}"
                                    class="dropdown-item {{ request()->is('smart-museums') ? 'active' : '' }}">Smart
                                    Museum Systems</a>
                                <a href="{{ url('/smart-commercial-buildings') }}"
                                    class="dropdown-item {{ request()->is('smart-commercial-buildings') ? 'active' : '' }}">Smart
                                    Commercial Solutions</a>
                                <a href="{{ url('/smart-education-schools') }}"
                                    class="dropdown-item {{ request()->is('smart-education-schools') ? 'active' : '' }}">Smart
                                    G5 Education Solutions</a>
                                <a href="{{ url('/religious-buildings') }}"
                                    class="dropdown-item {{ request()->is('religious-buildings') ? 'active' : '' }}">Religious
                                    Buildings and Orphanage Sys</a>
                                <a href="{{ url('/smart-office-automation') }}"
                                    class="dropdown-item {{ request()->is('smart-office-automation') ? 'active' : '' }}">Smart
                                    G5 Office Automation</a>
                                <a href="{{ url('/smart-city-solutions') }}"
                                    class="dropdown-item {{ request()->is('smart-city-solutions') ? 'active' : '' }}">Smart
                                    City By G5</a>
                                <a href="{{ url('/g5-retrofit-solutions') }}" target="_blank"
                                    class="dropdown-item {{ request()->is('g5-retrofit-solutions') ? 'active' : '' }}">Retrofit
                                    Hybrid Solution for Projects</a>
                            </div>
                        </div>

                        <div class="nav-item dropdown">
                            <a href="javascript:void(0);" class="nav-link dropdown-toggle"
                                data-bs-toggle="dropdown">Projects Ref.</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="https://www.facebook.com/smartbuildingcontrol/" terget="_blank"
                                    class="dropdown-item">Intelligent Buildings</a>
                                <a href="https://www.facebook.com/Hotelcontrol/" class="dropdown-item">Hotels &
                                    Restaurants (Hospitality)</a>
                                <a href="https://www.facebook.com/smarthospitalcontrol/" class="dropdown-item">Smart
                                    Hospital & Clinic</a>
                                <a href="https://www.facebook.com/profile.php?id=100064068393575"
                                    class="dropdown-item">Smart Residential Custom Homes</a>
                                <a href="https://www.facebook.com/smartprayerhall" class="dropdown-item">Smart Prayer
                                    Halls</a>
                                <a href="https://www.facebook.com/SmartmuseumG4/" class="dropdown-item">Smart
                                    Museums</a>
                                <a href="https://www.facebook.com/profile.php?id=100063868669379"
                                    class="dropdown-item">Smart Offices and Showrooms</a>
                                <a href="https://www.facebook.com/profile.php?id=100063723618688#"
                                    class="dropdown-item">Smart City Projects</a>
                                <a href="https://www.facebook.com/smartG4theaters" class="dropdown-item">Smart Theaters
                                    BallRoom and Cinema</a>
                                <a href="https://www.facebook.com/profile.php?id=100064042601338"
                                    class="dropdown-item">Smart Marine & Motorhomes</a>
                                <a href="https://www.facebook.com/G4Apps/" class="dropdown-item">Smart G5 APPs &
                                    Software</a>
                            </div>
                        </div>

                        <div class="nav-item dropdown">
                            <a href="{{ url('/products') }}"
                                class="nav-link dropdown-toggle {{ request()->is('products', 'new-products', 'knx-projects-range', 'consumer-ideas', 'consultant-designer-ideas', 'installer-integrator-ideas', 'g5-banners-archive') ? 'active' : '' }}">
                                Products
                            </a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="{{ url('/products') }}"
                                    class="dropdown-item {{ request()->is('products') ? 'active' : '' }}">Products</a>
                                <a href="{{ url('/g5-retrofit-solutions') }}"
                                    class="dropdown-item {{ request()->is('g5-retrofit-solutions') ? 'active' : '' }}">Retrofit
                                    Hybrid Range</a>
                                <a href="{{ url('/new-products') }}"
                                    class="dropdown-item {{ request()->is('new-products') ? 'active' : '' }}">Peek on
                                    New Products</a>
                                <a href="{{ url('/knx-projects-range') }}"
                                    class="dropdown-item {{ request()->is('knx-projects-range') ? 'active' : '' }}">KNX
                                    New Range</a>
                                <a href="{{ url('/consumer-ideas') }}"
                                    class="dropdown-item {{ request()->is('consumer-ideas') ? 'active' : '' }}">Ideas
                                    for Consumer</a>
                                <a href="{{ url('/consultant-designer-ideas') }}"
                                    class="dropdown-item {{ request()->is('consultant-designer-ideas') ? 'active' : '' }}">Ideas
                                    for Consultant/Designer</a>
                                <a href="{{ url('/installer-integrator-ideas') }}"
                                    class="dropdown-item {{ request()->is('installer-integrator-ideas') ? 'active' : '' }}">Ideas
                                    for Installers/Integrators</a>
                                <a href="{{ url('/g5-banners-archive') }}"
                                    class="dropdown-item {{ request()->is('g5-banners-archive') ? 'active' : '' }}">Banners</a>
                            </div>
                        </div>

                        <div class="nav-item dropdown">
                            <a href="javascript:void(0);"
                                class="nav-link dropdown-toggle {{ request()->is('catalogues-english', 'catalogues-multilingual', 'lab-tests-certifications-download', 'drive-share-downloads') ? 'active' : '' }}"
                                data-bs-toggle="dropdown">
                                Downloads
                            </a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="{{ url('catalogues-english') }}"
                                    class="dropdown-item {{ request()->is('catalogues-english') ? 'active' : '' }}">English
                                    Catalogues</a>
                                <a href="{{ url('catalogues-multilingual') }}"
                                    class="dropdown-item {{ request()->is('catalogues-multilingual') ? 'active' : '' }}">Catalogues
                                    Other Languages</a>
                                <a href="{{ url('lab-tests-certifications-download') }}"
                                    class="dropdown-item {{ request()->is('lab-tests-certifications-download') ? 'active' : '' }}">Download
                                    Lab Tests & Certification Bulk</a>
                                <a href="{{ url('drive-share-downloads') }}"
                                    class="dropdown-item {{ request()->is('drive-share-downloads') ? 'active' : '' }}"
                                    target="_blank">Download
                                    from our Drive Share</a>
                            </div>
                        </div>

                        <div class="nav-item dropdown">
                            <a href="javascript:void(0);"
                                class="nav-link dropdown-toggle {{ request()->is('buy-g5-products', 'become-dealer-or-distributor', 'training-request-form', 'g5-support', 'articles-and-case-studies', 'drive-share-downloads', 'faq', 'g5-dealers-forum') ? 'active' : '' }}"
                                data-bs-toggle="dropdown">
                                Project Support
                            </a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="{{ url('/buy-g5-products') }}"
                                    class="dropdown-item {{ request()->is('buy-g5-products') ? 'active' : '' }}">I have
                                    Project I need Help</a>
                                <a href="{{ url('/become-dealer-or-distributor') }}"
                                    class="dropdown-item {{ request()->is('become-dealer-or-distributor') ? 'active' : '' }}">How
                                    to become Dealer/Distributor</a>
                                <a href="{{ url('/training-request-form') }}"
                                    class="dropdown-item {{ request()->is('training-request-form') ? 'active' : '' }}">Training
                                    Request</a>
                                <a href="{{ url('/g5-support') }}"
                                    class="dropdown-item {{ request()->is('g5-support') ? 'active' : '' }}">Getting
                                    Support</a>
                                <a href="{{ url('/articles-and-case-studies') }}"
                                    class="dropdown-item {{ request()->is('articles-and-case-studies') ? 'active' : '' }}">Articles
                                    Case Study</a>
                                <a href="{{ url('/drive-share-downloads') }}"
                                    class="dropdown-item {{ request()->is('drive-share-downloads') ? 'active' : '' }}">Download
                                    from Drives</a>
                                <a href="{{ url('/faq') }}"
                                    class="dropdown-item {{ request()->is('faq') ? 'active' : '' }}">FAQ Q&A</a>
                                <a href="{{ url('/g5-dealers-forum') }}"
                                    class="dropdown-item {{ request()->is('g5-dealers-forum') ? 'active' : '' }}">Forum</a>
                            </div>

                        </div>
                        <div class="d-flex">
                            <a href="{{ url('/contact-us') }}" class="btn btn-primary rounded-0 py-3 px-3">
                                Contact Us <i class="fa fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>