<div id="back"></div>
<div class="login-box register-page">
    <div class="" style="">
      
       <img src="views/img/plantilla/horqueta.png" class="img-responsive" style="width:100%" alt="">
    </div>

    <div class="login-box-body">
        <p class="login-box-msg" style="font-size:30px">Inicia Sesión</p>

        <form  method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="usuario" name="usuario" required  style="font-size:20px">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password" required style="font-size:20px">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
             
     
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">ingresar</button>
                </div>
      
            </div>
            <?php 
                $login = new UsuarioController();
                $login->login();
            ?>
          
        </form>


    </div>

</div>

