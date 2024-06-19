<div class="navigasibar">
    <div class="img-header">
        <img src="/img/grpk.jpg" id="img-header" alt="Logo">
    </div>
    <div class="nav-profile">
        <p class=" p-2 "><?php $dateWaktu=\Carbon\Carbon::today()->translatedFormat('d F Y');
        echo $dateWaktu;
        ?></p> <p class=" p-2 ">{{ auth()->user()->username }}</p>
    </div>
</div>
<script>
    function removeImageOnSmallScreen() {
        if (window.innerWidth <= 476) {
            var img = document.getElementById('img-header');
            if (img) {
                img.parentNode.removeChild(img);
            }
        }
    }
    window.onload = removeImageOnSmallScreen;
    window.onresize = removeImageOnSmallScreen;
</script>