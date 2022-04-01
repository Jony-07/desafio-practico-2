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
                    <li class="nav-item dropdown navbar-right">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-fill"></i>  Mi cuenta
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?=PATH?>">Iniciar sesión</a></li>
                        <li><a class="dropdown-item" href="<?=PATH?>">Registrarse</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown navbar-right">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-box2-heart-fill"></i> Productos
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?=PATH?>/Productos">Ver lista</a></li>
                        <li><a class="dropdown-item" href="<?=PATH?>">Registrar producto</a></li>
                    </ul>
                </li>            
                </ul>
            </div>
        </div>
    </nav>