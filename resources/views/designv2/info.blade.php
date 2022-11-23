@extends('layouts.navBar')
@section('content')
<style>
    .Content{
        margin-left: 20%;
        margin-right: 20%;
    }

</style>

<div class="Content">

    <h5>Uw Bol.com account koppelen met de Koppeling.</h5><p>
    <p>
    Stap 1. Ga via de navigatiebar aan de linkerkant naar het kopje Instellingen.<p>
    <p>
    Stap 2. Vul alle velden in en klik vervolgens op het knopje "Maak bol account aan"<p>
        &nbsp;&nbsp;&nbsp;&nbsp;Uw clientId en secret kunt u vinden op uw bol verkoopaccount.<p>
        &nbsp;&nbsp;&nbsp;&nbsp;Onder het kopje omschrijving kunt u zelf iets invullen waardoor de verbinding makkelijk herkenbaar is.<p>
        &nbsp;&nbsp;&nbsp;&nbsp;Verstuurt u alleen in Nederland ? Kies dan voor Nederland. Hetzelfde geldt voor Belgie.<p>
        &nbsp;&nbsp;&nbsp;&nbsp;Wertk u vanuit beide landen ? Kies dan voor Nederland & Belgie.<p>
    <p>
    Stap 3. Controleer of de gegevens tevoorschijn komen onder het kopje "Actieve verbingen Bol-Koppeling"<br>


    <br><br><br>
    <h5>Uw Wordpress website koppelen met de Koppeling.</h5>
    <p>
    Stap 1. Voer de url in van uw website.
        <p>
    Stap 2. Onder het kopje Woo Key voert u uw woocommerce key in. Deze kunt u vinden in uw Wordpress omgeving.<p>
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Als u nog geen Woo Key heeft maak deze dan aan door :<p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ga via de navigatiebar aan de linkerkant naar WooCommerce en vervolgens naar Settings.<p>
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Klik vervolgens rechts boven op het knopje Advanced en daarna op REST API.<p>
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Om de key aan te maken klik je op add key.<p>
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Zet in de Description : Minty Bol Koppeling<p>
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Zet de Permissions op Read/Write.<p>
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Klik op Generate API Key.<p>
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Nu volgt de Consumer key en de Consumer secret. Deze kunt u kopieren en plakken in de juiste velden.<p>

    Stap 3. Klik op verbinding en controleer of de verbinding staat onder het kopje Actieve Woo-Koppeling.


    <br><br><br>
    <h5></h5>

    <br><br><br>
    <h5>WooCommerce Plug-in downloaden & API Key</h5><p>
    Stap 1. ga naar de home pagina en klik op "Nu downloaden". Er wordt nu een zip bestand op je computer gezet.<p>
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;De API key heb je nodig om de plug-in werkend te krijgen.<p>
    <p>
    Stap 2. Ga naar je Wordpress / WooCommerce website en ga naar PLugins. Klik vervolgens op 'Nieuwe plugin'.<p>
    <p>
    Stap 3. Klik op 'Plugin uploaden'. nu kan je de plug-in uploaden door op Bestand kiezen te drukken. Dit moet een zip betand zijn.<p>
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Het zip bestand is in stap 7 op je computer gezet. Heeft je computer er geen zip bestand van gemaakt ?<p>
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Klik dan rechter muisknop op het bestand en klik op cromptimeer. Zorg dat je het zip bestand selecteert in<p>
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;"bestande". Na het installeren, activeer je de plug-in.<p>

    Stap 4. Activeer nu de plug-in door op de blauwe knop te drukken.<p>

    Stap 5. Wanneer de plug-in is geactiveerd, is het tijd om de plug-in in te stellen.
    <p>
    Stap 6. In het kopje Koppeling adres voer je de API Key in die je terug kan vinden onder het kopje API Key op het dashboard.<>

</div>
