        <link href="{{ asset('css/dashboardOld.css') }}" rel="stylesheet">
<div class="divRegister">
 <!-- Navigatie -->
 <div class="container1">
          <div class="row">
              <ul class="nav justify-content-center">
                <li class="nav-item">
                  <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/Accounts">Accounts</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/">Api</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/">Webshop</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('login')}}">Uitloggen</a>
                </li>
              </ul>

            </div>
          </div>


          <!-- testing -->
          <div class="boxes">
            <div class="one box">
              <h1>Box 1</h1>
                <p>T1estTEst Test TEST TestTEst Test TEST TestTEst Test TEST</p>
                <p>TestTEst Test TEST TestTEst Test TEST TestTEst Test TEST</p>
            </div> 
            <div class="two box">
              <h1>Box 2</h1>
              <p>TestTEst Test TEST TestTEst Test TEST TestTEst Test TEST</p>
              <p>TestTEst Test TEST TestTEst Test TEST TestTEst Test TEST</p>
            </div> 
            <div class="three box">
              <h1>Box 3</h1>
              <p>TestTEst Test TEST TestTEst Test TEST TestTEst Test TEST</p>
              <p>TestTEst Test TEST TestTEst Test TEST TestTEst Test TEST</p>
            </div>
            <div class="one box">
              <h1>Box 4</h1>
                <p>TestTEst Test TEST TestTEst Test TEST TestTEst Test TEST</p>
                <p>TestTEst Test TEST TestTEst Test TEST TestTEst Test TEST</p>
                <?php
                  try {
                    \DB::connection()->getPDO();
                    echo \DB::connection()->getDatabaseName();
                  } catch (\Exception $e) {
                    echo 'None';
                  }

                  



                  
                ?>
            </div>  
          </div>
          <strong>Database Connected: </strong>


        



