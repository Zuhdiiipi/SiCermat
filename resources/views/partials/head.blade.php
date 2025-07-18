<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>SiCermat</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('admin') }}/assets/img/kaiadmin/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Fonts and icons -->
    <script src="{{ asset('admin') }}/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
            /
        });
    </script>
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/kaiadmin.min.css" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/demo.css" />
</head>
