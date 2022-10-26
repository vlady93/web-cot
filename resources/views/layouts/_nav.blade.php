<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html"> <img alt="image" src="" class="header-logo" /> <span
            class="logo-name">Otika</span>
        </a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Main</li>
        <li class="dropdown menu">
          <a href="index.html" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
        </li>
        @can('ver-cliente')
        <li><a class="nav-link" href={{route('clientes.index')}} ><i data-feather="users"></i><span>Clientes</span></a></li>
        @endcan
        @can('ver-termino')
        <li><a class="nav-link" href={{route('terminos.index')}} ><i data-feather="file-text"></i><span>Terminos</span></a></li>
        @endcan
        @can('ver-penalidad')
        <li><a class="nav-link" href= {{route('liquidacion_detalles.index')}}><i data-feather="edit"></i><span>Penalidades</span></a></li>
        @endcan
        @can('ver-liquidacion')
        <li><a class="nav-link" href={{route('liquidacions.index')}} ><i data-feather="clipboard"></i><span>Liquidaciones</span></a></li>
        @endcan
        @can('ver-usuario')
        <li><a class="nav-link" href={{route('usuarios.index')}} ><i data-feather="user"></i><span>Usuarios</span></a></li>
        @endcan
       
        @can('ver-rol')
        <li><a class="nav-link" href={{route('roles.index')}} ><i data-feather="tag"></i><span>Roles</span></a></li>
        @endcan
        
      </ul>
    </aside>
  </div>