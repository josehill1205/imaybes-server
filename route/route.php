<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

Route::rule('article/:id','index/Index/article','get');
Route::rule('cart/:typeData','index/Index/cart','get');
Route::rule('tag_list','index/Index/tag_list','get');
Route::rule('comment','index/Index/comment','get');
Route::rule('banner','index/Index/banner','get');

return [

];
