@extends('layouts.navBar')
@section('content')
    <title>Info</title>
<style>
    .Content{
        margin-left: 20%;
        margin-right: 20%;
    }

</style>
<div class="Content">


    <a href="#section1">* Uw Bol.com account koppelen met de Koppeling.</a><br>
    <a href="#section2">* Uw Wordpress website koppelen met de Koppeling.</a><br>
    <a href="#section3">* WooCommerce Plug-in downloaden & API Key</a><br>
    <a href="#section4">* Modules instelen en gebruiken</a><br>

    <br><br><br><br><br>




    <h5 id="section1">Uw Bol.com account koppelen met de Koppeling.</h5><p>
    <p>
    Stap 1. Ga via de navigatiebar aan de linkerkant naar het kopje Instellingen.<p>
    <img width="1000" src="{{asset('/img/infoPage/1.png')}}">
    <p>
    Stap 2. Vul alle velden in en klik vervolgens op het knopje "Maak bol account aan"<p>
        &nbsp;&nbsp;&nbsp;&nbsp;Uw clientId en secret kunt u vinden op uw bol verkoopaccount.<p>
        &nbsp;&nbsp;&nbsp;&nbsp;Onder het kopje omschrijving kunt u zelf iets invullen waardoor de verbinding makkelijk herkenbaar is.<p>
        <img width="1000" src="{{asset('/img/infoPage/2.png')}}"><p>
        &nbsp;&nbsp;&nbsp;&nbsp;Verstuurt u alleen in Nederland ? Kies dan voor Nederland. Hetzelfde geldt voor Belgie.<p>
        &nbsp;&nbsp;&nbsp;&nbsp;Wertk u vanuit beide landen ? Kies dan voor Nederland & Belgie.<p>
        <img width="1000" src="{{asset('/img/infoPage/3.png')}}">
    <p>
    Stap 3. Controleer of de gegevens tevoorschijn komen onder het kopje "Actieve verbingen Bol-Koppeling"<br>
        <img width="1000" src="{{asset('/img/infoPage/4.png')}}">


    <br><br><br><br><br><br><br><br><br>
    <h5 id="section2">Uw Wordpress website koppelen met de Koppeling.</h5>
    <p>
    Stap 1. Voer de url in van uw website.
        <img width="1000" src="{{asset('/img/infoPage/woo1.png')}}">

        <p>
    Stap 2. Onder het kopje Woo Key voert u uw woocommerce key in. Deze kunt u vinden in uw Wordpress omgeving.<p>
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Als u nog geen Woo Key heeft maak deze dan aan door :<p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ga via de navigatiebar aan de linkerkant naar WooCommerce en vervolgens naar Settings.<p>
        <img width="1000" src="{{asset('/img/infoPage/wor1.png')}}"><p>
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Klik vervolgens rechts boven op het knopje Advanced en daarna op REST API.<p>
        <img width="1000" src="{{asset('/img/infoPage/wor2.png')}}"><p>
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Om de key aan te maken klik je op add key.<p>
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Zet in de Description : Minty Bol Koppeling<p>
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Zet de Permissions op Read/Write.<p>
        <img width="1000" src="{{asset('/img/infoPage/wor3.png')}}"><p >
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Klik op Generate API Key.<p>
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Nu volgt de Consumer key en de Consumer secret. Deze kunt u kopieren en plakken in de juiste velden.<p>

        <img width="1000" src="{{asset('/img/infoPage/woo2.png')}}"><p>
    Stap 3. Klik op verbinding en controleer of de verbinding staat onder het kopje Actieve Woo-Koppeling.


    <br><br><br>
    <h5></h5>

    <br><br><br>
    <h5 id="section3">WooCommerce Plug-in downloaden & API Key</h5><p>
    Stap 1. ga naar de home pagina en klik op "Nu downloaden". Er wordt nu een zip bestand op je computer gezet.<p>
        <img width="1000" src="{{asset('/img/infoPage/key1.png')}}"><p >
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;De API key heb je nodig om de plug-in werkend te krijgen. Deze kan je vinden onder het tabje Instellingen.<p>
    <p>
    Stap 2. Ga naar je Wordpress / WooCommerce website en ga naar PLugins. Klik vervolgens op 'Nieuwe plugin'.<p>
        <img width="1000" src="{{asset('/img/infoPage/key2.png')}}"><p >
    <p>
    Stap 3. Klik op 'Plugin uploaden'. nu kan je de plug-in uploaden door op Bestand kiezen te drukken. Dit moet een zip betand zijn.<p>
        <img width="1000" src="{{asset('/img/infoPage/key3.png')}}"><p >
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Het zip bestand is in de vorige stappen op je computer gezet. Heeft je computer er geen zip bestand van gemaakt ?<p>
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Klik dan rechter muisknop op het bestand en klik op cromptimeer. Zorg dat je het zip bestand selecteert in<p>
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;"bestande". Na het installeren, activeer je de plug-in.<p>

    Stap 4. Activeer nu de plug-in door op de blauwe knop te drukken.<p>
        <img width="1000" src="{{asset('/img/infoPage/key4.png')}}"><p >

    Stap 5. Wanneer de plug-in is geactiveerd, is het tijd om de plug-in in te stellen.
    <p>
    Stap 6. In het kopje Koppeling adres voer je de API Key in die je terug kan vinden onder het kopje API Key op het dashboard.<p>
        <img width="1000" src="{{asset('/img/infoPage/key6.png')}}"><p >

    Invoeren van de juiste gegevens : <p>
        * API sleutel : Deze key vind je in het Minty-Bol dashboard onder het kopje instellingen.</p>

        * EAN Veld : Om de juiste producten op te halen (wat gebeurt d.m.v. de ean code ) moet hier het juiste veld ingevoerd worden<p>
        Wordpress maakt standaard gebruik van het _sku veld. Als jij dit niet verandert heb, kan je dit selecteren<p>
        Als je de product code in een ander veld opgeslagen hebt, zorg er dan voor dat je het juiste veld hierin selecteert. <p>

        *EAN fallback vield : Deze optie is niet voor iedereen van toepassing.<p>
        Dit veld is een alternatief veld voor het eerste EAN-veld. Dit houdt in dat als het eerste EAN-veld leeg is, dat er gekeken wordt naar dit veld.<p>

        * Leverancier : Als je je producten verstuurt via bol klik dan bol aan. <p>
    Als je de bestellingen zelf afhandelt klik dan op MyParcel.<p>
<br><br><br><br><br>

    <h5 id="section4">Modules instelen en gebruiken</h5><p>
    Stap 1: Druk op het tabje 'Modules' links in de menubalk.<p>
        <img width="1000" src="{{asset('/img/infoPage/mod1.png')}}"><p >
    Stap 2: Kies uit 1 of meerde modules en klik vervolgens op 'install'.<p>
        <img width="1000" src="{{asset('/img/infoPage/mod2.png')}}"><p >
    Mocht u niet op deze pagina komen, zorg er dan eerst voor dat de verbinding met bol tot stand komt. Hier boven wordt uitgelegd hoe u dat kunt doen.<p>
    Stap 3: Klik op bekijk instellingen.<p>
        <img width="1000" src="{{asset('/img/infoPage/mod3.png')}}"><p >
    Stap 4: Klik op de instellingen die u aan wil hebben en druk nu op opslaan.<p>
        <img width="1000" src="{{asset('/img/infoPage/mod4.png')}}"><p >
    Stap 5: Het is gelukt! Nu kunt u achterover leunen en genieten van hoe makkelijk het leven na vandaag is.
</div>
