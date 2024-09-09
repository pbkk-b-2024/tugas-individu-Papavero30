<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo e(config('app.name')); ?> - Page Not Found</title>

    <link href="https://bootswatch.com/5/minty/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="display-4 mt-5"><i class="fas fa-exclamation-triangle"></i> Oops!</h1>
                <p class="lead">The page you're looking for doesn't exist.</p>
                <a href="<?php echo e(url('/')); ?>" class="btn btn-primary mt-3"><i class="fas fa-home"></i> Go Back Home</a>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH D:\Materi Kuliah wajib\PBKK\Testing Laravel Project\ETS-FP_MuhammadNabilFadhil\PBKK-ETS_MuhammadNabilFadhil\resources\views/layout/fallback.blade.php ENDPATH**/ ?>