<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@extends('layouts.navAdmin')
@section('content')



<div>
    <?php
//        dd(count($allUsers));
    ?>
</div>
{{--toon alle modules--}}
<div class="container-xl px-4 mt-4">
    <div class="row">
<?php  for ($x = 0; $x < count($allUsers); $x++) {?>

        <div class="col-xl-4">
            <div class="card mb-4">
                <div class="card-header"><?php echo $allUsers[$x]->name?></div>
                <br>

                <?php echo $allUsers[$x]->description?>
                <div class="card-body">
                    <ion-icon size="Large" name="cog-outline"></ion-icon>
                </div>
            </div>
        </div>
        <?php }?>
