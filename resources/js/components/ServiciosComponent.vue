<template>
    <div>
        <form>
                <div class="header bg-gradient-dark pt-5 pt-nd-6">
                  <div class="container-fluid">
                    <div class="header pb-4">
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
                
    <div class="container-fluid" style="min-height: 80vh">
      <br><br>

            <div class="row mb-4" >
                        <div class="col-3">
                          <label style="color: #2d2d2d">Buscar:</label>
                            <div class="input-group ">
                              
                <input type="search" class="form-control" placeholder="Recipient's username" v-model="buscador" @keyup="buscarServicio" aria-label="Buscar Usuario..." aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn  btn-dark bg-dark" type="button" id="button-addon2"><h4 class="text-cyan"><i class="fa fa-search" aria-hidden="true"></i></h4></button>
                </div>
            </div>
                        </div>
                        <div class="col-3"></div>
                        <div class="col-3">

                            <label style="color: #2d2d2d">Filtrar:</label>
                            <select class="form-control" data-toggle="select" title="Simple select" >
                                            <option disabled selected>Tipo de Servicio</option>
                                            <option>Ingeribles - Alimentos y bebidas.</option>
                                            <option>Ambiente - Sonido y  luces.</option>
                                            <option>Música - Músicos y DJ's.</option>
                                            <option>Decoración - Exteriores e interiores.</option>
                                            <option>Extras- Hileras, tortilleros, centros de mesa, recuerdos, etc.</option>
                                            <option>Personal de servicio - Exteriores e interiores.</option>
                            </select>
                        </div>
                        <div class="col-3">

                            <label style="color: #2d2d2d">Estatus</label>
                            <select class="form-control" data-toggle="select" title="Simple select" >
                                            <option disabled selected>Eslige el estatus</option>
                                            <option>Habilitado</option>
                                            <option>Deshabilitado</option>
                                            
                            </select>
                        </div>
                    </div>


            <div class="row " >
                        <paginate name="var_servicios" :per="8" :list="lista_servicios" tag="div" class="card-deck">
                        <div class="col-3" v-for="v_servicio in paginated('var_servicios')">
                            <div class="cards-servicios">
                                <div class="face front">
                                    <a href="#" @click="abrirFoto(v_servicio.url_img)">
                                      <img alt="Image placeholder" width="30px" height="30px" :src="'/storage/'+v_servicio.url_img">
                                    </a>
                                    <h3>{{ v_servicio.tipo_serv }}</h3>
                                </div>
                                <div class="face back">
                                <div v-if="v_servicio.statusn==2">
                                <span class="text-white btn bg-red" style="font-size: 20px;">Inhabilitado</span>
                                </div>
                                <div v-if="v_servicio.statusn==1">
                                <span class="text-white btn bg-green" style="font-size: 24px;">Habilitado</span>
                                </div>
                                    <h3>{{ v_servicio.nego_name}}</h3>
                                    <p>{{ v_servicio.des }}</p>
                                    <b>${{ around(v_servicio.precio) }} MXN</b>
                                    <div class="contact_serv">
                                        <a  type="button" class="dropdown-item btn-dark bg-dark text-cyan" @click="editar_servicio(v_servicio)">Detalles</a>
                                        <a  type="button" class="dropdown-item btn-dark bg-dark text-rosita" @click="eliminarServicio(v_servicio)">Alta/Baja</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </paginate>
                        </div>
                        <nav aria-label="...">
                            <br>
                              <paginate-links for="var_servicios" :classes="{'ul': ['pagination','justify-content-end','nb-0','text-rosita'], 'li': ['page-item',], 'a':['page-link', 'bg-dark']}"></paginate-links>
                            <br>
                        </nav>
                
      
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
                                  <div v-if="logeado.tipo_us==1">
                                  <label>Negocio:</label>
                                  <select name="select" class="form-control"  v-model="servicio.id_us">
                                      <option v-for="nego in select_negocio" :value="nego.id" >{{nego.razon_social}}</option>
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
                logeado: {},
                buscador: '',
                setTimeoutBuscador: ''
            }
        },methods:{
            subirFoto(e){
                this.servicio.url_img = e.target.files[0];
            },
            negocios(){
              axios.get('/negocios_listar1')
                .then((response) => {
                    this.select_negocio = response.data;
                })
                .catch((error)=>{
                    console.log(error.response);
                })
            },
            listar_servicio(){
                axios.get("/servicios_listar", {
                  params: {
                        buscador: this.buscador
                    }
                }).then((response)=>{
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
              console.log(this.servicio.id)
              let idn = this.servicio.id;
                axios.post("/servicio_baja/"+idn).then((response)=>{
                  
                  
                }).catch((error)=>{
                  console.log(error.response);
                })
                this.servicio = {};
                  $("#eliminacionServicio").modal("toggle");
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
            
            buscarServicio(){
                clearTimeout(this.setTimeoutBuscador);
                this.setTimeoutBuscador = setTimeout(this.listar_servicio, 350);
            },
            around(value){
                return parseFloat(Math.round(value)).toFixed(2);
         }
        }
    }
</script>
