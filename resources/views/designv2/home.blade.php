@extends( ($userByCookie->rol === 1) ? 'layouts.navBarAdmin' :  'layouts.navBar')
<title>Home</title>
@section('content')
    <style>

    </style>




<div class="main-grid-min-nav">
    <div class="wrapped-container">
<div class="WelkomBanner">
        <h2>Goedendag <?php echo $userByCookie->naam;?>!</h2>
        <p><span class="welkomBol">Welkom bij de Bol Koppeling</span></p>
    </div>

    <div class="boxes">

        <div class="box">
            <h4>WooCommerce plugin downloaden</h4>
            <div class="button-footer">
            <a href="{{Storage::disk('public')->url("pluginmanager/bolconnector/minty-bolconnector-plugin.zip")}}"><button class="btn btn-primary" id="changeUserDetails" name="changeUserDetails" type="submit">Nu downloaden</button></a>
            </div>
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

        <div class="box">
            <h4>Koppeling informatie</h4>

            <div class="wrapper-indi">
                <div class="status-inci">Koppeling</div> <div class="status"><?php echo($userByCookie->API != 0) ? '<span class="status-circel active-circel"></span> Actief' : '<span class="status-circel inactive-circel"></span> Inactief';?></div>
                <div class="status-inci">Abonnement</div> <div class="status"><?php echo($userByCookie->geabonneerd != 0) ? '<span class="status-circel active-circel"></span> Actief' : '<span class="status-circel inactive-circel"></span> Inactief';?></div>
            </div>
        </div>

        <div class="box">
            <h4>Hulp nodig bij het instellen?</h4>
            <p>Om deze koppeling te kunnen gebruiken moeten een aantal dingen geinstalleerd en ingesteld worden
            Laten we samen door deze stappen lopen!</p>
            
            <div class="button-footer">
                <a href="{{route('info')}}"><button class="btn btn-primary">Zelf studie</button></a>
                <a href="mailto:support@mintymedia.nl" style="color: #FF6C00 !important"> <button class="btn btn-primary">Support</button></a>
            </div>
        </div>

        <style>
            .box2 img{
                width: 300px;
            }

        </style>

        <div class="box">
            <h4>Officieel Bol Partners!</h4>
                <p>Je kunt je webshop koppelen aan bol.com via Minty Media's bol koppeling. Door je webshop via de bol koppeling aan bol.com te koppelen is je voorraad op bol.com altijd actueel, worden bestellingen automatisch in je webshop geplaatst en heb je door de track&trace koppeling je leverbetrouwbaarheid goed onder controle. Daarnaast hebben we voor bol.com onze bol.com Repricer waarmee jij de concurrentie te slim af kunt zijn.</p>
                <a target="_blank" href="https://partnerplatform.bol.com/nl/intermediair/8739/"><img class="bol-logo" src="https://bolmate.nl/wp-content/uploads/2022/09/bolcom_Badge-Ambassador_compact_blauw_CMYK.png" class="attachment-full size-full" alt="" loading="lazy" srcset="https://bolmate.nl/wp-content/uploads/2022/09/bolcom_Badge-Ambassador_compact_blauw_CMYK.png 1247w, https://bolmate.nl/wp-content/uploads/2022/09/bolcom_Badge-Ambassador_compact_blauw_CMYK-300x129.png 300w, https://bolmate.nl/wp-content/uploads/2022/09/bolcom_Badge-Ambassador_compact_blauw_CMYK-1024x440.png 1024w, https://bolmate.nl/wp-content/uploads/2022/09/bolcom_Badge-Ambassador_compact_blauw_CMYK-768x330.png 768w" sizes="(max-width: 1247px) 100vw, 1247px"></a>

        </div>
        </div>
        </div>
    </div>


