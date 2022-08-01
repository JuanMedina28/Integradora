<template>
    <div>

        
                 
                <div class="header pt-4  pb-4" style="background-image: url('img/bg-2.jpg'); background-size: cover; background-position: center;" >

                <center><a><img :src="'img/ps-lg.png'" width="300" ></a></center>
                </div>
                <div class="container-fluid pt-5 bg-gris-oxford" style="min-height: 80vh"><br>
                        

                       


                    <div v-if="logeado.tipo_us==1">
                    <div class="row">

                        
                        <div class="col-md-4">
                            
                             <div class="card bg-dark text-white">
                        <img class="card-img" src="img/bg-2.jpg" alt="Card image">
                        <div class="card-img-overlay">
                            <h4 class="card-title" style="color: white;">Administrar Usuarios</h4>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                            
                            <a href="#" class="btn btn-dark bg-dark" @click="irUsuarios()" style="display: inline-block; width: 100%;">Ir a</a>
                        </div>
                        </div>

                        </div>
                        
                        <div class="col-md-4">
                            
                             <div class="card bg-dark text-white">
                        <img class="card-img" src="img/bg-2.jpg" alt="Card image">
                        <div class="card-img-overlay">
                            <h4 class="card-title" style="color: white;">Administrar Servicios</h4>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                            
                            <a href="#" class="btn btn-dark bg-dark" @click="irServicios()" style="display: inline-block; width: 100%;">Ir a</a>
                        </div>
                        </div>

                        </div>
                        <div class="col-md-4">
                            
                             <div class="card bg-dark text-white">
                        <img class="card-img" src="img/bg-2.jpg" alt="Card image">
                        <div class="card-img-overlay">
                            <h4 class="card-title" style="color: white;">Administrar Ventas</h4>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                            
                            <a href="#" class="btn btn-dark bg-dark"  @click="irVentas()"  style="display: inline-block; width: 100%;">Ir a</a>
                        </div>
                        </div>

                        </div>
                    </div>
                        
                        
                        
            </div>

            <div v-if="logeado.tipo_us==2">
                    <div class="row">

                        
                        
                        
                        <div class="col-md-6">
                            
                             <div class="card bg-dark text-white" style="max-width: 400px; margin: auto;">
                        <img class="card-img" src="img/bg-2.jpg" alt="Card image">
                        <div class="card-img-overlay">
                            <h4 class="card-title" style="color: white;">Administrar Servicios</h4>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                            <br><br>
                            <a href="#" class="btn btn-dark bg-dark" @click="irServicios()" style="display: inline-block; width: 100%;">Ir a</a>
                        </div>
                        </div>

                        </div>
                        <div class="col-md-6">
                            
                             <div class="card bg-dark text-white"  style="max-width: 400px; margin: auto;">
                        <img class="card-img" src="img/bg-2.jpg" alt="Card image">
                        <div class="card-img-overlay">
                            <h4 class="card-title" style="color: white;">Administrar Ventas</h4>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                            <br><br>
                            <a href="#" class="btn btn-dark bg-dark"  @click="irVentas()"  style="display: inline-block; width: 100%;">Ir a</a>
                        </div>
                        </div>

                        </div>
                    </div>
                        
                        
                        
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