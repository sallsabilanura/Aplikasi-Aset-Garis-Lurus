@can('is-admin')
<!-- Dashboard -->
<li class="menu-item active">
    <a href="/dashboard" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
    </a>
</li>

<!-- Menu Pages -->
<li class="menu-header small text-uppercase">
    <span class="menu-header-text">Data-data user</span>
</li>

<li class="menu-item">
    <a href="/users" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div data-i18n="Basic">Lihat User</div>
    </a>
</li>



<!-- Menu Pages -->
<li class="menu-header small text-uppercase">
    <span class="menu-header-text">Aset-aset user</span>
</li>


<li class="menu-item">
    <a href="/kategoris" class="menu-link">
        <i class="menu-icon tf-icons bx bx-list-ul"></i>
        <div data-i18n="Basic">Kategori Aset</div>
    </a>
</li>


<li class="menu-item">
    <a href="/asets" class="menu-link">
        <i class="menu-icon tf-icons bx bx-archive"></i>
        <div data-i18n="Basic">Data Aset</div>
    </a>
</li>

<li class="menu-item">
    <a href="/penyusutans" class="menu-link">
        <i class="menu-icon tf-icons bx bx-wrench"></i>
        <div data-i18n="Basic">Penyusutan Aset</div>
    </a>
</li>

<li class="menu-item">
    <a href="/penghapusan" class="menu-link">
        <i class="menu-icon tf-icons bx bx-trash"></i>
        <div data-i18n="Basic">Penghapusan Aset</div>
    </a>
</li>

<!-- Menu Pages -->
<li class="menu-header small text-uppercase">
    <span class="menu-header-text">Aplikasi</span>
</li>
<li class="menu-item">
    <a href="/testimonials" class="menu-link">
        <i class="menu-icon tf-icons bx bx-star"></i>
        <div data-i18n="Basic">Rating Aplikasi dari Pengguna</div>
    </a>
</li>
<li class="menu-item">
    <a href="/kontak" class="menu-link">
        <i class="menu-icon tf-icons bx bx-envelope"></i>
        <div data-i18n="Basic">Kontak Kami</div>
    </a>
</li>

@endcan


@can('is-instansi')
<!-- Dashboard -->
<li class="menu-item active">
    <a href="/dashboard" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
    </a>
</li>



<!-- Menu Pages -->
<li class="menu-header small text-uppercase">
    <span class="menu-header-text">Aset-aset</span>
</li>

<li class="menu-item">
    <a href="/kategoris" class="menu-link">
        <i class="menu-icon tf-icons bx bx-list-ul"></i>
        <div data-i18n="Basic">Kategori Aset</div>
    </a>
</li>

<li class="menu-item">
    <a href="/asets" class="menu-link">
        <i class="menu-icon tf-icons bx bx-archive"></i>
        <div data-i18n="Basic">Data Aset</div>
    </a>
</li>

<li class="menu-item">
    <a href="/penyusutans" class="menu-link">
        <i class="menu-icon tf-icons bx bx-wrench"></i>
        <div data-i18n="Basic">Penyusutan Aset</div>
    </a>
</li>
<li class="menu-item">
    <a href="/penghapusan" class="menu-link">
        <i class="menu-icon tf-icons bx bx-trash"></i>
        <div data-i18n="Basic">Penghapusan Aset</div>
    </a>
</li>
<!-- Menu Pages -->
<li class="menu-header small text-uppercase">
    <span class="menu-header-text">Aplikasi</span>
</li>
<li class="menu-item">
    <a href="/testimonials" class="menu-link">
        <i class="menu-icon tf-icons bx bx-star"></i>
        <div data-i18n="Basic">Beri Rating Aplikasi</div>
    </a>
</li>
<li class="menu-item">
    <a href="/kontak" class="menu-link">
        <i class="menu-icon tf-icons bx bx-envelope"></i>
        <div data-i18n="Basic">Kontak Kami</div>
    </a>
</li>


@endcan


</aside>