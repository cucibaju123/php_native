<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-category">Main Menu</li>
        <li class="nav-item">
            <a class="nav-link" href="./dashboard.php">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <?php if ($_SESSION["role"] === "admin") { ?>
            <li class="nav-item">
                <a class="nav-link" href="../nasabah/home.php">
                    <i class="menu-icon typcn typcn-shopping-bag"></i>
                    <span class="menu-title">Nasabah</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../rekening/home.php">
                    <i class="menu-icon typcn typcn-shopping-bag"></i>
                    <span class="menu-title">Nasabah</span>
                </a>
            </li>
        <?php } elseif ($_SESSION["role"] === "user") { ?>
            <li class="nav-item">
                <a class="nav-link" href="localhost/rekening/home.php">
                    <i class="menu-icon typcn typcn-shopping-bag"></i>
                    <span class="menu-title">Apa we</span>
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>