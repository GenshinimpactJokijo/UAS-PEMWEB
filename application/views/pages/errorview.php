<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Acccess Error</title>
</head>
<body>
    <div class="position-absolute top-50 start-50 translate-middle">
        <h1 class="text-danger text-center" style="font-size: 5rem;"><b>ERROR</b></h1>
        <p class="text-center" style="font-size: 1rem;">
            You don't have access to this page<br>
            Click <a href="<?= base_url("index.php/Home"); ?>">here</a> to go back
        </p>
    </div>
</body>
</html>