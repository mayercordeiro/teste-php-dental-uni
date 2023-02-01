<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dentistas Dental Uni</title>

    <link rel="icon" href="{{ asset('images/favicon.ico') }}" />
    <link rel="apple-touch-icon" href="{{ asset('images/favicon.ico') }}" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <header>
        <a href="{{ route('home') }}">
            <img src="/images/logo.png" alt="logo da empresa escrito dental uni cooperativa odontológica">
        </a>
    </header>

    @yield('content')

    <footer>
        <div class="footerContent container">
            <div class="footerAbout">
                <img src="/images/logowhite.png" alt="logo da empresa escrito dental uni cooperativa odontológica">
                <h5>Promover a saúde bucal criando sorrisos.</h5>
            </div>
            <div class="footerContact">
                <h4>Atendimento:</h4>
                <div class="contact">
                    <div class="infoContact">
                        <span>4007-2525</span>
                        <p>Capitais e região metropolitana</p>
                    </div>
                    <div class="infoContact">
                        <span>0800 603 3683</span>
                        <p>Demais localidades</p>
                    </div>
                    <div class="infoContact">
                        <span>0800 052 6000</span>
                        <p>Vendas</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
