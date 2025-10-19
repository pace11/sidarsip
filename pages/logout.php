<div class="c-subheader px-3">
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="?page=beranda">Home</a></li>
        <li class="breadcrumb-item active">Logout</li>
    </ol>
</div>
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">Logout Berhasil.
                        <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                </div>
                <?php
                    echo "<meta http-equiv='refresh' content='1;
                    url=login.php'>";
                ?>
            </div>
        </div>
    </div>
</main>