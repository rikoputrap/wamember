<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Daftar Member</h1>
    <form action="<?php echo e(url('/member')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <label for="">Nama</label>
        <input type="text" name="name" id="">
        <label for="">Alamat</label>
        <input type="text" name="address" id="">
        <button type="submit">Daftar</button>
    </form>
</body>

</html><?php /**PATH C:\laragon\www\wamember\larauser\resources\views/member/index.blade.php ENDPATH**/ ?>