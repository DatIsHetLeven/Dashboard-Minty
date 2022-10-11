<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">



<meta name="viewport" content="width=device-width, initial-scale=0.5">

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

@extends( ($userByCookie->rol === 3) ? 'layouts.nav' :  'layouts.navAdmin')
@section('content')
<div class="container-xl px-4 mt-4">
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">Persoonsgegevens</div>
                <div class="card-body">
                    <form>              
                        Naam<input class="form-control" type="text" id="text" placeholder=<?php echo $userByCookie->naam ?>><br>
                        Email<input class="form-control" type="text" id="text" placeholder=<?php echo $userByCookie->email ?>><br>
                        Telefoonnummer<input class="form-control" type="text" id="text" placeholder=<?php echo $userByCookie->telefoonnummer ?>><br>
                        Bedijfsnaam<input class="form-control" type="text" id="text" placeholder=<?php echo $userByCookie->bedrijfsnaam ?>><br>
                        Adres<input class="form-control" type="text" id="text" placeholder=<?php echo $userByCookie->adres ?>><br>
                        Postcode<input class="form-control" type="text" id="text" placeholder=<?php echo $userByCookie->postcode ?>><br>
                        Plaats<input class="form-control" type="text" id="text" placeholder<?php echo $userByCookie->plaats ?>><br>
                    </form>
                </div>
            </div>
        </div>






   