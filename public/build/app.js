(window.webpackJsonp=window.webpackJsonp||[]).push([["app"],{"1reU":function(t,n,e){"use strict";(function(t){e("fbCW"),e("rB9j"),e("Rm1S"),e("UxlC"),t((function(){var n=t("#sourceCodeModal"),e=n.find("code.php"),o=n.find("code.twig");function a(t,n){return'<a class="doclink" target="_blank" href="'+t+'">'+n+"</a>"}n.find(".hljs-comment").each((function(){t(this).html(t(this).html().replace(/https:\/\/symfony.com\/doc\/[\w\/.#-]+/g,(function(t){return a(t,t)})))}));var s={"@Cache":"https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/cache.html","@Method":"https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/routing.html#route-method","@ParamConverter":"https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html","@Route":"https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/routing.html#usage","@Security":"https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/security.html"};e.find(".hljs-doctag").each((function(){var n=t(this).text();s[n]&&t(this).html(a(s[n],n))})),o.find(".hljs-template-tag > .hljs-name").each((function(){var n=t(this).text();if("else"!==n&&!n.match(/^end/)){var e="https://twig.symfony.com/doc/2.x/tags/"+n+".html#"+n;t(this).html(a(e,n))}})),o.find(".hljs-template-variable > .hljs-name").each((function(){var n=t(this).text(),e="https://twig.symfony.com/doc/2.x/functions/"+n+".html#"+n;t(this).html(a(e,n))}))}))}).call(this,e("EVdn"))},ldto:function(t,n,e){},ng4s:function(t,n,e){"use strict";e.r(n);e("ldto"),e("QZqO"),e("wUUh"),e("1wtn"),e("21Hk"),e("3GEC"),e("EVdn");var o=e("pw5m"),a=e.n(o),s=e("KQfT"),r=e.n(s),i=e("9G73"),c=e.n(i);a.a.registerLanguage("php",r.a),a.a.registerLanguage("twig",c.a),a.a.initHighlightingOnLoad();e("1reU")}},[["ng4s","runtime",0,3]]]);