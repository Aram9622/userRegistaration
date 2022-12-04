<?php

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $user = \App\Helper\DB::select('users', "WHERE id = $id");
    $favorites = \App\Helper\DB::select('favorites');
}
else {
    header('Location: /');
}

?>

<div class="col-md-6 m-auto">
    <form class="p-3" action="/user.php?action=update&id=<?= $id?>" method="post">
        <div class="form-group row">
            <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10">
                <input type="text" name="first_name" id="first_name" class="form-control" value="<?= $user['first_name']?>">
                <?php
                if(condition("firstName")) :
                    ?>
                    <p><span class="text-danger"><?= getErrorMessage('firstName', 'empty')?></span></p>
                <?php endif;?>

            </div>
        </div>
        <div class="form-group row">
            <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
                <input type="text" name="last_name" id="last_name" class="form-control" value="<?= $user['last_name']?>">
                <?php
                if(condition("lastName")) :
                    ?>
                    <p><span class="text-danger"><?= getErrorMessage('lastName', 'empty')?></span></p>
                <?php endif;?>
            </div>
        </div>
        <div class="form-group row">
            <label for="date" class="col-sm-2 col-form-label">Date of Birth</label>
            <div class="col-sm-10">
                <input type="date" name="date" id="date" class="form-control" value="<?= $user['date']?>">
                <?php
                if(condition("date")) :
                    ?>
                    <p><span class="text-danger"><?= getErrorMessage('date', 'empty')?></span></p>
                <?php endif;?>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email Address</label>
            <div class="col-sm-10">
                <input type="text" name="email" id="email" class="form-control" value="<?= $user['email']?>">
                <?php
                if(condition("email")) :
                    ?>
                    <p><span class="text-danger"><?= getErrorMessage('email', 'empty')?></span></p>
                <?php endif;?>
                <?php
                if(!empty(getErrorMessage("email", "notValid"))):
                    ?>
                    <p><span class="text-danger"><?= getErrorMessage('email', 'notValid')?></span></p>
                <?php endif;?>
            </div>
        </div>
        <div class="form-group row">
            <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
            <div class="col-sm-10">
                <input type="text" name="phone" id="phone" class="form-control" value="<?= $user['phone']?>" placeholder="Example (999) 999-9999">
                <?php
                if(condition("phone")) :
                    ?>
                    <p><span class="text-danger"><?= getErrorMessage('phone', 'empty')?></span></p>
                <?php endif;?>
                <?php
                if(condition("phone", "notValid")) :
                    ?>
                    <p><span class="text-danger"><?= getErrorMessage('phone', 'notValid')?></span></p>
                <?php endif;?>
                <?php
                if(condition("phone", "exists")) :
                    ?>
                    <p><span class="text-danger"><?= getErrorMessage('phone', 'exists')?></span></p>
                <?php endif;?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2">Favorite sports</div>
            <div class="col-sm-10">
                <?php
                $favoriteJson = json_decode($user['favorites']);
                foreach ($favorites as $favorite) :
                    ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               id="gridCheck1"
                               name="favorites[]"
                               value="<?= $favorite['id']?>"
                               <?= in_array($favorite['id'], $favoriteJson) ? "checked" : "" ?>
                            >
                        <label class="form-check-label" for="gridCheck1">
                            <?= $favorite['name']?>
                        </label>
                    </div>
                <?php endforeach;?>
                <?php
                if(condition("favorites")) :
                    ?>
                    <p><span class="text-danger"><?= getErrorMessage('favorites', 'empty')?></span></p>
                <?php endif;?>
                <?php
                if(condition("favorites", 'isArray')) :
                    ?>
                    <p><span class="text-danger"><?= getErrorMessage('favorites', 'isArray')?></span></p>
                <?php endif;?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-secondary">Save</button>
            </div>
        </div>
    </form>
</div>

