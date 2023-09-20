<div class="woo_amc_open <?php echo $options['button_position']; ?><?php if ($cart_count) { echo ' woo_amc_open_active'; } ?>">
    <div class="woo_amc_open_image">
        <?php if ($cart_count>0) { ?>
        <!-- svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 99.91 100.28"><defs><style>.cls-1{fill:#ccc;}</style></defs><g id="Artwork"><path class="cls-1" d="M94.4,29.79A9,9,0,0,0,89.9,22L54.67,1.65a9,9,0,0,0-9,0L10.43,22a9,9,0,0,0-4.5,7.79v40.7a9,9,0,0,0,4.5,7.79L45.68,98.62a9,9,0,0,0,9,0L89.92,78.28a9,9,0,0,0,4.49-7.79ZM48.68,6.85a3,3,0,0,1,3,0l16.39,9.47L87.25,27.48l.13.1L72.7,35.85,35.39,14.53ZM47,92.46,13.44,73.07a3,3,0,0,1-1.5-2.58v-37L45.69,52.94a8.44,8.44,0,0,0,1.33.62Zm1.67-44.73L13.3,27.3l.14-.1L29.37,18,66.68,39.33l-14.56,8.4A3.42,3.42,0,0,1,48.69,47.73ZM86.91,73.07,53,92.64V53.82a9.56,9.56,0,0,0,2.09-.88L88.39,33.46l0,37A3,3,0,0,1,86.91,73.07Z"/></g></svg> -->

        <img src="https://thebutchersdog.com.au/wp-content/uploads/2021/04/TBD_Cart-Full.png" class="fullnormal">
        <img src="https://thebutchersdog.com.au/wp-content/uploads/2021/04/TBD_Cart-Full_Hover.png" class="fullnormalhover">
        
    <?php }
    else
        {
        ?>

<!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 99.91 100.28"><defs><style>.cls-1{fill:#97999b;}</style></defs><g id="Artwork"><path class="cls-1" d="M48.26,49.15,38.17,67.43,6.68,49.24l5.16-20.33L6.17,27.05s-6,22.76-6,23.42a3.29,3.29,0,0,0,1.52,2.77l35.49,20.7a3.26,3.26,0,0,0,1.78.52A3.31,3.31,0,0,0,41.67,73l5.24-10.41Z"/><path class="cls-1" d="M94.1,29.85h-6a3,3,0,0,0-1.49-2.59L51.41,6.94a3,3,0,0,0-3,0L13.24,27.26a3,3,0,0,0-1.49,2.59h-6a9,9,0,0,1,4.49-7.78L45.43,1.75a9,9,0,0,1,9,0l35.2,20.32A9,9,0,0,1,94.1,29.85Z"/><path class="cls-1" d="M49.92,99.78a9,9,0,0,1-4.49-1.2L10.24,78.26a9,9,0,0,1-4.49-7.78V53.84h6V70.48a3,3,0,0,0,1.49,2.59L48.43,93.39a3,3,0,0,0,3,0l35.2-20.32a3,3,0,0,0,1.49-2.59V54.31h6V70.48a9,9,0,0,1-4.49,7.78L54.41,98.58A8.94,8.94,0,0,1,49.92,99.78Z"/><path class="cls-1" d="M50.15,54.22A9.4,9.4,0,0,1,45.44,53L9.69,32.32l3-5.19L48.44,47.77a3.42,3.42,0,0,0,3.42,0L87.61,27.13l3,5.19L54.86,53A9.4,9.4,0,0,1,50.15,54.22Z"/><rect class="cls-1" x="46.77" y="4.36" width="6" height="92.61"/><path class="cls-1" d="M51.6,49.17,61.69,67.45,93.18,49.26,88,28.93l5.67-1.86s6,22.76,6,23.42a3.29,3.29,0,0,1-1.52,2.77L62.71,74a3.26,3.26,0,0,1-1.78.52A3.31,3.31,0,0,1,58.19,73L52.7,62.87Z"/></g></svg> -->
    <img src="https://thebutchersdog.com.au/wp-content/uploads/2021/04/TBD_Cart-Empty.png" class="normal">
    <img src="https://thebutchersdog.com.au/wp-content/uploads/2021/04/TBD_Cart-Empty_Hover.png" class="normalhover">

    

    <?php } ?>
    </div>
    <div class="woo_amc_open_count"><?php echo $cart_count; ?></div>
</div>
