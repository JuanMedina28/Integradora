<template>
    <div>

        <form>
                 
                <div class="header pt-4  pb-4" style="background-image: url('img/bg-2.jpg'); background-size: cover; background-position: center;" >

                <center><a><img :src="'img/ps-lg.png'" width="300" ></a></center>
                </div>
                <div class="container-fluid mt-0 bg-gris-oxford" style="min-height: 80vh"><br>
                        <center><h1 class="text-rosita">Servicios Disponibles</h1></center><br>
                        
            <div class="row mb-4" >
                        <div class="col-3">
                            <label style="color: white;">Buscar Servicio:</label><input v-model="buscador" @keyup="buscarServicio" style="color:white;background: black;" type="search" class="form-control"  placeholder="Buscar Servicio" aria-label="Buscar Usuario..." aria-describedby="button-addon2">
                        </div>
                        <div class="col-6"></div>
                        <div class="col-3">
                            <label style="color: white;">Filtrar:</label>
                            <select class="form-control" @change="onChange($event)" v-model="key" data-toggle="select" title="Simple select"  style="color:white;background: black;">
                                            <option disabled selected>Tipo de Servicio</option>
                                            <option value="1">Ingeribles - Alimentos y bebidas.</option>
                                            <option value="2">Ambiente - Sonido y luces.</option>
                                            <option value="3">Música - Músicos y DJ's.</option>
                                            <option value="4">Decoración - Exteriores e interiores.</option>
                                            <option value="5">Extras- Hileras, tortilleros, centros de mesa, recuerdos, etc.</option>
                                            <option value="6">Personal de servicio - Exteriores e interiores.</option>
                                            <option value="7">Mostrar Todos</option>
                            </select>
                        </div>
                    </div>

                    <paginate name="var_servicios" :per="8" :list="servicios" tag="div" class="card-deck">
                        <div class="col-3" v-for="v_servicio in paginated('var_servicios')">
                            <div class="cards-servicios">
                                <div class="face front">
                                    <a href="#" @click="abrirFoto(v_servicio.url_img)">
                                      <img alt="Image placeholder" width="30px" height="30px" :src="'/storage/'+v_servicio.url_img">
                                    </a>
                                    <h3>{{ v_servicio.tipo_serv }}</h3>
                                </div>
                                <div class="face back">
                                    
                                    <h3>{{ v_servicio.nego_name}}</h3>
                                    <p>{{ v_servicio.des }}</p>
                                    <b>${{ around(v_servicio.precio) }} MXN</b>
                                    
                                   
                                    <a href="#" class="btn btn-dark text-cyan" @click="cargaItem(v_servicio)">Agregar al Carrito</a>
                                
                                </div>
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
            paginate: ['var_servicios', 'var_negocios'],
            buscador: '',
            setTimeoutBuscador: '',
            key: ''
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
                axios.get("/servicios_listar2",{
                    params: {
                        buscador: this.buscador
                    }
                }).then((response)=>{
                    this.servicios = response.data;
                }).catch((error)=>{
                    console.log(error.response)
                })
        }, cargaItem(servicio){
            axios.post("/newItem", servicio).then((response)=>{

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
            axios.post("/carrito_guardar", servicio).then((response)=>{
                location.reload();
            }).catch((error)=>{
                console.log(error.response);
            })
        }, around(value){
                return parseFloat(Math.round(value)).toFixed(2);
         },
         buscarServicio(){
                clearTimeout(this.setTimeoutBuscador);
                this.setTimeoutBuscador = setTimeout(this.listar_servicios, 350);
            },
        onChange(event) {

             axios.get("/servicios_filtrar",{
                    params: {
                        key: event.target.value
                    }
                }).then((response)=>{
                    this.servicios = response.data;
                }).catch((error)=>{
                    console.log(error.response)
                })
            console.log(event.target.value)
        }
    }
}
</script>