<?php
// Static RFO
$str1 = strtotime('now');
$str2 = strtotime('+4 years +3 months', $str1);
$year1 = date('Y', $str1);
$year2 = date('Y', $str2);
$month1 = date('m', $str1);
$month2 = date('m', $str2);
$diff = ($year2 - $year1) * 12;
$end = date('F - Y', $str1);
$rfo = date('F - Y', $str2);

print '<input type="hidden" value="'. $diff .'" id="month-spread-php">';
print '<input type="hidden" value="'.$rfo .'" id="end-of-dp-php">';
print '<input type="hidden" value="'. $end .'" id="rfo-date-php">';
?>

<form action="/reservation" method="post">

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

<div class="bpc">
  <div class="row select-computation">
    <div class="large-6 columns active" data-select="Unit"><b>BUILDING UNIT</b></div>
    <div class="large-6 columns" data-select="Parking"><b>PARKING AREA</b></div>
  </div>
  <div class="sheet">
    <div class="row">
      <div class="large-6 columns">
        <table>
          <tbody>
            <tr>
              <td class="label">project</td>
              <td> <select id="select-project" name="project_selected"> <option>-- Select Project --</option> </select> </td>
            </tr>
            <tr>
              <td class="label">unit</td>
              <td><a href="#" data-reveal-id="myModal" id="unit-selected">-- Select Unit--</a></td>
            </tr>
            <tr>
              <td class="label">area</td>
              <td id="unit-area"></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="large-6 columns">
        <table>
          <tbody>
            <tr>
              <td class="label">rfo date</td>
              <td id="rfo-date"></td>
            </tr>
            <tr>
              <td class="label">end of dp</td>
              <td id="end-of-dp"></td>
            </tr>
            <tr>
              <td class="label">no. of months spread</td>
              <td id="month-spread"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="row term">
      <div class="large-12 columns large-centered">
        <table>
          <tbody>
            <tr>
              <td class="label">terms</td>
              <td>
                <select id="select-term" name="term_selected">
                  <option> -- Select Term -- </option>
                  <option value="6">30% in 48 Mos. 70% BANK FINANCING</option>
                  <option value="7">40% in 38 Mos. 60% BANK FINANCING</option>
                  <option value="8">50% in 28 Mos. 50% BANK FINANCING</option>
                  <option value="9">60% in 18 Mos. 40% BANK FINANCING</option>
                  <option value="10">70% in 08 Mos. 30% BANK FINANCING</option>
                </select>
                <input type="hidden" data-downpayment="30" data-bank="70" />
                <input type="hidden" data-downpayment="40" data-bank="60" />
                <input type="hidden" data-downpayment="50" data-bank="50" />
                <input type="hidden" data-downpayment="60" data-bank="40" />
                <input type="hidden" data-downpayment="70" data-bank="30" />
                <input type="hidden" value="" name="unit_selected" id="unit-selected-2" />
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="row calc">
      <div class="large-12 columns large-centered">
        <table>
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th>Unit</th>
              <th>Closing Fee</th>
              <th>Total</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td><b class="highlight">unit price</b></td>
              <td></td>
              <td></td>
              <td><b id="calc-unit-price-amount"></b></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Regular Discount</td>
              <td class="underline"><b id="calc-reg-discount-label"></b></td>
              <td></td>
              <td id="calc-reg-discount-amount"></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><b class="highlight">net</b></td>
              <td></td>
              <td></td>
              <td><b id="calc-net-amount"></b></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Discount (PDC)</td>
              <td class="underline"><b id="calc-pdc-discount-label"></b></td>
              <td></td>
              <td id="calc-pdc-discount-amount"></td>
              <td><sub><i>Divided in DP Period</i></sub></td>
              <td></td>
            </tr>
            <tr>
              <td><b class="highlight">Total Contract Price</b></td>
              <td></td>
              <td></td>
              <td class="underline"><b id="calc-total-price"></b></td>
              <td><span id="calc-dp-period-label"></span> - <b id="calc-dp-period-amount"></b></td>
              <td></td>
            </tr>
            <tr>
              <td><b class="highlight">Downpayment</b></td>
              <td><b id="calc-downpayment-label"></b></td>
              <td></td>
              <td><b id="calc-downpayment-amount"></b></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Additional Discount</td>
              <td></td>
              <td></td>
              <td class="underline"><b> - </b></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><b class="highlight">Net Downpayment</b></td>
              <td></td>
              <td></td>
              <td><b id="calc-net-downpayment-amount"></b></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Less: Reservation Fee</td>
              <td></td>
              <td></td>
              <td class="underline" id="reservation-fee"></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><b class="highlight">Net Downpayment</b></td>
              <td></td>
              <td></td>
              <td><b id="calc-net-downpayment-amount-2"></b></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><b class="highlight">Payable in</b></td>
              <td><b id="calc_payable_in_label"></b></td>
              <td>Months</td>
              <td class="underline"><b class="calc_payable_in_amount"></b></td>
              <td><b>6,525.17</b></td>
              <td><b class="calc_payable_in_amount"></b> / Month</td>
            </tr>
            <tr>
              <td><b class="highlight">Balance</b></td>
              <td class="underline"><b id="balance_label"></b></td>
              <td></td>
              <td class="underline"><b id="balance_amount"></b></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><b class="highlight">Estimated Bank Financing</b></td>
              <td><b>10</b></td>
              <td>Years</td>
              <td><b>26,309.00</b></td>
              <td></td>
              <td></td>
            </tr>
            <tr class="underline">
              <td></td>
              <td><b>15</b></td>
              <td>Years</td>
              <td><b>20,631.00</b></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><b class="highlight">Total Contract Price</b></td>
              <td></td>
              <td></td>
              <td><b class="total_contract_price_amount"></b></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Downpayment Discount</td>
              <td></td>
              <td></td>
              <td class="underline"><b> - </b></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><b class="highlight">net contract price</b></td>
              <td></td>
              <td></td>
              <td><b class="total_contract_price_amount"></b></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="row important">
      <div class="large-12 columns large-centered">
        <?php print $page['content']['system_main']['nodes'][16]['body']['#object']->body[LANGUAGE_NONE][0]['value']; ?>
      </div>
      <input type="submit" class="go-reserve right" value="next" />
    </div>
    <br/>

  </div>
</div>

</form>