<?php
use App\Helper\DB;

$users = DB::select('users');

?>

<table class="table table-hover">
    <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Favorites</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
    foreach ($users as $user):

        $favorites = json_decode($user['favorites'], true);
        ?>
    <tr>
        <td><?= $user['id']?></td>
        <td><?= $user['first_name']?></td>
        <td><?= $user['last_name']?></td>
        <td><?= $user['date']?></td>
        <td><?= $user['email']?></td>
        <td><?= $user['phone']?></td>
        <td>
            <?php
                foreach ($favorites as $favorite) :
                    $favoriteName = DB::select('favorites', "WHERE id=$favorite");

            ?>
            <span class="favorites"><?= $favoriteName['name']?></span>
            <?php endforeach;?>
        </td>
        <td><a href="/?id=<?= $user['id']?>" class="btn btn-primary">Edit</a></td>
        <td><a href="/user.php?action=delete&id=<?=$user['id']?>" class="btn btn-danger">Delete</a></td>
    </tr>
    <?php endforeach;?>



</table>