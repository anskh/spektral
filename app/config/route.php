<?php

declare(strict_types=1);

use App\Handler\AdminHandler;
use App\Handler\AuthHandler;
use App\Handler\SiteHandler;

return [
    'index' => ['GET', '/', SiteHandler::class],
    'modul_pembinaan' => ['GET','/modul[/{cat}]',[SiteHandler::class, 'modul']],
    'probis' => ['GET','/probis[/{step}]',[SiteHandler::class, 'probis']],
    'metadata' => ['GET','/metadata',[SiteHandler::class, 'metadata']],
    'romantik' => ['GET','/romantik',[SiteHandler::class, 'romantik']],

    'pembinaan' => ['GET','/pembinaan',[SiteHandler::class, 'pembinaan']],
    'pembinaan_view' => [['GET','POST'],'/pembinaan/view/{id:\d+}', [SiteHandler::class, 'viewPembinaan']],
    'pembinaan_edit' => [['GET','POST'],'/pembinaan/edit/{id:\d+}', [SiteHandler::class, 'editPembinaan']],
    'pembinaan_delete' => ['GET','/pembinaan/delete/{id:\d+}', [SiteHandler::class, 'deletePembinaan']],
    'pembinaan_entri' => [['GET','POST'],'/pembinaan/entri', [SiteHandler::class, 'entriPembinaan']],

    'dokumentasi' => ['GET','/dokumentasi',[SiteHandler::class, 'dokumentasi']],
    'dokumentasi_view' => ['GET','/dokumentasi/view/{id:\d+}',[SiteHandler::class, 'viewDokumentasi']],

    'testimoni' => [['GET','POST'],'/testimoni',[SiteHandler::class, 'testimoni']],

    'login' => [['GET','POST'], '/auth/login', AuthHandler::class],
    'login_sso' => ['GET', '/auth/login-sso', [AuthHandler::class, 'sso']],
    'reset' => [['GET','POST'], '/auth/reset', [AuthHandler::class, 'reset']],
    'reset_password' => [['GET','POST'], '/auth/reset/{token}', [AuthHandler::class, 'resetPassword']],
    'register' => [['GET','POST'], '/auth/register', [AuthHandler::class, 'register']],
    'activation' => ['GET', '/auth/activation/{token}', [AuthHandler::class, 'activation']],
    'logout' => ['GET', '/auth/logout', [AuthHandler::class, 'logout']],
    'user_info' => ['GET', '/auth/info', [AuthHandler::class, 'info']],
    'user_update' => [['GET','POST'], '/auth/update', [AuthHandler::class, 'update']],

    'admin_index' => ['GET', '/internal', AdminHandler::class],

    'admin_user' => ['GET','/internal/user', [AdminHandler::class, 'user']],
    'admin_user_view' => ['GET','/internal/user/view/{id:\d+}',[AdminHandler::class, 'viewUser']],
    'admin_user_delete' => ['GET','/internal/user/delete/{id:\d+}',[AdminHandler::class, 'deleteUser']],
    'admin_user_edit' => [['GET','POST'],'/internal/user/edit/{id:\d+}',[AdminHandler::class, 'editUser']],
    'admin_user_info' => ['GET','/internal/account/info',[AdminHandler::class, 'infoUser']],

    'admin_modul' => ['GET','/internal/modul[/{cat:\d+}]', [AdminHandler::class, 'modul']],
    'admin_modul_edit' => [['GET','POST'],'/internal/modul/edit/{id:\d+}', [AdminHandler::class, 'editModul']],
    'admin_modul_delete' => ['GET','/internal/modul/delete/{id:\d+}', [AdminHandler::class, 'deleteModul']],
    'admin_modul_entri' => [['GET','POST'],'/internal/modul/entri[/{cat:\d+}]', [AdminHandler::class, 'entriModul']],

    'admin_pembinaan' => ['GET','/internal/pembinaan', [AdminHandler::class, 'pembinaan']],
    'admin_pembinaan_view' => [['GET','POST'],'/internal/pembinaan/view/{id:\d+}', [AdminHandler::class, 'viewPembinaan']],
    'admin_pembinaan_delete' => ['GET','/internal/pembinaan/delete/{id:\d+}', [AdminHandler::class, 'deletePembinaan']],

    'admin_dokumentasi' => ['GET','/internal/dokumentasi',[AdminHandler::class, 'dokumentasi']],
    'admin_dokumentasi_view' => [['GET','POST'],'/internal/dokumentasi/view/{id:\d+}',[AdminHandler::class, 'viewDokumentasi']],
    'admin_dokumentasi_entri' => [['GET','POST'],'/internal/dokumentasi/entri[/{id:\d+}]',[AdminHandler::class, 'entridokumentasi']],
    'admin_dokumentasi_edit' => [['GET','POST'],'/internal/dokumentasi/edit/{id:\d+}',[AdminHandler::class, 'editDokumentasi']],
    'admin_dokumentasi_delete' => [['GET','POST'],'/internal/dokumentasi/delete/{id:\d+}',[AdminHandler::class, 'deleteDokumentasi']],

    'admin_testimoni' => ['GET','/internal/testimoni',[AdminHandler::class, 'testimoni']],
    'admin_testimoni_edit' => [['GET','POST'],'/internal/testimoni/edit/{id:\d+}',[AdminHandler::class, 'editTestimoni']],
    'admin_testimoni_delete' => [['GET','POST'],'/internal/testimoni/delete/{id:\d+}',[AdminHandler::class, 'deleteTestimoni']],
    
    //'admin_email' => [['GET','POST'],'/internal/email',[AdminHandler::class, 'email']]
];