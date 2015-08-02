<?php $profile = profile2_load_by_user(user_load(arg(1))); ?>
<div class="contacts row">
  <div class="clear-both"></div>
  <div class="large-10 columns large-centered">
    <div class="contact-info">
      <div class="large-3 columns"><center> <img src="<?php print file_create_url($profile['main']->field_image_profile[LANGUAGE_NONE][0]['uri']) ?>" /> </center></div>
      <div class="large-9 columns">
        <p class="title"> Contact Information </p>
        <div class="field row"> <div class="large-3 columns"> Name: </div>  <div class="large-9 columns"><?php print $profile['main']->field_name[LANGUAGE_NONE][0]['value'] ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Email: </div>  <div class="large-9 columns"><?php print $profile['main']->field_email[LANGUAGE_NONE][0]['value'] ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Contact: </div>  <div class="large-9 columns"><?php print $profile['main']->field_contact[LANGUAGE_NONE][0]['value'] ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Website: </div>  <div class="large-9 columns"><?php print $profile['main']->field_website[LANGUAGE_NONE][0]['value'] ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Birthday: </div> <div class="large-9 columns"><?php print $profile['main']->field_birthday[LANGUAGE_NONE][0]['value'] ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Position: </div> <div class="large-9 columns"><?php print $profile['main']->field_position[LANGUAGE_NONE][0]['value'] ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Department: </div>  <div class="large-9 columns">Sales Department</div> </div>
        <p class="title"> Additional Information </p>
        <div class="field row"> <div class="large-3 columns"> Address: </div>  <div class="large-9 columns"><?php print $profile['main']->field_address[LANGUAGE_NONE][0]['value'] ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Skills: </div>  <div class="large-9 columns"><?php print $profile['main']->field_skills[LANGUAGE_NONE][0]['value'] ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Interest: </div>  <div class="large-9 columns"><?php print $profile['main']->field_interests[LANGUAGE_NONE][0]['value'] ?></div> </div>
      </div>
      <div class="clear-both"> </div>
    </div>
  </div>
</div>