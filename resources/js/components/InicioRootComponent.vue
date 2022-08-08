<template>
    <div>

        
                 
                <div class="header pt-4  pb-4" style="background-image: url('img/bg-2.jpg'); background-size: cover; background-position: center;" >

                <center><a><img :src="'img/ps-lg.png'" width="300" ></a></center>
                </div>
                <div class="container-fluid pt-1 " style="min-height: 80vh"><br>
                        

                       


                    <div v-if="logeado.tipo_us==1">
                    <center><h1 class="text-rosita">Bienvenido Admin: <span style="color: white;">{{logeado.name}}</span></h1></center>
                    
                     <br>
                
                <section>
                    
                    <div class="row">
                        <div class="col-3">
                            <div class="cards-servicios">
                                <div class="face front">
                                    <img src="storage/menu/tienda.jpg" alt="" />
                                    <h3>Negocios</h3>
                                </div>
                                <div class="face back">
                                    <h1>Negocios</h1>
                                    <p>Aquí podrás administras los negocios que se han registrado</p>
                                    <div class="link">
                                        <a href="#" class="btn btn-dark text-cyan" @click="mandarNegocios()">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="cards-servicios">
                                <div class="face front">
                                    <img src="storage/menu/envio.jpg" alt="" />
                                    <h3>Servicios</h3>
                                </div>
                                <div class="face back">
                                    <h1>Servicios</h1>
                                    <p>Aquí podrás administrar todos los servicios que se han registrado</p>
                                    <div class="link">
                                        <a href="#" class="btn btn-dark text-cyan" @click="mandarServicios()">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="cards-servicios">
                                <div class="face front">
                                    <img src="storage/menu/programador.jpg" alt="" />
                                    <h3>Usuarios</h3>
                                </div>
                                <div class="face back">
                                    <h1>Usuarios</h1>
                                    <p>Aquí podrás administrar todos los usuarios que se han registrado</p>
                                    <div class="link">
                                        <a href="#" class="btn btn-dark text-cyan" @click="mandarUsuarios()">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="cards-servicios">
                                <div class="face front">
                                    <img src="storage/menu/tarjeta-de-debito.webp" alt="" />
                                    <h3>Pagos</h3>
                                </div>
                                <div class="face back">
                                    <h1>Pagos</h1>
                                    <p>Aquí podrás administrar todos los pagos que se han realizado</p>
                                    <div class="link">
                                        <a href="#" class="btn btn-dark text-cyan" @click="mandarPagos()">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                        
                        
            </div>

            <div v-if="logeado.tipo_us==2">
                    <div class="row" style="max-height: ">
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
                          <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                          </div>
                          <div class="carousel-inner">
                            <div class="carousel-item active">
                              <img src="storage/menu/slider-1.png" class="d-block" style="width: 100%; height: 20rem;">
                              <div class="carousel-caption d-none d-md-block">
                                <a href="/servicios" ><h1 class=" btn btn-dark bg-black text-cyan">Servicios</h1></a>
                                <p class="text-white"><h2>Aquí podrás administrar todos los servicios que se han registrado</h2></p>
                                
                              </div>
                            </div>
                            <div class="carousel-item">
                              <img src="storage/menu/slider-2.png" class="d-block" style="width: 100%; height: 20rem;">
                              <div class="carousel-caption d-none d-md-block ">
                                <a href="/pedidos" ><h2 class=" btn btn-dark bg-black text-cyan">Pedidos</h2></a>
                                <p ><h2 class="text-white">Aquí podrás administrar todos los pedidos que se han realizado</h2></p>
                              </div>
                            </div>
                            <div class="carousel-item">
                              <img src="storage/menu/slider-3.png" class="d-block" style="width: 100%; height: 20rem;">
                              <div class="carousel-caption d-none d-md-block">
                                <a href="/solicitud"  ><h2 class=" btn btn-dark bg-black text-cyan">Solicitudes</h2></a>
                                <p class="text-white"><h2 class="text-white">Aquí podrás administrar todas las solicitudes que se han generado</h2></p>
                              </div>
                            </div>
                          </div>
                          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                          </button>
                          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                          </button>
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
                    
        </div>
        
    </div>

</template>
<script>
import VuePaginate from "vue-paginate";
export default {

    mounted(){
        console.log("Component mounted.")
        this.usuarioEspec();
        this.listar_servicio();
        
    }, data(){
        return {
                servicio: {},
                lista_servicios:{},
  
                ruta : '',
                paginate: ['var_servicios'],
                logeado: {},
            }
        
    }, methods:{
        mandarNegocios(){
            window.location.href = '/negocios'
        },
        mandarServicios(){
            window.location.href = '/servicios'
        },
        mandarUsuarios(){
            window.location.href = '/usuarios'
        },
        mandarPagos(){
            
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
            irUsuarios(){
                window.location.href = '/usuarios'
        },
        irServicios(){
                window.location.href = '/servicios'
        },
        irVentas(){
                window.location.href = '/servicios'
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
            
            around(value){
                return parseFloat(Math.round(value)).toFixed(2);
         }
    }
}
</script>