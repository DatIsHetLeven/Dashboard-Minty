@extends( ($userByCookie->rol === 1) ? 'layouts.navBarAdmin' :  'layouts.navBar')
@section('content')

<style>
    body {
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #BA68C8
    }

    .profile-button {
        background-color: #0a58ca;
        box-shadow: none;
        border: none
    }

    .profile-button:hover {
        background: #682773
    }

    .profile-button:focus {
        background: #682773;
        box-shadow: none
    }

    .profile-button:active {
        background: #682773;
        box-shadow: none
    }

    .back:hover {
        color: #682773;
        cursor: pointer
    }

    .labels {
        font-size: 11px
    }

    .add-experience:hover {
        background: #BA68C8;
        color: #fff;
        cursor: pointer;
        border: solid 1px #BA68C8
    }
    </style>
<br><br><br>

<section class="page-content">
    <div class="container emp-profile">
        <form>
            <div class="border">
                <div class="row">

                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5>
                            Persoonsgegevens
                        </h5>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Naam</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="text" placeholder=<?php echo $userByCookie->naam ?>>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="text" placeholder=<?php echo $userByCookie->email ?>>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Telefoonnummer</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="text" placeholder=<?php echo $userByCookie->telefoonnummer ?>>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Bedijfsnaam</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="text" placeholder=<?php echo $userByCookie->bedrijfsnaam ?>>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>BTW-nummer</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="text" placeholder=<?php echo $userByCookie->btwNummer ?>>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Adres</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="text" placeholder=<?php echo $userByCookie->adres ?>>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Postcode</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="text" placeholder=<?php echo $userByCookie->postcode ?>>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Plaats</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="text" placeholder<?php echo $userByCookie->plaats ?>>
                                </div>
                            </div>
                            <a href="#"><button class="btn btn-primary" id="changeUserDetails" name="changeUserDetails" type="submit">Aanpassen</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
</section>




