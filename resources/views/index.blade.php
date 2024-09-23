<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TFilms</title>
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        
        <style>
            .bg-c-card{
                background-color: #131313;
                color: #C8C8C8;
                font-family: 'Nunito'!important;
            }

            .bg-c-card-modal{
                background-color: #1C1C1C;
                color: #C8C8C8;
                font-family: 'Ariel'!important;
            }

            .modal-header {
                min-height: 16.42857143px;
                padding: 15px;
                border-bottom: 1px solid #ffc107;
            }

            .modal-footer {
                padding: 15px;
                text-align: right;
                border-top: 1px solid #ffc107;
            }

            .bg-c-card-session{
                background-color: #1E1E1E;
                color: #C8C8C8;
                font-family: 'Nunito'!important;
            }

            .bg-c-body{
                background-color: black;
            }

            .c-photo{
                width: 100%;
                border-radius: 2%;
            }

            .nav-c-link-logo {
                display: block;
                padding: var(--bs-nav-link-padding-y) var(--bs-nav-link-padding-x);
                font-size: var(--bs-nav-link-font-size);
                font-weight: var(--bs-nav-link-font-weight);
                color: #ffc107;
                text-decoration: none;
                transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out;
                font-family: 'Algerian'!important;
            }
            .nav-c-link-logo:hover {
                display: block;
                padding: var(--bs-nav-link-padding-y) var(--bs-nav-link-padding-x);
                font-size: var(--bs-nav-link-font-size);
                font-weight: var(--bs-nav-link-font-weight);
                color: #ffc107;
                text-decoration: none;
                transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out;
                font-family: 'Algerian'!important;
            }

            .nav-c-link {
                display: block;
                padding: var(--bs-nav-link-padding-y) var(--bs-nav-link-padding-x);
                font-size: var(--bs-nav-link-font-size);
                font-weight: var(--bs-nav-link-font-weight);
                color: #ffc107;
                text-decoration: none;
                transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out;
            }

            .nav-c-link:hover {
                display: block;
                padding: var(--bs-nav-link-padding-y) var(--bs-nav-link-padding-x);
                font-size: var(--bs-nav-link-font-size);
                font-weight: var(--bs-nav-link-font-weight);
                color: #ffc107;
                text-decoration: none;
                transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out;
                scale: 1.05;
                font-size: 1em;
            }





            .session-c-link {
                color: #C8C8C8;
                font-family: 'Nunito'!important;
                text-decoration: none;
            }

            .session-c-link:hover {
                color: #ffc107;
                font-family: 'Nunito'!important;
                text-decoration: none;
                scale: 1.05;
                font-size: 1em;
            }
        </style>

    </head>
    <body class="bg-c-body">
        @include('header')
        
        
        
        @include('body')


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>