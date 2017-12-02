<?php ?>
@foreach ($article->medias as $media)

          <?php $path = '/storage/'.$media->storage.'/'.$media->file_name.'.'.$media->extension; ?>
            <!-- CONTENT -->
            <!-- Post Item 1 -->
              <div class="col-sm-6 col-md-4 col-lg-4 wow fadeIn pb-50 post-prev-img" style="visibility: visible; animation-name: fadeIn;">
                  <a href="{{$path}}" data-lightbox="{{$article->title_en}}"><img src="{{$path}}" alt="img"></a>
              </div>

              
            <!-- SIDEBAR -->
            <!-- <div class="col-sm-4 col-md-3 col-md-offset-1">
              <!-- WIDGET -->
              <!--<div class="widget">
                
                <h5 class="widget-title2">Galleries</h5>
                
                <div class="widget-body">
                  <ul class="clearlist widget-menu font-poppins">
                    <li>
                      <a href="#" title="">Gallery</a>
                    </li>
                    <li>
                      <a href="#" title="">Gallery 2</a>
                    </li>
                    <li>
                      <a href="#" title="">Gallery 3</a>
                    </li>
                    <li>
                      <a href="#" title="">...</a>
                    </li>
                  </ul>
                </div>
                
              </div>  
            </div>   -->       
@endforeach 
