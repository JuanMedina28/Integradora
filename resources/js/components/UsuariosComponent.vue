<template>
<div>
    <form>
        <div class="header bg-gradient-dark pt-5 pt-nd-6">
            <div class="container-fluid">
                <div class="header pb-4">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h1 class="text-rosita d-inline-block mb-0">Usuarios</h1>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            <!--button type="button"  @click="nuevoUsuario()" class="btn btn-sm btn-dark bg-dark"><h4 class="text-cyan">Nuevo Usuario</h4></button>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABLA -->
        <div class="container-fluid " style="min-height: 80vh">
             <br><br>
              <div class="row mb-4" >
                        <div class="col-3">
                          <label style="color: #2d2d2d">Buscar:</label>
                            <div class="input-group ">
                              
                <input type="search" class="form-control" placeholder="Recipient's username" v-model="buscador" @keyup="buscarUsuario" aria-label="Buscar Usuario..." aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn  btn-dark bg-dark" type="button" id="button-addon2"><h4 class="text-cyan"><i class="fa fa-search" aria-hidden="true"></i></h4></button>
                </div>
            </div>
                        </div>
                        <div class="col-3"></div>
                        <div class="col-3">

                            <label style="color: #2d2d2d">Filtrar:</label>
                            <select class="form-control" @change="onChange2($event)" v-model="key2" data-toggle="select" title="Simple select" >
                                            <option disabled selected>Tipo de Servicio</option>
                                            <option value="3">Clientes</option>
                                            <option value="2">Negocios</option>
                                            <option value="1">Administrador</option>
                                            <option value="4">Todos</option>
                                            
                            </select>
                        </div>
                        <div class="col-3">

                            <label style="color: #2d2d2d">Estatus</label>
                            <select class="form-control" @change="onChange($event)" v-model="key" data-toggle="select" title="Simple select" >
                                            <option disabled selected>Eslige el estatus</option>
                                            <option value="1">Habilitado</option>
                                            <option value="2">Deshabilitado</option>
                                            <option value="3">Todos</option>
                                            
                            </select>
                        </div>
                    </div>

                <div class="row">
                <paginate name="var_usuarios" :per="8" :list="lista_usuarios" tag="div" class="card-deck">
                        <div class="col-3" v-for="usuario in paginated('var_usuarios')">
                            <div class="card_usu bg-dark">
                              <div class="head_usu">
                                <div class="circle_usu"></div>
                                <div class="img_usu">
                                  <a @click="abrirFoto(usuario.url_img_us)">
                                    <img :src="'/storage/'+usuario.url_img_us">
                                  </a>
                                </div>
                              </div>
                              <div class="des_usu">
                                <h3>{{ usuario.name }} </h3>
                                 <div v-if="usuario.status==2">
                                <h2>{{usuario.name }} <span class="text-white bg-red" style="font-size: 14px;">Inhabilitado</span></h2>
                                </div>
                                <div v-if="usuario.status==1">
                                <h2>{{ usuario.name }} <span class="text-white bg-green" style="font-size: 14px;">Habilitado</span></h2>
                                </div>
                                <h3>
                                  <div v-if="usuario.tipo_us==1">Administrador</div>
                                  <div v-if="usuario.tipo_us==2">Negocio</div>
                                  <div v-if="usuario.tipo_us==3">Cliente</div>
                                </h3>
                                <h3>{{usuario.email}}</h3>
                                <h3>{{usuario.celular}}</h3>
                              </div>
                              <div class="contact_usu">
                                <a  type="button" class="dropdown-item bg-dark text-cyan" @click="editar_usuario(usuario)">Ver Detalles</a>
                                <a  type="button" class="dropdown-item bg-dark text-rosita" @click="eliminarUsuario(usuario)">Alta/Baja</a>
                              </div>
                            </div>
                        </div>
                        </paginate>
                        </div>
                        <nav aria-label="...">
                            <br>
                              <paginate-links for="var_usuarios" :classes="{'ul': ['pagination','justify-content-end','nb-0','text-rosita'], 'li': ['page-item',], 'a':['page-link', 'bg-dark']}"></paginate-links>
                            <br>
                        </nav>

          </div>

          <!-- Modal -->
              <div class="modal fade" id="formulario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title text-black" id="exampleModalLabel">Usuario</h1>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                                <!-- FORMULARIO -->
                                  <label for="">Nombre: </label>
                                  <input type="text" disabled class="form-control" id="nombreUsuario" v-model="usuario.name" placeholder="Nombre Completo...">
                                  <br>
                                  <label for="">Correo: </label>
                                  <input type="email" disabled class="form-control" id="emailUsuario" v-model="usuario.email" rows="3" placeholder="Email...">
                                  <div v-if="this.editando==false">
                                    <br>
                                    <input type="password" class="form-control" id="passwordUsuario" v-model="usuario.password" placeholder="Password...">
                                    <br>
                                    <input type="password" class="form-control" id="confirmacion" v-model="usuario.confirmacion" placeholder="Confirmar Password...">
                                    
                                    
                                  </div>
                                  <br>
                                  <label for="">Teléfono: </label>
                                  <input type="tel" disabled minlength="10" maxlength="10" class="form-control" id="celular" v-model="usuario.celular" placeholder="Telefono...">
                                    <br>
                                    <label for="">Estado: </label>
                                  <input type="text" disabled minlength="10" maxlength="10" class="form-control" id="celular" v-model="usuario.estado" placeholder="Estado">
                                    <br>
                                    <label for="">Municipio: </label>
                                  <input type="text" disabled minlength="10" maxlength="10" class="form-control" id="celular" v-model="usuario.municipio" placeholder="Municipio">
                                    <br>
                                  <label>Tipo de Usuario:</label>
                                  <select name="select" disabled class="form-control"  v-model="usuario.tipo_us">
                                      <option  :value="1" >Administrador</option>
                                      <option  :value="2" >Negocio</option>  
                                      <option  :value="3" >Cliente</option>                       
                                  </select>
                                  <br>
                                  <!--<input type="file" class="form-control" id="url_img_us"  accept="image/*" @change="subirFoto">-->
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-dark text-rosita" @click="cerrarModal">Cerrar</button>
                      <button type="button" class="btn btn-dark text-cyan" @click="guardarUsuario">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>

              <!--Modal Eliminar-->
              <div class="modal fade" id="eliminacionUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Alta/Baja</h5>
                      <button type="button" class="close" data-dismiss="modal" @click="eliminarUsuario()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <h4>¿Seguro que desea modificar este negocio?</h4>
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-dark text-rosita" @click="eliminarUsuario()"  data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-dark text-cyan" @click="eliminar_usuario()" id="botoncito">Eliminar</button>
                    </div>
                  </div>
                </div>
              </div>

              <!--Moodal Foto-->
              <div class="modal fade" id="viewfoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Vista</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <img :src="'/storage/'+this.ruta" style="width: 100%; height: 300px;" >
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" @click="cerrarIMG()" id="botoncito">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>

    </form>
</div>
</template>

<script>
import { timeouts } from "retry";
import VuePaginate from "vue-paginate";

    export default {
        mounted() {
            console.log('Component mounted.');
            this.listar_usuarios();
            this.usuarioEspec();
            this.items();
        }
        ,data(){
            return {
                usuario: {},
                lista_usuarios: {},
                editando:false,
                ruta : '',
                paginate: ['var_usuarios'],
                confirmacion: '',
                logeado: {},
                buscador: '',
                setTimeoutBuscador: '',
                key: '',
                key2: ''
            }
        },methods:{
            subirFoto(e){
                this.usuario.url_img_us = e.target.files[0];
            },
            guardarUsuario(){
                if(this.usuario.password==this.usuario.confirmacion){
                    
                        const datosUsuario = new FormData;
                        datosUsuario.set('name',this.usuario.name);
                        datosUsuario.set('email',this.usuario.email);
                        datosUsuario.set('celular',this.usuario.celular);
                        datosUsuario.set('password',this.usuario.password);
                        datosUsuario.set('tipo_us',this.usuario.tipo_us);                
                        datosUsuario.set('url_img_us',this.usuario.url_img_us);
                        
                        if(this.editando){
                        datosUsuario.set('id',this.usuario.id);
                        axios.post('/usuarios_editar',datosUsuario)
                            .then((response) => {
                            this.usuario = {};
                            this.listar_usuarios();
                            this.nuevoUsuario();
                            })
                            .catch((error)=>{
                                console.log(error.response);
                            })
                        }else{
                            axios.post('/usuarios_guardar',datosUsuario)
                            .then((response) => {
                            this.usuario = {};
                            this.listar_usuarios();
                            this.nuevoUsuario();
                            })
                            .catch((error)=>{
                                console.log(error.response);
                            })
                        }
                        
                }else{
                    alert("Las contraseñas no coinciden")
                }
            },
            usuarioEspec(){
                axios.get('/usuarioEspec')
                .then((response) => {
                    this.logeado = response.data;
                })
                .catch((error)=>{
                    console.log(error.response);
                })
            },
            listar_usuarios(){
                axios.get('/usuarios_listar', {
                    params: {
                        buscador: this.buscador
                    }
                })
                .then((response) => {
                    this.lista_usuarios = response.data;
                })
                .catch((error)=>{
                    console.log(error.response);
                })
            },
            editar_usuario(param_usuario){
              this.editando = true;
              this.usuario = param_usuario;
              this.confirmacion = this.usuario.password;
              this.nuevoUsuario();
            },
            eliminar_usuario(){
              console.log(this.usuario.id)
              let idn = this.usuario.id;
               axios.post('/usuarios_baja/'+ idn)
              .then((response) => {
    
                })
                .catch((error)=>{
                    console.log(error.response);
                });
                this.usuario = {};
                this.listar_usuarios(); 
                    $("#eliminacionUsuario").modal("toggle");
                  
            },nuevoUsuario(){
              $("#formulario").modal("toggle");
            }, eliminarUsuario(param_usuario){
              $("#eliminacionUsuario").modal("toggle");
              this.usuario = param_usuario;
            }, cerrarModal(){              
              $("#formulario").modal("toggle");
              this.editando=false;
              this.usuario = {};
            }, cerrarIMG(){
              this.ruta = '';
              $("#viewfoto").modal("toggle");
            }, abrirFoto(ruta){
              this.ruta = ruta;
              $("#viewfoto").modal("toggle");
            },
            buscarUsuario(){
                clearTimeout(this.setTimeoutBuscador);
                this.setTimeoutBuscador = setTimeout(this.listar_usuarios, 350);
            },
            onChange(event) {

             axios.get("/usuarios_filtrar",{
                    params: {
                        key: event.target.value
                    }
                }).then((response)=>{
                    this.lista_usuarios = response.data;
                }).catch((error)=>{
                    console.log(error.response)
                })
              console.log(event.target.value)
            },
            onChange2(event) {

             axios.get("/usuarios_filtrar2",{
                    params: {
                        key2: event.target.value
                    }
                }).then((response)=>{
                    this.lista_usuarios = response.data;
                }).catch((error)=>{
                    console.log(error.response)
                })
              console.log(event.target.value)
            }
        }
    }
</script>