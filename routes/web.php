<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'reset' => true,
    'confirm' => true,
]);

//Клиентский функционал
Route::get('/logout','Auth\LoginController@logout')->name('get-logout');
Route::get('/reset','ResetController@reset')->name('reset');


Route::middleware(['auth','verified'])->group(function(){
  Route::group([
    'prefix' => 'client',
    'namespace' => 'Client',
    'as' => 'client.'

  ],function(){
    Route::get('/orders', 'OrderController@AdminHome')->name('orders.index');
    Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
  });


//  Панель Разработчика
Route::group([
'namespace' => 'mainAdmin',
'prefix' => 'mainAdmin',
], function() {

    Route::get('/theme/check-slug', 'ThemeController@checkSlug')->name('theme.checkSlug');
    Route::resource('user','UserController');
    Route::resource('mainproducts', 'MainProductController');
    Route::resource('maincategory', 'MainCategoryController');
    Route::resource('shops', 'ShopController');
    Route::resource('devcomments', 'CommentController');
    Route::resource('themes', 'ThemeController');
    Route::get('cooperations/get','CooperationController@showCooperations')->name('index.cooperation');
    Route::get('colors/','ColorController@index')->name('color.index');
    Route::get('colors/create','ColorController@create')->name('color.create');
    Route::post('colors/store','ColorController@store')->name('color.store');
    Route::get('colors/edit','ColorController@edit')->name('color.edit');
    Route::post('colors/update','ColorController@update')->name('color.update');
    Route::post('colors/{colorId}/delete','ColorController@delete')->name('color.delete');

    Route::get('/category/check-slug', 'MainCategoryController@checkSlug')->name('category.checkSlug');

//Поисковик
        Route::group(['prefix' => 'search'], function (){
            Route::get('/user', 'SearchController@searchUser')->name('search.user');
            Route::get('/company', 'SearchController@searchCompany')->name('search.company');
            Route::get('/products', 'SearchController@searchProduct')->name('search.products');
            Route::get('/category', 'SearchController@searchCategory')->name('search.categories');
            Route::get('/comments', 'SearchController@searchComment')->name('search.comments');
            Route::get('/colors', 'SearchController@searchColor')->name('search.color');
        });
});


//Функционал для Администраторов магазина
Route::group([
'namespace' => 'Admin',
'prefix' => 'admin',
], function() {


    Route::get('/restaurant/check-slug/', 'RestaurantController@checkSlug')->name('restaurant.checkSlug');
    Route::get('/product/check-slug/', 'ShopController@checkSlug')->name('product.checkSlug');
    Route::get('/market/check-slug/', 'MarketController@checkSlug')->name('market.checkSlug');

    Route::get('/orders/', 'OrderController@AdminHome')->name('home');
    Route::get('/orders/{order}/', 'OrderController@show')->name('orders.show');

    Route::get('/product/{shopId}/index','ShopController@getProduct')->name('product.index');
    Route::get('/product/{shopId}/create/','ShopController@createProduct')->name('product.create');
    Route::post('/product/store/', 'ShopController@storeProduct')->name('product.store');

    Route::get('/food/{marketSlug}/index','MarketController@indexFood')->name('food.index');
    Route::get('/food/{marketSlug}/create/','MarketController@createFood')->name('food.create');
    Route::post('/food/store/', 'MarketController@storeFood')->name('food.store');
    Route::delete('/food/{foodSlug}/delete', 'MarketController@destroyFood')->name('food.destroy');
    Route::get('/food/{foodSlug}/edit', 'MarketController@foodEdit')->name('food.edit');
    Route::post('/food/{foodSlug}/update', 'MarketController@foodUpdate')->name('food.update');

    Route::get('/dish/{restaurantSlug}/index', 'RestaurantController@indexDish')->name('dish.index');
    Route::get('/dish/{restaurantSlug}/create', 'RestaurantController@createFood')->name('dish.create');
    Route::post('/dish/store/', 'RestaurantController@storeDish')->name('dish.store');
    Route::delete('/dish/{restaurantSlug}/delete', 'RestaurantController@destroyDish')->name('dish.destroy');
    Route::get('/dish/{restaurantSlug}/edit', 'RestaurantController@dishEdit')->name('dish.edit');
    Route::post('/dish/{restaurantSlug}/update', 'RestaurantController@dishUpdate')->name('dish.update');

    Route::get('/shop/{userId}/', 'ShopController@create')->name('shop.create');
    Route::post('shop/store/','ShopController@storeData')->name('store.shop');



    Route::get('/market/{userId}/', 'MarketController@createMarket')->name('market.create');
    Route::post('/market/store/', 'MarketController@storeMarket')->name('market.store');

    Route::get('/restaurant/{userId}/', 'RestaurantController@create')->name('restaurant.create');
    Route::post('/restaurant/store/', 'RestaurantController@storeRestaurant')->name('restaurant.store');



    Route::resource('categories','CategoryController');
    Route::resource('products','ProductController');
    Route::resource('photos','PhotoController');
    Route::resource('comments','CommentController');
    });
});

//Работа с корзиной
Route::post('/add/{id}','BasketController@basketAdd')->name('basket-add');
Route::post('/add/element/{elementId}', 'BasketController@addElementToBasket')->name('element.basket.add');
Route::delete('/drop/element/{elementId}', 'BasketController@dropElementFromBasket')->name('element.basket.drop');
Route::group(['prefix'=>'basket'], function(){
    Route::post('/add/{product}','BasketController@basketAdd')->name('basket-add');
    Route::group([
        'middleware'=>'not_empty_basket'
    ], function(){
        Route::get('/','BasketController@BasketChecking')->name('basket-check');
        Route::get('/place','BasketController@OrderArrange')->name('order-arrange');
        Route::post('/place','BasketController@OrderConfirm')->name('order-confirm');
        Route::post('/remove/{product}','BasketController@basketRemove')->name('basket-remove');
    });
});

//Подписатья на продукт если продукт нет в наличий
Route::post('/subscribtion/{product}','MainController@SubscribtionForm')->name('subscribe');

//Профайл routes
Route::group(['middleware' => 'auth'], function(){
    Route::get('/profile/{userId}', 'ProfileController@showProfile')->name('profile.show');
    Route::get('/profile/{userId}/edit', 'ProfileController@editProfile')->name('profile.edit');
    Route::patch('/profile/{userId}/update', 'ProfileController@updateProfile')->name('profile.update');
    Route::get('/chosen/{userId}','ProfileController@chosen')->name('chosen');
});


//Работа с главной страницой
Route::get('/','ShopController@getShops')->name('index-html');
Route::get('/company/{shopSlug}','ShopController@getDataInShop')->name('shop.index');
Route::get('/theme/{themeId}', 'ShopController@indexTheme')->name('index.theme');
Route::get('/categories','MainController@CategoriesTemplate')->name('categories');
Route::get('products/categories','MainController@productCategories')->name('product.categories');
Route::post('cooperation/','CooperationController@storeCooperations')->name('store.cooperation');



//Поисковики
Route::get('/search','SearchController@search')->name('search');
Route::get('/search/product','SearchController@searchProduct')->name('product.search');
Route::get('/search/category','SearchController@searchCategory')->name('category.search');
Route::get('/search/order', 'SearchController@searchOrder')->name('order.search');
Route::get('/search/comment', 'SearchController@searchComment')->name('comment.search');


//Продукты по котегориям и страница товара
Route::get('/categories/{category?}','MainController@CategoryShow')->name('category');
Route::get('products/categories/{category?}','MainController@productCategoryDetail')->name('product.category');

Route::get('categories/{category?}/{elements?}', 'MainController@elements')->name('elements')->where('elements', '[0-9]+');
Route::get('element/{element?}','MainController@elementDetail')->name('element.detail');

Route::get('/{category?}/{product?}','MainController@ProductPage')->name('product-more');
Route::get('{ParentParentCategory?}/{ParentCategory?}/{childCategory1?}','MainController@ChildCategoryShow')->name('childCategory1');


Route::get('/order/{id}/delete','BasketController@OrderDelete')->name('order-delete');

Route::get('/product/{productId}/like', 'LikeController@getLikes')->middleware('auth')->name('product-like');
Route::get('/product/{productId}/dislike', 'LikeController@getDislike')->middleware('auth')->name('product-dislike');


Route::post('/comment/{productId}','CommentController@PostingComment')->name('post.comment');
Route::get('/comment/{commentId}/delete','CommentController@destroyComment')->name('delete.comment');


Route::post('/reply/{commentId}', 'RepliesController@storeReply')->middleware('auth')->name('reply.store');
Route::delete('/reply/{replyId}/delete', 'RepliesController@destroyReply')->middleware('auth')->name('reply.destroy');


