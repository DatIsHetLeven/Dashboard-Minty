
<link href="{{ asset('css/logintest.css') }}" rel="stylesheet"> 
<br><br></br></br>
<h3><span id="minty"> MINTY</span> MEDIA<h3>
<h5><span id="dashboard">DASHBOARD</span></h5>

<div class="formlogin">

  <form method="POST" action="{{ route('set_password') }}">   
    <!-- ANDERE ROUTE?!?!?! -->
  @csrf
    <!-- E-mail invoeren -->
    <label>Wachtwoord</label>
    <p><input type="password" name="password" class="form_login" required autocomplete="email">
    <!-- Wachtwoord invoeren -->
    <label>Herhaal wachtwoord </label>

    <p><input type="password" name="password2" class="form_login" required autocomplete="password">
    <input type="hidden" name="resetToken" value="<?= $_GET['urlode']; ?>"  required>
    

    <!-- Button aanmelden -->
    <input type="submit" name="passwordButton" class="buttonlogin" value="Maak aan">

  </form>

</div>