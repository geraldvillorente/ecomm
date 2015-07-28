<div class="login-page">
  <div class="blurred-bg" style="background-image: url('<?php print $base_url_default_files ?>/login-bg.jpg')"></div>

  <?php if (!user_is_logged_in()): ?>
  <center class="login-form">
    <div class="msg-box"> <?php print $messages; ?> </div>
    <div class="content page-margin-top">
      <div class="row large-3 small-6 fields large-centered">
        <img src="<?php print $logo; ?>" />
        <?php print $login_form; ?>
      </div>
    </div>
  </center>
 <?php else: ?>
   <div class="selection-page">
     <div class="blurred-bg"></div>
     <div class="absolute-center row">
       <?php foreach($selections as $selection): ?>
         <a href="<?php print url($selection[0]); ?>"> <div class="large-6 small-12 columns selection"> <img src="<?php print $selection[1]; ?>" /> </div> </a>
       <?php endforeach; ?>
     </div>
   </div>
 <?php endif; ?>
</div>