
<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="leftColor">
    <div class="container">
        <div class="row">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Accounts">Accounts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/">Api</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/">Webshop</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('login')}}">Uitloggen</a>
            </li>
            </ul>
        </div>
    </div>
</div>

<div class="contentHomePage">
    <div class="WelkomBanner">
        <h2>Goede middag, Owen!</h2>
        <p><span class="welkomBol">Welkom bij de Bol Koppeling</span></p>
    </div>

    <div class="modules" id="actieveModules">
        <h4>Actieve modules</h4>
        Get Active module from db 
    </div>

    <div class="modules" id="dynamicText">
        <h4>Hulp nodig bij het instellen</h4>
        Get text  from db  
    </div>
</div>
<!-- <div id="wrap">
    <div id="left">I am div 1</div>
    <div id="right">I am div 2</div>
</div> -->