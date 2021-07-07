<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>TEST</title>
  </head>
  <body style="background-color:darkgray;">
    <div class="row justify-content-center align-items-center" style="height: 100vh">
        <div class="col-md-12 col-lg-4">
                        <div class="card">
                <div class="card-header text-center">
                    <h1 class="h4">Selamat Datang!</h1>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input class="form-control" type="text" name="" id="nama">
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input class="form-control" type="text" name="" id="alamat">
                        </div>
                </form></div>
                <div class="card-footer">
                    <button type="button" id="submit" class="btn btn-primary">Daftar Member Yuk!</button>
                </div>
            </div>
        </div>
    </div>
    <script text="text/javascript">
        $('#submit').on('click', function() {
            let nama = $('#nama').val()
            let alamat = $('#alamat').val()
            let url = `https://api.whatsapp.com/send?phone={6281907861308}&text=!daftar@${nama}@${alamat}`
            window.open(url, '_blank')
        })
    </script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>