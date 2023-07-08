<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php require_once 'src/components/menu.php'; ?>
    <div class="container">
        <h2>Profile <?php echo $this->d['user']->getUsername(); ?>
                 </h2>
        

        
        <?php
            $user = $this->d['user'];
            $posts= $user->getPosts();
            // dd($user,$posts);

            foreach ($posts as $p){?>
                <div class="card mt-2">
                    <div class="card-body">
                    <img class="rounded-circle" src="public/img/photos/<?php echo $p->getUser()->getProfile() ?>" width="32" />
                        <?php echo $p->getUser()->getUsername() ?>  
                    </div>
                    <img src="public/img/photos/<?php echo $p->getImage() ?>" width="100%" />
                    <div class="card-body">
                        
                        <div class="card-title">
                            <form action="/instagram/addLike" method="POST">
                                <input type="hidden" name="post_id" value="<?php echo $p->getId() ?>">
                                <input type="hidden" name="origin" value="profile/<?php echo $user->getUsername() ?>">
                                <button type="submit" class="btn btn-danger"><?php echo $p->getLikes(); ?> Likes</button>
                            </form>
                        </div>
                        <p class="card-text"><?php echo $p->getTitle() ?></p>
                    </div>
                </div>
                


           <?php }  ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html