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
            <center><h1 class="text-rosita">Bienvenido: <span style="color: white;">{{logeado.name}}</span></h1></center>
                    
                        
                    <section>
                    
                    <div class="row">
                       
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
                    
        </div>
        
    </div>

</template>
<script>
import VuePaginate from "vue-paginate";
export default {

    mounted(){
        console.log("Component mounted.")
        this.usuarioEspec();
        
    }, data(){
        return {
                
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
    }
}
</script>