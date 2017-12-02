<?php

use Illuminate\Database\Seeder;

class Content extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = DB::table('pages')->insertGetId([
            'parent_id' => '0',
            'author_id' => '1',
            'media_id' => '0',
            'home_page' => '1',
            'module_name' => '',
            'module_menu' => '',
            'title_hu' => 'Kezdolap',
            'title_sr' => 'Pocetna',
            'title_en' => 'Home',
            'description_hu' => 'kezdo oldal',
            'description_sr' => 'pocetna strana',
            'description_en' => 'home page',
            'url_en' => 'home',
            'url_sr' => 'pocetna',
            'url_hu' => 'kezdolap',
            'date_posted' => '20171111',
            'view' => 'welcome',
            'link' => 'link',
            'commentable' => '1',
            'access_level' => '1',
            'admin_access_role' => '1',
            'per_page' => '15',
            'level' => '1',
            'bc' => '0',
            'view_count' => '2',
            'featured' => '0',
            'online' => '1',
            'appears' => true
        ]);

        $page2 = DB::table('pages')->insertGetId([
            'parent_id' => '0',
            'author_id' => '1',
            'media_id' => '0',
            'home_page' => '0',
            'module_name' => '',
            'module_menu' => '',
            'title_hu' => 'Footer',
            'title_sr' => 'Footer',
            'title_en' => 'Footer',
            'description_hu' => 'c',
            'description_sr' => 'c',
            'description_en' => 'c',
            'url_en' => 'footer',
            'url_sr' => 'footer',
            'url_hu' => 'footer',
            'date_posted' => '20171010',
            'view' => 'default',
            'link' => 'link',
            'commentable' => '1',
            'access_level' => '1',
            'admin_access_role' => '1',
            'per_page' => '15',
            'level' => '1',
            'bc' => '1',
            'view_count' => '2',
            'featured' => '1',
            'online' => '1'
        ]);

        $page3 = DB::table('pages')->insertGetId([
            'parent_id' => '0',
            'author_id' => '1',
            'media_id' => '0',
            'home_page' => '0',
            'module_name' => '',
            'module_menu' => '',
            'title_hu' => 'Blog',
            'title_sr' => 'Blog',
            'title_en' => 'Blog',
            'description_hu' => 'c',
            'description_sr' => 'c',
            'description_en' => 'c',
            'url_en' => 'blog',
            'url_sr' => '',
            'url_hu' => '',
            'date_posted' => '20171010',
            'view' => 'default',
            'link' => 'link',
            'commentable' => '1',
            'access_level' => '1',
            'admin_access_role' => '1',
            'per_page' => '15',
            'level' => '1',
            'bc' => '1',
            'view_count' => '2',
            'featured' => '1',
            'online' => '1',
            'appears' => true
        ]);

        $page4 = DB::table('pages')->insertGetId([
            'parent_id' => '0',
            'author_id' => '1',
            'media_id' => '0',
            'home_page' => '0',
            'module_name' => '',
            'module_menu' => '',
            'title_hu' => 'Contact',
            'title_sr' => 'Contact',
            'title_en' => 'Contact',
            'description_hu' => 'c',
            'description_sr' => 'c',
            'description_en' => 'c',
            'url_en' => 'contact',
            'url_sr' => '',
            'url_hu' => '',
            'date_posted' => '20171010',
            'view' => 'default',
            'link' => 'link',
            'commentable' => '1',
            'access_level' => '1',
            'admin_access_role' => '1',
            'per_page' => '15',
            'level' => '1',
            'bc' => '1',
            'view_count' => '2',
            'featured' => '1',
            'online' => '1',
            'appears' => true
        ]);

        $article = DB::table('articles')->insertGetId([
            'user_id' => '1',
            'last_editor_id' => '1',
            'name' => 'Contact',
            'media_id' => '0',
            'title_en' => 'Home Blog',
            'title_sr' => 'Home Blog',
            'title_hu' => 'Home Blog',
            'subtitle_hu' => 'This is a blog post on the Home page',
            'subtitle_sr' => 'This is a blog post on the Home page',
            'subtitle_en' => 'This is a blog post on the Home page',
            'content_en' => '<p>Here appears the content of the blog post.</p>',
            'content_sr' => 'Tu smo',
            'content_hu' => 'Itt vagyunk',
            'description_en' => 'contact page',
            'description_sr' => 'kontakt stranica',
            'description_hu' => 'kapcsolat',
            'start_date' => '20170911',
            'end_date' => '20171112',
            'url_en' => 'home-blog',
            'url_hu' => '',
            'url_sr' => '',
            'archive' => '0',
            'commentable' => '1',
            'author_hu' => '',
            'author_sr' => '',
            'author_en' => 'ICBTech',
            'view_count' => '4',
            'order_no' => '999',
	        'view' => 'article'
        ]);

        $article2 = DB::table('articles')->insertGetId([
            'user_id' => '1',
            'last_editor_id' => '1',
            'name' => 'footer',
            'media_id' => '0',
            'title_en' => 'footer',
            'title_sr' => 'footer',
            'title_hu' => 'footer',
            'subtitle_hu' => 'footer',
            'subtitle_sr' => 'footer',
            'subtitle_en' => 'footer',
            'content_en' => '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="widget"><img alt="" class="padding-top" src="#" />
                                <p>Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Invst igationes demonstraverunt lectores legemer lius quod ii legunt saepius. Claritas est etiam processus dynamicusm lectorum.</p>

                                <div class="social-icons">&nbsp;</div>
                                <!-- end social icons --></div>
                                <!-- end widget --></div>
                                <!-- end columns -->

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="widget">
                                <div class="title">
                                <h3>Twitter Feeds</h3>
                                </div>
                                <!-- end title -->

                                <ul class="twitter_feed">
                                    <li>
                                    <p><span style="font-size:14px">Jolly Themes wishes you and your family a merry Christmas and a happy new! <a href="#">about 2 days ago</a></span></p>
                                    </li>
                                    <li>
                                    <p>Jolly Themes wishes you and your family a merry Christmas and a happy new! <a href="#">about 9 days ago</a></p>
                                    </li>
                                </ul>
                                <!-- end twiteer_feed --></div>
                                <!-- end widget --></div>
                                <!-- end columns -->

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="widget">
                                <div class="title">
                                <h3>Recent Posts</h3>
                                </div>
                                <!-- end title -->

                                <ul class="footer_post">
                                    <li><a href="#"><img alt="" class="img-rounded" src="/images/sliders/slider1.jpg" /></a></li>
                                    <li><a href="#"><img alt="" class="img-rounded" src="/images/sliders/slider1.jpg" /></a></li>
                                    <li><a href="#"><img alt="" class="img-rounded" src="/images/sliders/slider1.jpg" /></a></li>
                                    <li><a href="#"><img alt="" class="img-rounded" src="/images/sliders/slider1.jpg" /></a></li>
                                    <li><a href="#"><img alt="" class="img-rounded" src="/images/sliders/slider1.jpg" /></a></li>
                                    <li><a href="#"><img alt="" class="img-rounded" src="/images/sliders/slider1.jpg" /></a></li>
                                </ul>
                                <!-- recent posts --></div>
                                <!-- end widget --></div>
                                <!-- end columns -->

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="widget">
                                <div class="title">
                                <h3>NewsLetter</h3>
                                </div>
                                <!-- end title -->

                                <div class="newsletter_widget">
                                <p>Subscribe to our newsletter to receive news, updates, free stuff and new releases by email. We don&#39;t do spam..</p>

                                <p><a class="btn btn-primary pull-right" href="#">Subscribe</a></p>
                                <!-- end newsletter form --></div>
                                </div>
                                <!-- end widget --></div>
                                <!-- end columns -->',
            'content_sr' => '',
            'content_hu' => '',
            'description_en' => '',
            'description_sr' => '',
            'description_hu' => '',
            'start_date' => '20170910',
            'end_date' => '20181012',
            'url_en' => 'footer',
            'url_hu' => 'footer',
            'url_sr' => 'footer',
            'archive' => '0',
            'commentable' => '1',
            'author_hu' => 'pinter',
            'author_sr' => 'pinter',
            'author_en' => 'pinter',
            'view_count' => '4',
            'order_no' => '999',
	        'view' => 'footer',
        ]);

        $article3 = DB::table('articles')->insertGetId([
            'user_id' => '1',
            'last_editor_id' => '1',
            'name' => 'Post1',
            'media_id' => '0',
            'title_en' => 'Post1',
            'title_sr' => '',
            'title_hu' => '',
            'subtitle_hu' => '',
            'subtitle_sr' => '',
            'subtitle_en' => '',
            'content_en' => '<p>First blog post</p>',
            'content_sr' => '',
            'content_hu' => '',
            'description_en' => '',
            'description_sr' => '',
            'description_hu' => '',
            'start_date' => '20170910',
            'end_date' => '20181012',
            'url_en' => 'post1',
            'url_hu' => '',
            'url_sr' => '',
            'archive' => '0',
            'commentable' => '1',
            'author_hu' => 'pinter',
            'author_sr' => 'pinter',
            'author_en' => 'pinter',
            'view_count' => '4',
            'order_no' => '999',
            'view' => 'blog',
        ]);

        $article4 = DB::table('articles')->insertGetId([
            'user_id' => '1',
            'last_editor_id' => '1',
            'name' => 'Post2',
            'media_id' => '0',
            'title_en' => 'Post2',
            'title_sr' => '',
            'title_hu' => '',
            'subtitle_hu' => '',
            'subtitle_sr' => '',
            'subtitle_en' => '',
            'content_en' => '<p>Second post</p>',
            'content_sr' => '',
            'content_hu' => '',
            'description_en' => '',
            'description_sr' => '',
            'description_hu' => '',
            'start_date' => '20170910',
            'end_date' => '20181012',
            'url_en' => 'post',
            'url_hu' => '',
            'url_sr' => '',
            'archive' => '0',
            'commentable' => '1',
            'author_hu' => 'pinter',
            'author_sr' => 'pinter',
            'author_en' => 'pinter',
            'view_count' => '4',
            'order_no' => '999',
            'view' => 'blog',
        ]);

        $article5 = DB::table('articles')->insertGetId([
            'user_id' => '1',
            'last_editor_id' => '1',
            'name' => 'Contact',
            'media_id' => '0',
            'title_en' => 'Contact',
            'title_sr' => ' ',
            'title_hu' => ' ',
            'subtitle_hu' => '',
            'subtitle_sr' => '',
            'subtitle_en' => '',
            'content_en' => '<p>You can find us here:&nbsp;</p>
                             <p><iframe height="480" src="https://www.google.com/maps/d/embed?mid=1lwO16GVsu4rJHZ68FDlW36oiOJQ" width="640"></iframe></p>',
            'content_sr' => '',
            'content_hu' => '',
            'description_en' => '',
            'description_sr' => '',
            'description_hu' => '',
            'start_date' => '20170910',
            'end_date' => '20181012',
            'url_en' => 'contact',
            'url_hu' => '',
            'url_sr' => '',
            'archive' => '0',
            'commentable' => '1',
            'author_hu' => 'pinter',
            'author_sr' => 'pinter',
            'author_en' => 'pinter',
            'view_count' => '4',
            'order_no' => '999',
            'view' => 'article',
        ]);

        $a = DB::table('article_page')->insertGetId([
            'page_id' => $page,
            'article_id' => $article,
            'published' => 1
        ]);

        $a = DB::table('article_page')->insertGetId([
          'page_id' => $page2,
          'article_id' => $article2,
          'published' => 1
        ]);

        $a = DB::table('article_page')->insertGetId([
          'page_id' => $page3,
          'article_id' => $article3,
          'published' => 1
        ]);

        $a = DB::table('article_page')->insertGetId([
          'page_id' => $page3,
          'article_id' => $article4,
          'published' => 1
        ]);

        $a = DB::table('article_page')->insertGetId([
          'page_id' => $page4,
          'article_id' => $article5,
          'published' => 1
        ]);

        DB::table('media')->insertGetId([
            'article_id' => $article4,
            'storage' => 'Home Blog-455',
            'title_en' => 'slider3',
            'file_name' => 'slider3',
            'extension' => 'jpg',
            'appears_hu' => true,
            'appears_en' => true,
            'appears_sr' => true,
        ]);

        DB::table('media')->insertGetId([
            'article_id' => $article3,
            'storage' => 'Post1-457',
            'title_en' => 'slider1',
            'file_name' => 'slider1',
            'extension' => 'jpg',
            'appears_hu' => true,
            'appears_en' => true,
            'appears_sr' => true,
        ]);

        DB::table('media')->insertGetId([
            'article_id' => $article4,
            'storage' => 'Post2-458',
            'title_en' => 'slider4',
            'file_name' => 'slider4',
            'extension' => 'jpg',
            'appears_hu' => true,
            'appears_en' => true,
            'appears_sr' => true,
        ]);
    }
}
