<?php
/*template name: stockists*/

get_header();
wp_head();  

 
?>

   <section class="new-stoctic-banner" id="all-page-header-space">
    	<div class="container"> 
    		<div class="row">
    			<div class="stockists-he-c">
    				<h2>STOCKISTS</h2>
    			</div>
    			<div class="stoticks-right-image">
    				<img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/Butcher_Large_3.png">
    			</div>
    			<!-- <div class="nighohood-stor-text">
    				<p>neighbourhood butchers and pet stores.</p>
    			</div> -->
    		</div>
    	</div>
    </section>
    <section class="map-sec">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
          </div>
        </div>
      <div class="alwas-way-dog">
        <h2 class="find-h3">The butcher’s dog was always the fittest and healthiest dog in the neighbourhood and it’s no different today.</p>
      </div>
      <div class="three-bae-rr">
         <?php echo do_shortcode('[wpsl map_type="roadmap" auto_locate="true" start_marker="red" store_marker="blue"]');?>
      </div>
    </section>
    <section class="become-stocsk-last">
      <div class="container">
        <div class="row">
          <div class="main-become-top">
            <div class="card-b-c-fi">
              <h3>Become a Stockist</h3>
            </div>
            <div class="card-b-c-se">
              <p>If you are a Butcher Shop or Pet store owner who would like to stock our products, please get in touch.</p>
            </div>
            <div class="card-b-c-th">
              <a href="<?php echo get_site_url();?>/contact">Get in touch</a>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
 $crack = explode("/",$actual_link);
 //print_r($crack);
 ?>

   
<?php wp_footer(); ?> 
<?php
get_footer();
?>