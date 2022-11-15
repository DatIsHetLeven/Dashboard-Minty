@extends( ($userByCookie->rol === 1) ? 'layouts.navBarAdmin' :  'layouts.navBar')
@section('content')

    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    <div class="WelkomBanner">
        <h2>Goede middag <?php echo $userByCookie->naam;?> !</h2>
        <p><span class="welkomBol">Welkom bij de Bol Koppeling</span></p>
    </div>


    <div class="boxes">

        <div class="box1">
            <h4>WooCommerce plugin downloaden</h4>
            <a href="{{Storage::disk('public')->url("pluginmanager/bolconnector/minty-bolconnector-plugin.zip")}}"><button class="btn btn-primary" id="changeUserDetails" name="changeUserDetails" type="submit">Nu downloaden</button></a>

        @if(\Session::has('error'))
                <p class="error">
                    {{\Session::get('error')}}
                </p>
            @endif<p>
                <?php
                $geldig = $userByCookie->geldig;
                $dayVandaag = date('Y-m-d');

                //Laat deze melding alleen zien voor niet Admin!
                if(($userByCookie->rol) ==3 and($geldig != null) ){


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
            <a href="mailto:support@mintymedia.nl" style="color: #FF6C00 !important">} <input type="submit" class="btnSupport" value="Support"></a>
        </div>

        <div class="box2">
            <p>
            <h4>Koppeling informatie</h4>

            Koppeling : <?php echo($userByCookie->API != 0) ? 'Actief' : 'Inactief';?> <p><p>
            Abonnement : <?php echo($userByCookie->geabonneerd != 0) ? 'Actief' : 'Inactief';?>

            </div>
        </div>
