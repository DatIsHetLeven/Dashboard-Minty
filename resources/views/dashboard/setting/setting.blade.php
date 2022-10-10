<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
<link href="{{ asset('css/setting/setting.css') }}" rel="stylesheet">

<div class="leftColor">
    <div class="container1">
        <div class="row">
            <ul class="nav justify-content-center">
            <span id="MINTY">MINTY</span>
            <li>
                <a href="{{ route('dashboard') }}"><ion-icon size="large" name="home-outline"></ion-icon></a>
            </li>
            <li>
                <a><ion-icon size="large" name="apps-outline"></ion-icon><a>
            </li>
            <li>
                <a href="{{ route('persoonsgegevens') }}"><ion-icon size="large" name="people-outline"></ion-icon></a>
            </li>
            <li>
                <a><ion-icon size="large" name="file-tray-full-outline"></ion-icon></a>
            </li>
            <li>
                <a href="{{ route('allegebruikers') }}"><ion-icon size="Large" name="logo-playstation"></ion-icon></a>
            </li>
            <li>
                <a><ion-icon size="large"  name="settings-outline"></ion-icon></a>
            </li>
            </ul>
        </div>
    </div>
</div>

<div class="item1">
    <h2>Producten</h2>
        <a href = "{{ route('alleproducten') }}"><input type="button" value="Bekijk producten"></a>

</div>