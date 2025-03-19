<!-- Dashboard -->
<li class="menu-item active">
    <a href="/dashboard" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
    </a>
</li>



<!-- Menu Pages -->
<li class="menu-header small text-uppercase">
    <span class="menu-header-text">Pages</span>
</li>

<li class="menu-item">
    <a href="/kategoris" class="menu-link" target="_blank">
        <i class="menu-icon tf-icons bx bx-list-ul"></i>
        <div data-i18n="Basic">Kategori Aset</div>
    </a>
</li>

<li class="menu-item">
    <a href="/asets" class="menu-link" target="_blank">
        <i class="menu-icon tf-icons bx bx-archive"></i>
        <div data-i18n="Basic">Data Aset</div>
    </a>
</li>

<li class="menu-item">
    <a href="/penyusutans" class="menu-link" target="_blank">
        <i class="menu-icon tf-icons bx bx-wrench"></i>
        <div data-i18n="Basic">Penyusutan Aset</div>
    </a>
</li>


<!-- Logout -->
<li class="menu-item">
    <a class="menu-link logout-link" href="{{ route('logout') }}"
        onclick="event.preventDefault(); 
       if (confirm('Are you sure you want to logout?')) {
           document.getElementById('logout-form').submit();
       }">
        <i class="menu-icon tf-icons bx bx-log-out"></i> <!-- Ikon Logout -->
        <div>Logout</div>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</li>


</aside>