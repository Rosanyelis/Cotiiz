<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SpecialtyController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\OccupationController;
use App\Http\Controllers\Supplier\ProductController;
use App\Http\Controllers\Admin\RfcBussinesController;
use App\Http\Controllers\Admin\RfcSupplierController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Bussines\SubAccountController;
use App\Http\Controllers\Admin\SupplierRequestController;
use App\Http\Controllers\Bussines\BussinesChatController;
use App\Http\Controllers\Supplier\SupplierChatController;
use App\Http\Controllers\Bussines\BussinesUsersController;
use App\Http\Controllers\Admin\AdminProfessionalController;
use App\Http\Controllers\Bussines\BussinesRequestController;
use App\Http\Controllers\Supplier\RequestSupplierController;
use App\Http\Controllers\Bussines\BussinesRequestChatController;



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

    Route::get('/empresas', [RfcBussinesController::class, 'index'])->name('business.index');
    Route::get('/empresas/create', [RfcBussinesController::class, 'create'])->name('business.create');
    Route::post('/empresas', [RfcBussinesController::class, 'store'])->name('business.store');
    Route::get('/empresas/{cliente}/show', [RfcBussinesController::class, 'show'])->name('business.show');
    Route::get('/empresas/{cliente}/edit', [RfcBussinesController::class, 'edit'])->name('business.edit');
    Route::put('/empresas/{cliente}/update', [RfcBussinesController::class, 'update'])->name('business.update');
    Route::get('/empresas/{cliente}/activated', [RfcBussinesController::class, 'activated'])->name('business.activated');
    Route::get('/empresas/{cliente}/desactivated', [RfcBussinesController::class, 'desactivated'])->name('business.desactivated');
    Route::get('/empresas/{cliente}/users', [RfcBussinesController::class, 'rfcusers'])->name('business.users');
    Route::get('/empresas/{cliente}/users/create', [RfcBussinesController::class, 'create_users'])->name('business.users.create_users');
    Route::post('/empresas/{cliente}/users/store', [RfcBussinesController::class, 'store_users'])->name('business.users.store_users');
    Route::get('/empresas/users/{user}/activated', [RfcBussinesController::class, 'ActivateUsers'])->name('business.users.activated');
    Route::get('/empresas/users/{user}/desactivated', [RfcBussinesController::class, 'DesactivateUsers'])->name('business.users.desactivated');

    Route::get('/proveedores', [RfcSupplierController::class, 'index'])->name('supplier.index');
    Route::get('/proveedores/create', [RfcSupplierController::class, 'create'])->name('supplier.create');
    Route::post('/proveedores', [RfcSupplierController::class, 'store'])->name('supplier.store');
    Route::get('/proveedores/{cliente}/show', [RfcSupplierController::class, 'show'])->name('supplier.show');
    Route::get('/proveedores/{cliente}/edit', [RfcSupplierController::class, 'edit'])->name('supplier.edit');
    Route::put('/proveedores/{cliente}/update', [RfcSupplierController::class, 'update'])->name('supplier.update');
    Route::get('/proveedores/{cliente}/activated', [RfcSupplierController::class, 'activated'])->name('supplier.activated');
    Route::get('/proveedores/{cliente}/desactivated', [RfcSupplierController::class, 'desactivated'])->name('supplier.desactivated');
    Route::get('/proveedores/{cliente}/users', [RfcSupplierController::class, 'rfcusers'])->name('supplier.users');
    Route::get('/proveedores/{cliente}/users/create', [RfcSupplierController::class, 'create_users'])->name('supplier.users.create_users');
    Route::post('/proveedores/{cliente}/users/store', [RfcSupplierController::class, 'store_users'])->name('supplier.users.store_users');
    Route::get('/proveedores/users/{user}/activated', [RfcSupplierController::class, 'ActivateUsers'])->name('supplier.users.activated');
    Route::get('/proveedores/users/{user}/desactivated', [RfcSupplierController::class, 'DesactivateUsers'])->name('supplier.users.desactivated');

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


    #### FIN ADMINISTRADOR ####


    ##### PROVEEDOR ######

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
    Route::get('/usuarios', [BussinesUsersController::class, 'index'])->name('bussines-users.index');
    ###### FIN EMPRESA ######

});

require __DIR__.'/auth.php';
