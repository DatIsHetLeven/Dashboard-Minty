@extends('layouts.navBar')
@section('content')
    <link href="//code.ionicframework.com/nightly/css/ionic.css" rel="stylesheet">
    <script src="//code.ionicframework.com/nightly/js/ionic.bundle.js"></script>

    <style>
        .popup{
            width: 550px !important;
        }

    </style>



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
                        Voorraad synchronisatie
                        <label class="switch" >
                            <input type="checkbox" value="stock" name='stockSetting' {{   (($stockSyncSetting == false)) ? '': "checked"   }}>
                            <span class="slider round"></span>
                        </label>
                        <p>Synchroniseer alle product voorraden tussen Bol en WooCommcerce.</p>
                        </div>
                        <div class="module-row">
                        Prijs synchronisatie
                        <label class="switch" >
                            <input type="checkbox" value="price" name='priceSetting' {{   (($priceSyncSetting == false)) ? '': "checked"   }}>
                            <span class="slider round"></span>
                        </label>
                        <p>Geen idee meneer de Arthur .</p>
                        </div>
                        <div class="module-row">
                        Bol naar WooCommerce synchronisatie
                        <label class="switch" >
                            <input type="checkbox" value="price" name='bolToWooSync' {{   (($bolToWooSync == false)) ? '': "checked"   }}>
                            <span class="slider round"></span>
                        </label>
                        <p>Synchroniseer al je producten uit Bol.com naar WooCommerce. </p>
                        </div>
                        <div class="module-row">
                        WooCommerce naar Bol synchronisatie
                        <label class="switch" >
                            <input type="checkbox" value="price" name='wooToBolSync' {{   (($wooToBolSync == false)) ? '': "checked"   }}>
                            <span class="slider round"></span>
                        </label>
                        <p>Synchroniseer al je producten uit WooCommerce naar Bol.com.</p>
                        </div>
                        <div class="module-row">
                        Correcte voorraad checker

                        <label class="switch" >
                            <input type="checkbox" value="price" name='managedByRetailer' {{   (($managedByRetailer == false)) ? '': "checked"   }}>
                            <span class="slider round"></span>
                        </label>
                            <p>Deze instelling zorgt ervoor dat de correcte voorraad overgenomen en berekend wordt in Bol.</p><p></p>
{{--                            <p>Als voorbeeld:</p>--}}
{{--                            <p>Van een product pas je de voorraad in WooCommerce aan van 0 naar 10.</p>--}}
{{--                            <p>Mocht je geen openstaande bestellingen hebben van dit procut neemt bol de nieuwe voorraad over</p>--}}
{{--                            <p>Mocht je wel een openstaande bestelling hebben van dit product, ook dan neemt bol dit getal over maar trekt hiervan wel de aantal openstaande bestellingen vanaf. </p>--}}
                            <div ng-app="mySuperApp">
                                <div class="padding" ng-controller="PopupCtrl">
                                    <p class="button button-primary" ng-click="showConfirm()">
                                        Klik hier voor uitleg!
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="button-footer">
                            <button class="btn btn-primary" id="btnDeleteUser" name="createBolUserBTN" type="submit">opslaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>





    <script id="popup-template.html" type="text/ng-template">
        <input ng-model="data.wifi" type="text" placeholder="Password">
    </script>
    <script>
        angular.module('mySuperApp', ['ionic'])
            .controller('PopupCtrl',function($scope, $ionicPopup, $timeout) {
                // A confirm dialog
                $scope.showConfirm = function() {
                    var confirmPopup = $ionicPopup.confirm({
                        title: 'Correcte Voorraad checker',
                        template: 'Deze instelling zorgt ervoor dat de correcte voorraad overgenomen en berekend wordt in Bol <?php echo "<br>";?> <?php echo "<br>";?>Als voorbeeld: <?php echo "<br>";?>Van een product pas je de voorraad in WooCommerce aan van 0 naar 10 <?php echo "<br>";?>Mocht je geen openstaande bestellingen hebben van dit procut neemt bol de nieuwe voorraad over  <?php echo "<br>";?><?php echo "<br>";?>Mocht je wel een openstaande bestelling hebben van dit product, ook dan neemt bol dit getal over maar trekt hiervan wel eerst de aantal openstaande bestellingen vanaf.'
                    });
                };

            });
    </script>

