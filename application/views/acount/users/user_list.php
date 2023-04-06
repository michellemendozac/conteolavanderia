<div class="card-header  justify-content-between align-items-center"> 
    <div class="sub-header   px-md-0 align-self-center d-sm-flex w-100 rounded">
        <div class="w-sm-100 mr-auto">
            <h4 class="card-title">Usuarios</h4>                          
        </div>  
    </div>
</div>  

<div class="profile-menu theme-background border  z-index-1 p-2">
    <div class="d-sm-flex">
        <div class="align-self-center">
            <?php $this->load->view("acount/users/menu_user"); ?>
        </div>
        <!--
        <div class="align-self-center ml-auto text-center text-sm-right">           
            <a href="#" class="bg-primary py-2 px-2 rounded ml-auto text-white text-center openside">
                <i class="icon-plus align-middle text-white"></i> 
                <span class="d-none d-xl-inline-block">Usuario Nuevo</span>
            </a> 
        </div> -->
    </div>
</div> 

<div class="card-body">
    <div class="table-responsive">
        <table id="example" class="display w-100 table dataTable table-striped table-bordered editable-table">
            <thead>       
                <tr>
                    <th width="10%">ID</th>
                    <th width="20%">Usuario</th>
                    <th width="25%">Nombre</th>
                    <th width="25%">Correo</th>
                    <th width="10%" class="text-center">Estatus</th>
                    <th width="10%">&nbsp;</th>
                </tr>
            </thead> 
        </table>
    </div>
</div> 