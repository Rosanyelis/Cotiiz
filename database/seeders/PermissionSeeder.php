<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dev = Role::where('name', 'Desarrollador')->first();
        $admin = Role::where('name', 'Administrador')->first();
        $empresa = Role::where('name', 'Empresa')->first();
        $proveedor = Role::where('name', 'Proveedor')->first();
        // $empresaPrueba = Role::where('name', 'Empresa-Prueba')->first();
        // $proveedorPrueba = Role::where('name', 'Proveedor-Prueba')->first();
        // $empresaOperador = Role::where('name', 'Empresa-Operador')->first();
        // $proveedorOperador = Role::where('name', 'Proveedor-Operador')->first();

        # Dashboard
        # Perfil
        $permiso = Permission::create(['name' => 'profile.edit']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $empresa->givePermissionTo($permiso);
        $proveedor->givePermissionTo($permiso);

        $permiso = Permission::create(['name' => 'profile.update']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $empresa->givePermissionTo($permiso);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'profile.destroy']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);

        # Profesiones
        $permiso = Permission::create(['name' => 'occupation.index']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'occupation.create']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'occupation.store']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'occupation.edit']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'occupation.update']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'occupation.destroy']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'occupation.viewimport']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'occupation.import']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);

        # Especialidades
        $permiso = Permission::create(['name' => 'specialty.index']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'specialty.create']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'specialty.store']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'specialty.edit']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'specialty.update']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'specialty.destroy']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'specialty.viewimport']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'specialty.import']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        # Servicios
        $permiso = Permission::create(['name' => 'service.index']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'service.create']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'service.store']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'service.show']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'service.edit']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'service.update']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'service.destroy']);
        $proveedor->givePermissionTo($permiso);
        # Profesionales
        $permiso = Permission::create(['name' => 'professional.index']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'professional.create']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'professional.store']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'professional.show']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'professional.edit']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'professional.update']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'professional.destroy']);
        $proveedor->givePermissionTo($permiso);
        # Productos
        $permiso = Permission::create(['name' => 'product.index']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'product.create']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'product.store']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'product.show']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'product.edit']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'product.update']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'product.destroy']);
        $proveedor->givePermissionTo($permiso);
        # Empresas
        $permiso = Permission::create(['name' => 'business.index']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'business.create']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'business.store']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'business.show']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'business.edit']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'business.update']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'business.activated']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'business.desactivated']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'business.users']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'business.users.create_users']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'business.users.store_users']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'business.users.activated']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'business.users.desactivated']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        # Proveedores
        $permiso = Permission::create(['name' => 'supplier.index']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'supplier.create']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'supplier.store']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'supplier.show']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'supplier.edit']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'supplier.update']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'supplier.activated']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'supplier.desactivated']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'supplier.users']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'supplier.users.create_users']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'supplier.users.store_users']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'supplier.users.activated']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'supplier.users.desactivated']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        # Usuarios
        $permiso = Permission::create(['name' => 'user.index']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'user.create']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'user.store']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'user.show']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'user.edit']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'user.update']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'user.destroy']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'user.activated']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'user.desactivated']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        # Solicitudes de proveedores
        $permiso = Permission::create(['name' => 'request-supplier.index']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'request-supplier.datatable']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'request-supplier.create']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'request-supplier.store']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'request-supplier.show']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'request-supplier.storeChat']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'request-supplier.changeStatus']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        # Solicitudes de empresas
        $permiso = Permission::create(['name' => 'bussines-request.index']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'bussines-request.datatable']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'bussines-request.store']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'bussines-request.show']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'bussines-request.storeChat']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        # Solicitudes panel de proveedores
        $permiso = Permission::create(['name' => 'supplier-request.index']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'supplier-request.datatable']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'supplier-request.show']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'supplier-request.storeChat']);
        $proveedor->givePermissionTo($permiso);
        # Solicitudes panel de empresas
        $permiso = Permission::create(['name' => 'request-bussines.index']);
        $empresa->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'request-bussines-request.datatable']);
        $empresa->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'request-bussines-request.show']);
        $empresa->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'request-bussines-request.storeChat']);
        $empresa->givePermissionTo($permiso);
        # Roles
        $permiso = Permission::create(['name' => 'role.index']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'role.create']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'role.store']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'role.show']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'role.edit']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'role.update']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'role.destroy']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        # chat de proveedores
        $permiso = Permission::create(['name' => 'chat-supplier.index']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'chat-supplier.datatable']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'chat-supplier.show']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'chat-supplier.store-chat']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        # chat de empresas
        $permiso = Permission::create(['name' => 'chat-bussines.index']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'chat-bussines.datatable']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'chat-bussines.show']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'chat-bussines.store-chat']);
        $dev->givePermissionTo($permiso);
        $admin->givePermissionTo($permiso);
        # chat de panel de proveedores
        $permiso = Permission::create(['name' => 'supplier-chat.index']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'supplier-chat.datatable']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'supplier-chat.show']);
        $proveedor->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'supplier-chat.store-chat']);
        $proveedor->givePermissionTo($permiso);
        # chat de panel de empresas
        $permiso = Permission::create(['name' => 'bussines-chat.index']);
        $empresa->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'bussines-chat.datatable']);
        $empresa->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'bussines-chat.show']);
        $empresa->givePermissionTo($permiso);
        $permiso = Permission::create(['name' => 'bussines-chat.store-chat']);
        $empresa->givePermissionTo($permiso);


    }
}
