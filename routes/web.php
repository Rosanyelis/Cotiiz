<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KambanController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\WorkOrderController;
use App\Http\Controllers\OccupationController;
use App\Http\Controllers\RfcBussinesController;
use App\Http\Controllers\RfcSupplierController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\RequestSupplierController;
use App\Http\Controllers\SupplierRequestController;



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

    # Customers
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

    # Requests Proveedores
    Route::get('/solicitudes-de-proveedor', [SupplierRequestController::class, 'index'])->name('request-supplier.index');
    Route::get('/solicitudes-de-proveedor/datatable', [SupplierRequestController::class, 'datatable'])->name('request-supplier.datatable');
    Route::get('/solicitudes-de-proveedor/create', [SupplierRequestController::class, 'create'])->name('request-supplier.create');
    Route::post('/solicitudes-de-proveedor', [SupplierRequestController::class, 'store'])->name('request-supplier.store');
    Route::get('/solicitudes-de-proveedor/{request}/show', [SupplierRequestController::class, 'show'])->name('request-supplier.show');
    Route::post('/solicitudes-de-proveedor/{request}/chat', [SupplierRequestController::class, 'storeChat'])->name('request-supplier.storeChat');
    Route::post('/solicitudes-de-proveedor/{request}/cambiar-estatus', [SupplierRequestController::class, 'changeStatus'])->name('request-supplier.changeStatus');

    # Requests panel de Proveedores
    Route::get('/solicitudes', [RequestSupplierController::class, 'index'])->name('supplier-request.index');
    Route::get('/solicitudes/datatable', [RequestSupplierController::class, 'datatable'])->name('supplier-request.datatable');
    Route::post('/solicitudes', [RequestSupplierController::class, 'store'])->name('supplier-request.store');
    Route::get('/solicitudes/{request}/show', [RequestSupplierController::class, 'show'])->name('supplier-request.show');
    Route::post('/solicitudes/{request}/chat', [RequestSupplierController::class, 'storeChat'])->name('supplier-request.storeChat');
    Route::post('/solicitudes/{request}/cambiar-estatus', [RequestSupplierController::class, 'changeStatus'])->name('supplier-request.changeStatus');

    # Expenses
    Route::get('/gastos', [ExpenseController::class, 'index'])->name('expense.index');
    Route::get('/gastos/create', [ExpenseController::class, 'create'])->name('expense.create');
    Route::post('/gastos', [ExpenseController::class, 'store'])->name('expense.store');
    Route::get('/gastos/{gasto}/show', [ExpenseController::class, 'show'])->name('expense.show');
    Route::get('/gastos/{gasto}/edit', [ExpenseController::class, 'edit'])->name('expense.edit');
    Route::put('/gastos/{gasto}/update', [ExpenseController::class, 'update'])->name('expense.update');
    Route::get('/gastos/{gasto}/delete', [ExpenseController::class, 'destroy'])->name('expense.destroy');

    # Quotation
    Route::get('/cotizaciones', [QuotationController::class, 'index'])->name('quote.index');
    Route::get('/cotizaciones/datatable', [QuotationController::class, 'datatable'])->name('quote.datatable');
    Route::get('/cotizaciones/create', [QuotationController::class, 'create'])->name('quote.create');
    Route::post('/cotizaciones', [QuotationController::class, 'store'])->name('quote.store');
    Route::get('/cotizaciones/{quotation}/show', [QuotationController::class, 'show'])->name('quote.show');
    Route::get('/cotizaciones/{quotation}/edit', [QuotationController::class, 'edit'])->name('quote.edit');
    Route::post('/cotizaciones/{quotation}/update', [QuotationController::class, 'update'])->name('quote.update');
    Route::get('/cotizaciones/{quotation}/delete', [QuotationController::class, 'destroy'])->name('quote.destroy');
    Route::get('/cotizaciones/{quotation}/productjson', [QuotationController::class, 'productjson'])->name('quote.productjson');
    Route::get('/cotizaciones/{quotation}/quotepdf', [QuotationController::class, 'quotepdf'])->name('quote.quotepdf');
    Route::get('/cotizaciones/{quotation}/enviar-cotizacion', [QuotationController::class, 'sendEmailQuotepdf'])->name('quote.sendEmailQuotepdf');
    Route::post('/cotizaciones/cambiar-status', [QuotationController::class, 'cambiarStatus'])->name('quote.cambiarStatus');
    Route::post('/cotizaciones/agregar-numero-de-factura', [QuotationController::class, 'addReferencias'])->name('quote.addReferencias');

    # Contract
    Route::get('/contratos', [ContractController::class, 'index'])->name('contract.index');
    Route::get('/contratos/create', [ContractController::class, 'create'])->name('contract.create');
    Route::post('/contratos', [ContractController::class, 'store'])->name('contract.store');
    Route::get('/contratos/{contract}/show', [ContractController::class, 'show'])->name('contract.show');
    Route::get('/contratos/{contract}/edit', [ContractController::class, 'edit'])->name('contract.edit');
    Route::put('/contratos/{contract}/update', [ContractController::class, 'update'])->name('contract.update');
    Route::get('/contratos/{contract}/delete', [ContractController::class, 'destroy'])->name('contract.destroy');

    # Invoices
    Route::get('/facturas', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/facturas/create', [InvoiceController::class, 'create'])->name('invoice.create');
    Route::post('/facturas', [InvoiceController::class, 'store'])->name('invoice.store');
    Route::get('/facturas/{invoice}/show', [InvoiceController::class, 'show'])->name('invoice.show');
    Route::get('/facturas/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoice.edit');
    Route::put('/facturas/{invoice}/update', [InvoiceController::class, 'update'])->name('invoice.update');
    Route::get('/facturas/{invoice}/delete', [InvoiceController::class, 'destroy'])->name('invoice.destroy');

    # Compras
    Route::get('/compras', [PurchaseController::class, 'index'])->name('purchase.index');
    Route::get('/compras/datatable', [PurchaseController::class, 'datatable'])->name('purchase.datatable');
    Route::get('/compras/{product}/productjson', [PurchaseController::class, 'productjson'])->name('purchase.productjson');
    Route::get('/compras/create', [PurchaseController::class, 'create'])->name('purchase.create');
    Route::post('/compras', [PurchaseController::class, 'store'])->name('purchase.store');
    Route::get('/compras/{purchase}/show', [PurchaseController::class, 'show'])->name('purchase.show');
    Route::get('/compras/{purchase}/edit', [PurchaseController::class, 'edit'])->name('purchase.edit');
    Route::put('/compras/{purchase}/update', [PurchaseController::class, 'update'])->name('purchase.update');
    Route::get('/compras/{purchase}/delete', [PurchaseController::class, 'destroy'])->name('purchase.destroy');

    # Purchase Order
    Route::get('/ordenes-de-compra', [PurchaseOrderController::class, 'index'])->name('purchaseorder.index');
    Route::get('/ordenes-de-compra/datatable', [PurchaseOrderController::class, 'datatable'])->name('purchaseorder.datatable');
    Route::get('/ordenes-de-compra/create', [PurchaseOrderController::class, 'create'])->name('purchaseorder.create');
    Route::post('/ordenes-de-compra', [PurchaseOrderController::class, 'store'])->name('purchaseorder.store');
    Route::get('/ordenes-de-compra/{purchaseorder}/show', [PurchaseOrderController::class, 'show'])->name('purchaseorder.show');
    Route::get('/ordenes-de-compra/{purchaseorder}/edit', [PurchaseOrderController::class, 'edit'])->name('purchaseorder.edit');
    Route::put('/ordenes-de-compra/{purchaseorder}/update', [PurchaseOrderController::class, 'update'])->name('purchaseorder.update');
    Route::get('/ordenes-de-compra/{purchaseorder}/delete', [PurchaseOrderController::class, 'destroy'])->name('purchaseorder.destroy');

    # work order
    Route::get('/ordenes-de-trabajo', [WorkOrderController::class, 'index'])->name('workorder.index');
    Route::get('/ordenes-de-trabajo/create', [WorkOrderController::class, 'create'])->name('workorder.create');
    Route::post('/ordenes-de-trabajo', [WorkOrderController::class, 'store'])->name('workorder.store');
    Route::get('/ordenes-de-trabajo/{workorder}/show', [WorkOrderController::class, 'show'])->name('workorder.show');
    Route::get('/ordenes-de-trabajo/{workorder}/edit', [WorkOrderController::class, 'edit'])->name('workorder.edit');
    Route::put('/ordenes-de-trabajo/{workorder}/update', [WorkOrderController::class, 'update'])->name('workorder.update');
    Route::post('/ordenes-de-trabajo/delete', [WorkOrderController::class, 'destroy'])->name('workorder.destroy');

    # users
    Route::get('/usuarios', [UserController::class, 'index'])->name('user.index');
    Route::get('/usuarios/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/usuarios', [UserController::class, 'store'])->name('user.store');
    Route::get('/usuarios/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/usuarios/{user}/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/usuarios/{user}/delete', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/usuarios/{user}/activated', [UserController::class, 'activated'])->name('users.activated');
    Route::get('/usuarios/{user}/desactivated', [UserController::class, 'desactivated'])->name('users.desactivated');

     # Task
     Route::get('/tareas', [TodoListController::class, 'index'])->name('task.index');
     Route::get('/tareas/create', [TodoListController::class, 'create'])->name('task.create');
     Route::post('/tareas/store', [TodoListController::class, 'store'])->name('task.store');
     Route::post('/tareas/cambiar-estado', [TodoListController::class, 'changeStatus'])->name('task.changeStatus');
     Route::post('/tareas/destroy', [TodoListController::class, 'destroy'])->name('task.destroy');
});

require __DIR__.'/auth.php';
