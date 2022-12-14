@extends( ($userByCookie->rol === 1) ? 'layouts.navBarAdmin' :  'layouts.navBar')
<title>Instellingen</title>
@section('content')

<style>
    body {
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #BA68C8
    }

    .error{
        color: red;
    }

    @media screen and (max-width: 1770px){
        section{
            margin-left: 15% !important;
        }
    }
    @media screen and (max-width: 1500px){
        section{
            margin-left: 20% !important;
        }
    }
</style>

<div class="main-grid-min-nav">
    <div class="wrapped-container">
    <div class="WelkomBanner">
        <h2>Instellingen</h2>
        <p><span class="welkomBol">Dit zijn je instelling omtrent de koppeling</span></p>
    </div>

<section class="page-content">
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-4">
{{--                Bol koppeling--}}
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience"><span>Bol koppeling</span></div><br>
                    <form method="POST" action="{{ route('createBolUser',$userByCookie->userId) }}" >
                        @csrf
                        @if(\Session::has('error'))
                            <p class="error">
                                {{\Session::get('error')}}
                            </p>
                        @endif<p>
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
                        <a href="https://partner.bol.com/sdd/preferences/services/api">Haal hier uw gegevens op</a>
                        <br><a href="#"><button class="btn btn-primary" id="btnDeleteUser" name="createBolUserBTN" type="submit">Maak bol account aan</button></a>
                    </form>
                </div></div>
{{--            Woo koppeling--}}
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience"><span>Woo koppeling</span></div><br><p>
                    <form method="POST" action="{{ route('createWooUser',$userByCookie->userId) }}" >
                        @if(\Session::has('errorWoo'))
                            <p class="error">
                                {{\Session::get('errorWoo')}}
                            </p>
                        @endif
                        @csrf
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
                        <a href="#"><button class="btn btn-primary" id="btnDeleteUser" name="createWooUserBTN" type="submit">Maak verbinding</button></a>
                    </form>
                </div>
            </div>
{{--            API koppeling--}}
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience"><span>API key</span></div><br>
                    Gebruik de volgende api key in je wordpress website om verbinding te maken met het dashoard.<br><br>
                    <input class="form-control" id="inputUsername" name='wooClientSecret' type="text" readonly required value=<?php echo $userApiKey ?> >
                </div>
            </div>
{{--            Empty field -> center actieve verbindingen--}}
            <div class="col-md-4">
                <div class="p-3 py-5">
                </div>
            </div>
{{--            Actieve verbinidngen --}}
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
                                                <li><a href="{{ route('deleteBolUser',$bolConnection[$x]->bolUserId) }}" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete"><i class="far fa-trash-alt"></i></a></li>
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
    </div>

    </div>
    </div>
</section>

                                </div></div>




