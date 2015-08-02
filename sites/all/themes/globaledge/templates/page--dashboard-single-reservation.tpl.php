<?php $reserve = $reservation[0]->node; ?>
<div class="contacts row person">

  <div class="clear-both"></div>
  <div class="large-10 columns large-centered">
    <div class="contact-info">
      <div class="large-12 columns">
        <p class="title"> Contact Information </p>
        <div class="field row"> <div class="large-3 columns"> Name: </div>  <div class="large-9 columns"><?php print ucwords($reserve->firstName. " " .$reserve->lastName); ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Address: </div>  <div class="large-9 columns"><?php print $reserve->address; ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Town: </div>  <div class="large-9 columns"><?php print $reserve->town; ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Zip Code: </div>  <div class="large-9 columns"><?php print $reserve->zipCode; ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Country: </div>  <div class="large-9 columns"><?php print $reserve->country; ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Email Address: </div>  <div class="large-9 columns"><?php print $reserve->emailAddress; ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Contact Number: </div>  <div class="large-9 columns"><?php print $reserve->contactNumber; ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Property: </div>  <div class="large-9 columns"><?php print $reserve->property; ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Unit: </div>  <div class="large-9 columns"><?php print $reserve->unit; ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Terms: </div>  <div class="large-9 columns"><?php print $reserve->terms; ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Bank Name: </div>  <div class="large-9 columns"><?php print $reserve->bankName; ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Bank Account: </div>  <div class="large-9 columns"><?php print $reserve->bankAccount; ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Amount: </div>  <div class="large-9 columns"><?php print $reserve->amount; ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Type: </div>  <div class="large-9 columns"><?php print $reserve->type; ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Message: </div>  <div class="large-9 columns"><?php print $reserve->message; ?></div> </div>
        <div class="field row"> <div class="large-3 columns"> Status: </div>  <div class="large-9 columns"><?php print $reserve->status; ?></div> </div>
      </div>
      <div class="clear-both"> </div>
    </div>
  </div>
</div>