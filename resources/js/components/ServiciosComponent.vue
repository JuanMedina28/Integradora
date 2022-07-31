<template>
    <div>
        <form>
                <div class="header bg-gradient-dark pt-5 pt-nd-6">
                  <div class="container-fluid">
                    <div class="header pb-6">
                      <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                          <h1 class="text-rosita d-inline-block mb-0">Servicios</h1>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                          <button type="button" @click="nuevoServicio()" class="btn btn-sm btn-dark bg-dark"><h4 class="text-cyan">Nuevo Servicio</h4></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
    <div class="container-fluid bg-gris-oxford" style="min-height: 80vh">
      <br><br><br><br>
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->


                <div class="table-responsive">
                        <div>
                            <table class="table align-items-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name"><h5>Nombre</h5></th>
                                        <th scope="col" class="sort" data-sort="status"><h5>Imagen</h5></th>
                                        <th scope="col" class="sort" data-sort="name"><h5>Negocio</h5></th>
                                        <th scope="col" class="sort" data-sort="precio"><h5>Precio</h5></th>
                                        
                                        <th scope="col"><h5>Descripci&oacute;n</h5></th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <paginate name="var_servicios" :per="10" :list="lista_servicios" tag="tbody" class="list">
                                    <tr v-for="v_servicio in paginated('var_servicios')">
                                          <td class="budget">
                                              {{ v_servicio.tipo_serv }}
                                          </td>
                                          <td>
                                            <a href="#" class="" data-toggle="tooltip" @click="abrirFoto(v_servicio.url_img)" data-original-title="Romina Hadid">
                                                <img alt="Image placeholder" width="30px" height="30px" :src="'/storage/'+v_servicio.url_img">
                                            </a>
                                          </td>
                                          <td class="budget">
                                            {{ v_servicio.nego_name}}
                                          </td>
                                          <td>
                                            ${{ around(v_servicio.precio) }} MXN
                                          </td>
                                          
                                          <td>
                                              {{ v_servicio.des }}
                                          </td>
                                          <td class="text-right">
                                              <div class="dropdown">
                                                  <button class="btn btn-sm btn-icon-only text-dark"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                  </button>
                                                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arro bg-gris-oxford">
                                                      <button  type="button" class="dropdown-item btn-dark text-cyan" @click="editar_servicio(v_servicio)">Modificar</button>
                                                      <button  type="button" class="dropdown-item btn-dark text-rosita" @click="eliminarServicio(v_servicio)">Eliminar</button>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                    </paginate>
                                  
                            </table>
                        </div>
                        <div class="card-footer py-4">
                          <nav aria-label="...">
                              <paginate-links for="var_servicios" :classes="{'ul': ['pagination','justify-content-end','nb-0'], 'li': 'page-item', 'a':['page-link', 'bg-dark']}"></paginate-links>
                          </nav>
                        </div>


                </div>
            </div><br><br>
           
                  </div>
                </div>
              </div>

                  <!-- Modal -->
              <div class="modal fade" id="formulario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title text-black" id="exampleModalLabel">Servicio</h1>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                                <!-- FORMULARIO -->
                                  <input type="text" class="form-control" id="nombre" v-model="servicio.tipo_serv" placeholder="Nombre del servicio">
                                  <br>
                                  <div v-if="logeado.tipo_usuario==1">
                                  <label>Negocio:</label>
                                  <select name="select" class="form-control"  v-model="servicio.id_us">
                                      <option v-for="nego in select_negocio" :value="nego.id" >{{nego.name}}</option>
                                  </select>
                                  <br>
                                  </div>
                                  <input type="number" class="form-control" id="precio" min="1" v-model="servicio.precio"  placeholder="Precio">
                                  <br>
                                  <textarea class="form-control" id="descripcion"  rows="3" v-model="servicio.des" placeholder="Escribe una descripción detallada del servicio"></textarea>
                                  <br>
                                  <input type="file" class="form-control" id="url_img" enctype="multipart/form-data" accept="image/*" @change="subirFoto">

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-dark text-rosita" @click="cerrarModal">Cerrar</button>
                      <button type="button" class="btn btn-dark text-cyan"  @click="guardarServicio()">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="eliminacionServicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title" id="exampleModalLabel">Eliminar</h1>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <h3>¿Seguro que desea eliminar este Servicio?</h3>
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-dark text-rosita" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-dark text-cyan" @click="eliminar_servicio()" id="botoncito">Eliminar</button>
                    </div>
                  </div>
                </div>
              </div>

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
                      <button type="button" class="btn btn-dark text-rosita" @click="cerrarIMG()" id="botoncito">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
                  

              


              

   
        </form>
    </div>
</template>
<script>
import VuePaginate from 'vue-paginate'
Vue.use(VuePaginate)

    export default {
        mounted() {
            console.log('Component mounted.')
            this.listar_servicio();
            this.negocios();
            this.usuarioEspec();
            
        }
        ,data(){
            return {
                servicio: {},
                lista_servicios:{},
                editando:false,
                select_negocio:{},
                ruta : '',
                paginate: ['var_servicios'],
                logeado: {}
            }
        },methods:{
            subirFoto(e){
                this.servicio.url_img = e.target.files[0];
            },
            negocios(){
              axios.get('/lista_usuarios')
                .then((response) => {
                    this.select_negocio = response.data;
                })
                .catch((error)=>{
                    console.log(error.response);
                })
            },
            listar_servicio(){
                axios.get("/servicios_listar").then((response)=>{
                    this.lista_servicios = response.data;
                }).catch((error)=>{
                    console.log(error.response)
                })
            },
            guardarServicio(){
              if(this.logeado.tipo_us == 2){
                this.servicio.id_us = this.logeado.id
              }
              const datosAlimento = new FormData
              datosAlimento.set('nombre_libro',this.servicio.nombre_libro);
              datosAlimento.set('id_us',this.servicio.id_us);
              datosAlimento.set('precio',this.servicio.precio);
              datosAlimento.set('des',this.servicio.des);
              datosAlimento.set('tipo_serv',this.servicio.tipo_serv);
              datosAlimento.set('url_img', this.servicio.url_img);
              if(this.editando){
                    datosAlimento.set('id', this.servicio.id);
                    axios.post("/servicio_editar", datosAlimento).then((response)=>{
                      this.servicio = {};
                      this.listar_servicio();
                      this.nuevoServicio();

                    }).catch((error)=>{
                      console.log(error.response);
                    })
              }else{
                    axios.post("/servicio_guardar", datosAlimento).then((response)=>{
                      this.servicio = {};
                      this.listar_servicio();
                      this.nuevoServicio();
                    }).catch((error)=>{
                      console.log(error.response);
                    })
              }
            },
            editar_servicio(param_servicio){
               this.editando = true;
               this.servicio = param_servicio;
               this.nuevoServicio();
            },
            eliminar_servicio(){
                axios.delete("/servicio_eliminar/"+this.servicio.id).then((response)=>{
                  this.lista_servicios = response;
                  this.servicio = {};
                  $("#eliminacionServicio").modal("toggle");
                }).catch((error)=>{
                  console.log(error.response);
                })
                this.listar_servicio();
            },
            nuevoServicio(){
              $("#formulario").modal("toggle");
            },
            eliminarServicio(param_negocio){
              $("#eliminacionServicio").modal("toggle");
              this.servicio = param_negocio;
            },
            cerrarModal(){
              $("#formulario").modal("toggle");
              this.editando=false;
              this.servicio = {};
            },
            cerrarIMG(){
              this.ruta = '';
              $("#viewfoto").modal("toggle");
            }, 
            abrirFoto(ruta){
              this.ruta = ruta;
              $("#viewfoto").modal("toggle");
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
            around(value){
                return parseFloat(Math.round(value)).toFixed(2);
         }
        }
    }
</script>
