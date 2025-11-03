<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
      <p style="padding-top: 10px;">
        <img src="./dist/assets/img/sidarsip.jpeg" alt="logo-sidarsip" width="200px">
      </p>
    </div>
    <ul class="c-sidebar-nav">
      <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="?page=beranda">
          <svg class="c-sidebar-nav-icon">
            <use xlink:href="./coreui/icons/sprites/free.svg#cil-speedometer"></use>
          </svg>Beranda</a>
      </li>
      <li class="c-sidebar-nav-title">Menu</li>
      <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="?page=files-upload">
          <svg class="c-sidebar-nav-icon">
            <use xlink:href="./coreui/icons/sprites/free.svg#cil-cloud-upload"></use>
          </svg>Files Upload</a>
      </li>
      <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="?page=pengajuan-kurikulum">
          <svg class="c-sidebar-nav-icon">
            <use xlink:href="./coreui/icons/sprites/free.svg#cil-notes"></use>
          </svg>Pengajuan Kurikulum</a>
      </li>
      <li class="c-sidebar-nav-item" style="<?= is_superadmin() ? '' : 'display:none;' ?>"><a class="c-sidebar-nav-link" href="?page=institusi">
          <svg class="c-sidebar-nav-icon">
            <use xlink:href="./coreui/icons/sprites/free.svg#cil-school"></use>
          </svg>Institusi</a>
      </li>
      <li class="c-sidebar-nav-item" style="<?= is_superadmin() ? '' : 'display:none;' ?>"><a class="c-sidebar-nav-link" href="?page=users">
          <svg class="c-sidebar-nav-icon">
            <use xlink:href="./coreui/icons/sprites/free.svg#cil-user"></use>
          </svg>Users</a>
      </li>
    </ul>
    <div class="c-sidebar-bottom">
      <a href="?page=logout" class="c-sidebar-nav-link">
        <svg class="c-sidebar-nav-icon">
          <use xlink:href="./coreui/icons/sprites/free.svg#cil-account-logout"></use>
        </svg>
        Logout
      </a>
    </div>
</div>