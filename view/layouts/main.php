
<?php
function getErrorMessage($key, $type){
    return $_SESSION['error'][$key][$type] ?? null;
}

function condition($key, $type = "empty"){
    return isset($_SESSION['error']) && isset($_SESSION['error'][$key][$type]);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/asset/css/style.css">
    <script src="https://unpkg.com/imask"></script>
    <title>User Page</title>
</head>
<body onload="clearSession()">

<?php
 if(isset($_GET) && isset($_GET['id'])){
     require_once 'view/user-page-edit.php';
 }
 else {
     require_once 'view/user-page.php';
     require_once 'view/widget/table.php';
 }
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="view/asset/js/script.js"></script>
</body>
</html>