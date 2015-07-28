<input type="hidden" id="bpc-reservation" value="1">

<div class="page-content">
  <div class="reservation">
    <div class="large-6 columns slider-map" style="overflow: hidden;">
      <div class="swiper-container2">
        <div class="swiper-wrapper" style="height: 350px;">
          <div class="swiper-slide"> <div class="item" style="background: url(<?php print $base_url_default_files . "property-2.jpg" ?>) center center; width: 100%; height: 100%; background-size: cover"></div> </div>
          <div class="swiper-slide"> <div class="item" style="background: url(<?php print $base_url_default_files . "property-3.jpg" ?>) center center; width: 100%; height: 100%; background-size: cover"></div> </div>
          <div class="swiper-slide"> <div class="item" style="background: url(<?php print $base_url_default_files . "property-2.jpg" ?>) center center; width: 100%; height: 100%; background-size: cover"></div> </div>
        </div>
        <div class="swiper-pagination2"></div>
      </div>
      <center> we want to hear from you. Feel free to send us any suggestion, comment or inquiry.</center>

      <div class="row address">
        <div class="large-4 columns">
        <p class="address-title"> Contact Information </p>
          <b> Our Address: </b>
          <p class="address">
            <div>DMCI Homes Corporate</div> Center 1321 Apolinario St. Bangkal, Makati City
          </p>

          <p class="hours">
            <div>Monday to Fridays</div>
            8:00 am to 5:00 pm
          </p>

          <p class="line">
            <div>Head Office's Trunk Line:</div>
            (632) 555 7777
          </p>
        </div>

        <div class="large-7 columns"><iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d61779.36708262926!2d121.05804382695315!3d14.587081178095216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sdmci!5e0!3m2!1sen!2sph!4v1425621662704" width="100%" height="300" frameborder="0" style="border:0"></iframe></div>
      </div>
    </div>

    <div class="large-6 columns">
      <?php print render($reservation_form); ?>
    </div>
  </div>
</div>

<div id="myModalUnit" class="reveal-modal bldg" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
  <div class="visual">
    <div class="row"><div class="left"><i><b>BUILDING UNIT</b></i></div></div>
    <p><center class="facing top"></center></p>
    <div class="floor-plan-layout">
      <div class="clear-both"></div>
      <p><center class="facing bottom"></center></p>
      <div class="legend large-3 columns">
        <div class="type one-br"><span class="color">&nbsp;</span><b>1 Bedroom</b></div>
        <div class="type two-br"><span class="color">&nbsp;</span><b>2 Bedroom</b></div>
        <div class="type three-br"><span class="color">&nbsp;</span><b>3 Bedroom</b></div>
        <div class="type stairs"><span class="color">&nbsp;</span><b>Stairs</b></div>
      </div>
      <div class="large-6 text-center columns construction"></div>
      <div class="large-3 columns">
        <select id="select-floor">
          <option value="1" selected> 1ST FLOOR </option>
          <option value="2"> 2ND FLOOR </option>
          <option value="3"> 3RD FLOOR </option>
          <option value="4"> 4TH FLOOR </option>
          <option value="5"> 5TH FLOOR </option>
          <option value="6"> 6TH FLOOR </option>
          <option value="7"> 7TH FLOOR </option>
          <option value="8"> 8TH FLOOR </option>
          <option value="9"> 9TH FLOOR </option>
          <option value="10"> 10th FLOOR </option>
          <option value="11"> 11th FLOOR </option>
          <option value="12"> 12th FLOOR </option>
        </select>
      </div>
    </div>
  </div>
  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>

<input type="hidden" id="reserve_project" value="<?php echo $_POST['project_selected'] ?>">
<input type="hidden" id="reserve_unit" value="<?php echo $_POST['unit_selected'] ?>">
<input type="hidden" id="reserve_term" value="<?php echo $_POST['term_selected'] ?>">