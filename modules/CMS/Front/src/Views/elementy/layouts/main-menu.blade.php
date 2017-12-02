<!-- MAIN MENU CONTAINER -->
<?php $menu = CMS\Front\MainMenu::getMainMenu(); ?>
          <div class="main-menu-container" >
            
              <div class="container-m-30 clearfix"> 
              
                <!-- MAIN MENU -->
                <div id="main-menu" class="font-raleway">
                  <div class="navbar navbar-default" role="navigation">

                    <!-- MAIN MENU LIST -->
                    <nav class="collapse collapsing navbar-collapse right-1024">
                      <ul class="nav navbar-nav" >
                        
                        <!-- MENU ITEM -->
                        @foreach ($menu as $m)
                          <?php !empty($m['children']) ? $sub='open-sub' : $sub=''; 
                            //$sub != '' ? $href='href=' . $m['url'] : $href='';
                          ?>
                          <li class="parent">
                            <a href="{{$m['url']}}" >
                              <div class="main-menu-title" style="color:black!important">{{$m['name']}}</div></a>
                              @if ($sub != '')
                                <ul class="sub">
                                  @foreach ($m['children'] as $child)
                                  <li><a href="/{{$m['url'] . '/' . $child['url']}}">{{$child['title']}}</a></li>
                                  @endforeach
                                </ul>
                              @endif
                          </li>
                        @endforeach
                      </ul>
                
                    </nav>
   
                  </div>
                </div>
                <!-- END main-menu -->