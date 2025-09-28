<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title text-center">Inscription</h2>
        </div>
        <div class="panel-body text-center">
            <form action="signin" method="post">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                        <label for="login" class="form-label">Identifiant</label>
                        <input type="text" class="form-control" id="login" name="login" required>
                        </div>
                    </div>
                    </div>
                
                    <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    </div>
                
                    <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    </div>
                
                    <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="label-name">Nom de l'image</span>
                            <input type="text" class="form-control" name="name"
                                value="<?php if(isset($name)){ echo $name ;}?>" 
                                required aria-describedby="label-name">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="label-link">Lien de l'image</span>
                            <input type="url" class="form-control" name="link"
                                value="<?php if(isset($link)){ echo $link ;}?>" 
                                required aria-describedby="label-link" placeholder="https://exemple.com/image.jpg">
                        </div>
                        <?php if(isset($message)){ echo '<small class="text-danger">'.$message.'</small>'; } ?>
                        </div>
                    </div>
                    </div>
                
                    <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <input type="submit" class="btn btn-primary" name="inscription" value="S'inscrire">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>