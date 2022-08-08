<template>
    
    <div>
        <div class="header bg-dark pt-6 pt-nd-12">
            <div class="container-fluid">
                <div class="header pb-12">
                    <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h1 class=" text-rosita d-inline-block mb-0"><span v-if="logeado.tipo_us==2">Solicitudes de Servicios</span></h1>
                        <h4 class="text-white mb-0">Aquí puedes visualizar las solicitudes de Servicios personalizados que hayas</h4>
                    </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container  col-12" style="min-height: 83vh">
            <div class="row">
                <div class="col-1"></div>
                <div class="col"><br><br>
                <div class="card">

                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item mx-4">
                            <a class="nav-link mb-sm-3 mb-md-0 btn-dark active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-watch-time mr-2 text-degradado"></i>Pendientes</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 btn-dark" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-square-pin mr-2"></i>Aprobadas</a>
                            </li>
                        </ul>
                    </div>                   

            <div class="card shadow">
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                            <div class="card-header bg-white border-0">
                                <paginate name="var_item" :per=10 :list="list_items" class="card-body">
                                    <div  v-for="v_item in paginated('var_item')">
                                    <form method="post" autocomplete="off">
                                    <div class="container  mb-5">
                                    <div class="d-flex justify-content-center row">
                                        <div class="col-md-10">
                                            <div class="row p-2 bg-white border rounded">
                                                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" :src="'/storage/'+v_item.url_img"></div>
                                                <div class="col-md-6 mt-1">
                                                    <h5>{{v_item.tipo_serv}}</h5>
                                                    <p class="text-justify text-truncate para mb-0"><b>Descripción:</b> {{v_item.des}}</p>
                                                     <div v-if="v_item.solicitud=='si'">
                                                    <p class="text-justify text-truncate para mb-0"><b>Estatus:</b> <span style="color: blue;">En Revision</span></p>
                                                    </div>
                                                </div>
                                                <div class="align-items-center align-content-center col-md-3 border-left mt-1">

                                                    
                                                    <div class="d-flex flex-column mt-4">
                                                        <button class="btn btn-primary btn-sm" type="button" @click="ira(v_item)">Ver Detalle</button>
                                                        
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                                
                                                </div>
                                            </div>
                                        </div>

                                        </form>

                                        </div>
                                                            

                                        </paginate>
                                        <nav aria-label="...">
                                        <paginate-links for="var_item" :classes="{'ul': ['pagination','justify-content-end','nb-0'], 'li': 'page-item', 'a':['page-link', 'bg-dark']}"></paginate-links>
                                        </nav>

                                 
                            </div>
                            
                        </div>

                        <div class="tab-pane fade show" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                            <div class="card-header bg-white border-0">
                                <paginate name="var_itemsAcepts" :per=10 :list="list_itemsAcept" class="card-body">
                                    <div  v-for="v_itema in paginated('var_itemsAcepts')">
                                    <form method="post" autocomplete="off">
                                    <div class="container  mb-5">
                                    <div class="d-flex justify-content-center row">
                                        <div class="col-md-10">
                                            <div class="row p-2 bg-white border rounded">
                                                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" :src="'/storage/'+v_itema.url_img"></div>
                                                <div class="col-md-6 mt-1">
                                                    <h5>{{v_itema.tipo_serv}}</h5>
                                                    <p class="text-justify text-truncate para mb-0"><b>Descripción:</b> {{v_itema.des}}</p>
                                                     <div v-if="v_itema.solicitud=='aceptada'">
                                                    <p class="text-justify text-truncate para mb-0"><b>Estatus:</b> <span style="color: green;">Solicitud Aceptada</span></p>
                                                    </div>
                                                </div>
                                                <div class="align-items-center align-content-center col-md-3 border-left mt-1">

                                                    
                               
                                                    
                                                </div>
                                            </div>
                                                
                                                </div>
                                            </div>
                                        </div>

                                        </form>

                                        </div>
                                                            

                                        </paginate>
                                        <nav aria-label="...">
                                        <paginate-links for="var_item" :classes="{'ul': ['pagination','justify-content-end','nb-0'], 'li': 'page-item', 'a':['page-link', 'bg-dark']}"></paginate-links>
                                        </nav>

                                 
                            </div>
                            
                        </div>
                        
                        

                        </div>  
                <div class="modal fade" id="aceptar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content ">
                    <div class="modal-header">
                      <h1 class="modal-title text-rosita" id="exampleModalLabel">Aceptar Servicio</h1>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form>
                        <div class="row">
                         <div class="col-12">  
                            <img :src="'/storage/'+servicio.url_img" style="width: 100%; height: 200px;" ></img>
                        </div> 
                        
                        <div class="form-group mt-2">
                            <h4>Nombre: {{servicio.tipo_serv}}</h4>    
                       
                            <h4>Descripción: {{servicio.des}}</h4>   
                        </div>
                         <label for="">Precio:</label>
                        <div class="form-group">
                            <input type="number" class="form-control" id="precio" min="1" v-model="servicio.precio"  placeholder="Precio">
                        </div>
                         <label for="">Nota:</label>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-alternative" id="descripcionNegocio" v-model="servicio.notas" placeholder="Escribe una nota para el servicio">
                        </div>
                        </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-dark text-rosita" @click="ira()" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-dark text-cyan" @click="acepSol()" data-dismiss="modal">Aceptar</button>
                    </div>
                  </div>
                </div>
            </div>                  
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
    export default{
        mounted(){
            console.log("Component mounted.")
            this.usuarioEspec();
            this.items();
            this.itemsConcluidos();
        }, data(){
            return{
                logeado: {},
                list_items: {},
                list_itemsAcept: {},
                list_itemsCar: {},
                paginate: ['var_item', 
                'var_itemsAcepts', 
                'var_itemsSol',],
                servicio: {},
                carrito2: {},
                itemCar: '',
                ruta: '',
                unique_item: {},
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
            items(){
                axios.get('/item_solicitud').then((response)=>{
                    this.list_items = response.data;
                }).catch((error)=>{
                    console.log(error.response);
                })
            },
            itemsConcluidos(){
                axios.get('/item_solicitud2').then((response)=>{
                    this.list_itemsAcept = response.data;
                }).catch((error)=>{
                    console.log(error.response);
                })
            },
            itemsCarrito(){
                axios.get('/items_carrito', {
                    params: {
                        carrito: this.carrito.id
                    }
                }).then((response)=>{
                    this.list_itemsCar = response.data;
                    
                }).catch((error)=>{
                    console.log(error.response);
                })
            },
            finVenta(){
                axios.get('/nego_finventa', {
                    params: {
                        carrito: this.carrito.id
                    }
                }).then((response)=>{
                    this.list_itemsCar = response.data;
                    
                }).catch((error)=>{
                    console.log(error.response);
                })
                this.items();
            },
            abrir(param_venta){
                this.carrito = param_venta;
                console.log(this.carrito);
                this.itemsCarrito();
              $("#tarjeta").modal("toggle");
              
            },
            concluir(param_venta){
                this.carrito = param_venta;
                console.log(this.carrito);
                this.finVenta();
              
            },
            cerrar(){
              $("#tarjeta").modal("toggle");
              
            },
            acepSol(){
            const datosNegocio = new FormData;

            datosNegocio.set('notas',this.servicio.notas);
            datosNegocio.set('precio',this.servicio.precio);
            datosNegocio.set('id_ser',this.servicio.id);

            axios.post('/sol_servicio', datosNegocio)
            .then((response) => {
                this.servicio = {};
                window.location.reload();
            })
            .catch((error)=>{
                console.log(error.response);
            })
        },
            ira(param){
            this.servicio = param;
            console.log(this.servicio);
            $("#aceptar").modal("toggle");
              
        },
        }
    }
</script>
