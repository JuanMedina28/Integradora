<template>
    <div>

        <form>
                 
                <div class="header bg-shadow pt-4  pb-4" style="background-image: url('img/bg-2.jpg'); background-size: cover; background-position: center;" >

                <center><a><img :src="'img/ps-lg.png'" width="300" ></a></center>
                </div>
                <div class="container-fluid mt-0 " style="min-height: 80vh"><br>
                        <center><h1 class="text-rosita">Servicios Disponibles</h1></center><br>
                        
            <div class="row mb-4" >
                        <div class="col-3">
                            <label style="">Buscar Servicio:</label><input v-model="buscador" @keyup="buscarServicio" style="color:white;background: black;" type="search" class="form-control"  placeholder="Buscar Servicio" aria-label="Buscar Usuario..." aria-describedby="button-addon2">
                        </div>
                        <div class="col-5"></div>
                        <div class="col-4">
                            <label style="">Filtrar:</label>
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
                <div class="row">
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
                                    
                                   
                                    <a href="#" class="btn btn-dark text-cyan" @click="cargaItem(v_servicio)">Contratar</a>
                                
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
                        

                    <center><h1 class="text-rosita">Negocios</h1></center><br><br>
                    <div class="row">
                        <paginate name="var_negocios" :per="8" :list="negocios" tag="div" class="card-deck">
                        <div class="col-3" v-for="negocio in paginated('var_negocios')">
                            <div class="card_negoCL bg-dark">
                              <div class="head_negoCL">
                                <div class="circle_negoCL" style="margin-left: -20px;"></div>
                                <div class="img_negoCL">
                                  <a @click="abrirFoto(negocio.url_logo)">
                                    <img :src="'/storage/'+negocio.url_logo">
                                  </a>
                                </div>
                              </div>
                              <div class="des_negoCL">
                                <p>{{ negocio.razon_social }}</p>
                                <p>{{ negocio.tipo_ser }}</p>
                                <b>{{negocio.nego_email}}</b>
                                <p>Tel: {{negocio.nego_celular}}</p>
                                <p>{{negocio.rfc}}</p>
                              </div>
                              <div class="contact_negoCL">
                                <a href="#" class="btn btn-dark bg-dark text-cyan" @click="ira(negocio)">Solicitar</a>
                              </div>
                            </div>
                        </div>
                        </paginate>
                    </div>
                    <nav aria-label="...">
                            <br>
                            <paginate-links for="var_negocios" :classes="{'ul': ['pagination','justify-content-end','nb-0'], 'li': 'page-item', 'a':['page-link', 'bg-dark']}"></paginate-links>
                            <br>
                    </nav>

                    
                </div>
        </form>
                        <div class="modal fade" id="solicitud" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content ">
                    <div class="modal-header">
                      <h1 class="modal-title text-rosita" id="exampleModalLabel">Solicitar Servicio</h1>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form>
                        <div class="row">
                         <div class="col-12">  
                        <h3>Puedes ingresar una imagen de Muestra</h3>
                        <div class="custom-file">
                            <input type="file" require class="form-control form-control-alternative" id="url"  accept="image/*" @change="subirFoto">
                        </div>
                        </div> 
                        <br>
                        <label for="">Titulo del Servicio</label>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-alternative" id="descripcionNegocio" v-model="negocio.tipo_serv" placeholder="Escribe un nombre para la solicitud">
                        </div>
                        <label for="">Descripción</label>
                        <div class="form-group">
                            <textarea class="form-control" id="descripcion"  rows="3" v-model="negocio.des"  placeholder="Escribe una descripción detallada del servicio"></textarea>
                        </div>
                        </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-dark text-rosita" @click="ira()" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-dark text-cyan" @click="regSer()" data-dismiss="modal">Enviar</button>
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
        this.listar_servicios();
        this.listar_negocios();
    }, data(){
        return{
            servicios: {},
            negocios: {},
            negocio: {},
            paginate: ['var_servicios', 'var_negocios'],
            buscador: '',
            setTimeoutBuscador: '',
            key: ''
        }
    }, methods:{
        subirFoto(e){
            this.negocio.url = e.target.files[0];
        },
        listar_negocios(){
                axios.get('/negocios_listar2')
                .then((response) => {
                    this.negocios = response.data;
                })
                .catch((error)=>{
                    console.log(error.response);
                })
        },
        regSer(){
            const datosNegocio = new FormData;
            datosNegocio.set('razon_social',this.negocio.razon_social);
            datosNegocio.set('tipo_ser',this.negocio.tipo_ser);
            datosNegocio.set('email',this.negocio.nego_email);
            datosNegocio.set('celular',this.negocio.nego_celular);
            datosNegocio.set('rfc',this.negocio.rfc);
            datosNegocio.set('precio',this.negocio.etiquetas);
            datosNegocio.set('url',this.negocio.url);
            datosNegocio.set('tipo_serv',this.negocio.tipo_serv);
            datosNegocio.set('des',this.negocio.des);
            datosNegocio.set('id_pser',this.negocio.id_us);

            axios.post('/sol_servicio', datosNegocio)
            .then((response) => {
                this.negocio = {};
                window.location.reload();
            })
            .catch((error)=>{
                console.log(error.response);
            })
        },
        ira(param){
            this.negocio = param;
            console.log(this.negocio);
            $("#solicitud").modal("toggle");
              
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