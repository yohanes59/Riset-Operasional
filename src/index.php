<?php include "./template/header.php"; ?>
<div class="container d-flex justify-content-center py-5">
    <div class="col-sm-10 col-md-8 col-lg-6" id="main-page">
        <div class="jumbotron">
            <h1 class="display-4">Selamat Datang!</h1>
            <p class="lead">Silahkan memasukkan input pada kolom di bawah ini untuk menghitung biaya dengan menggunakan metode Approximation Vogel's.</p>
            <form action="input.php" method="post">
                <table class="table">
                    <tr>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Supply :</label>
                            <input type="text" class="form-control" placeholder="Masukkan Jumlah Baris" name="supply">
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Demand :</label>
                            <input type="text" class="form-control" placeholder="Masukkan Jumlah Kolom" name="demand">
                        </div>
                    </tr>
                </table>
                <button class="btn btn-info btn-md" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php include "./template/footer.php"; ?>