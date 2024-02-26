<!-- this file need to included and 
     other all content want to wrap with using the page-content class -->

<div class="loader-wrapper">
    <div class="loader"></div>
    <div>
        <img class="load-img" src="<?= ROOT ?>/assets/images/amorallogo.png" width="80px" height="80px" alt="loading...">
    </div>
</div>

<script>
    $(window).on("load", function() {
        $(".loader-wrapper").fadeOut(1100);
        $(".page-content").fadeIn(1200);
    });

</script>

<!-- Jquary library -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/loading.css"> -->