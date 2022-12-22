@extends( ($userByCookie->rol === 1) ? 'layouts.navBarAdmin' :  'layouts.navBar')
<title>Home</title>


<div class="main-grid-min-nav">
    <div class="wrapped-container">
      <div class="table-wrapper box">

        <div class="container">
            <form method="POST" action="{{ route('checkEanCode') }}" >
                @csrf
                    <h1>Zoek EAN-code :</h1>
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
            <table class="table" id="movie-list">
                <thead>
                <tr>
                    <th>Ean code</th>
                    <th>Reference</th>
                    <th>Bol-id</th>
                    <th>prijs</th>
                    <th>productnaam</th>
                    <th>Conditie</th>
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
    </div>
</div>


<div class="main-grid-min-nav">
    <div class="wrapped-container">
      <div class="table-wrapper box">
        <h1>Producten :</h1>
            <div class="scroll-bg">
                    <div class="scroll-object">
                        <table id="example" class="table table-striped table-hover user-table">
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
{{--                            Op het moment dat er geen producten beken zijn.--}}
                            <?php
                                   if (in_array("error", $allProducts))
                                   {?>
                                    <div class="perGeberuiker">
                                       <tr>
                                           <td><?php echo "Geen producten gevonden" ?></td>
                                       </tr>
                                    </div><?php
                                   }?>
                        {{--Op het moment dat er wel producten bekend zijn.--}}
                            <?php if (!in_array("error", $allProducts))
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
                                            } ?>
                                        </tr>
                                    </div> <?php
                                    }
                                   } ?></tbody></table>
                </div>
            </div>
            </table>
        </div>
      </div>
    </div>

