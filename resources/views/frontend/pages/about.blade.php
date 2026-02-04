@extends("frontend.layouts.app")

@section("title","lagan lakshmi infra | about")

@section("content")

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section spad set-bg" data-setbg="{{url('/assets/img/breadcrumb-bg.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h4>About us</h4>
                    <div class="bt-option">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>About</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- About Section Begin -->
<section class="about-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-text">
                    <div class="at-title">
                        <h3>Welcome to Lagan Lakshmi Infra</h3>
                        <p>
                            Lagan Lakshmi Infra is a trusted real estate platform dedicated to helping you
                            buy, rent, and sell properties with ease. We focus on transparency,
                            verified listings, and expert guidance to make your property journey
                            smooth and reliable.
                        </p>
                    </div>

                    <div class="at-feature">
                        <div class="af-item">
                            <div class="af-icon">
                                <img src="{{url('/assets/img/chooseus/chooseus-icon-1.png')}}" alt="">
                            </div>
                            <div class="af-text">
                                <h6>Find Your Future Home</h6>
                                <p>
                                    Explore carefully selected properties that match your lifestyle,
                                    budget, and long-term goals.
                                </p>
                            </div>
                        </div>

                        <div class="af-item">
                            <div class="af-icon">
                                <img src="{{url('/assets/img/chooseus/chooseus-icon-2.png')}}" alt="">
                            </div>
                            <div class="af-text">
                                <h6>Experienced & Trusted Agents</h6>
                                <p>
                                    Work with knowledgeable professionals who understand the local
                                    market and your requirements.
                                </p>
                            </div>
                        </div>

                        <div class="af-item">
                            <div class="af-icon">
                                <img src="{{url('/assets/img/chooseus/chooseus-icon-3.png')}}" alt="">
                            </div>
                            <div class="af-text">
                                <h6>Buy or Rent with Confidence</h6>
                                <p>
                                    Choose from a wide range of verified homes and apartments in
                                    prime and emerging locations.
                                </p>
                            </div>
                        </div>

                        <div class="af-item">
                            <div class="af-icon">
                                <img src="{{url('/assets/img/chooseus/chooseus-icon-4.png')}}" alt="">
                            </div>
                            <div class="af-text">
                                <h6>List Your Property Easily</h6>
                                <p>
                                    Create your listing in minutes and connect with genuine buyers
                                    or tenants faster.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="about-pic set-bg" data-setbg="{{url('/assets/img/about-us.jpg')}}">
                    <a href="https://www.youtube.com/watch?v=8EJ3zbKTWQ8" class="play-btn video-popup">
                        <i class="fa fa-play-circle"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section End -->

<!-- Team Section Begin -->
<section class="team-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <div class="section-title">
                    <h4>Our Property Consultants</h4>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="team-btn">
                    <a href="#"><i class="fa fa-user"></i> View All Consultants</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="ts-item">
                    <div class="ts-text">
                        <img src="{{url('/assets/img/team/team-1.jpg')}}" alt="Property Consultant">
                        <h5>Rahul Sharma</h5>
                        <span>+91 98765 43210</span>
                        <p>
                            Residential property expert specializing in apartments
                            and villas across prime city locations.
                        </p>
                        <div class="ts-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="mailto:rahul@example.com"><i class="fa fa-envelope-o"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="ts-item">
                    <div class="ts-text">
                        <img src="{{url('/assets/img/team/team-2.jpg')}}" alt="Property Consultant">
                        <h5>Pooja Verma</h5>
                        <span>+91 91234 56789</span>
                        <p>
                            Trusted advisor for buying and renting homes with
                            in-depth local market knowledge.
                        </p>
                        <div class="ts-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="mailto:pooja@example.com"><i class="fa fa-envelope-o"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="ts-item">
                    <div class="ts-text">
                        <img src="{{url('/assets/img/team/team-3.jpg')}}" alt="Property Consultant">
                        <h5>Amit Patel</h5>
                        <span>+91 99887 66554</span>
                        <p>
                            Specialist in commercial and investment properties,
                            helping clients make smart decisions.
                        </p>
                        <div class="ts-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="mailto:amit@example.com"><i class="fa fa-envelope-o"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Team Section End -->

<!-- Testimonial Section Begin -->
<section class="testimonial-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h4>What Our Clients Say</h4>
                </div>
            </div>
        </div>

        <div class="row testimonial-slider owl-carousel">
            <div class="col-lg-6">
                <div class="testimonial-item">
                    <div class="ti-text">
                        <p>
                            The entire process was smooth and transparent. The team understood our requirements
                            and helped us find the perfect home within our budget. Highly recommended.
                        </p>
                    </div>
                    <div class="ti-author">
                        <div class="ta-pic">
                            <img src="{{url('/assets/img/testimonial-author/ta-1.jpg')}}" alt="">
                        </div>
                        <div class="ta-text">
                            <h5>Rohit Sharma</h5>
                            <span>Home Buyer</span>
                            <div class="ta-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="testimonial-item">
                    <div class="ti-text">
                        <p>
                            Listing my property was quick and hassle-free. I received genuine inquiries and
                            closed the deal faster than expected. Great service and support.
                        </p>
                    </div>
                    <div class="ti-author">
                        <div class="ta-pic">
                            <img src="{{url('/assets/img/testimonial-author/ta-2.jpg')}}" alt="">
                        </div>
                        <div class="ta-text">
                            <h5>Anjali Verma</h5>
                            <span>Property Owner</span>
                            <div class="ta-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="testimonial-item">
                    <div class="ti-text">
                        <p>
                            Professional agents with excellent local knowledge. They guided us at every step
                            and made renting our new home a stress-free experience.
                        </p>
                    </div>
                    <div class="ti-author">
                        <div class="ta-pic">
                            <img src="{{url('/assets/img/testimonial-author/ta-1.jpg')}}" alt="">
                        </div>
                        <div class="ta-text">
                            <h5>Vikas Mehta</h5>
                            <span>Tenant</span>
                            <div class="ta-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonial Section End -->

<!-- Contact Section Begin -->
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="contact-info">
                    <div class="ci-item">
                        <div class="ci-icon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <div class="ci-text">
                            <h5>Address</h5>
                            <p>H-141, H Block, Sector 63, Noida, Uttar Pradesh 201309</p>
                        </div>
                    </div>
                    <div class="ci-item">
                        <div class="ci-icon">
                            <i class="fa fa-mobile"></i>
                        </div>
                        <div class="ci-text">
                            <h5>Phone</h5>
                            <ul>
                                <li>+918595543869</li>
                            </ul>
                        </div>
                    </div>
                    <div class="ci-item">
                        <div class="ci-icon">
                            <i class="fa fa-headphones"></i>
                        </div>
                        <div class="ci-text">
                            <h5>Support</h5>
                            <p>info@laganlakshmiinfra.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cs-map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d735515.5813275519!2d-80.41163541934742!3d43.93644386501528!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882a55bbf3de23d7%3A0x3ada5af229b47375!2sMono%2C%20ON%2C%20Canada!5e0!3m2!1sen!2sbd!4v1583262687289!5m2!1sen!2sbd"
            height="450" style="border:0;" allowfullscreen=""></iframe>
    </div>
</section>
<!-- Contact Section End -->
@endsection