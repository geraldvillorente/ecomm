<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<div class="large-8 columns featured-article" ng-controller="newsPageController">
  <div class="title"> Featured Articles </div>
  <div class="articles">
    <article ng-repeat="news in newsPage.response track by news.node.nid" class="large-12 article row">
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
<div class="large-4 columns updates">
  <div class="large-6 small-6 columns construction-updates">
    <div class="title"> Construction Updates </div>
    <div ng-controller="newsConsUpdateController">
      <div ng-repeat="consupdate in newsCons.response track by consupdate.node.nid">
        <a href="{{consupdate.node.path}}">
          <div class="large-12" style="background: url({{consupdate.node.image}}) center center; background-size: cover;"></div>
        </a>
      </div>
    </div>
  </div>
  <div class="large-6 small-6 columns latest-news">
    <div class="title"> Latest News </div>
    <div ng-controller="newsLatestNewsController">
      <div ng-repeat="latestnews in newsLatestNews.response track by latestnews.node.nid">
        <a href="{{latestnews.node.path}}">
          <div class="large-12" style="background: url({{latestnews.node.image}}) center center; background-size: cover;"> </div>
        </a>
      </div>
    </div>
  </div>
</div>
