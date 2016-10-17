<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>CSS 3D Football Field</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>    
  
       <link rel='stylesheet' href="{{ asset('/admin-ui/css/plan.css') }}">
  </head>


  <body>

    <main>
    <div class="static">
        <h1 class="js-heading">FOOTBALL LEAGUE</h1>
        <p class="js-subheading">Experimental team line-up and football field using CSS 3D transforms.</p>
        <div class="js-switcher switcher">
            <a href="#" class="js-switch disabled switch-btn">{{ $teamsname->T1name }}</a><a href="#" class="js-switch switch-btn">{{ $teamsname->T2name }}</a>
        </div>
    </div>
    <div class="js-stage stage texture">
        <div class="js-world world" style="opacity">
            <div class="team js-team">
                <!-- Team cards / icons goes here -->
            </div>
            <div class="terrain js-terrain">
                <div class="field field--alt"></div>
                <div class="field ground">
                    <div class="field__texture field__texture--gradient"></div>
                    <div class="field__texture field__texture--gradient-b"></div>
                    <div class="field__texture field__texture--grass"></div>
                    <div class="field__line field__line--goal"></div>
                    <div class="field__line field__line--goal field__line--goal--far"></div>
                    <div class="field__line field__line--outline"></div>
                    <div class="field__line field__line--penalty"></div>
                    <div class="field__line field__line--penalty-arc"></div>
                    <div class="field__line field__line--penalty-arc field__line--penalty-arc--far"></div>
                    <div class="field__line field__line--mid"></div>
                    <div class="field__line field__line--circle"></div>
                    <div class="field__line field__line--penalty field__line--penalty--far"></div>
                </div>
                <div class="field__side field__side--front"></div>
                <div class="field__side field__side--left"></div>
                <div class="field__side field__side--right"></div>
                <div class="field__side field__side--back"></div>
            </div>
        </div>
    </div>
    </main>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.min.js'></script>
    <script>
        (function() {
  var $closeBtn, $heading, $loadBtn, $loading, $players, $playersAway, $playersHome, $stage, $subHeading, $switchBtn, $switcher, $team, $teamListHome, $terrain, $world, ASSET_URL, anim, data, dom, events, init, pos, scenes, state;

  ASSET_URL = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/215059/';

  $stage = null;

  $world = null;

  $terrain = null;

  $team = null;

  $teamListHome = null;

  $players = null;

  $playersHome = null;

  $playersAway = null;

  $switchBtn = null;

  $loadBtn = null;

  $closeBtn = null;

  $heading = null;

  $subHeading = null;

  $loading = null;

  $switcher = null;

<?php $x=[110,-110,150,0,-150,-200,200,100,-100,0,0,110,-110,150,0,-150,-200,200,100,-100,0,0]; ?>
<?php $y=[-190,-190,50,100,50,180,180,300,300,410,-210,-190,-190,50,100,50,180,180,300,300,410,-210]; ?>

<?php $i=0;$age = 0; ?>
  data = {
    players: {

      home: [
@foreach($playersteam1 as $p)
<?php
$dob = strtotime(str_replace("/","-",$p->P1birth_date));       
$tdate = time();
while( $tdate > $dob = strtotime('+1 year', $dob))
{
    ++$age;
}
?>
        {
          name: '{{ $p->P1name }}',
          asset: '{!!$p->P1flag !!}',
          origin: '{{ $p->P1name }}',
          height: '{{ $p->P1height }}cm',
          shirt: '{{ $p->P1num }}',
          pos: '{{ $p->P1position }}',
          dob: '<?php echo $age; ?>' ,
          prefered_foot: '{{ $p->P1foot }}',
          weight: '{{ $p->P1weight }}km',
          x: <?php echo $x[$i]; ?>,
          y: <?php echo $y[$i]; ?>
        <?php if($i == 10) echo '}'; else echo '},';  $i++;  ?>
        @endforeach        
      ],

      away: [
      @foreach($playersteam2 as $p2)
      <?php
$dob = strtotime(str_replace("/","-",$p2->P2birth_date));       
$tdate = time();
while( $tdate > $dob = strtotime('+1 year', $dob))
{
    ++$age;
}
?>
        {
          name: '{{ $p2->P2name }}',
          asset: '{!!$p2->P2flag !!}',
          origin: '{{ $p2->P2name }}',
          height: '{{ $p2->P2height }}cm',
          shirt: '{{ $p2->P2num }}',
          pos: '{{ $p2->P2position }}',
          dob: '<?php echo $age; ?>',
          prefered_foot: '{{ $p2->P2foot }}',
          weight: '{{ $p2->P2weight }}km',
          x:  <?php echo $x[$i]; ?>,
          y:  <?php echo $y[$i]; ?>
     <?php if($i == 21) echo '}'; else echo '},';  $i++;  ?>
        @endforeach
        
      ]
    }
  };

  state = {
    home: true,
    disabHover: false,
    swapSides: function() {
      if (this.home) {
        return this.home = false;
      } else {
        return this.home = true;
      }
    },
    curSide: function() {
      if (this.home) {
        return 'home';
      } else {
        return 'away';
      }
    }
  };

  pos = {
    world: {
      baseX: 0,
      baseY: 0,
      baseZ: -200
    },
    def: {
      goalie: [0, -50]
    }
  };

  dom = {
    addPlayers: function(side) {
      var $el, key, ref, val;
      ref = data.players[side];
      for (key in ref) {
        val = ref[key];
        val.side = side;
        $el = this.addPlayer(val);
        $team.append($el);
      }
      $players = $('.js-player');
      $playersHome = $('.js-player[data-side="home"]');
      return $playersAway = $('.js-player[data-side="away"]');
    },
    addPlayer: function(data) {
      var $el;
      $el = $('<div class="js-player player" data-name="' + data.name + '" data-side="' + data.side + '" data-x="' + data.x + '" data-y="' + data.y + '"></div>');
      $el.append('<div class="player__label" style="opacity:1 !important;"><span>' + data.name + '</span></div>');
      $el.append('<div class="player__img"><img src= '+"../images/uploads/" + data.asset + '></div>');
      $el.prepend('<div class="player__card"> </div>');
      $el.prepend('<div class="player__placeholder"></div>');
      this.populateCard($el.find('.player__card'), data);
      return $el;
    },
    preloadImages: function(preload) {
      var i, promises;
      promises = [];
      i = 0;
      while (i < preload.length) {
        (function(url, promise) {
          var img;
          img = new Image;
          img.onload = function() {
            return promise.resolve();
          };
          return img.src = url;
        })(preload[i], promises[i] = $.Deferred());
        i++;
      }
      return $.when.apply($, promises).done(function() {
        scenes.endLoading();
        return scenes.loadIn(1600);
      });
    },
    populateCard: function($el, data) {
      return $el.append('<h3>' + data.name + '</h3>' + '<ul class="player__card__list"><li><span>DOB</span><br/>' + data.dob + ' yr</li><li><span>Height</span><br/>' + data.height + '</li><li><span>Origin</span><br/>' + data.origin + '</li></ul>' + '<ul class="player__card__list player__card__list--last"><li><span>weight</span><br/>' + data.weight + '</li><li><span>Foot</span><br/>' + data.prefered_foot + '</li></ul>');
    },
    displayNone: function($el) {
      return $el.css('display', 'none');
    }
  };

  events = {
    attachAll: function() {
      $switchBtn.on('click', function(e) {
        var $el;
        e.preventDefault();
        $el = $(this);
        if ($el.hasClass('disabled')) {
          return;
        }
        scenes.switchSides();
        $switchBtn.removeClass('disabled');
        return $el.addClass('disabled');
      });
      $loadBtn.on('click', function(e) {
        e.preventDefault();
        return scenes.loadIn();
      });
      return $players.on('click', function(e) {
        var $el;
        e.preventDefault();
        $el = $(this);
        if ($('.active').length) {
          return false;
        }
        $el.addClass('active');
        scenes.focusPlayer($el);
        return setTimeout((function() {
          return events.attachClose();
        }), 1);
      });
    },
    attachClose: function() {
      return $stage.one('click', function(e) {
        e.preventDefault();
        return scenes.unfocusPlayer();
      });
    }
  };

  scenes = {
    preLoad: function() {
      $teamListHome.velocity({
        opacity: 1
      }, 1);
      $players.velocity({
        opacity: 1
      }, 1);
      $loadBtn.velocity({
        opacity: 1
      }, 1);
      $switcher.velocity({
        opacity: 1
      }, 1);
      $heading.velocity({
        opacity: 1
      }, 1);
      $subHeading.velocity({
        opacity: 1
      }, 1);
      $playersAway.css('display', 'none');
      $world.velocity({
        opacity: 1,
        translateZ: -200,
        translateY: -60
      }, 1);
      return $('main').velocity({
        opacity: 1
      }, 1);
    },
    loadIn: function(delay) {
      var delayInc;
      if (delay == null) {
        delay = 0;
      }
      $world.velocity({
        opacity: 1,
        translateY: 0,
        translateZ: -200
      }, {
        duration: 1000,
        delay: delay,
        easing: 'spring'
      });
      anim.fadeInDir($heading, 300, delay + 600, 0, 30);
      anim.fadeInDir($subHeading, 300, delay + 800, 0, 30);
      anim.fadeInDir($teamListHome, 300, delay + 800, 0, 30);
      anim.fadeInDir($switcher, 300, delay + 900, 0, 30);
      delay += 1200;
      delayInc = 30;
      return anim.dropPlayers($playersHome, delay, delayInc);
    },
    startLoading: function() {
      var images, key, ref, val;
      anim.fadeInDir($loading, 300, 0, 0, -20);
      images = [];
      ref = data.players.home && data.players.away;
      for (key in ref) {
        val = ref[key];
        images.push(ASSET_URL + val.asset);
      }
      return dom.preloadImages(images);
    },
    endLoading: function() {
      return anim.fadeOutDir($loading, 300, 1000, 0, -20);
    },
    arrangePlayers: function() {
      return $players.each(function() {
        var $el;
        $el = $(this);
        return $el.velocity({
          translateX: parseInt($el.attr('data-x')),
          translateZ: parseInt($el.attr('data-y'))
        });
      });
    },
    focusPlayer: function($el) {
      var shiftY;
      data = $el.data();
      shiftY = data.y;
      if (shiftY > 0) {
        shiftY = data.y / 2;
      }
      $('.js-player[data-side="' + state.curSide() + '"]').not('.active').each(function() {
        var $unfocus;
        $unfocus = $(this);
        return anim.fadeOutDir($unfocus, 300, 0, 0, 0, 0, null, 0.2);
      });
      $world.velocity({
        translateX: pos.world.baseX - data.x,
        translateY: pos.world.baseY,
        translateZ: pos.world.baseZ - shiftY
      }, 600);
      $terrain.velocity({
        opacity: 0.66
      }, 600);
      return this.showPlayerCard($el, 600, 600);
    },
    unfocusPlayer: function() {
      var $el;
      $el = $('.js-player.active');
      data = $el.data();
      anim.fadeInDir($('.js-player[data-side="' + state.curSide() + '"]').not('.active'), 300, 300, 0, 0, 0, null, 0.2);
      $el.removeClass('active');
      $world.velocity({
        translateX: pos.world.baseX,
        translateY: pos.world.baseY,
        translateZ: pos.world.baseZ
      }, 600);
      $terrain.velocity({
        opacity: 1
      }, 600);
      return this.hidePlayerCard($el, 600, 600);
    },
    hidePlayerCard: function($el, dur, delay) {
      var $card, $image;
      $card = $el.find('.player__card');
      $image = $el.find('.player__img');
      $image.velocity({
        translateY: 0
      }, 300);
      anim.fadeInDir($el.find('.player__label', 200, delay));
      return anim.fadeOutDir($card, 300, 0, 0, -100);
    },
    showPlayerCard: function($el, dur, delay) {
      var $card, $image;
      $card = $el.find('.player__card');
      $image = $el.find('.player__img');
      $image.velocity({
        translateY: '-=150px'
      }, 300);
      anim.fadeOutDir($el.find('.player__label', 200, delay));
      return anim.fadeInDir($card, 300, 200, 0, 100);
    },
    switchSides: function() {
      var $new, $old, delay, delayInc;
      delay = 0;
      delayInc = 20;
      $old = $playersHome;
      $new = $playersAway;
      if (!state.home) {
        $old = $playersAway;
        $new = $playersHome;
      }
      state.swapSides();
      $old.each(function() {
        var $el;
        $el = $(this);
        anim.fadeOutDir($el, 200, delay, 0, -60, 0);
        anim.fadeOutDir($el.find('.player__label'), 200, delay + 700);
        return delay += delayInc;
      });
      $terrain.velocity({
        rotateY: '+=180deg'
      }, {
        delay: 150,
        duration: 1200
      });
      return anim.dropPlayers($new, 1500, 30);
    }
  };

  anim = {
    fadeInDir: function($el, dur, delay, deltaX, deltaY, deltaZ, easing, opacity) {
      if (deltaX == null) {
        deltaX = 0;
      }
      if (deltaY == null) {
        deltaY = 0;
      }
      if (deltaZ == null) {
        deltaZ = 0;
      }
      if (easing == null) {
        easing = null;
      }
      if (opacity == null) {
        opacity = 0;
      }
      $el.css('display', 'block');
      $el.velocity({
        translateX: '-=' + deltaX,
        translateY: '-=' + deltaY,
        translateZ: '-=' + deltaZ
      }, 0);
      return $el.velocity({
        opacity: 1,
        translateX: '+=' + deltaX,
        translateY: '+=' + deltaY,
        translateZ: '+=' + deltaZ
      }, {
        easing: easing,
        delay: delay,
        duration: dur
      });
    },
    fadeOutDir: function($el, dur, delay, deltaX, deltaY, deltaZ, easing, opacity) {
      var display;
      if (deltaX == null) {
        deltaX = 0;
      }
      if (deltaY == null) {
        deltaY = 0;
      }
      if (deltaZ == null) {
        deltaZ = 0;
      }
      if (easing == null) {
        easing = null;
      }
      if (opacity == null) {
        opacity = 0;
      }
      if (!opacity) {
        display = 'none';
      } else {
        display = 'block';
      }
      return $el.velocity({
        opacity: opacity,
        translateX: '+=' + deltaX,
        translateY: '+=' + deltaY,
        translateZ: '+=' + deltaZ
      }, {
        easing: easing,
        delay: delay,
        duration: dur
      }).velocity({
        opacity: opacity,
        translateX: '-=' + deltaX,
        translateY: '-=' + deltaY,
        translateZ: '-=' + deltaZ
      }, {
        duration: 0,
        display: display
      });
    },
    dropPlayers: function($els, delay, delayInc) {
      return $els.each(function() {
        var $el;
        $el = $(this);
        $el.css({
          display: 'block',
          opacity: 0
        });
        anim.fadeInDir($el, 800, delay, 0, 50, 0, 'spring');
        anim.fadeInDir($el.find('.player__label'), 200, delay + 250);
        return delay += delayInc;
      });
    }
  };

  init = function() {
    $stage = $('.js-stage');
    $world = $('.js-world');
    $switchBtn = $('.js-switch');
    $loadBtn = $('.js-load');
    $heading = $('.js-heading');
    $switcher = $('.js-switcher');
    $closeBtn = $('.js-close');
    $subHeading = $('.js-subheading');
    $terrain = $('.js-terrain');
    $team = $('.js-team');
    $teamListHome = $('.js-team-home');
    $loading = $('.js-loading');
    dom.addPlayers('home');
    dom.addPlayers('away');
    scenes.preLoad();
    scenes.arrangePlayers();
    events.attachAll();
    return scenes.startLoading();
  };

  $(document).ready(function() {
    return init();
  });

}).call(this);

    </script>
  </body>
</html>
