<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
</style>


@extends('layouts.navAdmin')
@section('content')


    <div>
        <?php

        ?>
    </div>
    {{--toon alle modules--}}

    <div class="container-xl px-4 mt-4">
        <hr class="mt-0 mb-4">

        <div class="col-xl-12">
            <div class="card mb-6">
                <div class="card-header"><?php echo $singleModule->identifier ?></div>
                <div class="card-body">
                    <form action="{{ route('updateOrderWachtagent') }}" method="post">
                        @csrf

                        <?php
                        $possibleSettingList = json_decode($singleModule->settings,true);
                        //dd($possibleSettingList);
                        //dump($singleModule->settings);
                        //dd($possibleSettingList);
                        $phoneSetting = $possibleSettingList['phone'];

                        //dd($phoneSetting);
                        $emailSetting= $possibleSettingList['email'];
                        $statusSetting = $possibleSettingList['status'];?>

                        Phone setting :
                        <label class="switch" >
                            <input type="checkbox" value="phone" name='phoneSetting' {{   (empty($phoneSetting)) ? '': "checked"   }}>
                            <span class="slider round"></span>
                        </label>
                        <br><br><br>

                        Email setting :)
                        <label class="switch">
                            <input type="checkbox" value="email" name='emailSetting' {{   (empty($emailSetting)) ? '': "checked"   }}>
                            <span class="slider round"></span>
                        </label>
                        <br><br><br>

                        Status :
                        <label class="switch">
                            <input type="checkbox" value="status" name='statusSetting' {{   (empty($statusSetting)) ? '': "checked"   }}>
                            <span class="slider round"></span>
                        </label>

                        <br>
                        <br><br>
                        <button class="btn btn-primary" id="btnDeleteUser" name="createBolUserBTN" type="submit">opslaan</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>





