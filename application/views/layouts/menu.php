<!-- START: Main Menu-->
<div class="sidebar menux_sidebar">
    <div class="site-width">
        <!-- START: Menu-->
        <ul id="side-menu" class="sidebar-menu">


            <li><a href="<?=base_url()?>/Counts/Count"><i class="icon-doc mr-1"></i> Conteo </a></li>
            <li><a href="<?=base_url()?>/Counts/Count/Order_Package"> <i class="icon-calendar"></i> Empacar </a></li>
            <li><a href="<?=base_url()?>/operation/Visit"><i class="icon-layers mr-1"></i> Operaciones </a> </li> 
            <li class="dropdown"><a href="#" onclick="version_msg()"><i class="icon-doc mr-1"></i> Resultados </a></li> 
            <li class="dropdown"><a href="#"><i class="icon-doc mr-1"></i> Cuenta  </a>                  
                <ul>  
                    <li><a href="#" onclick="version_msg()"><i class="icon-book-open"></i> Usuarios </a> </li>
                    <li><a href="#" onclick="version_msg()"><i class="icon-book-open"></i> Empresas </a> </li>
                    <li><a href="#" onclick="version_msg()"><i class="icon-book-open"></i> Plantas </a> </li>
                    <li><a href="#" onclick="version_msg()"><i class="icon-book-open"></i> Contactos </a> </li>
                    <li><a href="#" onclick="version_msg()"> <i class="icon-book-open"></i> Preferencias </a> </li> 
                </ul>                   
            </li> 

        </ul>
        <!-- END: Menu-->

        <!-- Breadcrumbs -->
        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0 ml-auto">
            <li class="breadcrumb-item"><a href="#">Application</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

    </div>
</div>
<!-- END: Main Menu--> 