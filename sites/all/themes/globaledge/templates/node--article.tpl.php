<div class="row">
  <center> <img src="<?php print file_create_url($content['body']['#object']->field_image['und'][0]['uri']); ?>"> </center>
  <h2><center> <?php print_r($content['body']['#object']->title); ?> </center></h2>
  <center><?php print ucwords($content['body']['#object']->name); ?> - <?php print date('F d, Y', $content['body']['#object']->created); ?></center>
  <hr />
  <?php print $content['body']['#object']->body[LANGUAGE_NONE][0]['value']; ?>
</div>