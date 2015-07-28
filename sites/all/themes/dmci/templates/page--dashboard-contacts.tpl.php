<div class="contacts row" ng-controller="contactsController">
  <div class="clear-both"></div>
  <div class="contact-container">
    <div ng-repeat="contact in contacts.response" ng-if="contact.user.position != ''">
      <div class="contact">
        <div class="large-5 small-12 columns border">
          <div class="large-4 columns"> <a href="{{contact.user.url}}"> <img src="{{contact.user.image}}" /> </a> </div>
          <div class="large-8 columns">
            <div class="field row"> <div class="large-3 columns"> Name: </div> <div class="large-9 columns">{{contact.user.name}}</div> </div>
            <div class="field row"> <div class="large-3 columns"> Contact: </div> <div class="large-9 columns">{{contact.user.contact}}</div> </div>
            <div class="field row"> <div class="large-3 columns"> Email: </div> <div class="large-9 columns">{{contact.user.email}}</div> </div>
            <div class="field row"> <div class="large-3 columns"> Address: </div> <div class="large-9 columns">{{contact.user.address}}</div> </div>
            <div class="right"><a href="">View Contacts</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>