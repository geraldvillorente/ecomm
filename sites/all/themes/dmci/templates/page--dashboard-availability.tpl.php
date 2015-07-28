<input type="hidden" id="hidden-availability" />

<div class="swiper-container-3">
  <div class="swiper-wrapper">
    <?php foreach($projects['nodes'] as $project): ?>
      <div class="swiper-slide" style="background: url(<?php print $project['node']['image']; ?>) center; background-size: cover">
        <a href="#" data-reveal-id="myModal" class="myModal showAvailability" data-title="<?php print strtolower(str_replace(" ", "_", $project['node']['title'])); ?>"></a>
        <center class="logo"> <?php print $project['node']['title']; ?> </center>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<div id="myModal" class="reveal-modal x-large bldg" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog" ng-controller="availabilityController">
<div class="row"><div class="left"><i><b>BUILDING UNIT</b></i></div></div>
<center class="facing top"></center>
  <div class="visual units">

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