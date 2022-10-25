<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

@extends( ($userByCookie->rol === 3) ? 'layouts.nav' :  'layouts.navAdmin')
@section('content')


{{--toon alle modules--}}
<div class="container-xl px-4 mt-4">
    <div class="row">
<?php  for ($x = 0; $x < count($allUsers); $x++) {?>
        <div class="col-xl-4">
            <div class="card mb-4">
                <?php if($boolModule[$x] == true){?><a href="{{ route('GetSingleModule',$allUsers[$x]->identifier) }}"><div class="card-header"><?php echo $allUsers[$x]->name?></div></a><?php } ?>
                <?php if($boolModule[$x] == false){?><a href="#"><div class="card-header"><?php echo $allUsers[$x]->name?></div></a><?php } ?>
                <br>
                <?php echo $allUsers[$x]->description ?>
                <div class="card-body">
                    <label class="switch">
                        <input type="checkbox" <?php if ($boolModule[$x] === true){?>checked<?php  }?> >
                        <span class="slider round"></span>
                    </label>
                        <?php if (!$boolModule[$x] === true){?>
                    <a href="{{ route('EnableSingleModule',$allUsers[$x]->identifier) }}">Install</a><?php }
                    else{?><a href="{{ route('DisableSingleModule',$allUsers[$x]->identifier) }}">Uninstall</a><?php } ?>
                </div>
            </div>
        </div>
        <?php }?>


        <div class="scroll-bg">
            <div class="scroll-div">
                <div class="scroll-object">
                    <table id="example" class="table table-striped">
                        <thead>
                        <tr>
                            <th>message</th>
                            <th>status</th>
                        </tr>
                        </thead>
                        <tbody><?php
                               $count = 0;
                               for ($x = 0; $x < count($allLogs->logs); $x++) {?>
                        <div class="perGeberuiker" value={{$count}}>
                            <tr>
                                <td><?php echo $allLogs->logs[$x]->message; ?></td>
                                <td><?php echo $allLogs->logs[$x]->status; ?></td>
                            </tr>
                        </div>
                            <?php
                        }?></tbody></table>
                </div>
            </div>
        </div>


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
