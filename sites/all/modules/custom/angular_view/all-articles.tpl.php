<div ng-app="app" id="article" ng-controller="appController">
  <div ng-show="data.status">{{data.status}}</div>
  <!-- Iterate the result. Equivalent to foreach in php. -->
  <div ng-repeat="article in data track by article.node.Nid | firstPage:currentPage*pageSize | limitTo:pageSize">
    <h2>{{article.node.title}}</h2>
    <div class="body">{{article.node.Body}}</div>
    <div class="image"><img src="{{article.node.Image}}" /></div>
  </div>

  <div class="pagination">
    <button ng-disabled="currentPage == 0" ng-click="currentPage=currentPage-1"><</button>
    <span>{{currentPage+1}}/{{numberOfPages()}}</span>
    <button ng-disabled="currentPage >= data.length/pageSize - 1" ng-click="currentPage=currentPage+1">></button>
  </div>
</div>
