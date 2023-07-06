<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h2>Home <?php echo $this->d['user']->getUsername(); ?></h2>
        <?php require_once 'src/components/create.php'; ?>
    </div>
    
</body>
</html