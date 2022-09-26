
<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<meta name="viewport" content="width=device-width, initial-scale=0.5">

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<div class="leftColor">
    <div class="container">
        <div class="row">
            <ul class="nav justify-content-center">
            <span id="MINTY">MINTY</span>
            <li>
                <a><ion-icon size="large" name="home-outline"></ion-icon></a>
            </li>
            <li>
                <a><ion-icon size="large" name="apps-outline"></ion-icon><a>
            </li>
            <li>
                <a><ion-icon size="large" name="people-outline"></ion-icon></a>
            </li>
            <li>
                <a class="instellinglogo"><ion-icon size="large"  name="settings-outline"></ion-icon></a>
            </li>
            </ul>
        </div>
    </div>
</div>






    <div class="WelkomBanner">
        <h2>Goede middag <?php echo $userByCookie ->naam;?> !</h2>
        <p><span class="welkomBol">Welkom bij de Bol Koppeling</span></p>
    </div>

    <div class="boxes">
        <div class="box1">
            <h4>Actieve module(s)</h4>

            <!-- <?php echo $userByCookie   ?> -->
        </div>

        <div class="box2">
            <h4>Hulp nodig bij het instellen?</h4>
            Om deze koppeling te kunnen gebruiken moeten een aantal dingen geinstalleerd en ingesteld worden
            Laten we samen door deze stappen lopen!
            
            <input type="submit" class="btnZelfStudie" value="Zelf studie">
            <input type="submit" class="btnSupport" value="Support">
        </div> 
    </div>