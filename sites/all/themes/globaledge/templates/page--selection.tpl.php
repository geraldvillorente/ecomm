<div class="selection-page">
  <div class="blurred-bg"></div>
  <div class="absolute-center row">
    <?php foreach($selections as $selection): ?>
      <a href="<?php print url($selection[0]); ?>"> <div class="large-6 small-12 columns selection"> <img src="<?php print $selection[1]; ?>" /> </div> </a>
    <?php endforeach; ?>
  </div>
</div>