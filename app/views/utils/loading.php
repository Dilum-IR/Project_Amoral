<div class="loader-wrapper">
    <div class="loader"></div>
    <div class="">
        <img src="<?= ROOT ?>/assets/images/amorallogo.png" width="80px" height="80px" alt="">
    </div>
</div>

</div>
<script>
    $(window).on("load", function() {
        $(".loader-wrapper").fadeOut(1400);
        $(".page-content").fadeIn(1500);
    });
</script>