<?php

use Carbon\Carbon;

/*******************************************************************************
   Route web file that contains all the routes for the backend
*******************************************************************************/

Route::group(['namespace' => 'CMS\admin\Controllers', 'middleware' => ['web']], function() {

    Route::get('/admin', function () {
        return view('admin::welcome');
    });
    Route::group(['middleware' => 'guest'], function() {
        Route::get('login', [
            'uses' => 'AuthController@login',
            'as' => 'login'
        ]);
        Route::get('register', [
            'uses' => 'AuthController@getRegister',
            'as' => 'register'
        ]);
    });

    Route::get('gmail-mail', [
    	'uses' => 'MailController@mail'
    ]);
    Route::post('register', [
        'uses' => 'AuthController@store',
        'as' => 'postRegister'
    ]);
    Route::get('mail', function() {
        return view('admin::admin.email.verify');
    });
    Route::get('register/verify/{confirmationCode}', [
        'as' => 'confirmation_path',
        'uses' => 'AuthController@confirm'
    ]);
    Route::post('login', [
        'uses' => 'AuthController@postLogin',
        'as' => 'postLogin'
    ]);

    Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function() {
        Route::get('logout', [
          'uses' => 'AuthController@destroy',
          'as' => 'logout'
        ]);
        Route::get('dashboard', [
            'as' => 'dashboard',
            'uses' => 'ViewController@dashboard'
        ]);
        Route::get('dashboard/valami', [
            'as' => 'dash.valami',
            'uses' => 'ViewController@valami'
        ]);
        Route::get('pages', [
            'as' => 'pages',
            'uses' => 'ViewController@pages'
        ]);
        Route::post('page/store', [
            'as' => 'store.page',
            'uses' => 'PageController@store'
        ]);
        Route::get('page/create', [
            'as' => 'create.page',
            'uses' => 'ViewController@createPage'
        ]);
        Route::put('page/update/{id}', [
            'as' => 'page.update',
            'uses' => 'PageController@update'
        ]);
        Route::post('page/order',[
           'as' => 'page.ordering',
            'uses' => 'PageController@pageOrder'
        ]);
        Route::post('page/online',[
           'as' => 'page.online',
            'uses' => 'PageController@onlineToggle'
        ]);
        Route::post('page/delete', [
            'as' => 'page.delete',
            'uses' => 'PageController@destroy'
        ]);
        Route::post('article/create', [
            'as' => 'create.article',
            'uses' => 'ViewController@createArticle'
        ]);
        Route::post('article/store', [
            'as' => 'article.store',
            'uses' => 'ArticleController@store'
        ]);
        Route::put('article/update/{id}', [
            'as' => 'article.update',
            'uses' => 'ArticleController@update'
        ]);
        Route::post('article/file-update', [
            'as' => 'article.file.update',
            'uses' => 'ArticleController@fileUpdate'
        ]);
        Route::post('article/order', [
            'as' => 'article.ordering',
            'uses' => 'ArticleController@articleOrder'
        ]);
        Route::post('article/publish', [
            'as' => 'article.publish',
            'uses' => 'ArticleController@publishToggle'
        ]);
        Route::post('article/delete', [
            'as' => 'article.delete',
            'uses' => 'ArticleController@destroy'
        ]);
        Route::get('posts', [
            'as' => 'posts',
            'uses' => 'ViewController@posts'
        ]);
        Route::get('media', [
            'as' => 'media',
            'uses' => 'ViewController@media'
        ]);
        Route::get('users', [
            'as' => 'users',
            'uses' => 'ViewController@users'
        ]);
        Route::post('user/modify', [
            'as' => 'user.modify',
            'uses' => 'UserController@update'
        ]);
        Route::post('user/delete',[
            'as' => 'user.delete',
            'uses' => 'UserController@destroy'
        ]);
        Route::post('users/add', [
            'as' => 'user.add',
            'uses' => 'UserController@store'
        ]);
        Route::get('profile', [
            'as' => 'profile',
            'uses' => 'ViewController@profile'
        ]);
        Route::post('profile/pass-change', [
            'as' => 'pass.change',
            'uses' => 'AuthController@passChange'
        ]);
        Route::post('profile/user-change', [
            'as' => 'username.change',
            'uses' => 'AuthController@usernameChange'
        ]);

        Route::get('get-data', [
            'as' => 'get.data',
            'uses' => 'DataController@getJSONtree'
        ]);
        Route::post('get-page-from-tree', [
            'as' => 'get.page.from.tree',
            'uses' => 'PageController@getPageFromTree'
        ]);
        Route::post('file-upload', [
            'as' => 'file.upload',
            'uses' => 'ImageController@mediaUpload'
        ]);

        Route::post('image/get', [
            'as' => 'get-article-images',
            'uses' => 'ImageController@getArticleMedia'
        ]);
        Route::post('image/delete',[
            'as' => 'delete-article-image',
            'uses' => 'ImageController@deleteArticleMedia'
        ]);
        Route::post('image/sort',[
            'as' => 'image.sort',
            'uses' => 'ImageController@sortMedia'
        ]);

        Route::post('get-media-property', [
          'as' => 'get.media.for.edit',
          'uses' => 'MediaController@getMediaForEdit'
        ]);

        Route::post('new-image', [
          'as' => 'get.new.image',
          'uses' => 'MediaController@getNewImage'
        ]);

        Route::get('slides', [
          'as' => 'sliders',
          'uses' => 'ViewController@sliders'
        ]);
        Route::get('sliders/get', [
          'as' => 'get.slides',
          'uses' => 'SlideShowImageController@getSlides'
        ]);
        Route::get('slide-image/new' , [
          'as' => 'new.slider.image',
          'uses' => 'SlideShowImageController@newSlide'
        ]);
        Route::post('slide-image/edit', [
          'as' => 'slide.image.edit',
          'uses' => 'SlideShowImageController@editSlideImageProperty'
        ]);
        /*****************************************************/
        Route::post('slide-image/del' , [
          'as' => 'delete.slider.image',
          'uses' => 'SlideShowImageController@deleteSlide'
        ]);
        /*****************************************************/
        Route::post('slide-image/item', [
          'as' => 'get.slide.item',
          'uses' => 'SlideShowItemController@getSlideItems'
        ]);
        /*****************************************************/
        Route::post('slide-image/delete', [
          'as' => 'delete.slide.image',
          'uses' => 'SlideShowImageController@deleteSlideImage'
        ]);
        /*****************************************************/
        Route::post('slider/sort', [
          'as' => 'slider.sort',
          'uses' => 'SlideShowImageController@sliderSort'
        ]);
        Route::get('refresh', [
          'as' => 'refresh.slide.list',
          'uses' => 'SlideShowImageController@refreshSlideImageList'
        ]);
        Route::post('slide-image/options' , [
          'as' => 'get.slide.options',
          'uses' => 'ViewController@getSlideOptions'
        ]);
        Route::post('item/delete' , [
          'as' => 'delete.image.item',
          'uses' => 'SlideShowItemController@deleteImageItem'
        ]);
        Route::post('item/new', [
          'as' => 'new.image.item',
          'uses' => 'SlideShowItemController@createItem'
        ]);
        Route::post('item/properties', [
          'as' => 'get.item.properties',
          'uses' => 'ViewController@getItemProperties'
        ]);
        Route::post('item/publish', [
          'as' => 'slide.image.item.publish',
          'uses' => 'SlideShowItemController@publish'
        ]);
        Route::post('image/publish', [
          'as' => 'slide.image.publish',
          'uses' => 'SlideShowImageController@publish'
        ]);
        Route::post('slide-image/upload-form', [
          'as' => 'slider.image.upload.form',
          'uses' => 'SlideShowImageController@imageUploadFromModal'
        ]);
        Route::post('item/editable', [
          'as' => 'slide.item.editable',
          'uses' => 'SlideShowItemController@editableSlideItem'
        ]);
        Route::post('slide-item/edit', [
          'as' => 'slide.item.edit',
          'uses' => 'SlideShowItemController@editSlideItem'
        ]);
        Route::post('item/add-image', [
          'as' => 'add.item.image',
          'uses' => 'SlideShowItemController@addImage'
        ]);
        Route::post('slider/preview', [
          'as' => 'slider.preview',
          'uses' => 'SlideShowImageController@showPreview'
        ]);

        Route::get('asd', function () {
            // $now = Carbon::now()->addHour(2);
            // $a = CMS\admin\Article::where('date_posted', '>' ,$now)->get();
            // dd($a);

          return  CMS\admin\Language::getLanguages();
        });

        Route::get('refreshJS', [
          'as' => 'refresh.JS',
          'uses' => 'ViewController@refreshJS'
        ]);
        Route::get('settings', [
            'as' => 'settings',
            'uses' => 'ViewController@settings'
        ]);
        Route::post('settings/submit', [
           'as' => 'submit.settings',
           'uses' => 'SettingsController@submitForm'
        ]);
        Route::get('settings/data', [
           'as' => 'get.setting.data',
           'uses' => 'SettingsController@getData'
        ]);
        Route::post('settings/update', [
           'as' => 'update.settings',
           'uses' => 'SettingsController@update'
        ]);
        Route::post('get-selected-settings', [
            'as' => 'get.selected.settings',
            'uses' => 'SettingsController@getSelectedSetting'
        ]);
        Route::post('add-settings', [
            'as' => 'add.settings',
            'uses' => 'SettingsController@store'
        ]);
        Route::post('delete-settings', [
            'as' => 'delete.settings',
            'uses' => 'SettingsController@delete'
        ]);

        Route::get('modules', [
            'as' => 'modules',
            'uses' => 'ViewController@modules'
        ]);
        Route::put('/install-modules/{id}', [
            'as' => 'module.toggle.install',
            'uses' => 'ModulesController@updateToggle'
        ]);
        
        Route::get('get-module-information/{id}', [
            'as' => 'get.module.information',
            'uses' => 'ModulesController@getInformation'
        ]);
        Route::get('install/new/module', [
            'uses' => 'ModulesController@doInstall'
        ]);
        Route::post('uninstall/module', [
            'uses' => 'ModulesController@doUninstall'
        ]);
        Route::get('module/{module}', [
            'as' => 'module-link',
            'uses' => 'ViewController@getModuleLink'
        ]);



        // Route::get('module/install/test', function () {
        //     CMS\admin\Controllers\ModulesController::doInstall();
        // });
        Route::get('email/test', function () {
            CMS\Contact\Controllers\ContactController::leaveMessage();
        });
		Route::get('sitemap', [
           'as' => 'sitemap',
           'uses' => 'ViewController@sitemap'
        ]);
		Route::get('generate-sitemap', [
            'as' => 'generate.sitemap',
            'uses' => 'SiteMapController@generateSiteMap'
        ]);
    });
});
