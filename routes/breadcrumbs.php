<?php

// Главная страница
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::register('index-html', function ($trail) {
    $trail->push('Главная страница', route('index-html'));
});
// Главная страница -> Магазины
Breadcrumbs::register('shops', function ($trail, $theme) {
    $trail->parent('index-html');
    $trail->push('Все магазины', route('index.theme', $theme));
});
// Главная страница -> Магазины -> [Имя магазина]
Breadcrumbs::for('owner', function ($trail, $shop) {
    $trail->parent('shops', $shop->themes->code);
    $trail->push($shop->name, route('shop.index',  $shop->slug));
});
// Главная страница -> Категорий
Breadcrumbs::register('categories', function ($trail) {
    $trail->parent('index-html');
    $trail->push('Категорий', route('categories'));
});
// Главная страница -> Категорий -> [Имя категорий]
Breadcrumbs::register('category', function ($trail, $category) {
    $trail->parent('categories');
    $trail->push($category->name, route('category',  ['category'=>$category->code]));
});
// Главная страница -> Категорий -> [Имя категорий] -> [Имя продукта]
Breadcrumbs::register('product-more', function ($trail, $category, $product) {
    $trail->parent('category', $product->category);
    $trail->push($product->name, route('product-more',  ['category'=>$category->code, 'product'=>$product->slug]));
});

