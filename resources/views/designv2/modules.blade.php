@extends( ($userByCookie->rol === 1) ? 'layouts.navBarAdmin' :  'layouts.navBar')
@section('content')

<style>
    .bcolor{
        color: blue;
    }
    .uninstall{
        color: red;
    }
    .install{
        color: green;
    }

    @media screen and (max-width: 1770px){
        .row{
            margin-left: 15% !important;
        }
    }
    @media screen and (max-width: 1500px){
        .row{
            margin-left: 20% !important;
        }
    }
    </style>






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
                            <?php if (!$boolModule[$x] === true){?>
                        <span class="install"><a href="{{ route('EnableSingleModule',$allUsers[$x]->identifier) }}">Install</a></span><?php }
                                                                                                         else{?><span class="uninstall"><a href="{{ route('DisableSingleModule',$allUsers[$x]->identifier) }}">Uninstall</a></span><?php } ?>

                        &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

                        <?php if (!$boolModule[$x] === true){?>
                        <a href="{{ route('EnableSingleModule',$allUsers[$x]->identifier) }}"></a><?php }
                        else{?><span class="bcolor"><a href=" {{ route('GetSingleModule',$allUsers[$x]->identifier) }}">Bekijk instellingen</a></span><?php } ?>

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
                                <th>Status</th>
                                <th>Date</th>
                                <th>Message</th>
                            </tr>
                            </thead>
                            <tbody><?php
                                   $count = 0;
                                   for ($x = 0; $x < count($allLogs->logs); $x++) {?>
                            <div class="perGeberuiker" value={{$count}}>
                                <tr>
                                    <td><?php echo $allLogs->logs[$x]->status; ?></td>
                                    <td><?php echo $allLogs->logs[$x]->logDate; ?></td>
                                    <td><?php echo $allLogs->logs[$x]->message; ?></td>
                                </tr>
                            </div>
                                <?php
                            }?></tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">VERWIJDER DE KLANT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Weet je zeker dat je deze klant wilt verwijderen
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<script>

    var myModal = document.getElementById('exampleModal')
    var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus()
    })
</script>
