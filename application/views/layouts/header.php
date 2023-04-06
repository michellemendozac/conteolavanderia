
<div id="header-fix" class="header fixed-top">
    <div class="site-width">
        <nav class="navbar navbar-expand-lg  p-0">
            <div class="navbar-header  h-100 h4 mb-0 align-self-center logo-bar text-left">  
                <a href="index.html" class="horizontal-logo text-left">
                    <img   height="40px" src="<?=base_url()?>/assets/images/layout/logo_head.png"/>                                
                </a>                    
            </div>

            <div class="navbar-header h4 mb-0 text-center h-100 collapse-menu-bar">
                <a href="#" id="show_menu_p"><i class="icon-menu"></i></a>
            </div>

            
             


            <form class="float-left d-none d-lg-block search-form">
                <div class="form-group mb-0 position-relative">
                    <input type="text" class="form-control border-0 rounded bg-search pl-5" placeholder="Buscar...">
                        <div class="btn-search position-absolute top-0">
                            <a href="#"><i class="h6 icon-magnifier"></i></a>
                        </div>
                        <a href="#" class="position-absolute close-button mobilesearch d-lg-none" data-toggle="dropdown" aria-expanded="false">
                            <i class="icon-close h5"></i>                               
                        </a>
 
                </div>
            </form>

            <div class="navbar-right ml-auto h-100">
                <ul class="ml-auto p-0 m-0 list-unstyled d-flex top-icon h-100">

                    <li class="d-inline-block align-self-center  d-block d-lg-none">
                        <a href="#" class="nav-link mobilesearch" data-toggle="dropdown" aria-expanded="false"><i class="icon-magnifier h4"></i>                               
                        </a>
                    </li>                        
                  
                    <li class="dropdown user-profile align-self-center d-inline-block">
                        <a href="#" class="nav-link py-0" data-toggle="dropdown" aria-expanded="false"> 
                            <div class="media">                                   
                                <img src="<?=base_url()?>/dist/images/author.jpg" alt="" class="d-flex img-fluid rounded-circle" width="29">
                            </div>
                        </a>

                        <div class="dropdown-menu border dropdown-menu-right p-0">
                            <a href="" class="dropdown-item px-2 align-self-center d-flex">
                                <span class="icon-pencil mr-2 h6 mb-0"></span> 
                                Perfil
                            </a> 

                            <a href="http://rastreovehicular/Login/cerrar_session" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                <span class="icon-logout mr-2 h6  mb-0"></span> 
                                Cerrar Sessión
                            </a>

                        </div>

                    </li>

                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- END: Header-->

<script>
 function version_msg(){
    alert("Esta versión no cuenta con esta opción");
 }
</script>