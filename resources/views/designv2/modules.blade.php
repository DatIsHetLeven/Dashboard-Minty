@extends( ($userByCookie->rol === 1) ? 'layouts.navBarAdmin' :  'layouts.navBar')
<title>Modules</title>
@section('content')

<style>
    a.install-btn button {
    background-color: #1bbd8e!important;
    color: #fff;
}
.uninstall button {
    background-color: #dc3545!important;
    color: #fff;
}
</style>

<div class="main-grid-min-nav">
    <div class="wrapped-container">
<div class="WelkomBanner">
        <h2>Modules</h2>
        <p><span class="welkomBol">Stel hier de koppeling naar wens aan</span></p>
    </div>



        <div class="row">
            <?php  for ($x = 0; $x < count($allUsers); $x++) {?>
            <div class="col-xl-4">
                <div class="card mb-4">
                    
                        <?php if($boolModule[$x] == true){?><a href="{{ route('GetSingleModule',$allUsers[$x]->identifier) }}"><div class="card-header"><?php echo $allUsers[$x]->name?></div></a><?php } ?>
                        <?php if($boolModule[$x] == false){?><a href="#"><div class="card-header"><?php echo $allUsers[$x]->name?></div></a><?php } ?>

                    <div class="card-body">  
                        <?php echo $allUsers[$x]->description ?>
                        <div class="button-footer">
                            <?php if (!$boolModule[$x] === true){?>
                                    <span class="install">
                                        <a class="install-btn" href="{{ route('EnableSingleModule',$allUsers[$x]->identifier) }}"><button class="btn btn-primary">Installeren</button></a>
                                    </span>
                            <?php } else{?>
                                <span class="uninstall">
                                    <a href="{{ route('DisableSingleModule',$allUsers[$x]->identifier) }}"><button class="btn btn-primary">Deïnstalleren</button></a>
                                </span>
                            <?php } ?>

                            <?php if (!$boolModule[$x] === true){?>
                                <a href="{{ route('EnableSingleModule',$allUsers[$x]->identifier) }}"></a><?php }
                            else{?>
                                <span class="bcolor">
                                    <a href=" {{ route('GetSingleModule',$allUsers[$x]->identifier) }}">Bekijk instellingen</a>
                                </span>
                            <?php } ?>
                        </div>
                        
                    </div>
                </div>
            </div>

        <?php }?>
    </div>
    <div class="box">
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
                        </div>
<script>

    var myModal = document.getElementById('exampleModal')
    var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus()
    })
</script>
