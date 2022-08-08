<template>
    <div>
        <form>

            <div class="header bg-gradient-dark pt-5 pt-nd-6">
                  <div class="container-fluid">
                    <div class="header pb-4">
                      <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                          <h1 class="text-rosita d-inline-block mb-0">Negocios</h1>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                          <!--<button type="button" @click="nuevoNegocio()" class="btn btn-sm btn-dark bg-dark"><h4 class="text-cyan">Nuevo Negocio</h4></button>-->
                        </div>
                      </div>
                    </div>
                  </div>
            </div>

            <!-- TABLA -->
            <div class="container-fluid mt-0 " style="min-height: 80vh"> <br><br>
              <div class="row mb-4" >
                        <div class="col-3">
                          <label style="color: #2d2d2d">Buscar:</label>
                            <div class="input-group ">
                              
                <input type="search" class="form-control" placeholder="Recipient's username" aria-label="Buscar Usuario..." aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn  btn-dark bg-dark" type="button" id="button-addon2"><h4 class="text-cyan"><i class="fa fa-search" aria-hidden="true"></i></h4></button>
                </div>
            </div>
                        </div>
                        <div class="col-3"></div>
                        <div class="col-3">

                            <label style="color: #2d2d2d">Filtrar:</label>
                            <select class="form-control" @change="onChange($event)" v-model="key" data-toggle="select" title="Simple select" >
                                            <option disabled selected>Giro del negocio</option>
                                            <option value="1">Ingeribles - Alimentos y bebidas.</option>
                                            <option value="2">Ambiente - Sonido y luces.</option>
                                            <option value="3">Música - Músicos y DJ's.</option>
                                            <option value="4">Decoración - Exteriores e interiores.</option>
                                            <option value="5">Extras- Hileras, tortilleros, centros de mesa, recuerdos, etc.</option>
                                            <option value="6">Personal de servicio - Exteriores e interiores.</option>
                                            <option value="7">Mostrar Todos</option>
                            </select>
                        </div>
                        <div class="col-3">

                            <label style="color: #2d2d2d">Estatus</label>
                            <select class="form-control" @change="onChange2($event)" v-model="key2" data-toggle="select" title="Simple select" >
                                            <option disabled selected>Eslige el estatus</option>
                                            <option value="1">Habilitado</option>
                                            <option value="2">Deshabilitado</option>
                                            <option value="3">Todos</option>
                                            
                            </select>
                        </div>
                    </div>
                    <div class="row">             
                        <paginate name="var_negocios" :per="8" :list="lista_negocios" tag="div" class="card-deck">
                        <div class="col-3" v-for="v_negocio in paginated('var_negocios')">
                            <div class="card_nego bg-dark">
                              <div class="head_nego">
                                <div class="circle_nego"></div>
                                <div class="img_nego">
                                  <a @click="abrirFoto(v_negocio.url_logo)">
                                    <img :src="'/storage/'+v_negocio.url_logo">
                                  </a>
                                </div>
                              </div>
                              <div class="des_nego">
                                <div v-if="v_negocio.status==2">
                                <h2>{{ v_negocio.razon_social }} <span class="text-white bg-red" style="font-size: 14px;">Inhabilitado</span></h2>
                                </div>
                                <div v-if="v_negocio.status==1">
                                <h2>{{ v_negocio.razon_social }} <span class="text-white bg-green" style="font-size: 14px;">Habilitado</span></h2>
                                </div>
                                <p>{{ v_negocio.tipo_ser }}</p>
                                <b>{{v_negocio.nego_email}}</b>
                                <p>{{v_negocio.nego_celular}}</p>
                                <p>{{v_negocio.rfc}}</p>
                              </div>
                              <div class="contact_nego">
                                <a  type="button" class="dropdown-item btn-dark bg-dark text-cyan" @click="editar_negocio(v_negocio)">Detalles</a>
                                <a  type="button" class="dropdown-item btn-dark bg-dark text-rosita" @click="eliminarNegocio(v_negocio)">Alta/Baja</a>
                              </div>
                            </div>
                        </div>
                        </paginate>
                        </div> 
                        <nav aria-label="...">
                            <br>
                              <paginate-links for="var_negocios" :classes="{'ul': ['pagination','justify-content-end','nb-0','text-rosita'], 'li': ['page-item',], 'a':['page-link', 'bg-dark']}"></paginate-links>
                            <br>
                        </nav>
                </div>
               
          

          <!-- Modal -->
              <div class="modal fade" id="formulario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title text-black" id="exampleModalLabel">Negocio</h1>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="cerrarModal()">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                                <!-- FORMULARIO -->
                                  <input type="text" disabled class="form-control" id="nombreNegocio" v-model="negocio.razon_social" placeholder="Nombre del negocio.">
                                  <br>
                                  <label>Giro del negocio:</label>
                                  
                                    <select class="form-control" disabled data-toggle="select" title="Simple select" v-model="negocio.tipo_ser">
                                            <option disabled selected>Elige tu tipo de Negocio</option>
                                            <option>Ingeribles - Alimentos y bebidas.</option>
                                            <option>Ambiente - Sonido y  luces.</option>
                                            <option>Música - Músicos y DJ's.</option>
                                            <option>Decoración - Exteriores e interiores.</option>
                                            <option>Extras- Hileras, tortilleros, centros de mesa, recuerdos, etc.</option>
                                            <option>Personal de servicio - Exteriores e interiores.</option>
                                    </select>
                                 
                                  <br>
                                  <input type="text" disabled class="form-control form-control-alternative" id="giroNegocio" v-model="negocio.nego_email" placeholder="RFC del negocio">
                                  <br>
                                  <input type="tel" disabled minlength="10" maxlength="10" class="form-control form-control-alternative" id="telefono" v-model="negocio.nego_celular"  placeholder="Telefono del negocio">
                                   <br>   
                                  <input type="text" disabled class="form-control form-control-alternative" id="etiquetasNegocio" v-model="negocio.rfc" placeholder="Razón social del negocio">
                                  <br>
                                  <input type="file" disabled class="form-control" id="url_logo"  accept="image/*" @change="subirFoto">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-dark text-rosita" @click="cerrarModal()">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="eliminacionNegocio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Estatus</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <h4>¿Seguro que desea cambiar el status de la cuenta?</h4>
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary" @click="eliminar_negocio()" id="botoncito">}Confirmar</button>
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
                      <img :src="'/storage/'+this.url_logo" style="width: 100%; height: 300px;" >
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
   import VuePaginate from "vue-paginate";

    export default {
        mounted() {
            console.log('Component mounted.')
            this.listar_negocios();
        }
        ,data(){
            return {
                negocio: {},
                lista_negocios:{},
                editando:false,
                ruta : '',
                idneg: '',
                paginate: ['var_negocios'],
                key: '',
                key2: ''
            }
        },methods:{
            subirFoto(e){
                this.negocio.url_logo = e.target.files[0];
            },
            guardarNegocio(){
                const datosNegocio = new FormData;
                datosNegocio.set('razon_social',this.negocio.razon_social);
                datosNegocio.set('tipo_ser',this.negocio.tipo_ser);
                datosNegocio.set('email',this.negocio.nego_email);
                datosNegocio.set('celular',this.negocio.nego_celular);
                datosNegocio.set('rfc',this.negocio.rfc);
                datosNegocio.set('etiquetas',this.negocio.etiquetas);
                datosNegocio.set('url_logo',this.negocio.url_logo);
                if(this.editando){
                  datosNegocio.set('id',this.negocio.id);
                   axios.post('/negocios_editar',datosNegocio)
                    .then((response) => {
                      this.negocio = {};
                      this.listar_negocios();
                      this.nuevoNegocio();
                    })
                    .catch((error)=>{
                        console.log(error.response);
                    })
                }else{
                    axios.post('/negocios_guardar1',datosNegocio)
                    .then((response) => {
                      this.negocio = {};
                      this.listar_negocios();
                      this.nuevoNegocio();
                    })
                    .catch((error)=>{
                        console.log(error.response);
                    })
                }
            },
            listar_negocios(){
                axios.get('/negocios_listar2')
                .then((response) => {
                    this.lista_negocios = response.data;
                })
                .catch((error)=>{
                    console.log(error.response);
                })
            },
            editar_negocio(param_negocio){
              this.editando = true;
              this.negocio = param_negocio;
              this.nuevoNegocio();
            },
            eliminar_negocio(){
              console.log(this.negocio.id)
              let idn = this.negocio.id;
               axios.post('/negocio_baja/'+ idn )
              .then((response) => {
                
                    
                })
                .catch((error)=>{
                    console.log(error.response);
                })
                this.negocio = {};
                      this.listar_negocios();
                    $("#eliminacionNegocio").modal("toggle");          
            },nuevoNegocio(){
              $("#formulario").modal("toggle");
            }, 
            eliminarNegocio(param_negocio){
              
              this.negocio = param_negocio;
              console.log(this.negocio = param_negocio);
              $("#eliminacionNegocio").modal("toggle");
            }, 
            cerrarModal(){              
              $("#formulario").modal("toggle");
              this.editando=false;
              this.negocio = {};
            }, cerrarIMG(){
              this.ruta = '';
              $("#viewfoto").modal("toggle");
            }, abrirFoto(ruta){
              this.ruta = ruta;
              $("#viewfoto").modal("toggle");
            },
            onChange(event) {

             axios.get("/negocios_filtrar",{
                    params: {
                        key: event.target.value
                    }
                }).then((response)=>{
                    this.lista_negocios = response.data;
                }).catch((error)=>{
                    console.log(error.response)
                })
            console.log(event.target.value)
        },
        onChange2(event) {

             axios.get("/negocios_filtrar2",{
                    params: {
                        key2: event.target.value
                    }
                }).then((response)=>{
                    this.lista_negocios = response.data;
                }).catch((error)=>{
                    console.log(error.response)
                })
              console.log(event.target.value)
            }
        }
    }
</script>