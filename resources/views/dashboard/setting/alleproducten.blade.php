<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
<link href="{{ asset('css/setting/setting.css') }}" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


<div class="leftColor">
    <div class="container1">
        <div class="row">
            <ul class="nav justify-content-center">
            <span id="MINTY">MINTY</span>
            <li>
                <a href="{{ route('dashboard') }}"><ion-icon size="large" name="home-outline"></ion-icon></a>
            </li>
            <li>
                <a><ion-icon size="large" name="apps-outline"></ion-icon><a>
            </li>
            <li>
                <a href="{{ route('persoonsgegevens') }}"><ion-icon size="large" name="people-outline"></ion-icon></a>
            </li>
            <li>
                <a><ion-icon size="large" name="file-tray-full-outline"></ion-icon></a>
            </li>
            <li>
                <a href="{{ route('allegebruikers') }}"><ion-icon size="Large" name="logo-playstation"></ion-icon></a>
            </li>
            <li>
                <a><ion-icon size="large"  name="settings-outline"></ion-icon></a>
            </li>
            </ul>
        </div>
    </div>
</div>

<div class="alleProducten" class="overlay">
  <div class="table-pos">
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Product</th>
                <th>ProductNaam</th>
            </tr>
        </thead>
    <tbody><?php
    $count = 0;
    for ($x = 0; $x < count($alleProducten); $x++) {?>
      <div class="perGeberuiker" value={{$count}}>
        <tr>
            <td><a href="{{ route('productinfo',$alleProducten[$x]->id) }}"><?php echo $alleProducten[$x]->code; ?></a></td>    
            <td><a href="{{ route('productinfo',$alleProducten[$x]->id) }}"><?php echo $alleProducten[$x]->name; ?></td>
        </tr>
      </div>
        <?php
        }?></tbody></table>
</div>
</div>