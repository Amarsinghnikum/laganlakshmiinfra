    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta name="description" content="Aler Template">
        <meta name="keywords" content="Aler, unica, creative, html">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Lagan Lakshmi Infra </title>

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900&display=swap"
            rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">

        <!-- Css Styles -->
        <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{url('assets/css/font-awesome.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{url('assets/css/elegant-icons.css')}}" type="text/css">
        <link rel="stylesheet" href="{{url('assets/css/jquery-ui.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{url('assets/css/nice-select.css')}}" type="text/css">
        <link rel="stylesheet" href="{{url('assets/css/owl.carousel.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{url('assets/css/magnific-popup.css')}}" type="text/css">
        <link rel="stylesheet" href="{{url('assets/css/slicknav.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{url('assets/css/style.css')}}" type="text/css">

        @stack('styles')
    </head>

    <body>

        @include('partials.header')

        @yield('content')

        @include('partials.footer')

        <!-- Scripts -->
        <script src="{{url('assets/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{url('assets/js/bootstrap.min.js')}}"></script>
        <script src="{{url('assets/js/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{url('assets/js/mixitup.min.js')}}"></script>
        <script src="{{url('assets/js/jquery-ui.min.js')}}"></script>
        <script src="{{url('assets/js/jquery.nice-select.min.js')}}"></script>
        <script src="{{url('assets/js/jquery.slicknav.js')}}"></script>
        <script src="{{url('assets/js/owl.carousel.min.js')}}"></script>
        <script src="{{url('assets/js/jquery.richtext.min.js')}}"></script>
        <script src="{{url('assets/js/image-uploader.min.js')}}"></script>
        <script src="{{url('assets/js/main.js')}}"></script>
        <script>
        $(document).ready(function() {
            $('#contact-form').on('submit', function(e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('contact.submit') }}",
                    type: "POST",
                    data: formData,
                    beforeSend: function() {
                        $('#form-response').html(
                            '<span style="color:blue;">Sending...</span>');
                    },
                    success: function(response) {

                        if (response.status === true) {
                            $('#form-response').html(
                                '<span style="color:green;">' + response.message +
                                '</span>'
                            );
                            $('#contact-form')[0].reset();
                        } else {
                            let errorHtml = '<ul style="color:red;">';
                            $.each(response.errors, function(key, value) {
                                errorHtml += '<li>' + value[0] + '</li>';
                            });
                            errorHtml += '</ul>';
                            $('#form-response').html(errorHtml);
                        }
                    },
                    error: function() {
                        $('#form-response').html(
                            '<span style="color:red;">Something went wrong. Please try again.</span>'
                        );
                    }
                });
            });
        });
        </script>

        @stack('scripts')
    </body>

    </html>