<template>
    <div> 
               
            <div class="container-fluid bg-gris-oxford">
                <br><br>
                <div class="row">
                    <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                        <div class="card card-profile shadow bg-dark">
                            <div class="row justify-content-center">
                                <div class="col-lg-3 order-lg-2">
                                    <div class="card-profile-image">
                                        <a href="#"  data-toggle="modal" data-target="#viewfoto">
                                            <img :src="'/storage/'+logeado.url_img_us"  class="rounded-circle z-depth-2 ">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0 pt-md-4">
                                <div class="row">
                                    <div class="col">
                                        
                                    <div class="h5 font-weight-300">
                                        <i class="ni location_pin mr-2"></i>
                                    </div>
                                        <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                        </div> 
                                        <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                            <br>
                                            <h1 class="text-rosita">{{logeado.name}}</h1>
                                        </div>
                                        <center>
                                            <div class="card-profile-stats d-flex justify-content-center ">
                                                <div class="d-flex justify-content-between">
                                                <a href="#" data-toggle="modal" data-target="#viewfoto" class="btn btn-dark bg-black text-cyan mr-4">Modificar foto</a>
                                                </div>
                                            </div>
                                        </center>   
                                    </div>
                                                                    
                                </div>
                                <div class="text-center">
                                    <h3>
                                       <span class="font-weight-light"></span>
                                    </h3>
                                    <div class="h5 font-weight-300">
                                        <i class="ni location_pin mr-2"></i>
                                    </div>
                                    <div class="h5 mt-4">
                                        <i class="ni business_briefcase-24 mr-2"></i>
                                    </div>
                                    <div>
                                        <i class="ni education_hat mr-2"></i>
                                    </div>
                                   <!-- <hr class="my-4" />
                                    <p>Descripcion</p>
                                    <a href="#">Ver mas</a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 order-xl-1">
                        <div class="card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <h3 class="mb-0">&nbsp;Editar Perfil</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="post"  autocomplete="off">
                                    <h6 class="heading-small text-muted mb-4">Informaci&oacute;n del Usuario</h6>
                                       <!-- ALERTAAAAAAAAA -->
                                        <div class="alert alert-success" role="alert" id="modfy_1">
                                            <strong>{{men}}!</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="alert alert-danger" role="alert" id='modfy_2'>
                                            <strong>{{men}}!</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                    <div class="pl-lg-4">
                                        <div class="">
                                            <label class="form-control-label" for="input-name">Nombre:</label>
                                            <input type="text" name="name" id="input-name" class="form-control form-control-alternative" :placeholder="logeado.name" v-model="logeado.name" required autofocus>
                                        </div>
                                        <div class="">
                                            <label class="form-control-label" for="input-email">Correo:</label>
                                            <input type="email" name="email" id="input-email" class="form-control form-control-alternative" :placeholder="logeado.email" v-model="logeado.email" required>
                                        </div>

                                        <div class="text-center">
                                            <button type="button" class="btn btn-dark text-cyan mt-4" @click="modifyInformation()">Guardar</button>
                                        </div>
                                    </div>
                                </form>
                                <hr class="my-4" />
                                <form method="post" autocomplete="off">

                                    <h6 class="heading-small text-muted mb-4">Constrase&ntilde;a</h6>

                                        <!-- ALERTAAAAAAAAA -->
                                        <div class="alert alert-success" role="alert" id="modfy_3">
                                            <strong>{{men}}!</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="alert alert-danger" role="alert" id='modfy_4'>
                                            <strong>{{men}}!</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>



                                    <div class="pl-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-current-password">Actual Contrase&ntilde;a</label>
                                            <input type="password" name="old_password" id="input-current-password" class="form-control form-control-alternative" :placeholder="logeado.password" v-model="logeado.passwordOld" required>
                                        
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-password">Nueva Contrase&ntilde;a</label>
                                            <input type="password" name="password" id="input-password" class="form-control form-control-alternative" placeholder="Nueva Contraseña" v-model="logeado.newPassword" required>
                                            
                                           
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-password-confirmation">Confirmar Nueva Contrase&ntilde;a</label>
                                            <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="Confirmar Nueva Contraseña" v-model="logeado.confirmPassword" required>
                                        </div>

                                        <div class="text-center">
                                            <button type="button" class="btn btn-dark text-cyan mt-4" @click="modifyP()">Cambiar Contrase&ntilde;a</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div><br><br>
            </div>



            <div class="modal fade" id="viewfoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title" id="exampleModalLabel">Modificar Foto</h1>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                        <div class="modal-body">
                            <img :src="'/storage/'+this.ruta" style="width: 100%; height: 300px;" >
                        </div>
                        <center>
                            <div class="custom-file">
                                <label class="custom-file-label" for="url_img_us">Seleccionar Archivo</label>
                                <input type="file" class="custom-file-input" id="url_img_us"  enctype="multipart/form-data" accept="image/*" @change="subirFoto">
                                
                        
                            </div>
                        </center>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-dark text-rosita" @click="cerrarIMG()" id="botoncito">Cerrar</button>
                      <button type="button" class="btn btn-dark text-cyan" @click="guardarIMG()" id="botoncito">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>
    </div>
</template>
<script>
export default{
    mounted(){
        this.usuarioEspec();     
        this.alerts();
    }, data(){
        return {
            logeado: {},
            men: '',
            ruta: '',
        }
    }, methods:{
            usuarioEspec(){
                axios.get('/usuarioEspec')
                .then((response) => {
                    this.logeado = response.data;
                    this.ruta = this.logeado.url_img_us;
                })
                .catch((error)=>{
                    console.log(error.response);
                })
            },
            modifyInformation(){
                axios.post('/nameEmail', this.logeado).then((response)=>{
                    this.men = response.data;
                    this.usuarioEspec();
                    if(this.men == 'La información ha sido actualizada'){
                        $('#modfy_1').show();
                        $('#modfy_2').hide();                
                        $('#modfy_3').hide();
                        $('#modfy_4').hide();
                    }else{
                        $('#modfy_2').show();
                        $('#modfy_1').hide();                
                        $('#modfy_3').hide();
                        $('#modfy_4').hide();
                    }
                }).catch((error)=>{
                    console.log(error.response);
                })
            },modifyP(){
                if(this.logeado.newPassword==this.logeado.confirmPassword){ 
                const data = new FormData();
                data.set('passwordOld',this.logeado.passwordOld);
                data.set('passwordNew', this.logeado.passwordNew);
                axios.post('/pModify', data).then((response)=>{
                    this.men = response.data;
                    this.usuarioEspec();
                    if(this.men == 'La información ha sido actualizada'){
                        $('#modfy_3').show();
                        $('#modfy_1').hide();
                        $('#modfy_2').hide();                        
                        $('#modfy_4').hide();
                    }else{
                        $('#modfy_4').show();
                        $('#modfy_1').hide();
                        $('#modfy_2').hide();
                
                        $('#modfy_3').hide();
                    }
                }).catch((error)=>{
                    console.log(error.response);
                })
                }else{
                    this.men = 'Las Contraseñas no Coinciden';
                    $('#modfy_4').show();
                    $('#modfy_1').hide();
                    $('#modfy_2').hide();
                }
            }, alerts(){
                $('#modfy_1').hide();
                $('#modfy_2').hide();                
                $('#modfy_3').hide();
                $('#modfy_4').hide();
            },cerrarIMG(){
                $("#viewfoto").modal("toggle");
                location.reload();
            }, guardarIMG(){
                $("#viewfoto").modal("toggle");
                const data = new FormData();
                data.set('url_img_us',this.logeado.url_img_us);
                axios.post('/modificarFotoPerfil', data).then((response)=>{
                    this.usuarioEspec();
                }).catch((error)=>{
                    console.log(error.response);
                })
                
                location.reload();
            }, subirFoto(e){
                this.logeado.url_img_us = e.target.files[0];
            }
    }
}
</script>