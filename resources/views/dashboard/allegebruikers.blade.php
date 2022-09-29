<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
<link href="{{ asset('css/persoonsgegevens.css') }}" rel="stylesheet">
<link href="{{ asset('css/logintest.css') }}" rel="stylesheet"> 

<meta name="viewport" content="width=device-width, initial-scale=0.5">

<script src="{{ asset('js/popupgebruiker.js') }}"></script>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<div class="leftColor">
    <div class="container">
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
                <a class="instellinglogo"><ion-icon size="large"  name="settings-outline"></ion-icon></a>
            </li>
            </ul>
        </div>
    </div>
</div>

<!-- Alle gebruikers tonen -->
<h3> Alle Gebruikers</h3>



<div class="alleGebruikersForm" class="overlay">
<table style="border-collapse:collapse;" class="table-table" id="data-table">
    <thead>
      <tr>
        <th>Gebruiker</th>
        <th>Bedrijfsnaam</th>
        <th>Email</th>
        <th>factuursturen</th>
        <th>Geverififeerd</th>
        <th>Geabonneerd</th>
        <th>API actief</th>
      </tr>
    </thead>
    <tbody><?php
    $count = 0;
    for ($x = 0; $x < count($allegebruikers) - 1; $x++) {?>
      <div class="perGeberuiker" value={{$count}}>
        <tr>
            <td><a href="{{ route('seeCustomerDetail',$allegebruikers[$x]->userId) }}"><?php echo $allegebruikers[$x]->naam; ?></a></td>    
            <td><a href="{{ route('seeCustomerDetail',$allegebruikers[$x]->userId) }}"><?php echo $allegebruikers[$x]->bedrijfsnaam; ?></td>
            <td><a href="{{ route('seeCustomerDetail',$allegebruikers[$x]->userId) }}"><?php echo $allegebruikers[$x]->email; ?></td>
            <?php $count++;?>
            <td><a href="{{ route('createUserFactuursturen',$allegebruikers[$x]->userId) }}" value=<?php $count?>>Add</a>
            <td>test</td>
            <td>test</td>
            <td>test</td>
        </tr>
      </div>
        <?php
        }?></tbody>
</div>
