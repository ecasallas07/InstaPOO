<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="create">
        <form action="/instagram/publish" method="POST" enctype="multipart/form-data">
            <textarea class="form-control mb-2" name="title" rows="3"></textarea>

            <div class="d-flex justify-content-between">
                <input type="file" class="w-50" name="image" > <!--Con el atributo accept como validacion-->
                <input type="submit" class="btn btn-primary w-25" value="Publicar">
            </div>
        </form>
    </div>
    
</body>
</html>