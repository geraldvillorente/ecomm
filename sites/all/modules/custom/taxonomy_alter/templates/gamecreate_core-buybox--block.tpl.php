<div class="cb-module-custom clearfix buybox-wrapper">
<?php
  $counter=0;
  foreach ($items as $item):
    $item_number = $item['NeweggItemNumber'];
    $line_description = $item['LineDescription'];
    $limit_quantity = $item['LimitQuantity'];
    $discount_instant = $item['DiscountInstant'];
    $unit_price = $item['UnitPrice'];
    $price_save_percent = $item['PriceSavePercent'];
    $final_price = $item['FinalPrice'];
    $platform = $item['platform'];
    $shipped_by_newegg = $item['ShipByNewegg'];
    $counter2=0;
    $counter4=0;
    $display="";

    if ($counter > 0) {
     $display = "style='display: none'";
    }
?>
<div class="buybox" id="buybox_<?php print $item_number; ?>"  <?php print $display; ?> >
  <div class="grpSelector">
    <div class="itmSelector">
      <span class="label">Platform: </span>
      <span class="value"><?php print $platform; ?></span>
    </div>
    <div class="itmSelector">
        <?php
        $counter3=0;
        $blessing='';
        $display='';
        ?>
        <?php foreach ($platforms as $val): ?>
        <?php
          if ($platform == $val['first']) {
            $display = "selected";
            $blessing =  $val['second'];
          }
          $current_item = $blessing;
          $is_new_version = strstr($current_item, '-');
          if (!$is_new_version) {
            $next_item = $val['second'];
          }
          else {
            $next_item = "N82E168" . str_replace("-","", $val['second']);
          }
        ?>
        <li class="category-button <?php print $display; ?>" title="<?php print $val['first']; ?>">
          <button onclick="newegg_display_item('<?php print $next_item; ?>','<?php print $current_item; ?>');"><?php print $val['first'];  ?></button>
        </li>
          <?php $counter3++; ?>
        <?php endforeach; ?>
    </div>
  </div>
  <span id="grpDescrip_<?php print $item_number; ?>" itemprop="name"><?php print $line_description; ?></span>
  <div class="buybox-product">
    <div class="grpAside">
      <div class="objImages">
        <a name="gallery" id="gallery_<?php print $item_number; ?>">
          <?php foreach ($item['Images'] as $image): ?>
             <?php if ($counter4 <= 3): ?>
               <?php if($counter4 > 0) {
                  $display = "style='display: none'";
                } else {
                  $display = "";
                }
               ?>
              <span class="mainSlide" id="mainSlide_<?php print $item_number . $counter4; ?>" <?php print $display; ?>">
                <img style="width:164px;height:169px;" title="<?php print $line_description; ?>" alt="<?php print $line_description; ?>" src="<?php print $image['ImageSize300']; ?>">
              </span>
              <?php $counter4++; ?>
            <?php endif; ?>
          <?php endforeach; ?>
        </a>

        <ul class="navThumbs">
          <?php foreach ($item['Images'] as $image): ?>
            <?php if ($counter2 <= 3): ?>
              <li>
                <a class="noLine" href="javascript:void(0)" onmouseover="newegg_display_img('<?php print $item_number; ?>',<?php print $counter2; ?>)" title="<?php print $line_description; ?> (Image <?php print $counter2; ?>)">
                  <img style="width:48px;height:36px;" src="<?php print $image['ImageSize125']; ?>" alt="<?php print $line_description; ?> - image <?php print $counter2; ?>" title="<?php print $line_description; ?> - image <?php print $counter2; ?>">
                </a>
              </li>
            <?php endif; ?>
          <?php $counter2++; ?>
          <?php endforeach; ?>
        </ul>

        <span id="skipImageGallery"></span>
        <span class="note"></span>
      </div>
    </div>
  </div><!--buybox-product-->
  <div class="buybox-details">
    <ul class="price">
        <span class="price-current-label"></span> $<?php print $final_price; ?>
    </ul>
    <div class="featured-seller" id="pSoldBy">
      <?php
      if($shipped_by_newegg):
        ?>
        <div class='label'>Sold and Shipped by:</div><div class='seller-info'>Newegg</div>
      <?php
      endif;
      ?>
    </div>
    <a href="javascript:addToCart.newegg_add_cart('http://secure.newegg.com/Common/Ajax/AddCartService.aspx?ItemList=<?php print $item_number; ?>','<?php print $item_number; ?>', <?php print $unit_price; ?>);" class="<?php print $item_number;  ?> button-primary">
Add to Cart
    </a>
    <div class="grpQty">
      <label for="qtyMainItems_<?php print $item_number; ?>"></label>
      <input type="hidden" id="qtyMainItems_<?php print $item_number; ?>" name="qtyMainItems_<?php print $item_number; ?>" maxlenght="3" value="1" maxlength="3" lmtqty="<?php print $limit_quantity; ?>">
    </div><!--grpQty-->
      </div><!--buybox-details-->
  <!-- buybox-modal -->
</div><!--buybox-->

<?php $counter++; ?>
<?php endforeach; ?>


<script type="text/javascript">
  function newegg_display_item(itemnumber,currentItem){
    if(itemnumber!=currentItem){
      jQuery(".buybox").hide();
      jQuery("#buybox_"+itemnumber).show();
    }
  }
  function newegg_open_window(url, target, w, h, t, l) {
    t = ",top=" +  t ;
    l = ",left=" + l ;
    w = "width=" + w;
    h = ",height=" + h;
    window.open(url, target, w + h + t + l);
  }
  function newegg_display_img(itemnumber, imgId){
    jQuery('#gallery_'+itemnumber+' .mainSlide').hide();
    jQuery("#mainSlide_"+itemnumber+imgId).show();
  }
</script>
</div>
