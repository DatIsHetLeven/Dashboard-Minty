<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<meta name="viewport" content="width=device-width, initial-scale=0.5">

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<style>
    #lowerleft
    {
        margin-bottom: 1px;
        margin-left : 1px;
        width: 200px;
        height: 200px;
        background-color: red;
        color: green;
        position: fixed;
        bottom: 0;
    }
    </style>

<div class="leftColor">
    <div class="container1">
        <div class="row">
            <ul class="nav justify-content-center">
            <span id="MINTY">MINTY</span>
            <li>
                <a href="{{ route('dashboard') }}"><ion-icon size="large" name="home-outline"></ion-icon></a>
            </li>
            <li>
                <a href="{{ route('persoonsgegevens') }}"><ion-icon size="large" name="person-outline"></ion-icon></a>
            </li>
            <li>
                <a href="{{ route('toonBolSetting') }}"><ion-icon size="large"  name="settings-outline"></ion-icon></a>
            </li>
            <li>
                <a href="{{ route('GetAllModules') }}"><ion-icon size="large" name="build-outline"></ion-icon></a>
            </li>
                <?php if (isset($_COOKIE['adminSessie'])){?>
            <li>
                <a href="{{ route('allegebruikers') }}"><ion-icon size="large" name="people-outline"></ion-icon></a>
            </li>
                <?php } ?>
            <li>
                <a href="{{ route('logout') }}"><ion-icon size="Large" name="log-out-outline"></ion-icon></a>
            </li>
{{--            <?php if (isset($_COOKIE['adminSessie'])){ ?>--}}
{{--            <li>--}}
{{--                <a href="{{ route('herstellenEigenAccountInlog') }}"><ion-icon size="large" name="rocket-outline"></ion-icon></a>--}}
{{--            </li>--}}
{{--                <?php } ?>--}}
            </ul>
        </div>
    </div>
    <?php if (isset($_COOKIE['adminSessie'])){ ?>

    <div id="lowerleft">
        <a href="{{ route('herstellenEigenAccountInlog') }}">U bent ingelogd als een klant. Druk hier om terug te gaan naar je eigen account!</a>
    </diV>
    <?php } ?>
</div>


@yield('content')
