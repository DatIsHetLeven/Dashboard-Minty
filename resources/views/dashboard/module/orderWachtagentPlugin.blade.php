@extends('layouts.navBar')
@section('content')

<style>

</style>

@extends('layouts.navAdmin')
@section('content')


<div class="main-grid-min-nav">
    <div class="wrapped-container">
<div class="WelkomBanner">
        <h2>Module</h2>
        <p><span class="welkomBol"><?php echo $singleModule->identifier ?></span></p>
    </div>




                <div class="box module">
                    <form action="{{ route('updateOrderWachtagent') }}" method="post">
                        @csrf

                        <?php
                        $possibleSettingList = json_decode($singleModule->settings,true);
                        $phoneSetting = $possibleSettingList['phone'];
                        $emailSetting= $possibleSettingList['email'];
                        $statusSetting = $possibleSettingList['status'];?>

                        <div class="module-row">
                            Phone setting
                            <label class="switch" >
                                <input type="checkbox" value="phone" name='phoneSetting' {{   (empty($phoneSetting)) ? '': "checked"   }}>
                                <span class="slider round"></span>
                            </label>
                            <p>Deze instelling biedt de mogelijkheid om een nummer te krijgen</p>
                        </div>




                        <div class="module-row">
                        E-mail instelling
                        <label class="switch">
                            <input type="checkbox" value="email" name='emailSetting' {{   (empty($emailSetting)) ? '': "checked"   }}>
                            <span class="slider round"></span>
                        </label>
                        <p>Verander alle emailadressen in de bestellingen naar: bol@mintyconnect.nl</p>
                        </div>

                        <div class="module-row">
                        Status
                        <label class="switch">
                            <input type="checkbox" value="status" name='statusSetting' {{   (empty($statusSetting)) ? '': "checked"   }}>
                            <span class="slider round"></span>
                        </label>
                        <p>Maak gebruik van de standaard Bol-Order-Status voor alle afgeronde bestellingen.</p>
                        </div>

                        <div class="button-footer">
                        <button class="btn btn-primary" id="btnDeleteUser" name="createBolUserBTN" type="submit">Opslaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</div>





