@extends('layouts.navBar')
@section('content')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    @media screen and (max-width: 1770px){
        .InfoBar{
            margin-left: 15% !important;
        }
    }
    @media screen and (max-width: 1500px){
        .InfoBar{
            margin-left: 20% !important;
        }
    }
</style>


@extends('layouts.navAdmin')
@section('content')

    <div>
        <?php
//        dd(count($allUsers));
        ?>
    </div>
    {{--toon alle modules--}}

    <div class="container-xl px-4 mt-4">
        <hr class="mt-0 mb-4">

        <div class="InfoBar">
            <div class="card mb-6">
                <div class="card-header"><?php echo $singleModule->identifier ?></div>
                <div class="card-body">
                    <form action="{{ route('updateProductWachtagent') }}" method="post">
                        @csrf
                        <?php
                        $possibleSettingList = json_decode($singleModule->settings,true);
                        $stockSyncSetting = $possibleSettingList['syncStock'];
                        $priceSyncSetting= $possibleSettingList['priceSync'];
                        $bolToWooSync = $possibleSettingList['bolToWooSync'];
                        $wooToBolSync = $possibleSettingList['wooToBolSync'];
                        $managedByRetailer = $possibleSettingList['managedByRetailer']
                        ?>
                        StockSync setting :
                        <label class="switch" >
                            <input type="checkbox" value="stock" name='stockSetting' {{   (($stockSyncSetting == false)) ? '': "checked"   }}>
                            <span class="slider round"></span>
                        </label>
                        <br><br><br>

                        PriceSync setting :
                        <label class="switch" >
                            <input type="checkbox" value="price" name='priceSetting' {{   (($priceSyncSetting == false)) ? '': "checked"   }}>
                            <span class="slider round"></span>
                        </label>
                        <br><br><br>

                        bolToWooSync setting :
                        <label class="switch" >
                            <input type="checkbox" value="price" name='bolToWooSync' {{   (($bolToWooSync == false)) ? '': "checked"   }}>
                            <span class="slider round"></span>
                        </label>
                        <br><br><br>

                        wooToBolSync setting :
                        <label class="switch" >
                            <input type="checkbox" value="price" name='wooToBolSync' {{   (($wooToBolSync == false)) ? '': "checked"   }}>
                            <span class="slider round"></span>
                        </label>
                        <br><br><br>

                        managedByRetailer setting :
                        <label class="switch" >
                            <input type="checkbox" value="price" name='managedByRetailer' {{   (($managedByRetailer == false)) ? '': "checked"   }}>
                            <span class="slider round"></span>
                        </label>
                        <br><br><br>

                        <button class="btn btn-primary" id="btnDeleteUser" name="createBolUserBTN" type="submit">opslaan</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>





