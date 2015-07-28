<div class="project-information">
  <div class="swiper-container">
    <div class="swiper-wrapper window map">

      <div class="swiper-slide first-slide">
        <div class="info">
          <div class="large-6 columns">
            <?php foreach($content['field_front_slide_image']['#object']->field_front_slide_image['und'] as $image): ?>
            <div class="fixed-item" style="background: url(<?php print file_create_url($image['uri']); ?>); width: 47%; height: 50%; background-size: cover"></div>
            <?php endforeach; ?>
          </div>

          <div class="large-6 columns copy">
            <?php print $content['field_front_slide_desc']['#object']->field_front_slide_desc['und'][0]['value']; ?>
          </div>
        </div>
      </div>

      <?php foreach($content['field_other_slide']['#items'] as $key => $slide): ?>
      <?php
        $con = $content['field_other_slide'][$key]['entity']['field_collection_item'][$slide['value']];
        $google_map = $con['field_google_map']['#object']->field_google_map['und'][0]['value'];
        $image = $con['field_image']['#object']->field_image['und'];
        $title = $con['field_title']['#object']->field_title['und'][0]['value'];
        $first_column = $con['field_first_column']['#object']->field_first_column['und'][0]['value'];
        $second_column = $con['field_second_column']['#object']->field_second_column['und'];
        $third_column = $con['field_third_column']['#object']->field_third_column['und'][0]['value'];
        $logo = $con['field_logo']['#object']->field_logo['und'][0]['uri'];
      ?>

      <div class="swiper-slide">
      <?php if ($google_map != ""): ?>
        <iframe src="<?php print $google_map; ?>" width="100%" height="300" frameborder="0" style="border:0"></iframe>
      <?php else: ?>
        <div class="swiper-container2" style="overflow: hidden;">
          <div class="swiper-wrapper" style="height: 300px;">
            <?php foreach($image as $img): ?>
              <div class="swiper-slide"> <div class="item" style="background: url(<?php print file_create_url($img['uri']); ?>) center center; width: 100%; height: 100%; background-size: cover"></div> </div>
            <?php endforeach; ?>
          </div>
          <div class="swiper-pagination2"></div>
        </div>
       <?php endif; ?>

        <div class="subtitle copy">
          <center>
            <?php print $title; ?>
          </center>
        </div>

        <div class="info">
           <div class="large-5 columns copy">
             <center><img src="<?php print file_create_url($logo); ?>" /></center>
             <?php print $first_column; ?>
           </div>

           <div class="large-3 columns image-set">
             <?php foreach($second_column as $image): ?>
               <a href="<?php print file_create_url($image['uri']); ?>" data-lightbox="example-set"> <div class="item" style="background: url(<?php print file_create_url($image['uri']); ?>); width: 45%; height: 125px; background-size: cover"></div> </a>
             <?php endforeach; ?>
           </div>

           <div class="large-4 columns copy">
             <?php print $third_column; ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
</div>