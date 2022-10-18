<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

@extends('layouts.navAdmin')
@section('content')


{{--toon alle modules--}}
<div class="container-xl px-4 mt-4">
    <div class="row">
<?php  for ($x = 0; $x < count($allUsers); $x++) {?>


        <div class="col-xl-4">
            <div class="card mb-4">
                <a href="{{ route('GetSingleModule',$allUsers[$x]->identifier) }}"><div class="card-header"><?php echo $allUsers[$x]->name?></div></a>
                <br>
                <?php echo $allUsers[$x]->description?>
                <div class="card-body">
                    <a href="{{ route('GetSingleModule',$allUsers[$x]->identifier) }}"><ion-icon size="Large" name="cog-outline"></ion-icon></a>
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






