@extends('layouts.navBarAdmin')
<title>Gebruiker info</title>
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <div class="container-xl px-4 mt-4">

            <hr class="mt-0 mb-4">
            <div class="row">

                <div class="col-xl-8">
                    <div class="card mb-4">
                        <div class="card-header">Bol details</div>
                        <div class="card-body">
                            <form>
                                <!-- Form Group (username)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputUsername">Koppeling :</label>
                                    <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="qwertyuiopasdfghjklzxcvbnm">
                                </div>
                                <a href="{{ route('blokkeerApi',$user->userId) }}"><button class="btn btn-primary" id="btnDeleteUser" type="button">Blokkeer Api voor klant</button></a>
                                <a href="{{ route('inloggenAlsKlant',$user->userId) }}"><button class="btn btn-primary" id="btnInloggenAlsKlant" type="button">Inloggen als klant</button></a>
                                <a href="{{ route('deleteUser',$user->userId) }}"><button class="btn btn-primary" id="btnDeleteUser" type="button">Verwijder klant</button></a>
                                <br><br><br>
                                Geverififeerd<input type="checkbox" id="test"<?php if($user->geverifieerd == TRUE){?>checked<?php }?> onclick="return false;"><br><br>
                                Geabonneerd<input type="checkbox" <?php if($user->geabonneerd == TRUE){?>checked<?php }?> onclick="return false;"><br><br>
                                API actief<input type="checkbox" <?php if($user->API == TRUE){?>checked<?php }?> onclick="return false;"><br><br>
                                Wordpress ingesteld<input type="checkbox" <?php if($user->wordpress == TRUE){?>checked<?php }?> onclick="return false;"><br><br>
                                Koppeling server<input class="form-control" type="text" id="text" placeholder=<?php if(!empty($user->server)){echo $user->server;} else{echo "n.v.t";}?> onclick="return false;"><br><br>
                                Koppeling geldig tm<input class="form-control" type="text" id="text" placeholder=<?php if(!empty($user->geldig)){                                $originalDate = $user->geldig;
                                $newDate = date("d-m-Y", strtotime($originalDate));echo $newDate;} else{echo "n.v.t";}?> onclick="return false;"><br><br>
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
                                    <label class="small mb-1" for="inputUsername">Naam</label>
                                    <input class="form-control" id="inputUsername" type="text" placeholder=<?php echo $user->naam ?>>
                                </div>
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (first name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputFirstName">Email</label>
                                        <input class="form-control" id="inputFirstName" type="text" placeholder=<?php echo $user->email ?>>
                                    </div>
                                    <!-- Form Group (last name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputLastName">Telefoonnummer</label>
                                        <input class="form-control" id="inputLastName" type="text" placeholder=<?php echo $user->telefoonnummer ?>>
                                    </div>
                                </div>
                                <!-- Form Row        -->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (organization name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputOrgName">Bedrijfsnaam</label>
                                        <input class="form-control" id="inputOrgName" type="text" placeholder=<?php echo $user->bedrijfsnaam ?>>
                                    </div>
                                    <!-- Form Group (location)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputLocation">Adres</label>
                                        <input class="form-control" id="inputLocation" type="text" placeholder=<?php echo $user->adres ?>>
                                    </div>
                                </div>
                                <!-- Form Group (email address)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputEmailAddress">Postcode</label>
                                    <input class="form-control" id="inputEmailAddress" type="email" placeholder=<?php echo $user->postcode ?>>
                                </div>
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (phone number)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputPhone">Plaats</label>
                                        <input class="form-control" id="inputPhone" type="tel" placeholder=<?php echo $user->plaats ?>>
                                    </div>
                                    <!-- Form Group (birthday)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputBirthday">Factuursturen klant nr.</label>
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
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputUsername">Koppeling :</label>
                                    <input class="form-control" id="inputUsername" type="number" name="aantalDagen" placeholder="" value="">

                                    <a href="{{ route('verlengVervaldatum',$user->userId) }}"><button class="btn btn-primary" id="btnDeleteUser" name="btnAddDays" type="submit">Toevoegen</button></a><br>

                                    <!-- Bereken hoelang koppeling nog geldig is -->
                                    <?php
                                    $currentDateTime = date('Y-m-d');

                                    $diff = strtotime($user->geldig) - strtotime($currentDateTime);

                                    $nogGeldig = abs($diff/86400);

                                    if ($user->geldig < $currentDateTime)$nogGeldig=0;



                                    ?>Koppeling is nog <?php echo $nogGeldig ?> dag(en) geldig.<br><br>
                                    Voer een numerieke waarde in om de vervaldatum van de koppeling te wijzigen.
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
                                <a href="{{ route('getUserInvoice',182) }}">factuur reference : <?php echo($user->factuur_reference);
                                                                                          }?></a>

                            </form>
                        </div>
                    </div>
                </div>



            </div>
        </div>
