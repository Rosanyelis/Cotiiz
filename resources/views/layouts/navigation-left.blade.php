        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="{{ route('dashboard') }}" class="app-brand-link">
                    <span class="app-brand-logo demo">
                        <span style="color: var(--bs-primary)">
                            <img src="{{ asset('assets/img/logo-cotiz.png') }}" width="185" height="70" alt="" >
                        </span>
                    </span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                        d="M8.47365 11.7183C8.11707 12.0749 8.11707 12.6531 8.47365 13.0097L12.071 16.607C12.4615 16.9975 12.4615 17.6305 12.071 18.021C11.6805 18.4115 11.0475 18.4115 10.657 18.021L5.83009 13.1941C5.37164 12.7356 5.37164 11.9924 5.83009 11.5339L10.657 6.707C11.0475 6.31653 11.6805 6.31653 12.071 6.707C12.4615 7.09747 12.4615 7.73053 12.071 8.121L8.47365 11.7183Z"
                        fill-opacity="0.9" />
                        <path
                        d="M14.3584 11.8336C14.0654 12.1266 14.0654 12.6014 14.3584 12.8944L18.071 16.607C18.4615 16.9975 18.4615 17.6305 18.071 18.021C17.6805 18.4115 17.0475 18.4115 16.657 18.021L11.6819 13.0459C11.3053 12.6693 11.3053 12.0587 11.6819 11.6821L16.657 6.707C17.0475 6.31653 17.6805 6.31653 18.071 6.707C18.4615 7.09747 18.4615 7.73053 18.071 8.121L14.3584 11.8336Z"
                        fill-opacity="0.4" />
                    </svg>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                @if(auth()->user()->hasRole('Administrador') || auth()->user()->hasRole('Desarrollador')
                || auth()->user()->hasRole('Operador'))
                    <!-- Dashboards -->
                    <li class="menu-item @if (Route::currentRouteName() == 'dashboard') active @endif">
                        <a href="{{ route('dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons ri-home-smile-line"></i>
                            <div data-i18n="Dashboard">Dashboard</div>
                        </a>
                    </li>
                    <li class="menu-item
                        @if (Route::currentRouteName() == 'business.index' ||
                            Route::currentRouteName() == 'business.create' ||
                            Route::currentRouteName() == 'business.edit' ||
                            Route::currentRouteName() == 'business.show')
                            active open
                        @endif">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ri-shield-user-line"></i>
                            <div data-i18n="Empresas">Empresas</div>
                            <div id="nav-empresa" class="badge bg-danger rounded-pill ms-auto">0</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item
                                @if (Route::currentRouteName() == 'business.index') active @endif">
                                <a href="{{ route('business.index') }}" class="menu-link">
                                    <div data-i18n="Listado">Listado</div>
                                </a>
                            </li>
                            <li class="menu-item
                                @if (Route::currentRouteName() == 'business.create') active @endif">
                                <a href="{{ route('business.create') }}" class="menu-link">
                                    <div data-i18n="Agregar Empresa">Agregar Empresa</div>
                                </a>
                            </li>
                            <li class="menu-item
                                @if (Route::currentRouteName() == 'business.create_user_bussines') active @endif">
                                <a href="{{ route('business.create_user_bussines') }}" class="menu-link">
                                    <div data-i18n="Agregar Usuario">Agregar Usuario</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item
                        @if (Route::currentRouteName() == 'supplier.index' ||
                            Route::currentRouteName() == 'supplier.create' ||
                            Route::currentRouteName() == 'supplier.edit' ||
                            Route::currentRouteName() == 'supplier.show') active @endif">
                        <a href="{{ route('supplier.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons ri-shield-user-line"></i>
                            <div data-i18n="Proveedores">Proveedores</div>
                            <div id="nav-proveedor" class="badge bg-danger rounded-pill ms-auto">0</div>
                        </a>
                    </li>
                    <!-- solicitudes creadas por administrador -->
                    <li class="menu-header mt-1">
                        <span class="menu-header-text" data-i18n="Usuarios">Usuarios</span>
                    </li>
                    <li class="menu-item
                        @if (Route::currentRouteName() == 'admin.bussines-users.index' ||
                            Route::currentRouteName() == 'admin.bussines-users.show' ||
                            Route::currentRouteName() == 'admin.supplier-users.index'||
                            Route::currentRouteName() == 'admin.supplier-users.show' ||
                            Route::currentRouteName() == 'admin.prueba-users.index' ||
                            Route::currentRouteName() == 'admin.prueba-users.show'
                            )
                            active open
                        @endif
                    ">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ri-group-2-fill"></i>
                            <div data-i18n="Usuarios">Usuarios</div>
                            <div id="nav-usuarios" class="badge bg-danger rounded-pill ms-auto">0</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item
                                @if (Route::currentRouteName() == 'admin.bussines-users.index'
                                    || Route::currentRouteName() == 'admin.bussines-users.show') active @endif">
                                <a href="{{ route('admin.bussines-users.index') }}" class="menu-link">
                                    <div data-i18n="Empresas">Empresas</div>
                                    <div id="nav-usersempresa" class="badge bg-danger rounded-pill ms-auto">0</div>
                                </a>
                            </li>
                            <li class="menu-item
                                @if (Route::currentRouteName() == 'admin.supplier-users.index'
                                    || Route::currentRouteName() == 'admin.supplier-users.show') active @endif">
                                <a href="{{ route('admin.supplier-users.index') }}" class="menu-link">
                                    <div data-i18n="Proveedores">Proveedores</div>
                                    <div id="nav-usersproveedor" class="badge bg-danger rounded-pill ms-auto">0</div>
                                </a>
                            </li>
                            <li class="menu-item
                                @if (Route::currentRouteName() == 'admin.prueba-users.index'
                                || Route::currentRouteName() == 'admin.prueba-users.show') active @endif">
                                <a href="{{ route('admin.prueba-users.index') }}" class="menu-link">
                                    <div data-i18n="Prueba">Prueba</div>
                                    <div id="nav-usersprueba" class="badge bg-danger rounded-pill ms-auto">0</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- solicitudes creadas por administrador -->
                    <li class="menu-header mt-1">
                        <span class="menu-header-text" data-i18n="Solicitudes">Solicitudes</span>
                    </li>
                    <li class="menu-item
                        @if (Route::currentRouteName() == 'request-supplier.index' ||
                            Route::currentRouteName() == 'request-supplier.create' ||
                            Route::currentRouteName() == 'request-supplier.show'
                            || Route::currentRouteName() == 'admin.supplier-users.index'
                            || Route::currentRouteName() == 'admin-request-bussines.show')
                            active open
                        @endif
                    ">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ri-list-view"></i>
                            <div data-i18n="Solicitudes">Solicitudes</div>
                            <div id="nav-solicitudes" class="badge bg-danger rounded-pill ms-auto">0</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item
                                @if (Route::currentRouteName() == 'request-supplier.index'
                                    || Route::currentRouteName() == 'request-supplier.show'
                                    || Route::currentRouteName() == 'request-supplier.create') active @endif">
                                <a href="{{ route('request-supplier.index') }}" class="menu-link">
                                    <div data-i18n="Solicitudes de Proveedor">Solicitudes de Proveedor</div>
                                    <div id="nav-solicitudesproveedor" class="badge bg-danger rounded-pill ms-auto">0</div>
                                </a>
                            </li>
                            <li class="menu-item
                                @if (Route::currentRouteName() == 'admin-request-bussines.index'
                                || Route::currentRouteName() == 'admin-request-bussines.show') active @endif">
                                <a href="{{ route('admin-request-bussines.index') }}" class="menu-link">
                                    <div data-i18n="Solicitudes de Empresa">Solicitudes de Empresa</div>
                                    <div id="nav-solicitudesempresa" class="badge bg-danger rounded-pill ms-auto">0</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-header mt-1">
                        <span class="menu-header-text" data-i18n="Catálogos">Catálogos</span>
                    </li>
                    <li class="menu-item
                        @if (Route::currentRouteName() == 'admin.product.index'     ||
                                Route::currentRouteName() == 'admin.product.create' ||
                                Route::currentRouteName() == 'admin.product.edit'   ||
                                Route::currentRouteName() == 'admin.product.show'   ||
                                Route::currentRouteName() == 'admin.service.index'  ||
                                Route::currentRouteName() == 'admin.service.create' ||
                                Route::currentRouteName() == 'admin.service.edit'   ||
                                Route::currentRouteName() == 'admin.service.show '  ||
                                Route::currentRouteName() == 'admin.professional.index' ||
                                Route::currentRouteName() == 'admin.professional.create' ||
                                Route::currentRouteName() == 'admin.professional.edit' ||
                                Route::currentRouteName() == 'admin.professional.show')
                            active open
                        @endif
                    ">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ri-box-3-fill"></i>
                            <div data-i18n="Catálogos">Catálogos</div>
                            <div id="nav-catalogo" class="badge bg-danger rounded-pill ms-auto">0</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item
                                @if (Route::currentRouteName() == 'admin.product.index' ||
                                    Route::currentRouteName() == 'admin.product.create' ||
                                    Route::currentRouteName() == 'admin.product.edit' ||
                                    Route::currentRouteName() == 'admin.product.show') active @endif">
                                <a href="{{ route('admin.product.index') }}" class="menu-link">
                                    <div data-i18n="Productos">Productos</div>
                                    <div id="nav-productos" class="badge bg-danger rounded-pill ms-auto">0</div>
                                </a>
                            </li>
                            <li class="menu-item
                                @if (Route::currentRouteName() == 'admin.service.index' ||
                                        Route::currentRouteName() == 'admin.service.create' ||
                                        Route::currentRouteName() == 'admin.service.edit' ||
                                        Route::currentRouteName() == 'admin.service.show') active @endif">
                                <a href="{{ route('admin.service.index') }}" class="menu-link">
                                    <div data-i18n="Servicios">Servicios</div>
                                    <div id="nav-servicios" class="badge bg-danger rounded-pill ms-auto">0</div>
                                </a>
                            </li>
                            <li class="menu-item
                               @if (Route::currentRouteName() == 'admin.professional.index' ||
                                    Route::currentRouteName() == 'admin.professional.create' ||
                                    Route::currentRouteName() == 'admin.professional.edit' ||
                                    Route::currentRouteName() == 'admin.professional.show') active @endif">
                                <a href="{{ route('admin.professional.index') }}" class="menu-link">
                                    <div data-i18n="Profesionales">Profesionales</div>
                                    <div id="nav-profesional" class="badge bg-danger rounded-pill ms-auto">0</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-header mt-1">
                        <span class="menu-header-text" data-i18n="Chats">Chats</span>
                    </li>
                    <!-- buzon proveedor -->
                    <li class="menu-item
                        @if (Route::currentRouteName() == 'admin.supplier-chat.index' ||
                            Route::currentRouteName() == 'admin.supplier-chat.show' ||
                            Route::currentRouteName() == 'admin.supplier-chat.chat')
                            active
                        @endif
                        ">
                        <a href="{{ route('admin.supplier-chat.index') }} " class="menu-link">
                            <i class="menu-icon tf-icons ri-chat-1-line"></i>
                            <div data-i18n="Buzón Proveedores">Buzón Proveedores</div>
                            <div id="nav-buzon" class="badge bg-danger rounded-pill ms-auto">0</div>
                        </a>
                    </li>
                    <li class="menu-header mt-1">
                        <span class="menu-header-text" data-i18n="Configuración">Configuración</span>
                    </li>
                    <li class="menu-item
                        @if (Route::currentRouteName() == 'occupation.index' ||
                            Route::currentRouteName() == 'occupation.create' ||
                            Route::currentRouteName() == 'occupation.edit' ||
                            Route::currentRouteName() == 'specialty.index' ||
                            Route::currentRouteName() == 'specialty.create' ||
                            Route::currentRouteName() == 'specialty.edit')
                            active open
                        @endif
                    ">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ri-settings-4-fill"></i>
                            <div data-i18n="Configuración">Configuración</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item
                                @if (Route::currentRouteName() == 'occupation.index'
                                    || Route::currentRouteName() == 'occupation.create'
                                    || Route::currentRouteName() == 'occupation.edit') active @endif">
                                <a href="{{ route('occupation.index') }}" class="menu-link">
                                    <div data-i18n="Profesiones">Profesiones</div>
                                </a>
                            </li>
                            <li class="menu-item
                                @if (Route::currentRouteName() == 'specialty.index'
                                || Route::currentRouteName() == 'specialty.create'
                                || Route::currentRouteName() == 'specialty.edit') active @endif">
                                <a href="{{ route('specialty.index') }}" class="menu-link">
                                    <div data-i18n="Especialiadades">Especialiadades</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(auth()->user()->hasRole('Empresa')|| auth()->user()->hasRole('Empresa-Prueba'))
                    <!-- Dashboards -->
                    <li class="menu-item @if (Route::currentRouteName() == 'dashboard') active @endif">
                        <a href="{{ route('dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons ri-home-smile-line"></i>
                            <div data-i18n="Dashboard">Dashboard</div>
                        </a>
                    </li>

                    <li class="menu-item
                        @if (Route::currentRouteName() == 'bussines-request.index' ||
                            Route::currentRouteName() == 'bussines-request.create' ||
                            Route::currentRouteName() == 'bussines-request.show' ||
                            Route::currentRouteName() == 'bussines-request.chat'
                            ) active
                        @endif">
                        <a href="{{ route('bussines-request.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons ri-mail-check-line"></i>
                            <div data-i18n="Mis solicitudes">Mis solicitudes</div>
                        </a>
                    </li>
                    <li class="menu-header mt-5">
                        <span class="menu-header-text" data-i18n="Cuentas">Cuentas</span>
                    </li>
                    <li class="menu-item
                        @if (Route::currentRouteName() == 'subaccount.index')
                            active
                        @endif">
                        <a href="{{ route('subaccount.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons ri-group-fill"></i>
                            <div data-i18n="Subcuentas">Subcuentas</div>
                        </a>
                    </li>
                    <li class="menu-item
                        @if (Route::currentRouteName() == 'bussines-users.index')
                            active
                        @endif">
                        <a href="{{ route('bussines-users.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons ri-group-3-fill"></i>
                            <div data-i18n="Usuarios">Usuarios</div>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasRole('Proveedor'))
                    <!-- Dashboards -->
                    <li class="menu-item @if (Route::currentRouteName() == 'dashboard') active @endif">
                        <a href="{{ route('dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons ri-home-smile-line"></i>
                            <div data-i18n="Dashboard">Dashboard</div>
                        </a>
                    </li>
                    <li class="menu-item
                        @if (Route::currentRouteName() == 'supplier-request.index' ||
                            Route::currentRouteName() == 'supplier-request.show') active @endif">
                        <a href="{{ route('supplier-request.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons ri-mail-check-line"></i>
                            <div data-i18n="Solicitudes">Solicitudes</div>
                            <div id="prov-solicitudes" class="badge bg-danger rounded-pill ms-auto">0</div>
                        </a>
                    </li>
                    <li class="menu-header mt-5">
                        <span class="menu-header-text" data-i18n="Catálogos">Catálogos</span>
                    </li>
                    <li class="menu-item
                        @if (Route::currentRouteName() == 'product.index' ||
                            Route::currentRouteName() == 'product.create' ||
                            Route::currentRouteName() == 'product.edit' ||
                            Route::currentRouteName() == 'product.show') active @endif">
                        <a href="{{ route('product.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons ri-box-3-line"></i>
                            <div data-i18n="Productos">Productos</div>
                            <div id="prov-productos" class="badge bg-danger rounded-pill ms-auto">0</div>
                        </a>
                    </li>
                    <li class="menu-item
                        @if (Route::currentRouteName() == 'service.index' ||
                            Route::currentRouteName() == 'service.create' ||
                            Route::currentRouteName() == 'service.edit' ||
                            Route::currentRouteName() == 'service.show') active @endif">
                        <a href="{{ route('service.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons ri-survey-line"></i>
                            <div data-i18n="Servicios">Servicios</div>
                            <div id="prov-servicios" class="badge bg-danger rounded-pill ms-auto">0</div>
                        </a>
                    </li>
                    <li class="menu-item
                        @if (Route::currentRouteName() == 'professional.index' ||
                            Route::currentRouteName() == 'professional.create' ||
                            Route::currentRouteName() == 'professional.edit' ||
                            Route::currentRouteName() == 'professional.show') active @endif">
                        <a href="{{ route('professional.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons ri-user-2-line"></i>
                            <div data-i18n="Profesionales">Profesionales</div>
                            <div id="prov-profesionales" class="badge bg-danger rounded-pill ms-auto">0</div>
                        </a>
                    </li>
                    <li class="menu-header mt-5">
                        <span class="menu-header-text" data-i18n="Chats">Chats</span>
                    </li>
                    <!-- buzon proveedor -->
                    <li class="menu-item
                        @if (Route::currentRouteName() == 'supplier-chat.index')
                            active
                        @endif
                        ">
                        <a href="{{ route('supplier-chat.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons ri-chat-1-line"></i>
                            <div data-i18n="Buzón">Buzón</div>
                            <div id="prov-buzon" class="badge bg-danger rounded-pill ms-auto">0</div>
                        </a>
                    </li>
                @endif

            </ul>
        </aside>
