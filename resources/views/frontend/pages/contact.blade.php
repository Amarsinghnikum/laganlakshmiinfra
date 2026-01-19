@extends("frontend.layouts.app")

@section("title","lagan lakshmi infra | Contact us")

@section("content")
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section spad set-bg" data-setbg="{{url('/assets/img/breadcrumb-contact-bg.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h4>Contact Us</h4>
                    <div class="bt-option">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>Contact</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Contact Form Section Begin -->
<section class="contact-form-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cf-content">
                    <div class="cc-title text-center">
                        <h4>Get in Touch</h4>
                        <p>
                            Have questions about buying, renting, or listing a property?
                            Fill out the form below and our team will get back to you shortly.
                        </p>
                    </div>

                    <!-- Success message -->
                    <div class="col-md-12 text-center mt-3">
                        <div id="successMsg" class="alert alert-success d-none"></div>
                    </div>
                    <form id="contactForm" method="POST" class="cc-form">
                        @csrf
                        <div class="row">
                            <!-- Row 1 -->
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Full Name">
                                <small class="text-danger error-name"></small>
                            </div>

                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="Email Address">
                                <small class="text-danger error-email"></small>
                            </div>

                            <!-- Row 2 -->
                            <div class="col-md-6">
                                <input type="tel" name="phone" class="form-control" placeholder="Phone Number">
                                <small class="text-danger error-phone"></small>
                            </div>

                            <div class="col-md-6">
                                <input type="text" name="subject" class="form-control" placeholder="Subject">
                                <small class="text-danger error-subject"></small>
                            </div>

                            <!-- Message -->
                            <div class="col-md-12">
                                <textarea name="message" class="form-control" placeholder="Your Message"
                                    rows="5"></textarea>
                                <small class="text-danger error-message"></small>
                            </div>

                            <!-- Button -->
                            <div class="col-md-12 text-center">
                                <button type="submit" class="site-btn" id="submitBtn">Send Message</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Form Section End -->

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
                                <li>+91 85955 43869</li>

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
@endsection

@push('scripts')
<script>
$('#contactForm').on('submit', function(e) {
    e.preventDefault();

    $('#submitBtn').prop('disabled', true).text('Sending...');
    $('.text-danger').text('');
    $('#successMsg').addClass('d-none').text('');

    $.ajax({
        url: "{{ route('contact.submit') }}",
        type: "POST",
        data: $(this).serialize(),
        success: function(response) {
            $('#successMsg')
                .removeClass('d-none')
                .text(response.message);

            $('#contactForm')[0].reset();
            $('#submitBtn').prop('disabled', false).text('Send Message');
        },
        error: function(xhr) {
            $('#submitBtn').prop('disabled', false).text('Send Message');

            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                $.each(errors, function(key, value) {
                    $('.error-' + key).text(value[0]);
                });
            }
        }
    });
});
</script>
@endpush