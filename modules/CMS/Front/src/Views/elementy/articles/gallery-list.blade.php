<!-- CONTAINER -->        
          <div class="relative">
            <!-- PORTFOLIO FILTER -->                                
                    
            <!-- ITEMS GRID -->
            <ul class="port-grid port-grid-2 port-grid-gut clearfix" id="items-grid" >
              
              @foreach ($page_articles as $key => $article)
              <?php $path = '/storage/'.$article->medias[$key]->storage.'/'.$article->medias[$key]->file_name.'_small.'.$article->medias[$key]->extension; ?>
              <!-- Item 1 -->
              <li class="port-item mix design" style="position: absolute; left: 0px; top: 0px;">
                <a href="{{$page->url_en . '/' . $article->url_en}}">
                  <div class="port-img-overlay">
                    <img class="port-main-img" src="{{$path}}" alt="img">
                  </div>
                  <div class="port-overlay-cont">
                    <div class="port-title-cont2">
                      <h3>{{$article->title_en}}</h3>
                      <!-- <span>design</span> -->
                    </div>
                  </div>
                </a>
              </li>
              @endforeach
             

            </ul>
          
          <div class="pagination_wrapper">
                        {{ $page_articles->links() }}
                    </div>
          </div>