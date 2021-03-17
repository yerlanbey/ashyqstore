<?php
use Illuminate\Support\Facades\Auth;
Auth::routes([
    'reset' => true,
    'confirm' => true,
    'verify' => true,
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
Route::group(['middleware'=>'mainadmin'], function(){

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


//Поисковик
    Route::get('/search/user', 'SearchController@searchUser')->name('search.user');
    Route::get('/search/company', 'SearchController@searchCompany')->name('search.company');
    Route::get('/search/products', 'SearchController@searchProduct')->name('search.products');
    Route::get('/search/category', 'SearchController@searchCategory')->name('search.categories');
    Route::get('/search/comments', 'SearchController@searchComment')->name('search.comments');
    Route::get('/search/colors', 'SearchController@searchColor')->name('search.color');
});
});


//Функционал для Администраторов магазина
Route::group([
'namespace' => 'Admin',
'prefix' => 'admin',
], function() {
Route::group(['middleware'=>'is_admin'], function(){
Route::get('/orders', 'OrderController@AdminHome')->name('home');
Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
Route::get('/creating/{userId}', 'ShopController@create')->name('create.index');
Route::post('/store','ShopController@storeData')->name('store.shop');
Route::get('/organization/{companyId}','ShopController@getProduct')->name('company.get');
Route::get('/organization/{companyId}/create/','ShopController@createProduct')->name('company.create');
Route::post('/organization/store/product', 'ShopController@storeProduct')->name('company.store');
Route::get('/product/check-slug', 'ShopController@checkSlug')->name('product.checkSlug');
Route::get('/market/check-slug', 'MarketController@checkSlug')->name('market.checkSlug');
Route::get('/market/create/{id}', 'MarketController@create')->name('market.create');

Route::resource('categories','CategoryController');
Route::resource('products','ProductController');
Route::resource('photos','PhotoController');
Route::resource('comments','CommentController');


});
});
});

//Работа с корзиной
Route::post('/add/{id}','BasketController@basketAdd')->name('basket-add');
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

Route::group([
'middleware'=>'not_empty_basket',
'prefix' => 'basket'], function(){
Route::get('/','BasketController@BasketChecking')->name('basket-check');
Route::get('/place','BasketController@OrderArrange')->name('order-arrange');
Route::post('/place','BasketController@OrderConfirm')->name('order-confirm');
Route::post('/remove/{id}','BasketController@basketRemove')->name('basket-remove');
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
Route::post('cooperation/','CooperationController@storeCooperations')->name('store.cooperation');


//Поисковики
Route::get('/search','SearchController@search')->name('search');
Route::get('/search/product','SearchController@searchProduct')->name('product.search');
Route::get('/search/category','SearchController@searchCategory')->name('category.search');
Route::get('/search/order', 'SearchController@searchOrder')->name('order.search');
Route::get('/search/comment', 'SearchController@searchComment')->name('comment.search');



//Продукты по котегориям
Route::get('/{category?}','MainController@CategoryShow')->name('category');


//Страница продукта
Route::get('/{category?}/{product?}','MainController@ProductChecking')->name('product-more');


Route::get('/order/{id}/delete','BasketController@OrderDelete')->name('order-delete');

Route::get('/product/{productId}/like', 'LikeController@getLikes')->middleware('auth')->name('product-like');
Route::get('/product/{productId}/dislike', 'LikeController@getDislike')->middleware('auth')->name('product-dislike');


Route::post('/comment/{productId}','CommentController@PostingComment')->name('post.comment');
Route::get('/comment/{commentId}/delete','CommentController@destroyComment')->name('delete.comment');


Route::post('/reply/{commentId}', 'RepliesController@storeReply')->middleware('auth')->name('reply.store');
Route::delete('/reply/{replyId}/delete', 'RepliesController@destroyReply')->middleware('auth')->name('reply.destroy');



