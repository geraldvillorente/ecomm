<div class="large-4 columns notification" ng-controller="updatesController">
  <div class="title"> Updates </div>
  <ul>
    <li ng-repeat="list in updates.response"> {{list.text}} </li>
    <a href="#" class="button right"> Read More </a>
  </ul>
</div>

<div class="large-8 columns featured-article">
  <div class="title"> News </div>
  <div class="articles" ng-controller="newsPageController">
    <article class="large-12 article row" ng-repeat="news in newsPage.response track by news.node.nid">
      <div class="large-5 columns">
        <div class="image" style="background: url({{news.node.image}}) center center; background-size: cover;"></div>
      </div>
      <div class="large-7 columns read-more">
        <div class="title">{{news.node.title}}</div>
        <div class="date">{{news.node.term }} | {{news.node.date }}</div>
        <div class="excerpt">{{news.node.body}}</div>
        <a href="{{news.node.path}}" class="button"> Read More </a>
      </div>
    </article>
  </div>
</div>
