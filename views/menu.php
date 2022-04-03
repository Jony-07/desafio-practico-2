<nav class="navbar navbar-expand-lg navbar-dark bg-dark navstyle">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"></a>
           <a href="<?=PATH?>"> Textil Export</a>
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?=PATH?>">
                        <i class="bi bi-house-fill"></i> Inicio</a>
                    </li>   

                
                <?php 
                  if(isset($_SESSION['login_buffer'])){
                if($_SESSION['login_buffer']['id_tipo_usuario']==1)
              { ?>
                <li class="nav-item dropdown navbar-right">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-people-fill"></i> Usuarios
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?=PATH?>/Usuarios/Signin">Registrar usuario</a></li>
                   
                        <li><a class="dropdown-item" href="<?=PATH?>/Usuarios/Estado/Habilitado">Usuarios habilitados</a></li>
                        <li><a class="dropdown-item" href="<?=PATH?>/Clientes/Estado/Habilitado">Clientes habilitados</a></li>
                        <li><a class="dropdown-item" href="<?=PATH?>/Usuarios/Estado/Deshabilitado">Usuarios deshabilitados</a></li>
                        <li><a class="dropdown-item" href="<?=PATH?>/Clientes/Estado/Deshabilitado">Clientes deshabilitados</a></li>
                      
                    </ul>
                </li>
                <?php } }?>
                <li class="nav-item dropdown navbar-right">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-box2-heart-fill"></i> Productos
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                        <li><a class="dropdown-item" href="<?=PATH?>/Productos">Ver lista</a></li>
                        <?php 
                    if(isset($_SESSION['login_buffer'])){
                        if($_SESSION['login_buffer']['id_tipo_usuario']!=3){
                        ?>                
                        <li><a class="dropdown-item" href="<?=PATH?>/Productos/Listado">Listado</a></li>
                        <li><a class="dropdown-item" href="<?=PATH?>/Productos/Create">Insertar producto</a></li>
                        <?php 
                    if($_SESSION['login_buffer']['id_tipo_usuario']==1)
              { ?>
                        <li><a class="dropdown-item" href="<?=PATH?>/Productos/Descontinuados">Descontinuados</a></li>
                        <?php } } }?>
                    </ul>
                </li>      
                <li class="nav-item dropdown navbar-right">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-diagram-2-fill"></i> Categorias
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <?php 
                    if(isset($_SESSION['login_buffer'])){
                    if($_SESSION['login_buffer']['id_tipo_usuario']==1)
              { ?>
                        <li><a class="dropdown-item" href="<?=PATH?>/Categorias">Ver lista</a></li>
                        <li><a class="dropdown-item" href="<?=PATH?>/Categorias/Descontinuados">Descontinuadas</a></li>
                        <?php
              }
            }
                                    foreach($categorias as $categoria){
                                ?>
                                 <li><a class="dropdown-item" href="<?=PATH?>/Productos/categoria/<?=$categoria['nombre_categoria']?>"><?=$categoria['nombre_categoria']?></a></li>
                                <?php  }?>
                    </ul>
                </li>  
                <?php if(!isset($_SESSION['login_buffer'])){?>
                    <li class="nav-item dropdown navbar-right">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-fill"></i>  Mi cuenta
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php if(!isset($_SESSION['login_buffer'])){?>
                        <li><a class="dropdown-item" href="<?=PATH?>/Usuarios/Login">Iniciar sesión</a></li>
                        <?php }?>
                     
                        <li><a class="dropdown-item" href="<?=PATH?>/Clientes/Signin">Registrarse</a></li>
                     
                    </ul>
                </li>
                <?php }?>   
                <?php if(isset($_SESSION['login_buffer'])){?>
                <li class="nav-item dropdown navbar-right">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-fill"></i>  <?=$_SESSION['login_buffer']['nombre']?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php if(isset($_SESSION['login_buffer'])){?>
                        <li><a class="dropdown-item" href="<?=PATH?>/Usuarios/Logout">Cerrar sesión</a></li>
                        <?php }
                        if($_SESSION['login_buffer']['id_tipo_usuario']==3){
                        ?>
                        <li><a class="dropdown-item" href="<?=PATH?>/Clientes/Edit">Editar</a></li>
                        <?php }     if($_SESSION['login_buffer']['id_tipo_usuario']!=3){ ?>
                        <li><a class="dropdown-item" href="<?=PATH?>/Usuarios/Edit">Editar</a></li>
                        <?php }?>
                    </ul>
                </li>
                <?php }?>
            </div>
        </div>
    </nav>