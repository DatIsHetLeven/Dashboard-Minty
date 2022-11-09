<link href="{{ asset('css/logintest.css') }}" rel="stylesheet">
<style>

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

    .wrapper{ width: 1200px; margin: 20 auto;  background-color: #bdd3de; hoverflow: hidden;}


    .panel .front{
        text-align: center;
    }
    table{
        box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
    }

    .centerDiv{
        margin-left: 350px;
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


@extends( ($userByCookie->rol === 1) ? 'layouts.navAdmin' :  'layouts.nav')
@section('content')
    <div class="wrapper">
        <div class="col_third">
            <div class="hover panel">
                <div class="front">
                    <div class="box1">
                        <form method="POST" action="{{ route('createBolUser',$userByCookie->userId) }}" >
                            @csrf
                            @if(\Session::has('error'))
                                <p class="error">
                                    {{\Session::get('error')}}
                                </p>
                            @endif<p>
                            <h5>Bol-Koppeling</h5>
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Client Id</label>
                                <input class="form-control" id="inputUsername" name='clientId' type="text" required>
                            </div>
                            <!-- Form Row-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Secret</label>
                                <input class="form-control" id="inputUsername" name='secret' type="text" required>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Omschrijving</label>
                                <input class="form-control" id="inputUsername" name='description' type="text" required>
                            </div>
                            <label for="color">Land :</label>
                            <select name="land" class="form-select" aria-label="Default select example">
                                <option selected>--- Maak uw keuze ---</option>
                                <option value="nl">Netherlands</option>
                                <option value="be">Belgium</option>
                                <option value="nl-be">Netherlands & Belgium</option>
                            </select>
                            <br>
                            <a href="#"><button class="btn btn-primary" id="btnDeleteUser" name="createBolUserBTN" type="submit">Versturen</button></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col_third">
        <div class="hover panel">
            <div class="front">
                <div class="box1">
                    <form method="POST" action="{{ route('createWooUser',$userByCookie->userId) }}" >
                        @csrf
                        <h5>Woo-Koppeling</h5>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Host</label>
                            <input class="form-control" id="inputUsername" name='wooClientHost' type="text" required>
                        </div>
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Woo Key</label>
                            <input class="form-control" id="inputUsername" name='wooClientKey' type="text" required>
                        </div>
                        <!-- Form Row-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Secret</label>
                            <input class="form-control" id="inputUsername" name='wooClientSecret' type="text" required>
                        </div>
                        <br>
                       <a href="#"><button class="btn btn-primary" id="btnDeleteUser" name="createWooUserBTN" type="submit">Versturen</button></a>
                    </form>
                    Gebruik de volgende api key in je wordpress website om verbinding te maken met het dashboard.
                    <input class="form-control" id="inputUsername" name='wooClientSecret' type="text" required value=<?php echo $userApiKey ?> >

                </div>
            </div>
        </div>
    </div>
    </div>

    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>



<div class="centerDiv">
    <div class="container mt-3 mb-4">
        <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
                        <table class="table manage-candidates-top mb-0">
                            <thead>
                            <h5>Actieve verbinding(en) Bol-Koppeling</h5>
                            <br>
                            <tr>
                                <th>Omschrijving</th>
                                <th class="text-center">Client Id</th>
                                <th class="action text-right">Verwijder</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for ($x = 0; $x < count($bolConnection); $x++) {?>
                            <tr class="candidates-list">
                                <td class="title">
                                    <?php if (!empty($bolConnection[$x]->description)) echo $bolConnection[$x]->description; ?>
                                </td>
                                <td class="candidate-list-favourite-time text-center">
                                        <?php echo $bolConnection[$x]->clientId ?>
                                </td>
                                <td>
                                    <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                        <li><a href="{{ route('deleteBolUser',$bolConnection[$x]->userId) }}" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete"><i class="far fa-trash-alt"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <br><br><br>
                        <?php if (!empty($wooConnection) ) { ?>
                        <table class="table manage-candidates-top mb-0">
                            <thead>
                            <h5>Actieve verbinding Woo-Koppeling</h5>
                            <br>
                            @if(\Session::has('errorWoo'))
                                <p class="error">
                                    {{\Session::get('error')}}
                                </p>
                            @endif<p>
                            <tr>
                                <th>Host</th>
                                <th class="text-center">Woo key</th>
                                <th class="action text-right">Verwijder</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for ($x = 0; $x < 1; $x++) { ?>
                            <tr class="candidates-list">
                                <td class="title">
                                        <?php if (!empty($wooConnection->host)) echo $wooConnection->host; ?>
                                </td>
                                <td class="candidate-list-favourite-time text-center">
                                        <?php echo $wooConnection->wooKey ?>
                                </td>
                                <td>
                                    <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                        <li><a href="{{ route('deleteWooConnection',$wooConnection->userId) }}" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete"><i class="far fa-trash-alt"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <?php }
                            }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





