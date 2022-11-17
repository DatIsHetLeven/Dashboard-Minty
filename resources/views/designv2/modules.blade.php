
@extends( ($userByCookie->rol === 1) ? 'layouts.navBarAdmin' :  'layouts.navBar')
@section('content')






{{--<section class="page-content">--}}
{{--    <div class="container rounded bg-white mt-5 mb-5">--}}
{{--        <div class="row">--}}
{{--            <div class="item  col-xs-4 col-lg-4">--}}
{{--                <div class="thumbnail">--}}
{{--                    <img class="group list-group-image" src="http://placehold.it/400x250/000/fff" alt="" />--}}
{{--                    <div class="caption">--}}
{{--                        <h4 class="group inner list-group-item-heading">--}}
{{--                            Order wachtagent plugin</h4>--}}
{{--                        <p class="group inner list-group-item-text">--}}
{{--                            Deze plugin biedt de mogelijkheid om bestellingen van Bol naar WooCommerce te verzenden.--}}
{{--                        </p>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-xs-12 col-md-6">--}}
{{--                                <p class="lead">--}}
{{--                                    €1.000.000 (cash only)</p>--}}
{{--                            </div>--}}
{{--                            <div class="col-xs-12 col-md-6">--}}
{{--                                <a class="btn btn-success" href="#">Downloaden</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
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
