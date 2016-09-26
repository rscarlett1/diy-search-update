<?php

  $this->layout('master', [
    'title'=>'Login to DIY Cleaning Website',
    'desc'=>'Login Page'
  ]);

?>

<main>

  <div class="row container" id="login-center">
    <div class="col-xs-12">
      <div class="form-group">
        <form id="login-form"  action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">

        <h1>Login</h1>
        
        <div id="social-buttons">
        <button type="button" class="btn btn-primary">Facebook</button>
        <button type="button" class="btn btn-success">Google</button>
        </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control input-details" id="input-email" name="email" placeholder="Email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
          </div>

          <?php if( isset ($emailMessage) ):  ?>
          <p> <?= $emailMessage ?></p>
          <?php endif ?>

        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control input-details" id="exampleInputPassword1" name="password" placeholder="Password">
        </div>

        <?php if( isset ($loginMessage) ):  ?>

        <p> <?= $loginMessage ?></p>
      <?php endif ?>
      <input type="submit" value="Login" name="login" class="btn btn-default">
    </form>
    </div>
  </div>
</div>

  
