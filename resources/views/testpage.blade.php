<style>
    body{
        background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    }
    .emp-profile{
        padding: 3%;
        margin-top: 3%;
        margin-bottom: 3%;
        border-radius: 0.5rem;
        background: #fff;
    }
    .profile-img{
        text-align: center;
    }
    .profile-img img{
        width: 70%;
        height: 100%;
    }
    .profile-img .file {
        position: relative;
        overflow: hidden;
        margin-top: -20%;
        width: 70%;
        border: none;
        border-radius: 0;
        font-size: 15px;
        background: #212529b8;
    }
    .profile-img .file input {
        position: absolute;
        opacity: 0;
        right: 0;
        top: 0;
    }
    .profile-head h5{
        color: #333;
    }
    .profile-head h6{
        color: #0062cc;
    }
    .profile-edit-btn{
        border: none;
        border-radius: 1.5rem;
        width: 70%;
        padding: 2%;
        font-weight: 600;
        color: #6c757d;
        cursor: pointer;
    }
    .proile-rating{
        font-size: 12px;
        color: #818182;
        margin-top: 5%;
    }
    .proile-rating span{
        color: #495057;
        font-size: 15px;
        font-weight: 600;
    }
    .profile-head .nav-tabs{
        margin-bottom:5%;
    }
    .profile-head .nav-tabs .nav-link{
        font-weight:600;
        border: none;
    }
    .profile-head .nav-tabs .nav-link.active{
        border: none;
        border-bottom:2px solid #0062cc;
    }
    .profile-work{
        padding: 14%;
        margin-top: -15%;
    }
    .profile-work p{
        font-size: 12px;
        color: #818182;
        font-weight: 600;
        margin-top: 10%;
    }
    .profile-work a{
        text-decoration: none;
        color: #495057;
        font-weight: 600;
        font-size: 14px;
    }
    .profile-work ul{
        list-style: none;
    }
    .profile-tab label{
        font-weight: 600;
    }
    .profile-tab p{
        font-weight: 600;
        color: #0062cc;
    }

    body {
        background-color: #ecf0f1;
        margin: 20px;
        font-family: Arial, Tahoma;
        font-size: 20px;
        color: #666666;
        text-align: center;
    }

    /*-=-=-=-=-=-=-=-=-=-*/
    /* Column Grids */
    /*-=-=-=-=-=-=-=-=-= */

    .col_third { width: 35%; }
    .col_third{
        position: relative;
        display:inline;
        display: inline-block;
        float: left;
        margin-right: 2%;
        margin-bottom: 20px;
    }
    .end { margin-right: 0 !important; }

    /*-=-=-=-=-=-=-=-=-=-=- */
    /* Flip Panel */
    /*-=-=-=-=-=-=-=-=-=-=- */

    .wrapper{ width: 1200px; margin: 20 auto;  background-color: #bdd3de; hoverflow: hidden;}



    .panel .front{
        text-align: center;
    }



    .box1{
        background-color: #14bcc8;
        width: 250px;
        height: 380px;
        margin: 0 auto;
        margin-left: 200px;
        padding: 20px;
        border-radius: 10px;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
    }

</style>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@extends( ($userByCookie->rol === 1) ? 'layouts.navAdmin' :  'layouts.nav')
@section('content')
<div class="container emp-profile">
    <form method="post">
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
                                <p><?php echo $userByCookie->naam ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $userByCookie->email ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Telefoonnummer</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $userByCookie->telefoonnummer ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Bedijfsnaam</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $userByCookie->bedrijfsnaam ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label><?php echo $userByCookie->btwNummer ?></label>
                            </div>
                            <div class="col-md-6">
                                <p>Web Developer and Designer</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Adres</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $userByCookie->adres ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Postcode</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $userByCookie->postcode ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Plaats</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $userByCookie->plaats ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>






{{--<div class="wrapper">--}}
{{--    <div class="col_third">--}}
{{--        <div class="hover panel">--}}
{{--            <div class="front">--}}
{{--                <div class="box1">--}}
{{--                    <form method="POST" action="#" >--}}
{{--                        @csrf--}}
{{--                        <h5>Bol-Koppeling</h5>--}}
{{--                        <!-- Form Group (username)-->--}}
{{--                        <div class="mb-3">--}}
{{--                            <label class="small mb-1" for="inputUsername">Client Id</label>--}}
{{--                            <input class="form-control" id="inputUsername" name='clientId' type="text" >--}}
{{--                        </div>--}}
{{--                        <!-- Form Row-->--}}
{{--                        <div class="mb-3">--}}
{{--                            <label class="small mb-1" for="inputUsername">Secret</label>--}}
{{--                            <input class="form-control" id="inputUsername" name='secret' type="text" >--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label class="small mb-1" for="inputUsername">description</label>--}}
{{--                            <input class="form-control" id="inputUsername" name='description' type="text">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3">--}}
{{--                            <br><label for="color">Land :</label>--}}
{{--                            <select name="land" id="color">--}}
{{--                                <option value="" selected>--- Maak uw keuze ---</option>--}}
{{--                                <option value="nl">Netherlands</option>--}}
{{--                                <option value="be">Belgium</option>--}}
{{--                                <option value="nl-be">Netherlands & Belgium</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <br>--}}
{{--                        <a href="#"><button class="btn btn-primary" id="btnDeleteUser" name="createBolUserBTN" type="submit">Versturen</button></a>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--    <div class="col_third">--}}
{{--        <div class="hover panel">--}}
{{--            <div class="front">--}}
{{--                <div class="box1">--}}
{{--                    <form method="POST" action="#" >--}}
{{--                        @csrf--}}
{{--                        <h5>Woo-Koppeling</h5>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label class="small mb-1" for="inputUsername">Host</label>--}}
{{--                            <input class="form-control" id="inputUsername" name='wooClientHost' type="text" >--}}
{{--                        </div>--}}
{{--                        <!-- Form Group (username)-->--}}
{{--                        <div class="mb-3">--}}
{{--                            <label class="small mb-1" for="inputUsername">Woo Key</label>--}}
{{--                            <input class="form-control" id="inputUsername" name='wooClientKey' type="text" >--}}
{{--                        </div>--}}
{{--                        <!-- Form Row-->--}}
{{--                        <div class="mb-3">--}}
{{--                            <label class="small mb-1" for="inputUsername">Secret</label>--}}
{{--                            <input class="form-control" id="inputUsername" name='wooClientSecret' type="text" >--}}
{{--                        </div>--}}
{{--                        <br>--}}
{{--                        <a href="#"><button class="btn btn-primary" id="btnDeleteUser" name="createWooUserBTN" type="submit">Versturen</button></a>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<br><br><br><br><br><br>--}}
{{--<br><br><br><br><br><br>--}}
{{--<br><br><br><br><br><br>--}}
{{--<br>--}}
{{--<div class="container emp-profile">--}}
{{--    <h5> Actieve verbinding(en) </h5>--}}
{{--    <?php--}}
{{--    if (!empty($bolConnection)){--}}

{{--    for ($x = 0; $x < count($bolConnection); $x++) { ?>--}}
{{--    <div class="mb-3">--}}
{{--        <div class="card mb-4">--}}
{{--            <div class="card-header">Verbinding: <?php echo $x+1 ?></div>--}}
{{--            <div class="card-body">--}}
{{--                <label class="small mb-1" for="inputUsername">Omschrijving:</label>--}}
{{--                <input class="form-control" id="inputUsername" name='wooClientKey' placeholder=<?php if (!empty($bolConnection[$x]->description)) echo $bolConnection[$x]->description; ?> >--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <label class="small mb-1" for="inputUsername">client id</label>--}}
{{--                <input class="form-control" id="inputUsername" name='wooClientKey' placeholder=<?php echo $bolConnection[$x]->clientId ?> >--}}
{{--                <a href="{{ route('deleteBolUser',$bolConnection[$x]->bolUserId) }}"><button type="button" class="btn btn-danger">Verwijderen</button></a>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--    <?php }--}}
{{--    } ?>--}}
{{--</div>--}}





