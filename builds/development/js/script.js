(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
var fill;

(fill = function(item) {
  return $('.tagline').append("" + item);
})('InfoGue.id is awesome');

fill;

$(function () {

    // SMOOTH SCROLL---------------------------------------------------------------
    $(function() {
        $('a[href*="#"]:not([href="#"]):not([data-toggle="tab"])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });


    // STICKY HEADER---------------------------------------------------------------
    var closed = new Waypoint({
        element: $("header"),
        handler: function () {
            if ($(".header.closed").length) {
                $(".header").addClass("transition");
                //console.log("add transition when closed");
            }
            $(".header").toggleClass('closed');
            //console.log(this.element.class + ' closed triggers at ' + this.triggerPoint)

            if (!$(".header.closed").length) {
                setTimeout(function(){
                    $(".header").removeClass("transition");
                    //console.log("remove transition when closed");
                }, 500);
            }
        },
        offset: -200
    });

    var sticky = new Waypoint({
        element: $("header"),
        handler: function () {
            if ($(".header.closed").length) {
                $(".header").addClass("transition");
                //console.log("add transition when stickied");
            }
            $(".header").toggleClass('sticky');
            //console.log(this.element.class + ' triggers at ' + this.triggerPoint)
        },
        offset: -300
    });


    // STICKY STATIC NAV ----------------------------------------------------------
    var staticNav = new Waypoint({
        element: $('.static-nav'),
        handler: function() {
            $('.static-nav').toggleClass('sticky');
        },
        offset: 100
    })

    var topOffset = 0;

    var statisNavRelease = new Waypoint({
        element: $('.static-nav'),
        handler: function() {
            $('.static-nav').toggleClass('release');
            topOffset = $(window).scrollTop();
        },
        offset: - ($('.static-page').height() - 500)
    })

    $(window).scroll(function () {
        if ($('.static-nav').hasClass('release')) {
            $('.static-nav').css('top', 40 - Math.abs(topOffset - $(window).scrollTop()));
            console.log('release');
        }
        else{
            topOffset = 0;
            $('.static-nav').removeAttr('style');
        }
    });


    // NAVIGATION SUPERFISH -------------------------------------------------------
    var navigation = $('#navigation').superfish({
        speed: 'fast',
        cssArrows: false,
        delay: 100
    });


    // RATING ---------------------------------------------------------------------
    var rateMessage = ['WORST', 'BAD', 'GOOD', 'EXCELLENT', 'GREAT'];
    var lastMessage = $(".rating > .rate-message").text();

    renderRate();
    function renderRate(){
        $('.rating-wrapper').each(function () {
            var rating = $(this).data('rating');

            $(this).html("");

            for (var index = 0; index < 5; index++) {
                if (index < rating) {
                    $(this).append("<i class='fa fa-circle rated'></i>")
                }
                else {
                    $(this).append("<i class='fa fa-circle unrated'></i>")
                }
            }

            $(".rating > .rate-message").text(rateMessage[rating-1]);
        });
    }

    $(".rating-wrapper.control i").click(function(){
        $(".rating-wrapper.control i")
            .removeClass('active')
            .removeClass('inactive');

        var rate = $(".rating-wrapper.control i").index($(this));
        $(".rating-wrapper.control i").removeClass('rated').removeClass('unrated');
        for(var i = 0; i < 5; i++){
            if (i <= rate) {
                $(".rating-wrapper.control")
                    .children()
                    .eq(i)
                    .addClass('rated');
            }
            else {
                $(".rating-wrapper.control")
                    .children()
                    .eq(i)
                    .addClass('unrated');
            }
        }
        lastMessage = rateMessage[rate];
    });

    $(".rating-wrapper.control i").hover(function(){
        var rate = $(".rating-wrapper.control i").index($(this));
        for(var i = 0; i < 5; i++){
            if(i <= rate){
                $(".rating-wrapper.control")
                    .children()
                    .eq(i)
                    .addClass('active');
            }
            else{
                $(".rating-wrapper.control")
                    .children()
                    .eq(i)
                    .addClass('inactive');
            }
        }
        $(".rating > .rate-message").text(rateMessage[rate]);
    }, function(){
        $(".rating-wrapper.control i")
            .removeClass('active')
            .removeClass('inactive');
        $(".rating > .rate-message").text(lastMessage);
    });

    // PARALLAX EFFECT ------------------------------------------------------------
    $(window).stellar({responsive: false, horizontalScrolling: false});


    // EQUALIZE SOMETHING ---------------------------------------------------------
    $('.featured-list').equalize({equalize: 'height', children: '.featured-mini'});
    $('.articles').equalize({equalize: 'height', children: '.article-preview'});


    // FEATURED SLIDE SHOW --------------------------------------------------------
    var imagesFeatured = new Array();
    var position = 2;
    var tid;

    setLargeFeatured();

    $('.featured-mini img').each(function () {
        //console.log($(this).data("echo"));
        imagesFeatured.push($(this).data("echo"));
    });

    if(imagesFeatured.length > 0){
        tid = setInterval(changeFeatured, 5000);
    }

    function changeFeatured() {
        if(imagesFeatured.length > 0){
            setFeatured();

            position++;
            if(position > imagesFeatured.length){
                position = 1;
            }
        }
    }

    function abortChangeFeatured() { // to be called when you want to stop the timer
        clearInterval(tid);
    }

    $(".slide").click(function(){
        position = $(".slide").index($(this)) + 1;
        changeFeatured();

        abortChangeFeatured();
        tid = setInterval(changeFeatured, 5000);
    });

    function setFeatured(){
        var imageSection = $(".featured-list div:nth-child("+position+")").find(".featured-mini");

        $(".featured-mini").removeClass("active");
        imageSection.addClass("active");

        var title = imageSection.find(".src-title").text();
        var category = imageSection.find(".src-category").text();
        var description = imageSection.find(".src-description").text();
        var image = imagesFeatured[position-1];

        //console.log("change "+position);
        //console.log("title "+imageSection.find(".src-title").text());
        //console.log("category "+imageSection.find(".src-category").text());
        //console.log("description "+imageSection.find(".src-description").text());

        $(".slide-title").text(title);
        $(".slide-category").text(category);
        $(".slide-description").text(description);
        $('.featured-large .featured-image').data("featured", image);

        setLargeFeatured();
    }

    function setLargeFeatured(){
        var largeFeature = $('.featured-large .featured-image');
        var image = largeFeature.data('featured');

        largeFeature.css('opacity', 0);
        setTimeout(function(){
            largeFeature.css('opacity', 1);
        }, 300);

        largeFeature.css('content', ' ');
        largeFeature.css('background', "url('" + image + "') center center");
        largeFeature.css('background-size', 'cover');
    }


    // IMAGE LAZY LOADING ---------------------------------------------------------
    echo.init({
        offset: 50,
        throttle: 250,
        unload: false,
        callback: function (element, op) {
            //console.log(element, 'has been', op + 'ed')
            $(element).css('opacity', '0');

            setTimeout(function(){
                if(op === 'load') {
                    changeClass($(element));
                    $(element).addClass('transition');
                    $(element).css('opacity', '1');
                }
            }, 100);
        }
    });

    $( window ).resize(function() {
        $(".featured-image").each(function(){
            changeClass($(this).find('img'));
        });
    });

    function changeClass(element){
        var containerRatio = element.parent().width() / element.parent().height();
        var imageRatio = element.width() / element.height();

        var imgClass = (imageRatio > 1) ? 'wide' : 'tall';

        if(imgClass == 'wide'){
            if(containerRatio > imageRatio){
                console.log('change to tall');
                imgClass = 'tall';
            }
        }
        else{
            if(containerRatio < imageRatio){
                console.log('change to wide');
                imgClass = 'wide';
            }
        }

        element.removeClass('tall')
            .removeClass('wide')
            .addClass(imgClass);
    }


    // TO TOP ---------------------------------------------------------------------
    $('footer').waypoint(function() {
        if($(document).height() > 1500){
            $('.to-top').toggleClass('visible');
        }
    }, { offset: '140%' });


    // BROWSER UPGRADE ------------------------------------------------------------
    $('.browserupgrade').waypoint(function() {
        $('.browserupgrade').toggleClass('bottom');
    }, { offset: "30" });


    // NICE SCROLL ----------------------------------------------------------------
    $("html").niceScroll({
        cursorcolor: '#4dc4d2',
        cursorborder: 'none'
    });

});

$(function () {
    if($('.btn-load-more').length){
        var count = 2;
        var total = 10;
        var onloading = false;

        $(window).scroll(function () {
            if ($(window).scrollTop() > $(document).height() - $(window).height() - 500 && !onloading) {
                loadArticle(count);
            }
        });

        $('.btn-load-more').click(function (e) {
            e.preventDefault();
            loadArticle(count);
        });
    }

    function loadArticle(pageNumber) {
        if (count > total) {
            $('.btn-load-more').text("END OF PAGE").addClass('disabled');
            return false;
        } else {
            $('.loading').show();
            $('.btn-load-more').hide();
            onloading = true;

            console.log('load article ' + pageNumber);

            setTimeout(function(){
                count++;
                onloading = false;
                $('.loading').hide();
                $('.btn-load-more').show();
                generateDummy();

                if (count > total) {
                    $('.btn-load-more').text("END OF PAGE").addClass('disabled');
                    return false;
                }
            }, 500);
        }
    }

    function generateDummy(){
        for(var i = 0; i < 6; i++){
            var image = getRandomInt(1, 25);
            var template = '<div class="col-md-4">' +
                '<div class="article-preview portrait">' +
                '<div class="featured-image">' +
                '<img src="images/misc/preloader.gif" alt="Featured 25" data-echo="images/featured/image'+image+'.jpg"/>' +
                '</div>' +
                '<div class="title-wrapper">' +
                '<p class="category"><a href="category.html">Entertainment</a></p>' +
                '<h1 class="title">' +
                '<a href="article.html">Smile and happy make the world better</a>' +
                '</h1>' +
                '<ul class="timestamp">' +
                '<li>By <a href="profile.html">Wanda Kisaku</a></li>' +
                '<li>12 April 2016</li>' +
                '<li>27 Views</li>' +
                '</ul>' +
                '</div>' +
                '<article>' +
                'After success with single Don’t Let You Go, Reika the band from america starting create' +
                'ivideo clip. Black and white describe about the song that can make feels free...' +
                '</article>' +
                '<div class="rating-wrapper" data-rating="2"></div>' +
                '<ul class="social text-right">' +
                '<li><a href="http://www.facebook.com/infogue" class="facebook"><i class="fa fa-facebook"></i></a></li>' +
                '<li><a href="http://www.twitter.com/infogue" class="twitter"><i class="fa fa-twitter"></i></a></li>' +
                '<li><a href="http://plus.google.com/+infogue" class="googleplus"><i class="fa fa-google-plus"></i></a></li>' +
                '</ul>' +
                '</div>' +
                '</div>';

            $('#articles').append(template);
            $('.rating-wrapper').each(function () {
                var rating = $(this).data('rating');

                $(this).html("");

                for (var index = 0; index < 5; index++) {
                    if (index < rating) {
                        $(this).append("<i class='fa fa-circle rated'></i>")
                    }
                    else {
                        $(this).append("<i class='fa fa-circle'></i>")
                    }
                }
            });
        }
    }

    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

});
$(function () {
    var Mustache = require('mustache');

    $.getJSON('js/data.json', function (data) {
        if ($('#articlestpl').length) {
            var template = $('#articlestpl').html();
            var html = Mustache.to_html(template, data);
            $('#articles').html(html);
        }
    }); // getJSON

}); // function
},{"mustache":2}],2:[function(require,module,exports){
/*!
 * mustache.js - Logic-less {{mustache}} templates with JavaScript
 * http://github.com/janl/mustache.js
 */

/*global define: false Mustache: true*/

(function defineMustache (global, factory) {
  if (typeof exports === 'object' && exports && typeof exports.nodeName !== 'string') {
    factory(exports); // CommonJS
  } else if (typeof define === 'function' && define.amd) {
    define(['exports'], factory); // AMD
  } else {
    global.Mustache = {};
    factory(global.Mustache); // script, wsh, asp
  }
}(this, function mustacheFactory (mustache) {

  var objectToString = Object.prototype.toString;
  var isArray = Array.isArray || function isArrayPolyfill (object) {
    return objectToString.call(object) === '[object Array]';
  };

  function isFunction (object) {
    return typeof object === 'function';
  }

  /**
   * More correct typeof string handling array
   * which normally returns typeof 'object'
   */
  function typeStr (obj) {
    return isArray(obj) ? 'array' : typeof obj;
  }

  function escapeRegExp (string) {
    return string.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, '\\$&');
  }

  /**
   * Null safe way of checking whether or not an object,
   * including its prototype, has a given property
   */
  function hasProperty (obj, propName) {
    return obj != null && typeof obj === 'object' && (propName in obj);
  }

  // Workaround for https://issues.apache.org/jira/browse/COUCHDB-577
  // See https://github.com/janl/mustache.js/issues/189
  var regExpTest = RegExp.prototype.test;
  function testRegExp (re, string) {
    return regExpTest.call(re, string);
  }

  var nonSpaceRe = /\S/;
  function isWhitespace (string) {
    return !testRegExp(nonSpaceRe, string);
  }

  var entityMap = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#39;',
    '/': '&#x2F;',
    '`': '&#x60;',
    '=': '&#x3D;'
  };

  function escapeHtml (string) {
    return String(string).replace(/[&<>"'`=\/]/g, function fromEntityMap (s) {
      return entityMap[s];
    });
  }

  var whiteRe = /\s*/;
  var spaceRe = /\s+/;
  var equalsRe = /\s*=/;
  var curlyRe = /\s*\}/;
  var tagRe = /#|\^|\/|>|\{|&|=|!/;

  /**
   * Breaks up the given `template` string into a tree of tokens. If the `tags`
   * argument is given here it must be an array with two string values: the
   * opening and closing tags used in the template (e.g. [ "<%", "%>" ]). Of
   * course, the default is to use mustaches (i.e. mustache.tags).
   *
   * A token is an array with at least 4 elements. The first element is the
   * mustache symbol that was used inside the tag, e.g. "#" or "&". If the tag
   * did not contain a symbol (i.e. {{myValue}}) this element is "name". For
   * all text that appears outside a symbol this element is "text".
   *
   * The second element of a token is its "value". For mustache tags this is
   * whatever else was inside the tag besides the opening symbol. For text tokens
   * this is the text itself.
   *
   * The third and fourth elements of the token are the start and end indices,
   * respectively, of the token in the original template.
   *
   * Tokens that are the root node of a subtree contain two more elements: 1) an
   * array of tokens in the subtree and 2) the index in the original template at
   * which the closing tag for that section begins.
   */
  function parseTemplate (template, tags) {
    if (!template)
      return [];

    var sections = [];     // Stack to hold section tokens
    var tokens = [];       // Buffer to hold the tokens
    var spaces = [];       // Indices of whitespace tokens on the current line
    var hasTag = false;    // Is there a {{tag}} on the current line?
    var nonSpace = false;  // Is there a non-space char on the current line?

    // Strips all whitespace tokens array for the current line
    // if there was a {{#tag}} on it and otherwise only space.
    function stripSpace () {
      if (hasTag && !nonSpace) {
        while (spaces.length)
          delete tokens[spaces.pop()];
      } else {
        spaces = [];
      }

      hasTag = false;
      nonSpace = false;
    }

    var openingTagRe, closingTagRe, closingCurlyRe;
    function compileTags (tagsToCompile) {
      if (typeof tagsToCompile === 'string')
        tagsToCompile = tagsToCompile.split(spaceRe, 2);

      if (!isArray(tagsToCompile) || tagsToCompile.length !== 2)
        throw new Error('Invalid tags: ' + tagsToCompile);

      openingTagRe = new RegExp(escapeRegExp(tagsToCompile[0]) + '\\s*');
      closingTagRe = new RegExp('\\s*' + escapeRegExp(tagsToCompile[1]));
      closingCurlyRe = new RegExp('\\s*' + escapeRegExp('}' + tagsToCompile[1]));
    }

    compileTags(tags || mustache.tags);

    var scanner = new Scanner(template);

    var start, type, value, chr, token, openSection;
    while (!scanner.eos()) {
      start = scanner.pos;

      // Match any text between tags.
      value = scanner.scanUntil(openingTagRe);

      if (value) {
        for (var i = 0, valueLength = value.length; i < valueLength; ++i) {
          chr = value.charAt(i);

          if (isWhitespace(chr)) {
            spaces.push(tokens.length);
          } else {
            nonSpace = true;
          }

          tokens.push([ 'text', chr, start, start + 1 ]);
          start += 1;

          // Check for whitespace on the current line.
          if (chr === '\n')
            stripSpace();
        }
      }

      // Match the opening tag.
      if (!scanner.scan(openingTagRe))
        break;

      hasTag = true;

      // Get the tag type.
      type = scanner.scan(tagRe) || 'name';
      scanner.scan(whiteRe);

      // Get the tag value.
      if (type === '=') {
        value = scanner.scanUntil(equalsRe);
        scanner.scan(equalsRe);
        scanner.scanUntil(closingTagRe);
      } else if (type === '{') {
        value = scanner.scanUntil(closingCurlyRe);
        scanner.scan(curlyRe);
        scanner.scanUntil(closingTagRe);
        type = '&';
      } else {
        value = scanner.scanUntil(closingTagRe);
      }

      // Match the closing tag.
      if (!scanner.scan(closingTagRe))
        throw new Error('Unclosed tag at ' + scanner.pos);

      token = [ type, value, start, scanner.pos ];
      tokens.push(token);

      if (type === '#' || type === '^') {
        sections.push(token);
      } else if (type === '/') {
        // Check section nesting.
        openSection = sections.pop();

        if (!openSection)
          throw new Error('Unopened section "' + value + '" at ' + start);

        if (openSection[1] !== value)
          throw new Error('Unclosed section "' + openSection[1] + '" at ' + start);
      } else if (type === 'name' || type === '{' || type === '&') {
        nonSpace = true;
      } else if (type === '=') {
        // Set the tags for the next time around.
        compileTags(value);
      }
    }

    // Make sure there are no open sections when we're done.
    openSection = sections.pop();

    if (openSection)
      throw new Error('Unclosed section "' + openSection[1] + '" at ' + scanner.pos);

    return nestTokens(squashTokens(tokens));
  }

  /**
   * Combines the values of consecutive text tokens in the given `tokens` array
   * to a single token.
   */
  function squashTokens (tokens) {
    var squashedTokens = [];

    var token, lastToken;
    for (var i = 0, numTokens = tokens.length; i < numTokens; ++i) {
      token = tokens[i];

      if (token) {
        if (token[0] === 'text' && lastToken && lastToken[0] === 'text') {
          lastToken[1] += token[1];
          lastToken[3] = token[3];
        } else {
          squashedTokens.push(token);
          lastToken = token;
        }
      }
    }

    return squashedTokens;
  }

  /**
   * Forms the given array of `tokens` into a nested tree structure where
   * tokens that represent a section have two additional items: 1) an array of
   * all tokens that appear in that section and 2) the index in the original
   * template that represents the end of that section.
   */
  function nestTokens (tokens) {
    var nestedTokens = [];
    var collector = nestedTokens;
    var sections = [];

    var token, section;
    for (var i = 0, numTokens = tokens.length; i < numTokens; ++i) {
      token = tokens[i];

      switch (token[0]) {
        case '#':
        case '^':
          collector.push(token);
          sections.push(token);
          collector = token[4] = [];
          break;
        case '/':
          section = sections.pop();
          section[5] = token[2];
          collector = sections.length > 0 ? sections[sections.length - 1][4] : nestedTokens;
          break;
        default:
          collector.push(token);
      }
    }

    return nestedTokens;
  }

  /**
   * A simple string scanner that is used by the template parser to find
   * tokens in template strings.
   */
  function Scanner (string) {
    this.string = string;
    this.tail = string;
    this.pos = 0;
  }

  /**
   * Returns `true` if the tail is empty (end of string).
   */
  Scanner.prototype.eos = function eos () {
    return this.tail === '';
  };

  /**
   * Tries to match the given regular expression at the current position.
   * Returns the matched text if it can match, the empty string otherwise.
   */
  Scanner.prototype.scan = function scan (re) {
    var match = this.tail.match(re);

    if (!match || match.index !== 0)
      return '';

    var string = match[0];

    this.tail = this.tail.substring(string.length);
    this.pos += string.length;

    return string;
  };

  /**
   * Skips all text until the given regular expression can be matched. Returns
   * the skipped string, which is the entire tail if no match can be made.
   */
  Scanner.prototype.scanUntil = function scanUntil (re) {
    var index = this.tail.search(re), match;

    switch (index) {
      case -1:
        match = this.tail;
        this.tail = '';
        break;
      case 0:
        match = '';
        break;
      default:
        match = this.tail.substring(0, index);
        this.tail = this.tail.substring(index);
    }

    this.pos += match.length;

    return match;
  };

  /**
   * Represents a rendering context by wrapping a view object and
   * maintaining a reference to the parent context.
   */
  function Context (view, parentContext) {
    this.view = view;
    this.cache = { '.': this.view };
    this.parent = parentContext;
  }

  /**
   * Creates a new context using the given view with this context
   * as the parent.
   */
  Context.prototype.push = function push (view) {
    return new Context(view, this);
  };

  /**
   * Returns the value of the given name in this context, traversing
   * up the context hierarchy if the value is absent in this context's view.
   */
  Context.prototype.lookup = function lookup (name) {
    var cache = this.cache;

    var value;
    if (cache.hasOwnProperty(name)) {
      value = cache[name];
    } else {
      var context = this, names, index, lookupHit = false;

      while (context) {
        if (name.indexOf('.') > 0) {
          value = context.view;
          names = name.split('.');
          index = 0;

          /**
           * Using the dot notion path in `name`, we descend through the
           * nested objects.
           *
           * To be certain that the lookup has been successful, we have to
           * check if the last object in the path actually has the property
           * we are looking for. We store the result in `lookupHit`.
           *
           * This is specially necessary for when the value has been set to
           * `undefined` and we want to avoid looking up parent contexts.
           **/
          while (value != null && index < names.length) {
            if (index === names.length - 1)
              lookupHit = hasProperty(value, names[index]);

            value = value[names[index++]];
          }
        } else {
          value = context.view[name];
          lookupHit = hasProperty(context.view, name);
        }

        if (lookupHit)
          break;

        context = context.parent;
      }

      cache[name] = value;
    }

    if (isFunction(value))
      value = value.call(this.view);

    return value;
  };

  /**
   * A Writer knows how to take a stream of tokens and render them to a
   * string, given a context. It also maintains a cache of templates to
   * avoid the need to parse the same template twice.
   */
  function Writer () {
    this.cache = {};
  }

  /**
   * Clears all cached templates in this writer.
   */
  Writer.prototype.clearCache = function clearCache () {
    this.cache = {};
  };

  /**
   * Parses and caches the given `template` and returns the array of tokens
   * that is generated from the parse.
   */
  Writer.prototype.parse = function parse (template, tags) {
    var cache = this.cache;
    var tokens = cache[template];

    if (tokens == null)
      tokens = cache[template] = parseTemplate(template, tags);

    return tokens;
  };

  /**
   * High-level method that is used to render the given `template` with
   * the given `view`.
   *
   * The optional `partials` argument may be an object that contains the
   * names and templates of partials that are used in the template. It may
   * also be a function that is used to load partial templates on the fly
   * that takes a single argument: the name of the partial.
   */
  Writer.prototype.render = function render (template, view, partials) {
    var tokens = this.parse(template);
    var context = (view instanceof Context) ? view : new Context(view);
    return this.renderTokens(tokens, context, partials, template);
  };

  /**
   * Low-level method that renders the given array of `tokens` using
   * the given `context` and `partials`.
   *
   * Note: The `originalTemplate` is only ever used to extract the portion
   * of the original template that was contained in a higher-order section.
   * If the template doesn't use higher-order sections, this argument may
   * be omitted.
   */
  Writer.prototype.renderTokens = function renderTokens (tokens, context, partials, originalTemplate) {
    var buffer = '';

    var token, symbol, value;
    for (var i = 0, numTokens = tokens.length; i < numTokens; ++i) {
      value = undefined;
      token = tokens[i];
      symbol = token[0];

      if (symbol === '#') value = this.renderSection(token, context, partials, originalTemplate);
      else if (symbol === '^') value = this.renderInverted(token, context, partials, originalTemplate);
      else if (symbol === '>') value = this.renderPartial(token, context, partials, originalTemplate);
      else if (symbol === '&') value = this.unescapedValue(token, context);
      else if (symbol === 'name') value = this.escapedValue(token, context);
      else if (symbol === 'text') value = this.rawValue(token);

      if (value !== undefined)
        buffer += value;
    }

    return buffer;
  };

  Writer.prototype.renderSection = function renderSection (token, context, partials, originalTemplate) {
    var self = this;
    var buffer = '';
    var value = context.lookup(token[1]);

    // This function is used to render an arbitrary template
    // in the current context by higher-order sections.
    function subRender (template) {
      return self.render(template, context, partials);
    }

    if (!value) return;

    if (isArray(value)) {
      for (var j = 0, valueLength = value.length; j < valueLength; ++j) {
        buffer += this.renderTokens(token[4], context.push(value[j]), partials, originalTemplate);
      }
    } else if (typeof value === 'object' || typeof value === 'string' || typeof value === 'number') {
      buffer += this.renderTokens(token[4], context.push(value), partials, originalTemplate);
    } else if (isFunction(value)) {
      if (typeof originalTemplate !== 'string')
        throw new Error('Cannot use higher-order sections without the original template');

      // Extract the portion of the original template that the section contains.
      value = value.call(context.view, originalTemplate.slice(token[3], token[5]), subRender);

      if (value != null)
        buffer += value;
    } else {
      buffer += this.renderTokens(token[4], context, partials, originalTemplate);
    }
    return buffer;
  };

  Writer.prototype.renderInverted = function renderInverted (token, context, partials, originalTemplate) {
    var value = context.lookup(token[1]);

    // Use JavaScript's definition of falsy. Include empty arrays.
    // See https://github.com/janl/mustache.js/issues/186
    if (!value || (isArray(value) && value.length === 0))
      return this.renderTokens(token[4], context, partials, originalTemplate);
  };

  Writer.prototype.renderPartial = function renderPartial (token, context, partials) {
    if (!partials) return;

    var value = isFunction(partials) ? partials(token[1]) : partials[token[1]];
    if (value != null)
      return this.renderTokens(this.parse(value), context, partials, value);
  };

  Writer.prototype.unescapedValue = function unescapedValue (token, context) {
    var value = context.lookup(token[1]);
    if (value != null)
      return value;
  };

  Writer.prototype.escapedValue = function escapedValue (token, context) {
    var value = context.lookup(token[1]);
    if (value != null)
      return mustache.escape(value);
  };

  Writer.prototype.rawValue = function rawValue (token) {
    return token[1];
  };

  mustache.name = 'mustache.js';
  mustache.version = '2.2.1';
  mustache.tags = [ '{{', '}}' ];

  // All high-level mustache.* functions use this writer.
  var defaultWriter = new Writer();

  /**
   * Clears all cached templates in the default writer.
   */
  mustache.clearCache = function clearCache () {
    return defaultWriter.clearCache();
  };

  /**
   * Parses and caches the given template in the default writer and returns the
   * array of tokens it contains. Doing this ahead of time avoids the need to
   * parse templates on the fly as they are rendered.
   */
  mustache.parse = function parse (template, tags) {
    return defaultWriter.parse(template, tags);
  };

  /**
   * Renders the `template` with the given `view` and `partials` using the
   * default writer.
   */
  mustache.render = function render (template, view, partials) {
    if (typeof template !== 'string') {
      throw new TypeError('Invalid template! Template should be a "string" ' +
                          'but "' + typeStr(template) + '" was given as the first ' +
                          'argument for mustache#render(template, view, partials)');
    }

    return defaultWriter.render(template, view, partials);
  };

  // This is here for backwards compatibility with 0.4.x.,
  /*eslint-disable */ // eslint wants camel cased function name
  mustache.to_html = function to_html (template, view, partials, send) {
    /*eslint-enable*/

    var result = mustache.render(template, view, partials);

    if (isFunction(send)) {
      send(result);
    } else {
      return result;
    }
  };

  // Export the escaping function so that the user may override it.
  // See https://github.com/janl/mustache.js/issues/244
  mustache.escape = escapeHtml;

  // Export these mainly for testing, but also for advanced usage.
  mustache.Scanner = Scanner;
  mustache.Context = Context;
  mustache.Writer = Writer;

}));

},{}]},{},[1])