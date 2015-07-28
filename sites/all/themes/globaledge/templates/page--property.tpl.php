<div class="page-content" ng-controller="propertyController">
  <div class="property-selection">
    <div class="masonry">
      <a href="{{item.node.path}}" ng-repeat="item in property.response">
        <div class="item">
          <img src="{{item.node.image}}">
          <div class="description">
            <div class="title">{{item.node.title}}</div>
            <div class="copy">{{item.node.smallDesc}}</div>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>