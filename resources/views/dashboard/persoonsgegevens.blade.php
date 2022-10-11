
<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
<link href="{{ asset('css/persoonsgegevens.css') }}" rel="stylesheet">



<meta name="viewport" content="width=device-width, initial-scale=0.5">

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

@extends('layouts.nav')
@section('content')

<h3>Persoonsgegevens</h3>
            <?php echo $userByCookie->naam   ?> 
            
<div class="content">
    Naam<input type='text' placeholder=<?php echo $userByCookie->naam ?>></input>
    Email<input type='text' placeholder=<?php echo $userByCookie->email ?>></input>
    Telefoonnummer<input type='text' placeholder=<?php echo $userByCookie->telefoonnummer ?>></input>
    Bedijfsnaam<input type='text' placeholder=<?php echo $userByCookie->bedrijfsnaam ?>></input>
    Adres<input type='text' placeholder=<?php echo $userByCookie->adres ?>></input>
    Postcode<input type='text' placeholder=<?php echo $userByCookie->postcode ?>></input>
    Plaats<input type='text' placeholder=<?php echo $userByCookie->plaats ?>></input>
</div>
@endsection

   