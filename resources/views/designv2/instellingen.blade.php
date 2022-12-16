@extends( ($userByCookie->rol === 1) ? 'layouts.navBarAdmin' :  'layouts.navBar')
<title>Instellingen</title>
@section('content')

<style>
.list-unstyled.mb-0.d-flex.justify-content-end {
    justify-content: center!important;
}
th {
    font-weight: 500!important;
}
td {
    color: rgb(136, 136, 136);
}
a.text-danger {
    width: 28px;
    height: 28px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 1000px;
    background-color: #dc3545!important;
    font-size: 13px;
    color: #fff!important;
}
i.far.fa-trash-alt {
    color: #fff;
}
td {
    vertical-align: middle!important;
}
</style>

<div class="main-grid-min-nav">
    <div class="wrapped-container">
    <div class="WelkomBanner">
        <h2>Instellingen</h2>
        <p><span class="welkomBol">Dit zijn je instelling omtrent de koppeling</span></p>
    </div>

<section class="page-content">
        <div class="row">
            <div class="col-md-6">           
                <div class="mb-4 card">
                    <div class="card-header">Bol koppeling</div>
                    <div class="card-body">
                            <form method="POST" action="{{ route('createBolUser',$userByCookie->userId) }}" >
                                        @csrf
                                        @if(\Session::has('error'))
                                            <p class="error">
                                                {{\Session::get('error')}}
                                            </p>
                                        @endif
                                <div class="mb-3">
                                    <label class="small mb-1 label-inputs" for="inputUsername">Client Id</label>
                                    <input class="form-control" id="inputUsername" name='clientId' type="text" required>
                                </div>
                                <!-- Form Row-->
                                <div class="mb-3">
                                    <label class="small mb-1 label-inputs" for="inputUsername">Secret</label>
                                    <input class="form-control" id="inputUsername" name='secret' type="text" required>
                                </div>
                                <div class="mb-3">
                                    <label class="label-inputs small mb-1" for="inputUsername">Omschrijving A</label>
                                    <input class="form-control" id="inputUsername" name='description' type="text" required>
                                </div>
                                <label class="label-inputs" for="color">Land :</label>
                                <select name="land" class="form-select" aria-label="Default select example">
                                    <option selected>--- Maak uw keuze ---</option>
                                    <option value="nl">Netherlands</option>
                                    <option value="be">Belgium</option>
                                    <option value="nl-be">Netherlands & Belgium</option>
                                </select>
                                
                                <div class="button-footer">
                                        <a href="#"><button class="btn btn-primary" id="btnDeleteUser" name="createBolUserBTN" type="submit">Maak bol account aan</button></a>
                                        <a href="https://partner.bol.com/sdd/preferences/services/api">Haal hier uw gegevens op</a>
                                </div>
                            </form>

                    </div>
                </div>
            </div>

            <div class="col-md-6">           
                <div class="mb-4 card">
                    <div class="card-header">WooCommerce koppeling</div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('createWooUser',$userByCookie->userId) }}" >
                            @if(\Session::has('errorWoo'))
                                <p class="error">
                                    {{\Session::get('errorWoo')}}
                                </p>
                            @endif
                            @csrf
                        <div class="mb-3">
                            <label class="label-inputs small mb-1" for="inputUsername">Host</label>
                            <input class="form-control" id="inputUsername" name='wooClientHost' type="text" required>
                        </div>
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="label-inputs small mb-1" for="inputUsername">Woo Key</label>
                            <input class="form-control" id="inputUsername" name='wooClientKey' type="text" required>
                        </div>
                        <!-- Form Row-->
                        <div class="mb-3">
                            <label class="label-inputs small mb-1" for="inputUsername">Secret</label>
                            <input class="form-control" id="inputUsername" name='wooClientSecret' type="text" required>
                        </div>
                        
                        <div class="button-footer">
                            <a href="#"><button class="btn btn-primary" id="btnDeleteUser" name="createWooUserBTN" type="submit">Maak verbinding</button></a>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        
        
        
        
        
        
        </div>






        <div class="row mb-4">
            <div class="col-md-12">           
                <div class="card">
                    <div class="card-header">API koppeling</div>
                    <div class="card-body">

                    <p>Gebruik de volgende api key in je wordpress website om verbinding te maken met het dashoard.</p>
                    <input class="form-control" id="inputUsername" name='wooClientSecret' type="text" readonly required value=<?php echo $userApiKey ?> >
                           

                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-12">           
                <div class="card">
                    <div class="card-header">Actieve verbinding Woo-Koppeling</div>
                    <div class="card-body">

                    <div class="">
                                <table class="table manage-candidates-top mb-0">
                                    <thead></thead>
                                    <tr>
                                        <th>Omschrijving B BOL API KEYS</th>
                                        <th class="text-center">Client Id</th>
                                        <th class="action text-center">Verwijder</th>
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
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                <div class="row mb-4">
                <div class="col-md-12">           
                <div class="card">
                    <div class="card-header">Actieve verbinding Woo-Koppeling</div>
                    <div class="card-body">
                                <?php if (!empty($wooConnection) ): ?>
                                    <table class="table manage-candidates-top mb-0">
                                    <thead>
                                        @if(\Session::has('errorWoo'))
                                            <p class="error">
                                                {{\Session::get('error')}}
                                            </p>
                                        @endif<p>
                                        <tr>
                                            <th>Host woocommerce api keys</th>
                                            <th class="text-center">Woo key</th>
                                            <th class="action text-center">Verwijder</th>
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
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <?php endif; ?>
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




