<template>
    <div>

        <form>
                 
                <div class="header pt-4  pb-4" style="background-image: url('img/bg-2.jpg'); background-size: cover; background-position: center;" >

                <center><a><img :src="'img/ps-lg.png'" width="300" ></a></center>
                </div>
                <div class="container-fluid mt-0 bg-gris-oxford" style="min-height: 80vh"><br>
                        <center><h1 class="text-rosita">Servicios Disponibles</h1></center><br>
                        <paginate name="var_servicios" :per="4" :list="servicios" tag="div" class="card-deck">
                            <div class="card shadow-lg" style="max-width: 20rem;" v-for="servicio in paginated('var_servicios')">
                                <img class="card-img-top" width="300px" height="200px" :src="'/storage/'+servicio.url_img" alt="Card image cap">
                                <div class="card-body">
                                    <h3 class="card-title text-black">{{servicio.tipo_serv}}</h3>
                                    <p class="card-text text-black">{{servicio.des}}</p>
                                    <p class="card-text text-black">{{servicio.nego_name}}</p>
                                    <p class="card-text text-black">$ {{around(servicio.precio)}} MXN</p>
                                </div>
                            <div class="card-footer text-muted">
                                <a href="#" class="btn btn-dark text-cyan" @click="cargaItem(servicio)">Agregar al Carrito</a>
                            </div>
                            </div>
                        </paginate>
                        <nav aria-label="...">
                            <br>
                              <paginate-links for="var_servicios" :classes="{'ul': ['pagination','justify-content-end','nb-0','text-rosita'], 'li': ['page-item',], 'a':['page-link', 'bg-dark']}"></paginate-links>
                              <br>
                        </nav>

                    <center><h1 class="text-rosita">Negocios</h1></center><br>
                    <paginate name="var_negocios" :per="3" :list="negocios" tag="div" class="card-deck">
                            <div class="card" style="max-width: 18rem;" v-for="negocio in paginated('var_negocios')">
                                <img class="card-img-top" width="300px" height="250px" :src="'/storage/'+negocio.url_logo" alt="Card image cap">
                                <div class="card-body">
                                    <h3 class="card-title">{{negocio.razon_social}}</h3>
                                    <p class="card-text">{{negocio.tipo_ser}}</p>
                                    <p class="card-text">Contacto: {{negocio.nego_email}}</p>
                                    <p class="card-text">Telefono: {{negocio.nego_celular}}</p>
                                </div>
                                 <div class="card-footer text-muted">
                                    <a href="#" class="btn btn-dark text-cyan" @click="ira()">Ver mas...</a>
                                </div>  
                            </div>
                    </paginate>
                    <nav aria-label="...">
                            <br>
                            <paginate-links for="var_negocios" :classes="{'ul': ['pagination','justify-content-end','nb-0'], 'li': 'page-item', 'a':['page-link', 'bg-dark']}"></paginate-links>
                            <br>
                    </nav>

                    
                </div>
        </form>
    </div>

</template>
<script>
import VuePaginate from "vue-paginate";
export default {

    mounted(){
        console.log("Component mounted.")
        this.listar_servicios();
        this.listar_negocios();
    }, data(){
        return{
            servicios: {},
            negocios: {},
            paginate: ['var_servicios', 'var_negocios']
        }
    }, methods:{
        listar_negocios(){
                axios.get('/negocios_listar2')
                .then((response) => {
                    this.negocios = response.data;
                })
                .catch((error)=>{
                    console.log(error.response);
                })
        },
        ira(){
                window.location.href = 'http://localhost:8000' +'/servicios'
        },
        listar_servicios(){
                axios.get("/servicios_listar2").then((response)=>{
                    this.servicios = response.data;
                }).catch((error)=>{
                    console.log(error.response)
                })
        }, cargaItem(alimento){
            axios.post("/newItem", alimento).then((response)=>{

                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Item Agregado!',
                showConfirmButton: false,
                timer: 1500
                })
                location.reload();
            }).catch((error)=>{
                console.log(error.response);
            })
        }, around(value){
                return parseFloat(Math.round(value)).toFixed(2);
         }
    }
}
</script>