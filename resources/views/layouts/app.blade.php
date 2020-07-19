<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/all.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap" rel="stylesheet">
    <link href="//db.onlinewebfonts.com/c/0aee6008b82cde991ec28387169bb13e?family=GD+Sherpa" rel="stylesheet" type="text/css"/>
    <link href="//db.onlinewebfonts.com/c/ea0517f0c20dfd81ffa9363950561257?family=FlexoW01-Regular" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" integrity="sha256-xykLhwtLN4WyS7cpam2yiUOwr709tvF3N/r7+gOMxJw=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>
        
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Date and time picker -->
    <link href="{{ asset('css/jquery.datetimepicker.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery.datetimepicker.full.min.js') }}"></script>

    <script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css"> 
    
    <style>
        /*
            these styles will animate bootstrap alerts.
        */
        /* @font-face {font-family: "GD Sherpa"; src: url("//db.onlinewebfonts.com/t/0aee6008b82cde991ec28387169bb13e.eot"); src: url("//db.onlinewebfonts.com/t/0aee6008b82cde991ec28387169bb13e.eot?#iefix") format("embedded-opentype"), url("//db.onlinewebfonts.com/t/0aee6008b82cde991ec28387169bb13e.woff2") format("woff2"), url("//db.onlinewebfonts.com/t/0aee6008b82cde991ec28387169bb13e.woff") format("woff"), url("//db.onlinewebfonts.com/t/0aee6008b82cde991ec28387169bb13e.ttf") format("truetype"), url("//db.onlinewebfonts.com/t/0aee6008b82cde991ec28387169bb13e.svg#GD Sherpa") format("svg"); } */
        @font-face {font-family: "FlexoW01-Regular"; src: url("//db.onlinewebfonts.com/t/ea0517f0c20dfd81ffa9363950561257.eot"); src: url("//db.onlinewebfonts.com/t/ea0517f0c20dfd81ffa9363950561257.eot?#iefix") format("embedded-opentype"), url("//db.onlinewebfonts.com/t/ea0517f0c20dfd81ffa9363950561257.woff2") format("woff2"), url("//db.onlinewebfonts.com/t/ea0517f0c20dfd81ffa9363950561257.woff") format("woff"), url("//db.onlinewebfonts.com/t/ea0517f0c20dfd81ffa9363950561257.ttf") format("truetype"), url("//db.onlinewebfonts.com/t/ea0517f0c20dfd81ffa9363950561257.svg#FlexoW01-Regular") format("svg"); }
        * {
            /* font-family: 'Titillium Web', sans-serif; */
            /* font-family: "GD Sherpa"; */
            font-family: "FlexoW01-Regular";
            
        }
        .alert{
            z-index: 99;
            top: 60px;
            right:18px;
            min-width:30%;
            position: fixed;
            animation: slide 0.5s forwards;
        }

        @keyframes slide {
            100% { top: 30px; }
        }

        @media screen and (max-width: 668px) {
            .alert{ /* center the alert on small screens */
                left: 10px;
                right: 10px; 
            }
        }
    </style>
</head>
<body>

    @include('inc.navbar')

    <script src="{{asset('js/app.js')}}"></script>
    
    {{-- Success Alert --}}
    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Error Alert --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{session('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    <script>
        //close the alert after 3 seconds.
        $(document).ready(function(){
			setTimeout(function() {
	        	$(".alert").alert('close');
	    	}, 3000);
    	});
    </script>

</body>
</html>
