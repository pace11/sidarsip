<div class="c-subheader px-3">
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item">Home</li>
    </ol>
</div>
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <?php if (get_user_login('type') == 'superadmin') { ?>
                <div class="col-md-3">
                    <div class="card text-white bg-gradient-info">
                        <div class="card-body">
                            <div class="text-muted text-right mb-4">
                                <svg class="c-icon c-icon-3xl">
                                    <use xlink:href="./coreui/icons/sprites/free.svg#cil-school"></use>
                                </svg>
                            </div>
                            <div class="text-value-lg"><?= count_table('institutions') ?></div>
                            <small class="text-muted text-uppercase font-weight-bold">Institusi</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-gradient-danger">
                        <div class="card-body">
                            <div class="text-muted text-right mb-4">
                                <svg class="c-icon c-icon-3xl">
                                    <use xlink:href="./coreui/icons/sprites/free.svg#cil-notes"></use>
                                </svg>
                            </div>
                            <div class="text-value-lg"><?= count_table('curriculum_submissions') ?></div>
                            <small class="text-muted text-uppercase font-weight-bold">Pengajuan Kurikulum</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-gradient-success">
                        <div class="card-body">
                            <div class="text-muted text-right mb-4">
                                <svg class="c-icon c-icon-3xl">
                                    <use xlink:href="./coreui/icons/sprites/free.svg#cil-user"></use>
                                </svg>
                            </div>
                            <div class="text-value-lg"><?= count_table('users') ?></div>
                            <small class="text-muted text-uppercase font-weight-bold">Users</small>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if (get_user_login('type') != 'superadmin') { ?>
                    <div class="col-md-3">
                        <div class="card text-white bg-gradient-danger">
                            <div class="card-body">
                                <div class="text-muted text-right mb-4">
                                    <svg class="c-icon c-icon-3xl">
                                        <use xlink:href="./coreui/icons/sprites/free.svg#cil-notes"></use>
                                    </svg>
                                </div>
                                <div class="text-value-lg"><?= count_submission() ?></div>
                                <small class="text-muted text-uppercase font-weight-bold">Pengajuan Kurikulum</small>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>