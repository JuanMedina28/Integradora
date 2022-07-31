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
                          <button type="button" @click="nuevoNegocio()" class="btn btn-sm btn-dark bg-dark"><h4 class="text-cyan">Nuevo Negocio</h4></button>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>

            <!-- TABLA -->
            <div class="container-fluid bg-gris-oxford" style="min-height: 80vh">
              <br><br><br><br>
                <div class="row">
                  <div class="col">
                    <div class="card">
                      <div class="table-responsive">
                          <div>
                              <table class="table align-items-center">
                                  <thead class="thead-light">
                                      <tr>
                                          <th scope="col" class="sort" data-sort="name"><h5>Razon Social</h5></th>
                                          <th scope="col" class="sort" data-sort="">Foto</th>
                                          <th scope="col" class="sort" data-sort="name"><h5>Giro</h5></th>
                                          <th scope="col" class="sort" data-sort="name"><h5>Email</h5></th>
                                          
                                          <th scope="col" class="sort" data-sort="name">Telefono</th>
                                          <th scope="col" class="sort" data-sort="name">RFC</th>
                                          <th scope="col"></th>
                                      </tr>
                                  </thead>
                                    <paginate name="var_negocios" :per="10" :list="lista_negocios"  tag="tbody" class="list">                  
                                      <tr v-for="v_negocio in paginated('var_negocios')">
                                          <td class="budget">
                                              {{ v_negocio.razon_social }}
                                          </td>
                                          <td>
                                            <a href="#" class="avatar avatar-sm" data-toggle="tooltip" @click="abrirFoto(v_negocio.url_logo)" data-original-title="Romina Hadid">
                                                <img alt="Image placeholder" :src="'/storage/'+v_negocio.url_logo">
                                            </a>
                                          </td>
                                          <td>
                                              {{ v_negocio.tipo_ser }}
                                          </td>
                                          <td> 
                                            {{ v_negocio.nego_email }}                              
                                          </td>
                                          <td>
                                              {{ v_negocio.nego_celular }}
                                          </td>
                                          <td>
                                              {{ v_negocio.rfc }}
                                          </td>
                                          <td class="text-right">
                                              <div class="dropdown">
                                                  <button class="btn btn-sm btn-icon-only text-dark"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                  </button>
                                                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow bg-gris-oxford">
                                                      <button  type="button" class="dropdown-item btn-dark text-cyan" @click="editar_negocio(v_negocio)">Modificar</button>
                                                      <button  type="button" class="dropdown-item btn-dark text-rosita" @click="eliminarNegocio(v_negocio)">Eliminar</button>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                    </paginate>
                              </table>
                          </div>
                                    <paginate-links for="var_negocios" :classes="{'ul': ['pagination','justify-content-end','nb-0'], 'li': 'page-item', 'a':['page-link', 'bg-dark']}"></paginate-links>
                               
                    </div>
                  </div>
                </div>
              </div>
          </div>

          <!-- Modal -->
              <div class="modal fade" id="formulario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title text-black" id="exampleModalLabel">Negocio</h1>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                                <!-- FORMULARIO -->
                                  <input type="text" class="form-control" id="nombreNegocio" v-model="negocio.razon_social" placeholder="Nombre del negocio.">
                                  <br>
                                  <label>Giro del negocio:</label>
                                  
                                    <select class="form-control" data-toggle="select" title="Simple select" v-model="negocio.tipo_ser">
                                            <option disabled selected>Elige tu tipo de Negocio</option>
                                            <option>Ingeribles - Alimentos y bebidas.</option>
                                            <option>Ambiente - Sonido y  luces.</option>
                                            <option>Música - Músicos y DJ's.</option>
                                            <option>Decoración - Exteriores e interiores.</option>
                                            <option>Extras- Hileras, tortilleros, centros de mesa, recuerdos, etc.</option>
                                            <option>Personal de servicio - Exteriores e interiores.</option>
                                    </select>
                                 
                                  <br>
                                  <input type="text" class="form-control form-control-alternative" id="giroNegocio" v-model="negocio.nego_email" placeholder="RFC del negocio">
                                  <br>
                                  <input type="tel" minlength="10" maxlength="10" class="form-control form-control-alternative" id="telefono" v-model="negocio.nego_celular"  placeholder="Telefono del negocio">
                                   <br>   
                                  <input type="text" class="form-control form-control-alternative" id="etiquetasNegocio" v-model="negocio.rfc" placeholder="Razón social del negocio">
                                  <br>
                                  <input type="file" class="form-control" id="url_logo"  accept="image/*" @change="subirFoto">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-dark text-rosita" @click="cerrarModal">Cerrar</button>
                      <button type="button" class="btn btn-dark text-cyan" @click="guardarNegocio">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="eliminacionNegocio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <h4>¿Seguro que desea eliminar este negocio?</h4>
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary" @click="eliminar_negocio()" id="botoncito">Eliminar</button>
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
                paginate: ['var_negocios']
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
               axios.delete('/negocio_eliminar/'+this.negocio.id)
              .then((response) => {
                    this.lista_negocios = response;
                    this.negocio = {};
                    $("#eliminacionNegocio").modal("toggle");
                })
                .catch((error)=>{
                    console.log(error.response);
                })
                this.listar_negocios();           
            },nuevoNegocio(){
              $("#formulario").modal("toggle");
            }, eliminarNegocio(param_negocio){
              $("#eliminacionNegocio").modal("toggle");
              this.negocio = param_negocio;
            }, cerrarModal(){              
              $("#formulario").modal("toggle");
              this.editando=false;
              this.negocio = {};
            }, cerrarIMG(){
              this.ruta = '';
              $("#viewfoto").modal("toggle");
            }, abrirFoto(ruta){
              this.ruta = ruta;
              $("#viewfoto").modal("toggle");
            }
        }
    }
</script>