@extends( ($userByCookie->rol === 1) ? 'layouts.navBarAdmin' :  'layouts.navBar')
<title>Home</title>
@section('content')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <script
        src="http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>



    <div class="main-grid-min-nav">
    <div class="wrapped-container">
        <div class="WelkomBanner">
            <h2>Zoek EAN-code :</h2>
            <p><span class="welkomBol">Hier kunt u een product opzoeken o.b.v. EAN codes</span></p>
        </div>

      <div class="table-wrapper box">
        <div class="container">
            <form method="POST" action="{{ route('checkEanCode') }}" >
                @csrf
                    <div class="form-group">
                        <input type="text" class="form-control col-sm-6" id="searProduct   ch-table" data-table="movie-list" name="EanInput">
                        <button class="btn btn-outline-secondary" type="submit">Zoeken</button>
                        <br><br>
                    </div>
            </form>

            <?php if (!empty($EanResponse)){
            if ($EanResponse == 'Geen producten gevonden!'){ ?>
            <table class="table table-striped table-hover">
                <tbody>
                Geen product gevonden
                </tbody>
            </table><?php
            }
            else{ ?>

            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            {{--            <table class="table" id="movie-list">--}}
                <thead>
                <tr>
                    <th class="th-sm">Ean code</th>
                    <th class="th-sm">Reference</th>
                    <th class="th-sm">Bol-id</th>
                    <th class="th-sm">prijs</th>
                    <th class="th-sm">productnaam</th>
                    <th class="th-sm">Conditie</th>
                </tr>
                </thead>
                <tbody>
                Gevonden product :
                <tr style="display: table-row;">
                    <td><?php echo $EanResponse[0]->ean ?></td>
                    <td><?php echo $EanResponse[0]->reference ?></td>
                    <td><?php echo $EanResponse[0]->offerId ?></td>
                    <td><?php echo $EanResponse[0]->pricing->bundlePrices[0]->unitPrice ?></td>
                    <td><?php echo $EanResponse[0]->store->productTitle ?></td>
                    <td><?php echo $EanResponse[0]->condition->name ?></td>
                </tr>
                </tbody>
            </table>
            <?php } } ?>
        </div>
      </div>




      <div class="WelkomBanner">
        <h2>Producten :</h2>
          <p><span class="welkomBol">Overzicht van al uw producten</span></p>
      </div>

      <div class="table-wrapper box">
            <div class="scroll-bg">
                <div class="container">
                    <table class="table table-fluid table table-striped table-hover user-table" id="myTable">
                        <thead>
                            <tr>
                                <th>WooId</th>
                                <th>Bol stock</th>
                                <th>Woo stock</th>
                                <th>Ean</th>
                                <th>Warning</th>
                            </tr>
                        </thead>
                        <tbody>
{{--                    Op het moment dat er geen producten beken zijn.--}}
                            <?php
                                if (empty($allProducts))
                                {?>

                                    <div class="perGeberuiker">
                                       <tr>
                                           <td><?php echo "Geen producten gevonden" ?></td>
                                       </tr>
                                    </div><?php
                                }?>
                        {{--Op het moment dat er wel producten bekend zijn.--}}
                            <?php
                            if (!empty($allProducts))
                                {
                                    for ($x = 0; $x < count($allProducts); $x++) {?>
                                    <div class="perGeberuiker">
                                        <tr>
                                            <td><?php echo $allProducts[$x]->wooId ?></td>
                                            <td><?php echo $allProducts[$x]->bolStock ?></td>
                                            <td><?php echo $allProducts[$x]->wooStock ?></td>
                                            <td><?php echo $allProducts[$x]->ean ?></td>
                                            <?php if ($allProducts[$x]->bolStock != $allProducts[$x]->wooStock){ ?>
                                            <td><input type="checkbox" unchecked onclick="return false;"></td> <?php
                                            } else{?>
                                            <td><input type="checkbox" checked onclick="return false;"></td> <?php
                                            }?>
                                        </tr>
                                    </div> <?php
                                    }
                                   } ?>
                        </tbody>
                    </table>
                </div>
            </div>
      </div>
    </div>
  </div>
        <script>
            $(document).ready( function () {
                $('#myTable').DataTable();
            } );
        </script>



