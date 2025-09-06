<div class="container ">
    <div class="panel panel-default ">
        <div class="panel-heading">
            <h2 class="panel-title text-center"><?php if(isset($fonction)){ echo $fonction ; }?> un livre</h2>
        </div>
        <div class="panel-body text-center ">
            <form method="post">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <label for="title">Titre </label>
                            <input type="text" class='form-control' id="title" name="title" value="<?php if(isset($title)){ echo $title ;}?>"required>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <label for="author">Auteur </label>
                            <input type="text" class='form-control' id="author" name="author" value="<?php if(isset($author)){ echo $author ;}?>" required>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off" name="disponibility" value="1" checked>
                            <label class="btn btn-outline-success" for="btncheck2">Disponible</label>
                        </div>
                    </div>
                </div>
                <div class="mb-10 row d-flex justify-content-center align-items-center">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <label for="pageNumber">Nombre de pages </label>
                            <input type="number" class='form-control' id="pageNumber" name="pageNumber" value="<?php if(isset($pageNumber)){ echo $pageNumber ;}?>" required>
                        </div>
                        <p class="text-danger"><?php if(isset($message)){ echo ($message) ; } ?><p>
                    </div>
                </div>
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-md-6 col-md-offset-3">
                        <input type="submit" class="btn btn-primary" name='<?php if(isset($fonction)){echo $fonction ; }?>' value="<?php if(isset($fonction)){echo $fonction ; }?> le livre">
                          <input type="hidden" class='form-control' id="book_id" name="book_id" value="<?php if(isset($id)){ echo $id ;}?>" required>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>