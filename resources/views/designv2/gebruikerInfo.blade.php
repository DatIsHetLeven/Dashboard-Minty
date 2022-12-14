@extends('layouts.navBarAdmin')
<title>Gebruiker info</title>
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
    
    <style>
        .form-control {
            width: 100%;
            line-height: 1em;
            height: 45px;
            padding: 0px 15px;
            border: 1px solid #d2d2d2;
            border-radius: 4px;
            font-size: 13px;
        }
        .koppeling-geldigheid {
            font-size: 15px;
            color: #8b8b8b;
            border-radius: 5px;
            max-width: 400px;
            padding: 40px;
            background-color: #f2f2f2;
            display: flex;
            align-items: center;
            font-weight: 400;
            max-width: 290px;
        }
        .dagen-controller {
            display: flex;
            align-items: stretch;
            justify-content: space-between;
        }
        .dagen-form {
            width: 50%;
            max-width: 360px;
        }
        .hoeveeldagen {
            width: 50%;
            display: flex;
            justify-content: flex-end;
        }
        .textpinput {
            font-size: 15px;
            margin-top: 15px;
            color: #959595;
        }
    </style>
    
    <div class="main-grid-min-nav">
    <div class="wrapped-container">
    <div class="WelkomBanner">
        <h2>Accountpagina</h2>
        <p><span class="welkomBol"><?php echo $user->naam ?>'s account</span></p>
    </div>
    
            <div class="row">

                <div class="col-xl-8">
                    <div class="card mb-4">
                        <div class="card-header">Bol details</div>
                        <div class="card-body">
                            <form>
                                <!-- Form Group (username)-->
                                <div class="mb-3">
                                    <label class="label-inputs" for="inputUsername">Koppeling</label>
                                    <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="qwertyuiopasdfghjklzxcvbnm">
                                </div>
                                
                                <div class="button-footer">
                                <a href="{{ route('blokkeerApi',$user->userId) }}"><button class="btn btn-primary" id="btnDeleteUser" type="button">Blokkeer Api voor klant</button></a>
                                <a href="{{ route('inloggenAlsKlant',$user->userId) }}"><button class="btn btn-primary" id="btnInloggenAlsKlant" type="button">Inloggen als klant</button></a>
                                <a href="{{ route('deleteUser',$user->userId) }}"><button class="btn btn-danger" id="btnDeleteUser" type="button">Verwijder klant</button></a>
                                </div>


                                <div class="wwrapper-stattussen">
                                    <div class="status"><input type="checkbox" id="test"<?php if($user->geverifieerd == TRUE){?>checked<?php }?> onclick="return false;">Geverififeerd</div>
                                    <div class="status"> <input type="checkbox" <?php if($user->geabonneerd == TRUE){?>checked<?php }?> onclick="return false;">Geabonneerd</div>
                                    <div class="status"><input type="checkbox" <?php if($user->API == TRUE){?>checked<?php }?> onclick="return false;">API actief</div>
                                    <div class="status"><input type="checkbox" <?php if($user->wordpress == TRUE){?>checked<?php }?> onclick="return false;">Wordpress ingesteld</div>
                                </div>
                                
                                
                                
                                <label class="label-inputs">Koppeling server</label><input class="form-control" type="text" id="text" placeholder=<?php if(!empty($user->server)){echo $user->server;} else{echo "n.v.t";}?> onclick="return false;"><br>
                                <label class="label-inputs">Koppeling geldig t/m</label><input class="form-control" type="text" id="text" placeholder=<?php if(!empty($user->geldig)){                                $originalDate = $user->geldig;
                                $newDate = date("d-m-Y", strtotime($originalDate));echo $newDate;} else{echo "n.v.t";}?> onclick="return false;">


                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card mb-4">
                        <div class="card-header">Klant details</div>
                        <div class="card-body">
                            <form>
                                <!-- Form Group (username)-->
                                <div class="mb-3">
                                    <label class="label-inputs" for="inputUsername">Naam</label>
                                    <input class="form-control" id="inputUsername" type="text" placeholder=<?php echo $user->naam ?>>
                                </div>
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (first name)-->
                                    <div class="col-md-6">
                                        <label class="label-inputs" for="inputFirstName">Email</label>
                                        <input class="form-control" id="inputFirstName" type="text" placeholder=<?php echo $user->email ?>>
                                    </div>
                                    <!-- Form Group (last name)-->
                                    <div class="col-md-6">
                                        <label class="label-inputs" for="inputLastName">Telefoonnummer</label>
                                        <input class="form-control" id="inputLastName" type="text" placeholder=<?php echo $user->telefoonnummer ?>>
                                    </div>
                                </div>
                                <!-- Form Row        -->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (organization name)-->
                                    <div class="col-md-6">
                                        <label class="label-inputs" for="inputOrgName">Bedrijfsnaam</label>
                                        <input class="form-control" id="inputOrgName" type="text" placeholder=<?php echo $user->bedrijfsnaam ?>>
                                    </div>
                                    <!-- Form Group (location)-->
                                    <div class="col-md-6">
                                        <label class="label-inputs" for="inputLocation">Adres</label>
                                        <input class="form-control" id="inputLocation" type="text" placeholder=<?php echo $user->adres ?>>
                                    </div>
                                </div>
                                <!-- Form Group (email address)-->
                                <div class="mb-3">
                                    <label class="label-inputs" for="inputEmailAddress">Postcode</label>
                                    <input class="form-control" id="inputEmailAddress" type="email" placeholder=<?php echo $user->postcode ?>>
                                </div>
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (phone number)-->
                                    <div class="col-md-6">
                                        <label class="label-inputs" for="inputPhone">Plaats</label>
                                        <input class="form-control" id="inputPhone" type="tel" placeholder=<?php echo $user->plaats ?>>
                                    </div>
                                    <!-- Form Group (birthday)-->
                                    <div class="col-md-6">
                                        <label class="label-inputs" for="inputBirthday">Factuursturen klant nr.</label>
                                        <input class="form-control" id="inputBirthday" type="text" name="birthday" placeholder=<?php if(empty($user->factuurId )){echo "n.v.t.";}else{echo $user->factuurId;} ?>>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xl-13">
                    <div class="card mb-4">
                        <div class="card-header">Koppeling</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('verlengVervaldatum',$user->userId) }}" >
                                @csrf
                                <!-- Form -->
                                <div class="dagen-controller">

                                <div class="dagen-form">
                                    <label class="label-inputs">Hoe veel dagen wil je toevoegen/afhalen?</label>
                                    <input class="form-control" id="inputUsername" type="number" name="aantalDagen" placeholder="" value="">
                                    <div class="button-footer">
                                        <a href="{{ route('verlengVervaldatum',$user->userId) }}"><button class="btn btn-primary" id="btnDeleteUser" name="btnAddDays" type="submit">Toevoegen/Afhalen</button></a><br>
                                    </div>
                                    <div class="textpinput">Voer een numerieke waarde in om de vervaldatum van de koppeling te wijzigen.</div>
                                    </div>
                                    <!-- Bereken hoelang koppeling nog geldig is -->
                                    

                                    <div class="hoeveeldagen">
                                    <?php
                                    $currentDateTime = date('Y-m-d');

                                    $diff = strtotime($user->geldig) - strtotime($currentDateTime);

                                    $nogGeldig = abs($diff/86400);

                                    if ($user->geldig < $currentDateTime)$nogGeldig=0;?>
                                    
                                    <div class="koppeling-geldigheid">
                                        Koppeling van deze klant is nog <?php echo $nogGeldig ?> dag(en) geldig.
                                    </div>

                                    </div>
                                 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-xl-13">
                    <div class="card mb-4">
                        <div class="card-header">Facturing</div>
                        <div class="card-body">
                            <form>
                                <?php if(!empty($user->factuur_reference)) {?>
                                <a href="{{ route('getUserInvoice',$user->factuurId) }}">factuur reference<?php echo($user->factuur_reference);
                                                                                          }?></a>

                            </form>
                        </div>
                    </div>
                </div>



        </div>

</div>
</div>