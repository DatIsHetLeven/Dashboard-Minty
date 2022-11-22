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

    Stap 1. Voer de url in van uw website.

    Stap 2. Onder het kopje Woo Key voert u uw woocommerce key in. Deze kunt u vinden in uw Wordpress omgeving.
        Als u nog geen Woo Key heeft maak deze dan aan door :
            Ga via de navigatiebar aan de linkerkant naar WooCommerce en vervolgens naar Settings.
            Klik vervolgens rechts boven op het knopje Advanced en daarna op REST API.
    &nbsp;&nbsp;&nbsp;&nbsp;Om de key aan te maken klik je op add key.
    &nbsp;&nbsp;&nbsp;&nbsp;Zet in de Description : Minty Bol Koppeling
            Zet de Permissions op Read/Write.
            Klik op Generate API Key.
            Nu volgt de Consumer key en de Consumer secret. Deze kunt u kopieren en plakken in de juiste velden.

    Stap 3. Klik op verbinding en controleer of de verbinding staat onder het kopje Actieve Woo-Koppeling.


    <br><br><br>
    <h5>Uw Wordpress website koppelen met de Koppeling.</h5>
</div>

