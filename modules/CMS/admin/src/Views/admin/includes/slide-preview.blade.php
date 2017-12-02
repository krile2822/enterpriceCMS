<style>
.bannercontainer {
width:100%;
position:relative;
padding:0;
}
.banner{
width:100%;
position:relative;
}
</style>

<?php
  $locale = app()->getLocale();
  $filename = 'filename_' . $locale;
  $text = 'text_' . $locale;
 ?>

<div class="bannercontainer">
<div class="banner">
  <ul>
        <li data-transition="{{ $image->transition }}" data-slotamount="{{ $image->slotamount }}" > {{-- data-link=""  removed--}}
          <img src="/storage/rev_slider/images/{{ $image->$filename }}">
          @if (count($items) >= 1)
            @foreach ($items as $item)

              {{-- TODO Get all slide item properties --}}
              <?php ?>

              @if ($item->type == 1)
                <div class="caption sft {{ $item->class }}"  data-x="{{ $item->x }}"
                  data-y="{{ $item->y }}" data-speed="{{ $item->speed }}" data-start="{{ $item->start }}"
                  data-easing="{{ $item->easing }}"> {{ $item->$text }}
                </div>
              @else
                <div class="caption sft {{ $item->class }}"  data-x="{{ $item->x }}"
                  data-y="{{ $item->y }}" data-speed="{{ $item->speed }}" data-start="{{ $item->start }}"
                  data-easing="{{ $item->easing }}"><img src="/storage/rev_slider/items/{{ $item->filename }}" alt="Image not found!">
                </div>
              @endif
            @endforeach
          @endif
        </li>
</ul>
</div>
</div>

<script type="text/javascript">

   jQuery(document).ready(function() {
      jQuery('.banner').revolution({
         delay:5000,
         startwidth:960,
         startheight:500,
         autoHeight:"off",
         fullScreenAlignForce:"off",

         onHoverStop:"on",

         thumbWidth:100,
         thumbHeight:50,
         thumbAmount:3,

         hideThumbsOnMobile:"off",
         hideBulletsOnMobile:"off",
         hideArrowsOnMobile:"off",
         hideThumbsUnderResoluition:0,

         hideThumbs:0,
         hideTimerBar:"off",

         keyboardNavigation:"on",

         navigationType:"bullet",
         navigationArrows:"solo",
         navigationStyle:"round",

         navigationHAlign:"center",
         navigationVAlign:"bottom",
         navigationHOffset:30,
         navigationVOffset:30,

         soloArrowLeftHalign:"left",
         soloArrowLeftValign:"center",
         soloArrowLeftHOffset:20,
         soloArrowLeftVOffset:0,

         soloArrowRightHalign:"right",
         soloArrowRightValign:"center",
         soloArrowRightHOffset:20,
         soloArrowRightVOffset:0,


         touchenabled:"on",
         swipe_velocity:"0.7",
         swipe_max_touches:"1",
         swipe_min_touches:"1",
         drag_block_vertical:"false",

         stopAtSlide:-1,
         stopAfterLoops:-1,
         hideCaptionAtLimit:0,
         hideAllCaptionAtLilmit:0,
         hideSliderAtLimit:0,

         dottedOverlay:"none",

         fullWidth:"off",
         forceFullWidth:"off",
         fullScreen:"off",
         fullScreenOffsetContainer:"#topheader-to-offset",

         shadow:0
      });
   });

</script>
