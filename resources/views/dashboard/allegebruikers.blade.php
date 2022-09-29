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
<table class="table-table" id="data-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Sender</th>
        <th>Received</th>
        <th>Img src</th>
        <th>Image</th>
        <th>Commands</th>
        <th>button</th>
        <th>factuursturen</th>
      </tr>
    </thead>
    <tbody><?php
    $count = 0;
    for ($x = 0; $x < count($allegebruikers) - 1; $x++) {?>
        <div class="perGeberuiker" value={{$count}}>
        <tr>
            <td><?php echo $allegebruikers[$x]->naam; ?></td>    
            <td><?php echo $allegebruikers[$x]->email; ?></td>
            <td><?php echo $allegebruikers[$x]->telefoonnummer; ?></td>
            <td><?php echo $allegebruikers[$x]->bedrijfsnaam; ?></td>
            <td><?php echo $allegebruikers[$x]->btwNummer; ?></td>
            <td><?php echo $allegebruikers[$x]->adres; ?></td>
            <?php $count++;?>
            <td><a class="link" onclick="togglePopup(<?= $count ?>)" href="#registreren1"[$count]><button class="viewCustomerDetails" name="button" value=<?php $count?>>Bekijk</button></a></td>
            <td><a href="{{ route('createUserFactuursturen',$allegebruikers[$x]->userId) }}" value=<?php $count?>>Add</a>
        </div>
        </tr>

        <div class="popup" id="popup-<?= $count ?>">
            <div class="overlay"></div>
                <div class="content">
                    <div class="close-btn" onclick="togglePopup(<?= $count ?>)">&times;</div>
                        <h2>Gegevens</h2>
                        <br>Naam : <?php echo $allegebruikers[$x]->naam;?>
                        <br>email : <?php echo $allegebruikers[$x]->emaill;?>
                    </div>
                </div><?php
        }?></tbody>
</div>















<!-- Gebruikers info popup box! -->
<!-- <div id="registreren1" class="overlay">
	<div class="registreren">
		<a class="close" href="#">&times;</a>
        <form method="GET" class="formRegister">
        @csrf
         <div class="userinput">
          Naam  :<br><br>
          Email :<br><br>
          Adres :         

	</div>
</div> -->
