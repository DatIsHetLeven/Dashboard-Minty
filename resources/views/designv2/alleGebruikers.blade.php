@extends('layouts.navBarAdmin')
<title>Users</title>
@section('content')

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Alle gebuikers</title>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>

        <script src="{{ asset('js/popupToevoegen.js') }}"></script>

        <style>

            .table-responsive {
                margin: 30px 0;
            }
            .table-wrapper {
                min-width: 1000px;
                background: #fff;
                padding: 20px 25px;
                border-radius: 3px;
                box-shadow: 0 1px 1px rgba(0,0,0,.05);
            }
            .table-title {
                padding-bottom: 15px;
                background: rgb(185, 238, 205);
                color: #fff;
                padding: 16px 30px;
                margin: -20px -25px 10px;
                border-radius: 3px 3px 0 0;
            }
            .table-title h2 {
                margin: 5px 0 0;
                font-size: 24px;
            }
            .table-title .btn {
                color: #566787;
                float: right;
                font-size: 13px;
                background: #fff;
                border: none;
                min-width: 50px;
                border-radius: 2px;
                border: none;
                outline: none !important;
                margin-left: 10px;
            }
            .table-title .btn:hover, .table-title .btn:focus {
                color: #566787;
                background: #f2f2f2;
            }
            .table-title .btn i {
                float: left;
                font-size: 21px;
                margin-right: 5px;
            }
            .table-title .btn span {
                float: left;
                margin-top: 2px;
            }
            table.table tr th, table.table tr td {
                border-color: #e9e9e9;
                padding: 12px 15px;
                vertical-align: middle;
            }
            table.table tr th:first-child {
                width: 60px;
            }
            table.table tr th:last-child {
                width: 100px;
            }
            table.table-striped tbody tr:nth-of-type(odd) {
                background-color: #fcfcfc;
            }
            table.table-striped.table-hover tbody tr:hover {
                background: #f5f5f5;
            }
            table.table th i {
                font-size: 13px;
                margin: 0 5px;
                cursor: pointer;
            }
            table.table td:last-child i {
                opacity: 0.9;
                font-size: 22px;
                margin: 0 5px;
            }
            table.table td a {
                font-weight: bold;
                color: #566787;
                display: inline-block;
                text-decoration: none;
            }
            table.table td a:hover {
                color: #2196F3;
            }
            table.table td a.settings {
                color: #2196F3;
            }
            table.table td a.delete {
                color: #F44336;
            }
            table.table td i {
                font-size: 19px;
            }
            table.table .avatar {
                border-radius: 50%;
                vertical-align: middle;
                margin-right: 10px;
            }
            .status {
                font-size: 30px;
                margin: 2px 2px 0 0;
                display: inline-block;
                vertical-align: middle;
                line-height: 10px;
            }
            .text-success {
                color: #10c469;
            }
            .text-info {
                color: #62c9e8;
            }
            .text-warning {
                color: #FFC107;
            }
            .text-danger {
                color: #ff5b5b;
            }
            .pagination {
                float: right;
                margin: 0 0 5px;
            }
            .pagination li a {
                border: none;
                font-size: 13px;
                min-width: 30px;
                min-height: 30px;
                color: #999;
                margin: 0 2px;
                line-height: 30px;
                border-radius: 2px !important;
                text-align: center;
                padding: 0 6px;
            }
            .pagination li a:hover {
                color: #666;
            }
            .pagination li.active a, .pagination li.active a.page-link {
                background: #03A9F4;
            }
            .pagination li.active a:hover {
                background: #0397d6;
            }
            .pagination li.disabled i {
                color: #ccc;
            }
            .pagination li i {
                font-size: 16px;
                padding-top: 6px
            }
            .hint-text {
                float: left;
                margin-top: 10px;
                font-size: 13px;
            }


            .popUp .overlay {
                height: 100vh;
                width: 100vw;
                position: fixed;
                top: 0;
                left: 0;
                background: rgba(0, 0, 0, 0.7);
                z-index: 100;
                display: none;
                align-items: center;
                justify-content: center;
                padding-left: 220px;
            }
            .close-on-overlay {
                height: 100vh;
                width: 100vw;
                position: fixed;
                top: 0;
                left: 0; 
            }
            .popUp .content {
                background: #fff;
                width: 100%;
                max-width: 700px;
                z-index: 20000;
                text-align: center;
                padding: 50px;
                box-sizing: border-box;
                border-radius: 10px;
            }
            .popUp .close-btn {
                user-select: none;
                position: absolute;
                right: 20px;
                top: 20px;
                width: 30px;
                height: 30px;
                background: #222;
                color: #fff;
                font-size: 25px;
                font-weight: 600;
                line-height: 30px;
                text-align: center;
                border-radius: 50%;
                cursor: pointer;
            }
            .popUp.active .overlay {
                display: flex;
            }
            .popUp.active .content {
                transform: scale(1);
            }

            

            @media screen and (max-width: 1770px){
                .container-xl{
                    margin-left: 15% !important;
                }
                body{
                    background-color: red;
                }
            }
            @media screen and (max-width: 1500px){
                .container-xl{
                    margin-left: 20% !important;
                }

                body{
                    background-color: red;
                }
            }
        </style>




        <div class="popUp" id="popUp-1">
            <div class="overlay">
                <div class="close-on-overlay" onclick="show();"></div>
            <div class="content">
                <div class="close-btn" onclick="show();">&times;</div>
        <!-- Begin van de popup -> gebruiker toevoegen -->
        <form method="POST" action="{{ route('create_user_check') }}" class="formRegister">
            @csrf

            <h1 class="registreren">Registreren</h1>
                        <form>
                        <div class="form-flex">
                            <div class="form-left">
                            
                                        <input class="form-control" id="inputOrgName" type="text" name="email" placeholder='Email' required autocomplete="email">
                                
                                        <input class="form-control" id="inputLocation" type="text" name="userName" placeholder='Naam' required autocomplete="email">
                                
                                        <input class="form-control" id="inputFirstName" type="text" name="Telefoonnummer" placeholder='Telefoonnummer' required>
                            
                                        <input class="form-control" id="inputLastName" type="text" name="Bedijfsnaam" placeholder='Bedijfsnaam' required>
                                        
                                        <input class="form-control" id="inputOrgName" type="text" name="BTW-Nummer" placeholder='BTW-Nummer' required>
                                
                            </div>
                            <div class="form-right">     
                                
                                        <input class="form-control" id="inputLocation" type="text" name="Adres" placeholder='Adres+Huisnummer' required>
                                
                                        <input class="form-control" id="inputPhone" type="text" name="Postcode" placeholder='Postcode' required>
                                
                                        <input class="form-control" id="inputBirthday" type="text" name="Plaats" placeholder='Plaats' required>
                                
                                        <input class="form-control" id="inputPhone" type="text" name="FactuurId" placeholder='FactuursturenId' required>
                                    <div class="land-switcher">
                                       
                                        <label><input type="radio" name="land" checked
                                           <?php if (isset($land) && $land=="nl") echo "checked";?>
                                           value="nl">Nederland</label>
                                        
                                        <label>   <input type="radio" name="land"
                                           <?php if (isset($land) && $land=="be") echo "checked";?>
                                           value="be">Belgie     </label>
                                           
                                     </div>
                            </div>
                        </div>
                                    
                                    <br><label for="color">functie:</label>
                                        <select name="userRole" id="color">
                                            <option value="">--- Kies een functie ---</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Gebruiker" selected>Klant</option>
                                            <option value="Proefaccount" selected>Klant(14 dagen proef)</option>
                                        </select>
                                
                                <input type="hidden" name="checkbox_algemenevoorwaarden" value="checkox_value" checked>

                                <div class="button-footer">
                                <button class="btn btn-primary" id="buttonLogin" name="buttonregister" type="submit"  value="Registreren">{{ __('Registreren') }}</button><br><br>
                                </div>
                            </form>
                    </div>
                </div>
        </form>
        </div>
        </div>
        <!-- Einde Popup! -->




        <div class="main-grid-min-nav">
        <div class="wrapped-container">
        <div class="WelkomBanner plusbutton">
        <div class="left">
        <h2>Gebruikers</h2>
        <p><span class="welkomBol">Zie alle gebruikers of voeg nieuwe toe</span></p>
        </div>
        <div class="right">
        <a href="#" onclick="show()"><button class="btn btn-primary">Voeg gebruiker toe</button></a>
        </div>    
        </div>
                <div class="table-wrapper box">
                    <table class="table table-striped table-hover user-table">
                        <thead>
                        <tr>
                            <th>Gebruiker</th>
                            <th>Bedrijfsnaam</th>
                            <th>Email</th>
                            <th>Account</th>
                            <th>Eind</th>
                            <th>Geverifieerd</th>
                            <th>Geabonneerd</th>
                            <th>API actief</th>
                        </tr>
                        </thead><?php
                                $count = 0;

                                $current_date = new DateTime();
                                for ($x = 0; $x < count($allegebruikers); $x++) {
                                    //Data in nederlands format
                                    $opening_date = $allegebruikers[$x]->geldig;
                                    $current_date = date('Y-m-d');

                                    $orgDate = $opening_date;
                                    $newDate = date("d-m-Y", strtotime($orgDate));
                                    ?>




                        <div class="perGeberuiker" value={{$count}}>
                            <tr>
                                <td><a href="{{ route('seeCustomerDetail',$allegebruikers[$x]->userId) }}"><?php echo $allegebruikers[$x]->naam; ?></a></td>
                                <td><a href="{{ route('seeCustomerDetail',$allegebruikers[$x]->userId) }}"><?php echo $allegebruikers[$x]->bedrijfsnaam; ?></td>
                                <td><a href="{{ route('seeCustomerDetail',$allegebruikers[$x]->userId) }}"><?php echo $allegebruikers[$x]->email; ?></td>
                                    <?php $count++;?>
                                <td><input type="checkbox" id="test"<?php if($opening_date > $current_date ){?>checked<?php }?> onclick="return false;"></td>
                                <td><a href="{{ route('seeCustomerDetail',$allegebruikers[$x]->userId) }}"><?php echo $newDate; ?></td>
                                {{--            <td><a href="{{ route('createUserFactuursturen',$allegebruikers[$x]->userId) }}" value=<?php $count?>>Add</a>--}}
                                <td><input type="checkbox" id="test"<?php if($allegebruikers[$x]->geverifieerd == TRUE){?><?php }?> onclick="return false;"></td>
                                <td><input type="checkbox" id="test"<?php if($allegebruikers[$x]->geabonneerd == TRUE){?> checked   <?php }?> onclick="return false;"></td>
                                <td><input type="checkbox" id="test"<?php if($allegebruikers[$x]->API == TRUE){?>checked<?php }?> onclick="return false;"></td>
                            </tr>
                        </div>
                            <?php
                        }?></tbody></table>
                </div>
            </div>
        </div>
        </div>







</section>

