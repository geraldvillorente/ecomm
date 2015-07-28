<div class="page-content" ng-controller="historyController">
  <div class="swiper-container">
    <div class="swiper-wrapper">

      <?php foreach($slideContent->nodes as $slide): ?>
        <div class="swiper-slide middle row move">
          <div class="large-6 columns left-side">
            <div class="image">
              <img src="<?php print $slide->node->slideImage; ?>" />
            </div>
          </div>

          <div class="large-6 columns right-side">
            <div class="copy">
              <?php print $slide->node->slideDesc; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>

    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div> <!-- /.swiper-container -->

  <div class="bottom row">
  <!-- <img src="<?php print $base_url_default_files . "bottom-curve.png"; ?>" class="curve"> -->
    <div class="large-6 columns left-side">
      <div class="title italic"> Our Values </div>
      <div class="copy"><?php print $slideContent2[0]['node']['body']; ?></div>
    </div>
    <div class="large-6 columns right-side">
      <div class="masonry">
        <?php foreach($slideContent3['nodes'] as $image): ?>
           <img src="<?php print $image['node']['masonry']; ?>" />
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>