@extends('layouts.navBar')
@section('content')



@extends('layouts.navAdmin')
@section('content')



<div class="main-grid-min-nav">
    <div class="wrapped-container">
<div class="WelkomBanner">
        <h2>Module</h2>
        <p><span class="welkomBol"><?php echo $singleModule->identifier ?></span></p>
    </div>

                <div class="box module">
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
                        <div class="module-row">
                        StockSync setting
                        <label class="switch" >
                            <input type="checkbox" value="stock" name='stockSetting' {{   (($stockSyncSetting == false)) ? '': "checked"   }}>
                            <span class="slider round"></span>
                        </label>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut placerat augue metus, eu tincidunt purus sagittis quis.</p>
                        </div>
                        <div class="module-row">
                        PriceSync setting
                        <label class="switch" >
                            <input type="checkbox" value="price" name='priceSetting' {{   (($priceSyncSetting == false)) ? '': "checked"   }}>
                            <span class="slider round"></span>
                        </label>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut placerat augue metus, eu tincidunt purus sagittis quis.</p>
                        </div>
                        <div class="module-row">
                        bolToWooSync setting
                        <label class="switch" >
                            <input type="checkbox" value="price" name='bolToWooSync' {{   (($bolToWooSync == false)) ? '': "checked"   }}>
                            <span class="slider round"></span>
                        </label>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut placerat augue metus, eu tincidunt purus sagittis quis.</p>
                        </div>
                        <div class="module-row">
                        wooToBolSync setting
                        <label class="switch" >
                            <input type="checkbox" value="price" name='wooToBolSync' {{   (($wooToBolSync == false)) ? '': "checked"   }}>
                            <span class="slider round"></span>
                        </label>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut placerat augue metus, eu tincidunt purus sagittis quis.</p>
                        </div>
                        <div class="module-row">
                        managedByRetailer setting
                        <label class="switch" >
                            <input type="checkbox" value="price" name='managedByRetailer' {{   (($managedByRetailer == false)) ? '': "checked"   }}>
                            <span class="slider round"></span>
                        </label>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut placerat augue metus, eu tincidunt purus sagittis quis.</p>
                        </div>

                        <div class="button-footer">
                            <button class="btn btn-primary" id="btnDeleteUser" name="createBolUserBTN" type="submit">opslaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>