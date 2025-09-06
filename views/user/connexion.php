<div class="container ">
    <div class="panel panel-default ">
        <div class="panel-heading">
            <h2 class="panel-title text-center">Connexion</h2>
        </div>
        <div class="panel-body text-center ">
            <form action="login" method="post">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <label for="email">Adresse e-mail </label>
                            <input type="email" class='form-control' id="email" name="email" required>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <label for="password">Mot de passe </label>
                            <input type="password" class='form-control' id="password" name="password" required>
                        </div>
                        <p><?php if(isset($message)){ echo ($message) ; } ?><p>
                    </div>
                </div>
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-md-6 col-md-offset-3">
                        <input type="submit" class="btn btn-primary" name='connexion' value="Se connecter">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>