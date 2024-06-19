<header>
    <div class="offcanvas offcanvas-start d-flex flex-md-column" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel"></h5>
            <img src="/img/LogoBI.png" style="margin-top:20px" alt="">
        </div>
        <div class="offcanvas-body">
            <a href="/dashboard" class="side-menu d-flex flex-md-row">
                <img src="/img/home.png" style="height:30px" alt="">
                <p>Dashboard</p>
            </a>
            <a href="/reservasi" class="side-menu d-flex flex-md-row">
                <img src="/img/jadwal.png" style="height:30px" alt="">
                <p>Jadwal</p>
            </a>
            <a href="/reservasi/create" class="side-menu d-flex flex-md-row">
                <img src="/img/reservasi.png" style="height:30px" alt="">
                <p>Reservasi</p>
            </a>
            <a href="/reservasi/show" class="side-menu d-flex flex-md-row">
                <img src="/img/cekreservasi.png" style="height:30px" alt="">
                <p>Cek Reservasi</p>
            </a>
            <a href="/template" class="side-menu d-flex flex-md-row">
                <img src="/img/template.png" style="height:30px" alt="">
                <p>Template</p>
            </a>
            <a href="{{ auth()->check() && auth()->user()->isAdmin() ? '/admin/driver' : '/user/driver' }}" class="side-menu d-flex flex-md-row">
                <img src="/img/driver.png" style="height:30px; width:25px; margin-right:2px" alt="">
                <p>Driver</p>
            </a>
            
            <a href="/logout" class="side-menu d-flex flex-md-row" style="margin-top:100px">
                <img src="/img/logout.png" style="height:30px" alt="">
                <p>Logout</p>
            </a>
        </div>
    </div>

    <div class="sidebar p-3">
        <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><img class="logo-putih" src="/img/putih1.png" alt=""></a>
        
        <div class="menu">
            <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><img src="/img/home.png" style="width: 25px" alt=""></a>
            <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><img src="/img/jadwal.png" style="width: 25px" alt=""></a>
            <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><img src="/img/reservasi.png" style="width: 30px" alt=""></a>
            <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><img src="/img/cekreservasi.png" style="width: 30px" alt=""></a>
            <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><img src="/img/template.png" style="width: 25px" alt=""></a>
            <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><img src="/img/driver.png" style="width: 20px" alt=""></a>
        </div>

        <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><img src="/img/logout.png" style="width: 35px; margin-bottom:20px" alt=""></a>
    </div>
</header>