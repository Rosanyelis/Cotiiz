<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RfcPruebaController;
use App\Http\Controllers\Admin\SpecialtyController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\OccupationController;
use App\Http\Controllers\Supplier\ProductController;
use App\Http\Controllers\Supplier\ServiceController;
use App\Http\Controllers\Admin\RfcBussinesController;
use App\Http\Controllers\Admin\RfcSupplierController;
use App\Http\Controllers\Admin\UsersPruebaController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\UsersBussinesController;
use App\Http\Controllers\Admin\UsersSupplierController;
use App\Http\Controllers\Bussines\SubAccountController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SupplierRequestController;
use App\Http\Controllers\Bussines\BussinesChatController;
use App\Http\Controllers\Supplier\ProfessionalController;
use App\Http\Controllers\Supplier\SupplierChatController;
use App\Http\Controllers\Bussines\BussinesUsersController;
use App\Http\Controllers\Admin\AdminProfessionalController;
use App\Http\Controllers\Admin\AdminSupplierChatController;
use App\Http\Controllers\Bussines\BussinesRequestController;
use App\Http\Controllers\Supplier\RequestSupplierController;
use App\Http\Controllers\Admin\AdminBussinesRequestController;
use App\Http\Controllers\Supplier\SupplierDashboardController;
use App\Http\Controllers\Bussines\BussinesRequestChatController;
use App\Http\Controllers\Supplier\SupplierNotificactionController;



Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/tipo', [HomeController::class, 'create'])->name('tipo.register');
# Buscar rfc segun empresa o proveedor
Route::get('/buscar-rfc/{tipo}', [HomeController::class, 'viewsearchRfc'])->name('tipo.viewsearchRfc');
Route::get('/buscar-rfc/{tipo}/response', [HomeController::class, 'searchRfc'])->name('tipo.searchRfc');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    ####### Administrador #######

    Route::get('/notificaciones-de-administrador', [NotificationController::class, 'get_notifications'])->name('notifications');
    Route::get('/notificaciones-de-administrador/{notification}/read', [NotificationController::class, 'read_notification'])->name('notifications.read');
    Route::get('/notificaciones-de-administrador/marcar-leido', [NotificationController::class, 'markedAsRead'])->name('notifications.markedAsRead');
    Route::get('/notificaciones-de-administrador/{notification}/delete', [NotificationController::class, 'delete'])->name('notifications.delete');
    # dashboard y nav
    Route::get('/metricas-admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');


    # Profesiones
    Route::get('/profesiones', [OccupationController::class, 'index'])->name('occupation.index');
    Route::get('/profesiones/create', [OccupationController::class, 'create'])->name('occupation.create');
    Route::post('/profesiones/guardar', [OccupationController::class, 'store'])->name('occupation.store');
    Route::get('/profesiones/{occupation}/editar', [OccupationController::class, 'edit'])->name('occupation.edit');
    Route::put('/profesiones/{occupation}/actualizar', [OccupationController::class, 'update'])->name('occupation.update');
    Route::get('/profesiones/{occupation}/eliminar', [OccupationController::class, 'destroy'])->name('occupation.destroy');
    Route::get('/profesiones/importar-profesiones', [OccupationController::class, 'viewimport'])->name('occupation.viewimport');
    Route::post('/profesiones/import-data', [OccupationController::class, 'storeimport'])->name('occupation.import');

    # Especialidades
    Route::get('/especialidades', [SpecialtyController::class, 'index'])->name('specialty.index');
    Route::get('/especialidades/create', [SpecialtyController::class, 'create'])->name('specialty.create');
    Route::post('/especialidades/guardar', [SpecialtyController::class, 'store'])->name('specialty.store');
    Route::get('/especialidades/{specialty}/editar', [SpecialtyController::class, 'edit'])->name('specialty.edit');
    Route::put('/especialidades/{specialty}/actualizar', [SpecialtyController::class, 'update'])->name('specialty.update');
    Route::get('/especialidades/{specialty}/eliminar', [SpecialtyController::class, 'destroy'])->name('specialty.destroy');
    Route::get('/especialidades/importar-especialidades', [SpecialtyController::class, 'viewimport'])->name('specialty.viewimport');
    Route::post('/especialidades/import-data', [SpecialtyController::class, 'storeimport'])->name('specialty.import');

    # Requests Proveedores
    Route::get('/solicitudes-de-proveedor', [SupplierRequestController::class, 'index'])->name('request-supplier.index');
    Route::get('/solicitudes-de-proveedor/datatable', [SupplierRequestController::class, 'datatable'])->name('request-supplier.datatable');
    Route::get('/solicitudes-de-proveedor/create', [SupplierRequestController::class, 'create'])->name('request-supplier.create');
    Route::post('/solicitudes-de-proveedor', [SupplierRequestController::class, 'store'])->name('request-supplier.store');
    Route::get('/solicitudes-de-proveedor/{request}/show', [SupplierRequestController::class, 'show'])->name('request-supplier.show');
    Route::post('/solicitudes-de-proveedor/{request}/chat', [SupplierRequestController::class, 'storeChat'])->name('request-supplier.storeChat');
    Route::post('/solicitudes-de-proveedor/{request}/cambiar-estatus', [SupplierRequestController::class, 'changeStatus'])->name('request-supplier.changeStatus');

    # Requests EMpresas
    Route::get('/solicitudes-de-empresa', [AdminBussinesRequestController::class, 'index'])->name('admin-request-bussines.index');
    Route::get('/solicitudes-de-empresa/datatable', [AdminBussinesRequestController::class, 'datatable'])->name('admin-request-bussines.datatable');
    Route::get('/solicitudes-de-empresa/create', [AdminBussinesRequestController::class, 'create'])->name('admin-request-bussines.create');
    Route::post('/solicitudes-de-empresa', [AdminBussinesRequestController::class, 'store'])->name('admin-request-bussines.store');
    Route::get('/solicitudes-de-empresa/{request}/show', [AdminBussinesRequestController::class, 'show'])->name('admin-request-bussines.show');
    Route::post('/solicitudes-de-empresa/{request}/chat', [AdminBussinesRequestController::class, 'storeChat'])->name('admin-request-bussines.storeChat');
    Route::post('/solicitudes-de-empresa/{request}/cambiar-estatus', [AdminBussinesRequestController::class, 'changeStatus'])->name('admin-request-bussines.changeStatus');

    # Empresas
    Route::get('/empresas', [RfcBussinesController::class, 'index'])->name('business.index');
    Route::get('/empresas/create', [RfcBussinesController::class, 'create'])->name('business.create');
    Route::post('/empresas', [RfcBussinesController::class, 'store'])->name('business.store');
    Route::get('/empresas/{cliente}/show', [RfcBussinesController::class, 'show'])->name('business.show');
    Route::get('/empresas/{cliente}/edit', [RfcBussinesController::class, 'edit'])->name('business.edit');
    Route::put('/empresas/{cliente}/update', [RfcBussinesController::class, 'update'])->name('business.update');
    Route::get('/empresas/{cliente}/activated', [RfcBussinesController::class, 'activated'])->name('business.activated');
    Route::get('/empresas/{cliente}/desactivated', [RfcBussinesController::class, 'desactivated'])->name('business.desactivated');
    Route::post('/empresas/store-cashback', [RfcBussinesController::class, 'store_cashback'])->name('business.store_cashback');
    Route::get('/empresas/{cliente}/delete', [RfcBussinesController::class, 'delete'])->name('business.delete');
    # Empresas - Usuarios
    Route::get('/empresas/{cliente}/users', [RfcBussinesController::class, 'rfcusers'])->name('business.users');
    Route::get('/empresas/{cliente}/users/create', [RfcBussinesController::class, 'create_users'])->name('business.users.create_users');
    Route::post('/empresas/{cliente}/users/store', [RfcBussinesController::class, 'store_users'])->name('business.users.store_users');
    Route::get('/empresas/{cliente}/users/{user}/show', [RfcBussinesController::class, 'show_users'])->name('business.users.show_users');
    Route::get('/empresas/{cliente}/users/{user}/edit', [RfcBussinesController::class, 'edit_users'])->name('business.users.edit_users');
    Route::put('/empresas/{cliente}/users/{user}/update', [RfcBussinesController::class, 'update_users'])->name('business.users.update_users');
    Route::get('/empresas/{cliente}/users/{user}/delete', [RfcBussinesController::class, 'destroy_users'])->name('business.users.destroy_users');
    Route::get('/empresas/users/{user}/activated', [RfcBussinesController::class, 'ActivateUsers'])->name('business.users.activated');
    Route::get('/empresas/users/{user}/desactivated', [RfcBussinesController::class, 'DesactivateUsers'])->name('business.users.desactivated');
    # Empresas - Usuarios - Atajos
    Route::get('/empresas/create-user', [RfcBussinesController::class, 'create_user_bussines'])->name('business.create_user_bussines');
    Route::post('/empresas/store-user', [RfcBussinesController::class, 'store_user_bussines'])->name('business.store_user_bussines');

    # Proveedores
    Route::get('/proveedores', [RfcSupplierController::class, 'index'])->name('supplier.index');
    Route::get('/proveedores/create', [RfcSupplierController::class, 'create'])->name('supplier.create');
    Route::post('/proveedores', [RfcSupplierController::class, 'store'])->name('supplier.store');
    Route::get('/proveedores/{cliente}/show', [RfcSupplierController::class, 'show'])->name('supplier.show');
    Route::get('/proveedores/{cliente}/edit', [RfcSupplierController::class, 'edit'])->name('supplier.edit');
    Route::put('/proveedores/{cliente}/update', [RfcSupplierController::class, 'update'])->name('supplier.update');
    Route::get('/proveedores/{cliente}/activated', [RfcSupplierController::class, 'activated'])->name('supplier.activated');
    Route::get('/proveedores/{cliente}/desactivated', [RfcSupplierController::class, 'desactivated'])->name('supplier.desactivated');
    Route::get('/proveedores/{cliente}/delete', [RfcSupplierController::class, 'delete'])->name('supplier.delete');
    # Proveedores - Usuarios
    Route::get('/proveedores/{cliente}/users', [RfcSupplierController::class, 'rfcusers'])->name('supplier.users');
    Route::get('/proveedores/{cliente}/users/create', [RfcSupplierController::class, 'create_users'])->name('supplier.users.create_users');
    Route::post('/proveedores/{cliente}/users/store', [RfcSupplierController::class, 'store_users'])->name('supplier.users.store_users');
    Route::get('/proveedores/{cliente}/users/{user}/show', [RfcSupplierController::class, 'show_users'])->name('supplier.users.show_users');
    Route::get('/proveedores/{cliente}/users/{user}/edit', [RfcSupplierController::class, 'edit_users'])->name('supplier.users.edit_users');
    Route::put('/proveedores/{cliente}/users/{user}/update', [RfcSupplierController::class, 'update_users'])->name('supplier.users.update_users');
    Route::get('/proveedores/{cliente}/users/{user}/delete', [RfcSupplierController::class, 'destroy_users'])->name('supplier.users.destroy_users');
    Route::get('/proveedores/users/{user}/activated', [RfcSupplierController::class, 'ActivateUsers'])->name('supplier.users.activated');
    Route::get('/proveedores/users/{user}/desactivated', [RfcSupplierController::class, 'DesactivateUsers'])->name('supplier.users.desactivated');

     # Pruebas
     Route::get('/pruebas', [RfcPruebaController::class, 'index'])->name('prueba.index');
     Route::get('/pruebas/create', [RfcPruebaController::class, 'create'])->name('prueba.create');
     Route::post('/pruebas', [RfcPruebaController::class, 'store'])->name('prueba.store');
     Route::get('/pruebas/{cliente}/show', [RfcPruebaController::class, 'show'])->name('prueba.show');
     Route::get('/pruebas/{cliente}/edit', [RfcPruebaController::class, 'edit'])->name('prueba.edit');
     Route::put('/pruebas/{cliente}/update', [RfcPruebaController::class, 'update'])->name('prueba.update');
     Route::get('/pruebas/{cliente}/activated', [RfcPruebaController::class, 'activated'])->name('prueba.activated');
     Route::get('/pruebas/{cliente}/desactivated', [RfcPruebaController::class, 'desactivated'])->name('prueba.desactivated');
     Route::get('/pruebas/{cliente}/delete', [RfcPruebaController::class, 'delete'])->name('prueba.delete');
     # Pruebas - Usuarios
     Route::get('/pruebas/{cliente}/users', [RfcPruebaController::class, 'rfcusers'])->name('prueba.users');
     Route::get('/pruebas/{cliente}/users/create', [RfcPruebaController::class, 'create_users'])->name('prueba.users.create_users');
     Route::post('/pruebas/{cliente}/users/store', [RfcPruebaController::class, 'store_users'])->name('prueba.users.store_users');
     Route::get('/pruebas/{cliente}/users/{user}/show', [RfcPruebaController::class, 'show_users'])->name('prueba.users.show_users');
     Route::get('/pruebas/{cliente}/users/{user}/edit', [RfcPruebaController::class, 'edit_users'])->name('prueba.users.edit_users');
     Route::put('/pruebas/{cliente}/users/{user}/update', [RfcPruebaController::class, 'update_users'])->name('prueba.users.update_users');
     Route::get('/pruebas/{cliente}/users/{user}/delete', [RfcPruebaController::class, 'destroy_users'])->name('prueba.users.destroy_users');
     Route::get('/pruebas/users/{user}/activated', [RfcPruebaController::class, 'ActivateUsers'])->name('prueba.users.activated');
     Route::get('/pruebas/users/{user}/desactivated', [RfcPruebaController::class, 'DesactivateUsers'])->name('prueba.users.desactivated');

    # users
    Route::get('/gestion-de-usuarios', [AdminUsersController::class, 'index'])->name('admin.users.index');
    Route::get('/gestion-de-usuarios/create', [AdminUsersController::class, 'create'])->name('admin.users.create');
    Route::post('/gestion-de-usuarios', [AdminUsersController::class, 'store'])->name('admin.users.store');
    Route::get('/gestion-de-usuarios/{user}/edit', [AdminUsersController::class, 'edit'])->name('admin.users.edit');
    Route::put('/gestion-de-usuarios/{user}/update', [AdminUsersController::class, 'update'])->name('admin.users.update');
    Route::get('/gestion-de-usuarios/{user}/delete', [AdminUsersController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/gestion-de-usuarios/{user}/activated', [AdminUsersController::class, 'activated'])->name('admin.users.activated');
    Route::get('/gestion-de-usuarios/{user}/desactivated', [AdminUsersController::class, 'desactivated'])->name('admin.users.desactivated');

    # Gestion de productos de proveedores
    Route::get('/gestion-de-productos', [AdminProductController::class, 'index'])->name('admin.product.index');
    Route::get('/gestion-de-productos/{id}/show', [AdminProductController::class, 'show'])->name('admin.product.show');
    Route::get('/gestion-de-productos/{id}/aprove', [AdminProductController::class, 'aprove'])->name('admin.product.aprove');
    Route::get('/gestion-de-productos/{id}/reject', [AdminProductController::class, 'reject'])->name('admin.product.reject');

    # Gestion de servicios de proveedores
    Route::get('/gestion-de-servicios', [AdminServiceController::class, 'index'])->name('admin.service.index');
    Route::get('/gestion-de-servicios/{id}/show', [AdminServiceController::class, 'show'])->name('admin.service.show');
    Route::get('/gestion-de-servicios/{id}/aprove', [AdminServiceController::class, 'aprove'])->name('admin.service.aprove');
    Route::get('/gestion-de-servicios/{id}/reject', [AdminServiceController::class, 'reject'])->name('admin.service.reject');

    # Gestion de Profesinales de proveedores
    Route::get('/gestion-de-profesionales', [AdminProfessionalController::class, 'index'])->name('admin.professional.index');
    Route::get('/gestion-de-profesionales/{id}/show', [AdminProfessionalController::class, 'show'])->name('admin.professional.show');
    Route::get('/gestion-de-profesionales/{id}/aprove', [AdminProfessionalController::class, 'aprove'])->name('admin.professional.aprove');
    Route::get('/gestion-de-profesionales/{id}/reject', [AdminProfessionalController::class, 'reject'])->name('admin.professional.reject');

    # Usuarios de Empresas
    Route::get('/gestion-de-usuarios-empresas', [UsersBussinesController::class, 'index'])->name('admin.bussines-users.index');
    Route::get('/gestion-de-usuarios-empresas/{id}/show', [UsersBussinesController::class, 'show'])->name('admin.bussines-users.show');
    Route::post('/gestion-de-usuarios-empresas/change-password', [UsersBussinesController::class, 'changePasword'])->name('admin.bussines-users.changePasword');
    Route::get('/gestion-de-usuarios-empresas/{id}/get-password', [UsersBussinesController::class, 'getPassword'])->name('admin.bussines-users.getPassword');
    Route::get('/gestion-de-usuarios-empresas/{id}/activated', [UsersBussinesController::class, 'activated'])->name('admin.bussines-users.activated');
    Route::get('/gestion-de-usuarios-empresas/{id}/desactivated', [UsersBussinesController::class, 'desactivated'])->name('admin.bussines-users.desactivated');
    Route::get('/gestion-de-usuarios-empresas/{id}/delete', [UsersBussinesController::class, 'delete'])->name('admin.bussines-users.delete');
    # Usuarios de Proveedores
    Route::get('/gestion-de-usuarios-proveedores', [UsersSupplierController::class, 'index'])->name('admin.supplier-users.index');
    Route::get('/gestion-de-usuarios-proveedores/{id}/show', [UsersSupplierController::class, 'show'])->name('admin.supplier-users.show');
    Route::post('/gestion-de-usuarios-proveedores/change-password', [UsersSupplierController::class, 'changePasword'])->name('admin.supplier-users.changePasword');
    Route::get('/gestion-de-usuarios-proveedores/{id}/activated', [UsersSupplierController::class, 'activated'])->name('admin.supplier-users.activated');
    Route::get('/gestion-de-usuarios-proveedores/{id}/desactivated', [UsersSupplierController::class, 'desactivated'])->name('admin.supplier-users.desactivated');
    Route::get('/gestion-de-usuarios-proveedores/{id}/deleted', [UsersSupplierController::class, 'delete'])->name('admin.supplier-users.delete');
    Route::get('/gestion-de-usuarios-proveedores/{id}/get-password', [UsersSupplierController::class, 'getPassword'])->name('admin.supplier-users.getPassword');


    # Usuarios de Prueba
    Route::get('/gestion-de-usuarios-prueba', [UsersPruebaController::class, 'index'])->name('admin.prueba-users.index');
    Route::get('/gestion-de-usuarios-prueba/{id}/show', [UsersPruebaController::class, 'show'])->name('admin.prueba-users.show');
    Route::post('/gestion-de-usuarios-prueba/change-password', [UsersPruebaController::class, 'changePasword'])->name('admin.prueba-users.changePasword');
    Route::get('/gestion-de-usuarios-prueba/{id}/activated', [UsersPruebaController::class, 'activated'])->name('admin.prueba-users.activated');
    Route::get('/gestion-de-usuarios-prueba/{id}/desactivated', [UsersPruebaController::class, 'desactivated'])->name('admin.prueba-users.desactivated');

    # chat con proveedores
    Route::get('/buzon-de-mensajes-proveedores', [AdminSupplierChatController::class, 'index'])->name('admin.supplier-chat.index');
    Route::get('/buzon-de-mensajes-proveedores/create', [AdminSupplierChatController::class, 'create'])->name('admin.supplier-chat.create');
    Route::post('/buzon-de-mensajes-proveedores/store', [AdminSupplierChatController::class, 'storeBuzon'])->name('admin.supplier-chat.storeBuzon');
    Route::get('/buzon-de-mensajes-proveedores/{id}/show', [AdminSupplierChatController::class, 'show'])->name('admin.supplier-chat.show');
    Route::post('/buzon-de-mensajes-proveedores/{id}/store', [AdminSupplierChatController::class, 'store'])->name('admin.supplier-chat.store');



    #### FIN ADMINISTRADOR ####


    ##### PROVEEDOR ######

    Route::get('/notificaciones-de-proveedor', [SupplierNotificactionController::class, 'get_notifications'])->name('notifications-supplier');
    Route::get('/notificaciones-de-proveedor/{notification}/read', [SupplierNotificactionController::class, 'read_notification'])->name('notifications-supplier.read');
    Route::get('/notificaciones-de-proveedor/marcar-leido', [SupplierNotificactionController::class, 'markedAsRead'])->name('notifications-supplier.markedAsRead');
    Route::get('/notificaciones-de-proveedor/{notification}/delete', [SupplierNotificactionController::class, 'delete'])->name('notifications-supplier.delete');
    # dashboard y nav
    Route::get('/metricas-proveedor', [SupplierDashboardController::class, 'index'])->name('supplier.dashboard');


    # products
    Route::get('/productos', [ProductController::class, 'index'])->name('product.index');
    Route::get('/productos/datatable', [ProductController::class, 'datatable'])->name('product.datatable');
    Route::get('/productos/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/productos', [ProductController::class, 'store'])->name('product.store');
    Route::get('/productos/{product}/show', [ProductController::class, 'show'])->name('product.show');
    Route::get('/productos/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/productos/{product}/update', [ProductController::class, 'update'])->name('product.update');
    Route::get('/productos/{product}/delete', [ProductController::class, 'destroy'])->name('product.destroy');

    # servicios
    Route::get('/servicios', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/servicios/datatable', [ServiceController::class, 'datatable'])->name('service.datatable');
    Route::get('/servicios/create', [ServiceController::class, 'create'])->name('service.create');
    Route::post('/servicios', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/servicios/{service}/show', [ServiceController::class, 'show'])->name('service.show');
    Route::get('/servicios/{service}/edit', [ServiceController::class, 'edit'])->name('service.edit');
    Route::put('/servicios/{service}/update', [ServiceController::class, 'update'])->name('service.update');
    Route::get('/servicios/{service}/delete', [ServiceController::class, 'destroy'])->name('service.destroy');

    # Profesionales
    Route::get('/profesionales', [ProfessionalController::class, 'index'])->name('professional.index');
    Route::get('/profesionales/datatable', [ProfessionalController::class, 'datatable'])->name('professional.datatable');
    Route::get('/profesionales/create', [ProfessionalController::class, 'create'])->name('professional.create');
    Route::post('/profesionales', [ProfessionalController::class, 'store'])->name('professional.store');
    Route::get('/profesionales/{professional}/show', [ProfessionalController::class, 'show'])->name('professional.show');
    Route::get('/profesionales/{professional}/edit', [ProfessionalController::class, 'edit'])->name('professional.edit');
    Route::put('/profesionales/{professional}/update', [ProfessionalController::class, 'update'])->name('professional.update');
    Route::get('/profesionales/{professional}/delete', [ProfessionalController::class, 'destroy'])->name('professional.destroy');

    # Requests panel de Proveedores
    Route::get('/solicitudes', [RequestSupplierController::class, 'index'])->name('supplier-request.index');
    Route::get('/solicitudes/datatable', [RequestSupplierController::class, 'datatable'])->name('supplier-request.datatable');
    Route::get('/solicitudes/{request}/show', [RequestSupplierController::class, 'show'])->name('supplier-request.show');
    Route::post('/solicitudes/{request}/chat', [RequestSupplierController::class, 'storeChat'])->name('supplier-request.storeChat');

    # Chat con administracion
    Route::get('/buzon-de-mensajes', [SupplierChatController::class, 'index'])->name('supplier-chat.index');
    Route::post('/buzon-de-mensajes/store', [SupplierChatController::class, 'store'])->name('supplier-chat.store');
    ###### FIN PROVEEDOR ######


    ###### EMPRESA ######

    # Requests panel de Empresas
    Route::get('/mis-solicitudes', [BussinesRequestController::class, 'index'])->name('bussines-request.index');
    Route::get('/mis-solicitudes/datatable', [BussinesRequestController::class, 'datatable'])->name('bussines-request.datatable');
    Route::get('/mis-solicitudes/create-product', [BussinesRequestController::class, 'createProduct'])->name('bussines-request.createProduct');
    Route::post('/mis-solicitudes/store-product', [BussinesRequestController::class, 'storeProduct'])->name('bussines-request.storeProduct');
    Route::get('/mis-solicitudes/create-service', [BussinesRequestController::class, 'createService'])->name('bussines-request.createService');
    Route::post('/mis-solicitudes/store-service', [BussinesRequestController::class, 'storeService'])->name('bussines-request.storeService');
    Route::get('/mis-solicitudes/create-professional', [BussinesRequestController::class, 'createProfessional'])->name('bussines-request.createProfessional');
    Route::post('/mis-solicitudes/store-professional', [BussinesRequestController::class, 'storeProfessional'])->name('bussines-request.storeProfessional');
    # Chat de solicitud
    Route::get('/mis-solicitudes/{request}/chat', [BussinesRequestChatController::class, 'index'])->name('bussines-request.chat');
    Route::post('/mis-solicitudes/{request}/chat', [BussinesRequestChatController::class, 'storeChat'])->name('bussines-request.storeChat');
    Route::post('/mis-solicitudes/{request}/cambiar-estatus', [BussinesRequestChatController::class, 'changeStatus'])->name('bussines-request.changeStatus');
    # Chat con administracion
    Route::get('/buzon', [BussinesChatController::class, 'index'])->name('bussines-chat.index');
    Route::post('/buzon/store', [BussinesChatController::class, 'store'])->name('bussines-chat.store');

    # Subcuentas
    Route::get('/subcuentas', [SubAccountController::class, 'index'])->name('subaccount.index');

    # Usuarios
    Route::get('/gestion-de-usuarios', [BussinesUsersController::class, 'index'])->name('bussines-users.index');
    ###### FIN EMPRESA ######

});
Route::get('comandos', function () {
    Artisan::call('optimize');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:cache');
    Artisan::call('route:cache');

    return 'Comandos ejecutados con éxitos';
});

require __DIR__.'/auth.php';
