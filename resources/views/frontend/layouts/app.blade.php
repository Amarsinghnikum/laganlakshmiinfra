    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">

        <title>
            @yield('meta_title', 'Lagan Lakshmi Infra | Trusted Real Estate & Property Developers')
        </title>

        <meta name="description"
            content="@yield('meta_description', 'Lagan Lakshmi Infra is a trusted real estate company offering residential and commercial properties with transparent dealings and expert guidance.')">

        <meta name="keywords"
            content="@yield('meta_keywords', 'real estate, property developers, residential projects, commercial properties, plots, flats, villas, Lagan Lakshmi Infra')">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ url('assets/img/favicon.png') }}">
        <link rel="apple-touch-icon" href="{{ url('assets/img/favicon.png') }}">

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
            $('#newsletterForm').submit(function(e) {
                e.preventDefault();

                let email = $('#email').val();

                $.ajax({
                    url: "{{ route('newsletter.store') }}",
                    type: "POST",
                    data: {
                        email: email,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#newsletterMsg')
                            .css({
                                'color': 'rgb(6, 152, 6)',
                                'background-color': '#fff',
                                'border-radius': '10px',
                                'font-weight': '600',
                                'padding': '7px'
                            })
                            .text(response.message);

                        $('input[name="email"]').val('');
                    },
                    error: function(xhr) {
                        let message = 'Something went wrong. Please try again.';

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        $('#newsletterMsg')
                            .css({
                                'color': 'red',
                                'background-color': '#fff',
                                'border-radius': '10px',
                                'font-weight': '600',
                                'padding': '7px'
                            })
                            .text(message);
                    }
                });
            });
        });
        </script>
        @stack('scripts')
    </body>

    </html>