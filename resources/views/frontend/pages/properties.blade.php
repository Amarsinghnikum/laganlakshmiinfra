@extends("frontend.layouts.app")

@section("title","lagan lakshmi infra | properties page")

@section("content")
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section spad set-bg" data-setbg="{{url('/assets/img/breadcrumb-bg.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h4>Property Grid</h4>
                    <div class="bt-option">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>Property</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Property Section Begin -->
<section class="property-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h4>PROPERTY Grid</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="property-item">
                    <div class="pi-pic set-bg" data-setbg="{{url('/assets/img/property/property-1.jpg')}}">
                        <div class="label">For rent</div>
                    </div>
                    <div class="pi-text">
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <div class="pt-price">
                            <button class="btn"><a href="{{url('contact-us')}}" class="contact-btn">contact
                                    us</a></button>
                        </div>
                        <h5><a href="#">Supertech Supernova</a></h5>
                        <p><span class="icon_pin_alt"></span> Sector 94, Noida, UP</p>
                        <ul>
                            <li><i class="fa fa-object-group"></i> 1,450</li>
                            <li><i class="fa fa-bathtub"></i> 02</li>
                            <li><i class="fa fa-bed"></i> 03</li>
                            <li><i class="fa fa-automobile"></i> 01</li>
                        </ul>
                        <div class="pi-agent">
                            <div class="pa-item">
                                <div class="pa-info">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135789.png"
                                        alt="Female Agent">
                                    <h6>Priya Sharma</h6>
                                </div>
                                <div class="pa-text">987-123-4567</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="property-item">
                    <div class="pi-pic set-bg" data-setbg="{{url('/assets/img/property/property-2.jpg')}}">
                        <div class="label c-red">For rent</div>
                    </div>
                    <div class="pi-text">
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <div class="pt-price">
                            <button class="btn"><a href="{{url('contact-us')}}" class="contact-btn">contact
                                    us</a></button>
                        </div>
                        <h5><a href="#">DLF King's Court</a></h5>
                        <p><span class="icon_pin_alt"></span> Greater Kailash II, New Delhi</p>
                        <ul>
                            <li><i class="fa fa-object-group"></i> 2,800</li>
                            <li><i class="fa fa-bathtub"></i> 03</li>
                            <li><i class="fa fa-bed"></i> 04</li>
                            <li><i class="fa fa-automobile"></i> 02</li>
                        </ul>
                        <div class="pi-agent">
                            <div class="pa-item">
                                <div class="pa-info">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Male Agent">
                                    <h6>Rahul Khanna</h6>
                                </div>
                                <div class="pa-text">981-000-1122</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="property-item">
                    <div class="pi-pic set-bg" data-setbg="{{url('/assets/img/property/property-3.jpg')}}">
                        <div class="label c-magenta">For rent</div>
                    </div>
                    <div class="pi-text">
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <div class="pt-price">
                            <button class="btn"><a href="{{url('contact-us')}}" class="contact-btn">contact
                                    us</a></button>
                        </div>
                        <h5><a href="#">ATS Advantage</a></h5>
                        <p><span class="icon_pin_alt"></span> Indirapuram, Ghaziabad</p>
                        <ul>
                            <li><i class="fa fa-object-group"></i> 1,685</li>
                            <li><i class="fa fa-bathtub"></i> 02</li>
                            <li><i class="fa fa-bed"></i> 03</li>
                            <li><i class="fa fa-automobile"></i> 01</li>
                        </ul>
                        <div class="pi-agent">
                            <div class="pa-item">
                                <div class="pa-info">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Male Agent">
                                    <h6>Vikas Tyagi</h6>
                                </div>
                                <div class="pa-text">955-444-3322</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="property-item">
                    <div class="pi-pic set-bg" data-setbg="{{url('/assets/img/property/property-4.jpg')}}">
                        <div class="label">For rent</div>
                    </div>
                    <div class="pi-text">
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <div class="pt-price">
                            <button class="btn"><a href="{{url('contact-us')}}" class="contact-btn">contact
                                    us</a></button>
                        </div>
                        <h5><a href="#">Lodha World One</a></h5>
                        <p><span class="icon_pin_alt"></span> Lower Parel, Mumbai, MH</p>
                        <ul>
                            <li><i class="fa fa-object-group"></i> 1,100</li>
                            <li><i class="fa fa-bathtub"></i> 02</li>
                            <li><i class="fa fa-bed"></i> 02</li>
                            <li><i class="fa fa-automobile"></i> 01</li>
                        </ul>
                        <div class="pi-agent">
                            <div class="pa-item">
                                <div class="pa-info">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135789.png"
                                        alt="Female Agent">
                                    <h6>Anjali Mehta</h6>
                                </div>
                                <div class="pa-text">912-345-6789</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="property-item">
                    <div class="pi-pic set-bg" data-setbg="{{url('/assets/img/property/property-5.jpg')}}">
                        <div class="label c-red">For rent</div>
                    </div>
                    <div class="pi-text">
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <div class="pt-price">
                            <button class="btn"><a href="{{url('contact-us')}}" class="contact-btn">contact
                                    us</a></button>
                        </div>
                        <h5><a href="#">Prestige Shantiniketan</a></h5>
                        <p><span class="icon_pin_alt"></span> Whitefield, Bangalore, KA</p>
                        <ul>
                            <li><i class="fa fa-object-group"></i> 1,900</li>
                            <li><i class="fa fa-bathtub"></i> 02</li>
                            <li><i class="fa fa-bed"></i> 03</li>
                            <li><i class="fa fa-automobile"></i> 01</li>
                        </ul>
                        <div class="pi-agent">
                            <div class="pa-item">
                                <div class="pa-info">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Male Agent">
                                    <h6>Sandeep Nair</h6>
                                </div>
                                <div class="pa-text">888-999-0000</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="property-item">
                    <div class="pi-pic set-bg" data-setbg="{{url('/assets/img/property/property-6.jpg')}}">
                        <div class="label">For rent</div>
                    </div>
                    <div class="pi-text">
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <div class="pt-price">
                            <button class="btn"><a href="{{url('contact-us')}}" class="contact-btn">contact
                                    us</a></button>
                        </div>
                        <h5><a href="#">Amanora Gateway</a></h5>
                        <p><span class="icon_pin_alt"></span> Hadapsar, Pune, MH</p>
                        <ul>
                            <li><i class="fa fa-object-group"></i> 2,100</li>
                            <li><i class="fa fa-bathtub"></i> 03</li>
                            <li><i class="fa fa-bed"></i> 03</li>
                            <li><i class="fa fa-automobile"></i> 02</li>
                        </ul>
                        <div class="pi-agent">
                            <div class="pa-item">
                                <div class="pa-info">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135789.png"
                                        alt="Female Agent">
                                    <h6>Sneha Kulkarni</h6>
                                </div>
                                <div class="pa-text">997-555-1234</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="property-item">
                    <div class="pi-pic set-bg" data-setbg="{{url('/assets/img/property/property-7.jpg')}}">
                        <div class="label c-magenta">For rent</div>
                    </div>
                    <div class="pi-text">
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <div class="pt-price">
                            <button class="btn"><a href="{{url('contact-us')}}" class="contact-btn">contact
                                    us</a></button>
                        </div>
                        <h5><a href="#">My Home Abhra</a></h5>
                        <p><span class="icon_pin_alt"></span> Madhapur, Hyderabad, TS</p>
                        <ul>
                            <li><i class="fa fa-object-group"></i> 2,500</li>
                            <li><i class="fa fa-bathtub"></i> 03</li>
                            <li><i class="fa fa-bed"></i> 03</li>
                            <li><i class="fa fa-automobile"></i> 02</li>
                        </ul>
                        <div class="pi-agent">
                            <div class="pa-item">
                                <div class="pa-info">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Male Agent">
                                    <h6>Kiran Reddy</h6>
                                </div>
                                <div class="pa-text">770-222-8888</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="property-item">
                    <div class="pi-pic set-bg" data-setbg="{{url('/assets/img/property/property-1.jpg')}}">
                        <div class="label">For rent</div>
                    </div>
                    <div class="pi-text">
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <div class="pt-price">
                            <button class="btn"><a href="{{url('contact-us')}}" class="contact-btn">contact
                                    us</a></button>
                        </div>
                        <h5><a href="#">Godrej Palm Retreat</a></h5>
                        <p><span class="icon_pin_alt"></span> Sector 150, Noida, UP</p>
                        <ul>
                            <li><i class="fa fa-object-group"></i> 1,250</li>
                            <li><i class="fa fa-bathtub"></i> 02</li>
                            <li><i class="fa fa-bed"></i> 02</li>
                            <li><i class="fa fa-automobile"></i> 01</li>
                        </ul>
                        <div class="pi-agent">
                            <div class="pa-item">
                                <div class="pa-info">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Male Agent">
                                    <h6>Rohan Malhotra</h6>
                                </div>
                                <div class="pa-text">999-888-7776</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="property-item">
                    <div class="pi-pic set-bg" data-setbg="{{url('/assets/img/property/property-2.jpg')}}">
                        <div class="label c-red">For rent</div>
                    </div>
                    <div class="pi-text">
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <div class="pt-price">
                            <button class="btn"><a href="{{url('contact-us')}}" class="contact-btn">contact
                                    us</a></button>
                        </div>
                        <h5><a href="#">Oberoi Springs</a></h5>
                        <p><span class="icon_pin_alt"></span> Andheri West, Mumbai, MH</p>
                        <ul>
                            <li><i class="fa fa-object-group"></i> 1,600</li>
                            <li><i class="fa fa-bathtub"></i> 03</li>
                            <li><i class="fa fa-bed"></i> 03</li>
                            <li><i class="fa fa-automobile"></i> 02</li>
                        </ul>
                        <div class="pi-agent">
                            <div class="pa-item">
                                <div class="pa-info">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135789.png"
                                        alt="Female Agent">
                                    <h6>Kavita Iyer</h6>
                                </div>
                                <div class="pa-text">982-111-2233</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="property-item">
                    <div class="pi-pic set-bg" data-setbg="{{url('/assets/img/property/property-3.jpg')}}">
                        <div class="label">For rent</div>
                    </div>
                    <div class="pi-text">
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <div class="pt-price">
                            <button class="btn"><a href="{{url('contact-us')}}" class="contact-btn">contact
                                    us</a></button>
                        </div>
                        <h5><a href="#">Embassy Grove</a></h5>
                        <p><span class="icon_pin_alt"></span> Indiranagar, Bangalore, KA</p>
                        <ul>
                            <li><i class="fa fa-object-group"></i> 3,200</li>
                            <li><i class="fa fa-bathtub"></i> 04</li>
                            <li><i class="fa fa-bed"></i> 04</li>
                            <li><i class="fa fa-automobile"></i> 02</li>
                        </ul>
                        <div class="pi-agent">
                            <div class="pa-item">
                                <div class="pa-info">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Male Agent">
                                    <h6>Arjun Hegde</h6>
                                </div>
                                <div class="pa-text">804-555-6677</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="property-item">
                    <div class="pi-pic set-bg" data-setbg="{{url('/assets/img/property/property-4.jpg')}}">
                        <div class="label c-magenta">For rent</div>
                    </div>
                    <div class="pi-text">
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <div class="pt-price">
                            <button class="btn"><a href="{{url('contact-us')}}" class="contact-btn">contact
                                    us</a></button>
                        </div>
                        <h5><a href="#">Marvel Aurum</a></h5>
                        <p><span class="icon_pin_alt"></span> Koregaon Park, Pune, MH</p>
                        <ul>
                            <li><i class="fa fa-object-group"></i> 2,400</li>
                            <li><i class="fa fa-bathtub"></i> 03</li>
                            <li><i class="fa fa-bed"></i> 03</li>
                            <li><i class="fa fa-automobile"></i> 02</li>
                        </ul>
                        <div class="pi-agent">
                            <div class="pa-item">
                                <div class="pa-info">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135789.png"
                                        alt="Female Agent">
                                    <h6>Simran Kaur</h6>
                                </div>
                                <div class="pa-text">976-333-4455</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="property-item">
                    <div class="pi-pic set-bg" data-setbg="{{url('/assets/img/property/property-5.jpg')}}">
                        <div class="label c-red">For rent</div>
                    </div>
                    <div class="pi-text">
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <div class="pt-price">
                            <button class="btn"><a href="{{url('contact-us')}}" class="contact-btn">contact
                                    us</a></button>
                        </div>
                        <h5><a href="#">KW Srishti</a></h5>
                        <p><span class="icon_pin_alt"></span> Raj Nagar Extension, Ghaziabad, UP</p>
                        <ul>
                            <li><i class="fa fa-object-group"></i> 1,350</li>
                            <li><i class="fa fa-bathtub"></i> 02</li>
                            <li><i class="fa fa-bed"></i> 03</li>
                            <li><i class="fa fa-automobile"></i> 01</li>
                        </ul>
                        <div class="pi-agent">
                            <div class="pa-item">
                                <div class="pa-info">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135789.png"
                                        alt="Female Agent">
                                    <h6>Megha Gupta</h6>
                                </div>
                                <div class="pa-text">981-555-6677</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="loadmore-btn">
                    <a href="#">Load more</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection