<!-- Footer Section Begin -->
<footer class="footer-section">
    <div class="container">
        <div class="row">
            <!-- About -->
            <div class="col-lg-4 col-md-6">
                <div class="fs-about">
                    <div class="fs-logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ url('/assets/img/logo.webp') }}" alt="Company Logo"
                                style="border-radius: 10px;">
                        </a>
                    </div>
                    <p>
                        We help you buy, sell, and rent properties with confidence.
                        Our platform offers verified listings, expert guidance,
                        and a smooth property experience from start to finish.
                    </p>
                    <div class="fs-social">
                        <a href="#" aria-label="Facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fa fa-youtube-play"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fa fa-instagram"></i></a>
                        <a href="#" aria-label="Pinterest"><i class="fa fa-pinterest-p"></i></a>
                    </div>
                </div>
            </div>

            <!-- Help -->
            <div class="col-lg-2 col-sm-6">
                <div class="fs-widget">
                    <h5>Support</h5>
                    <ul>
                        <li><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
                        <li><a href="{{ url('/terms-conditions') }}">Terms & Conditions</a></li>
                        <li><a href="{{ url('/contact-us') }}">Contact Support</a></li>
                        <li><a href="{{ url('/faq') }}">FAQs</a></li>
                        <li><a href="{{ url('/careers') }}">Careers</a></li>
                    </ul>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-sm-6">
                <div class="fs-widget">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="{{ url('/properties') }}">Browse Properties</a></li>
                        <li><a href="{{ url('/login') }}">List Your Property</a></li>
                        <li><a href="{{ url('/my-properties') }}">My Properties</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    </ul>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="col-lg-4 col-md-6">
                <div class="fs-widget">
                    <h5>Newsletter</h5>
                    <p>
                        Subscribe to receive the latest property listings, market updates,
                        and exclusive offers directly in your inbox.
                    </p>
                    <form id="newsletterForm" class="subscribe-form">
                        @csrf
                        <input type="email" name="email" id="email" placeholder="Enter your email" required>
                        <button type="submit" class="site-btn">Subscribe</button>
                    </form>
                    <p id="newsletterMsg" class="mt-3"></p>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="copyright-text">
            <p class="footer-company-name">
                © {{ date('Y') }} Altrix Softech LLP. All Rights Reserved.
            </p>
        </div>
    </div>
</footer>
<!-- Footer Section End -->