<?php

use App\Http\Control as Api;
use Hyperf\HttpServer\Router\Router;

Router::post('/admin/login', [Api\Admin\AuthController::class, 'login']);

# 管理端路由
Router::addGroup('/admin', function () {
    // 用户
    Router::addGroup('/member', function () {
        Router::get('', [Api\Admin\MemberController::class, 'index']);
        Router::get('/{id}/package', [Api\Admin\MemberController::class, 'getPackage']);
        Router::post('/{id}/package', [Api\Admin\MemberController::class, 'givePackage']);
        Router::put('/{id}/status', [Api\Admin\MemberController::class, 'updateStatus']);
        Router::get('/package/record', [Api\Admin\MemberController::class, 'packageRecord']);
        Router::get('/wechat-oauth/record', [Api\Admin\MemberController::class, 'wechatOauthRecord']);
        Router::post('/wechat-oauth/unbind', [Api\Admin\MemberController::class, 'unbindWechatOauth']);
    });

    // 订单
    Router::addGroup('/order', function () {
        Router::get('', [Api\Admin\OrderController::class, 'index']);
    });

    // 套餐
    Router::addGroup('/package', function () {
        Router::get('', [Api\Admin\PackageController::class, 'index']);
        Router::get('/{id}', [Api\Admin\PackageController::class, 'show']);
        Router::post('', [Api\Admin\PackageController::class, 'store']);
        Router::put('/{id}', [Api\Admin\PackageController::class, 'update']);
        Router::put('/{id}/show', [Api\Admin\PackageController::class, 'updateShow']);
    });

    // 模型
    Router::addGroup('/chat-gpt-model', function () {
        Router::get('', [Api\Admin\ChatGptModelController::class, 'index']);
        Router::get('/{id}', [Api\Admin\ChatGptModelController::class, 'show']);
        Router::post('', [Api\Admin\ChatGptModelController::class, 'store']);
        Router::put('/{id}', [Api\Admin\ChatGptModelController::class, 'update']);
        Router::put('/{id}/status', [Api\Admin\ChatGptModelController::class, 'updateStatus']);
        Router::post('/{id}/top', [Api\Admin\ChatGptModelController::class, 'top']);
        Router::post('/{id}/cancel-top', [Api\Admin\ChatGptModelController::class, 'cancelTop']);
        Router::post('/{id}/copy-gpt', [Api\Admin\ChatGptModelController::class, 'copyModel']);
        Router::get('/{id}/violation', [Api\Admin\ChatGptModelController::class, 'getViolationRecord']);
    });

    // 任务
    Router::addGroup('/task', function () {
        Router::get('/record', [Api\Admin\TaskRecordController::class, 'index']);
        Router::get('', [Api\Admin\TaskController::class, 'index']);
        Router::get('/{type}', [Api\Admin\TaskController::class, 'show']);
        Router::post('/{type}', [Api\Admin\TaskController::class, 'store']);
        Router::put('/{type}/status', [Api\Admin\TaskController::class, 'updateStatus']);
    });

    // 配置项
    Router::addGroup('/config', function () {
        Router::get('/{type}', [Api\Admin\ConfigController::class, 'show']);
        Router::post('/{type}', [Api\Admin\ConfigController::class, 'store']);
    });

    // CDK管理
    Router::addGroup('/cdk', function () {
        Router::get('', [Api\Admin\CdkController::class, 'index']);
        Router::get('/group', [Api\Admin\CdkController::class, 'group']);
        Router::get('/export', [Api\Admin\CdkController::class, 'export']);
        Router::get('/{id}', [Api\Admin\CdkController::class, 'show']);
        Router::post('', [Api\Admin\CdkController::class, 'store']);
        Router::put('/{id}', [Api\Admin\CdkController::class, 'update']);
    });


    Router::addGroup('/upload', function () {
        Router::get('/qiniu/token', [Api\Common\UploadController::class, 'getQiniuToken']);
        Router::post('/image', [Api\Common\UploadController::class, 'uploadImage']);
    });

    // 素材管理
    Router::addGroup('/material', function () {
        Router::get('', [Api\Admin\MaterialController::class, 'index']);
        Router::post('', [Api\Admin\MaterialController::class, 'store']);
        Router::delete('/{id}', [Api\Admin\MaterialController::class, 'destroy']);
    });

    // 开发者套餐
    Router::addGroup('/develop', function () {
        Router::get('/package', [Api\Admin\DevelopController::class, 'getPackage']);
    });

    // 统计
    Router::addGroup('/statistics', function () {
        Router::get('/count', [Api\Admin\StatisticsController::class, 'index']);
    });
}, [
    'middleware' => [
        \App\Base\Auth\AdminAuthMiddleware::class,
    ],
]);
