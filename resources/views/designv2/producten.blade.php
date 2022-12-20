@extends( ($userByCookie->rol === 1) ? 'layouts.navBarAdmin' :  'layouts.navBar')
<title>Home</title>


<div class="main-grid-min-nav">
    <div class="wrapped-container">

        <div class="container">
            <h1>Zoek EAN-code :</h1>
            <div class="form-group">
                <input type="text" class="form-control col-sm-6" id="searProduct   ch-table" data-table="movie-list">
                <button class="btn btn-outline-secondary" type="button">Zoeken</button>

                <br><br>
            </div>


            <table class="table" id="movie-list">
                <tbody>
                Gevonden product :
                <tr style="display: table-row;">
                    <td>Zwemshort</td>
                    <td>Maat: M</td>
                </tr>

                </tbody>
            </table>
        </div>

    </div>
</div>

<div class="main-grid-min-nav">
    <div class="wrapped-container">
        <h1>Voorraadverschil :</h1>
            <div class="scroll-bg">
                    <div class="scroll-object">
                        <table id="example" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Voorraad</th>
                                <th>Product</th>
                                <th>Something ?!?!?!</th>
                            </tr>
                            </thead>
                            <tbody><?php
                                   $count = 0;
                                   for ($x = 0; $x < 5; $x++) {?>
                            <div class="perGeberuiker" value={{$count}}>
                                <tr>
                                    <td><?php echo "dddd" ?></td>
                                    <td><?php echo "dddd" ?></td>
                                    <td><?php echo "dddd" ?></td>
                                </tr>
                            </div>
                                <?php
                            }?></tbody></table>
                </div>
            </div>
            </table>
        </div>
    </div>

