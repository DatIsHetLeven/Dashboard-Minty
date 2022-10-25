
    @extends( ($userByCookie->rol === 3) ? 'layouts.nav' :  'layouts.navAdmin')
    @section('content')


    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <div class="WelkomBanner">
        <h2>Goede middag <?php echo $userByCookie ->naam;?> !</h2>
        <p><span class="welkomBol">Welkom bij de Bol Koppeling</span></p>
    </div>
<?php dump($userByCookie->naam)?>
    <div class="boxes">
        <div class="box1">
            <h4>Actieve module(s)</h4>
            <?php
            $geldig = $userByCookie->geldig;
            $dayVandaag = date('Y-m-d');
        //Laat deze melding alleen zien voor niet Admin!
        if($userByCookie->rol !=1 ){
            // Als koppeling niet meer geldig is
            if($geldig < $dayVandaag){
                ?> Uw proefperiode van 14 dagen zijn voorbij.<br>
                  Wilt u gebruik blijven maken van de koppeling ?<br>
                  <a href="{{ route('CreateMandate') }}">Abonneer hier nu!
                      <button type="submit">Abonneer nu!</button>
                  </a><?php
                }
            // Als koppeling nog geldig is maar klant niet geverf is
            if($geldig > $dayVandaag){
                if(!$userByCookie->geverifieerd === 1){
                ?> Uw roefperiode loopt binnenkort af.<br>
                   Wilt u gebruik blijven maken van de koppeling ?<br>
                   <a href="#">Abonneer hier nu!</a><?php
                 }}
        }?>
            </div>

        <div class="box2">
            <h4>Hulp nodig bij het instellen?</h4>
            Om deze koppeling te kunnen gebruiken moeten een aantal dingen geinstalleerd en ingesteld worden
            Laten we samen door deze stappen lopen!

            <input type="submit" class="btnZelfStudie" value="Zelf studie">
            <input type="submit" class="btnSupport" value="Support">
        </div>
    </div>



@endsection

