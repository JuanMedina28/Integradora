<template>
<div class="bg-gris-oxford">
        
                <div class="header bg-dark pt-6 pt-nd-12">
                  <div class="container-fluid">
                    <div class="header pb-12">
                      <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                          <h1 class=" text-rosita d-inline-block mb-0"><span v-if="logeado.tipo_us==2">Mis Ventas</span><span v-if="logeado.tipo_us==1">Ventas del Sistema</span></h1>
                          <h4 class="text-white mb-0">Aquí puedes visualizar las ventas que se han realizado</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <div class="container bg-gris-oxford col-12" style="min-height: 83vh">
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
                                        <a class="nav-link mb-sm-3 mb-md-0 btn-dark" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-square-pin mr-2"></i>Concluidass</a>
                                    </li>
                                </ul>
                            </div>
            <div class="card shadow">
                <div class="card-body">
                    <div v-if="logeado.tipo_us==1">
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
                                                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" style="max-height: 150px;" src="/argon/img/theme/open_logo.png"></div>
                                                <div class="col-md-6 mt-1">
                                                    <h5>Fecha de la compra: {{v_item.fecha}}</h5>
                                                    <p class="text-justify text-truncate para mb-0">Servicios: {{v_item.cant}}</p>
                                                    <div v-if="v_item.status==1">
                                                    <p class="text-justify text-truncate para mb-0">Estatus: En Proceso</p>
                                                    </div>
                                                    <div v-if="v_item.status==2">
                                                    <p class="text-justify text-truncate para mb-0">Estatus: Concluida</p>
                                                    </div>
                                                </div>
                                                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                                                    <div class="d-flex flex-row align-items-center">
                                                        <h4 class="mr-1">${{v_item.total}} MXN</h4>
                                                    </div>
                                                    <h5 class="text-success">Total</h5>
                                                    
                                                    <div class="d-flex flex-column mt-4">
                                                        <button class="btn btn-primary btn-sm" type="button" @click="abrir(v_item)">Ver Detalle</button>
                                                        
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

                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                            <div class="card-header bg-white border-0">
                                
                                <paginate name="var_itemsEnv" :per=4 :list="list_itemsEnv" class="card-body">
                                    <div  v-for="v_item2 in paginated('var_itemsEnv')">
                                    <form method="post" autocomplete="off">
                                    <div class="container  mb-5">
                                    <div class="d-flex justify-content-center row">
                                        <div class="col-md-10">
                                            <div class="row p-2 bg-white border rounded">
                                                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" style="max-height: 150px;" src="/argon/img/theme/open_logo.png"></div>
                                                <div class="col-md-6 mt-1">
                                                    <h5>Fecha de la compra: {{v_item2.fecha}}</h5>
                                                    <p class="text-justify text-truncate para mb-0">Servicios: {{v_item2.cant}}</p>
                                                    <div v-if="v_item2.status==1">
                                                    <p class="text-justify text-truncate para mb-0">Estatus: En Proceso</p>
                                                    </div>
                                                    <div v-if="v_item2.status==2">
                                                    <p class="text-justify text-truncate para mb-0">Estatus: Concluida</p>
                                                    </div>
                                                </div>
                                                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                                                    <div class="d-flex flex-row align-items-center">
                                                        <h4 class="mr-1">${{v_item2.total}} MXN</h4>
                                                    </div>
                                                    <h5 class="text-success">Total</h5>
                                                    
                                                    <div class="d-flex flex-column mt-4">
                                                        <button class="btn btn-primary btn-sm" type="button" @click="abrir2(v_item2)">Ver Detalle</button>
                                                        
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                                
                                                </div>
                                            </div>
                                        </div>

                                        </form>

                                        </div>
                                                            

                                        </paginate>
                                       
                                 
                            </div>
                            
                        </div>
                        
                        

                        </div>

                    </div>

                    <div v-if="logeado.tipo_us==2">
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
                                                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" :src="'/storage/'+v_item.img"></div>
                                                <div class="col-md-6 mt-1">
                                                    <h5>{{v_item.fecha}}</h5>
                                                    <h6>Fecha del evento: {{v_item.fevent2}}</h6>
                                                    <p class="text-justify text-truncate para mb-0">Cliente: {{v_item.name}} {{v_item.ap}} {{v_item.am}}</p>
                                                    <p class="text-justify text-truncate para mb-0">Paquete: {{v_item.tipo}}</p>
                                                    <p class="text-justify text-truncate para mb-0">Servicios: {{v_item.scant}}</p>
                                                     <div v-if="v_item.st==1">
                                                    <p class="text-justify text-truncate para mb-0">Estatus: Pagada/En Proceso</p>
                                                    </div>
                                                    <div v-if="v_item.st==2">
                                                    <p class="text-justify text-truncate para mb-0">Estatus: Concluida</p>
                                                    </div>
                                                </div>
                                                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                                                    <div class="d-flex flex-row align-items-center">
                                                        <h4 class="mr-1">${{v_item.stotal}} MXN</h4>
                                                    </div>
                                                    <h5 class="text-success">Total</h5>
                                                    
                                                    <div class="d-flex flex-column mt-4">
                                                        <button class="btn btn-primary btn-sm" type="button" @click="concluir(v_item)">Ver Detalle</button>
                                                        
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

                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                            <div class="card-header bg-white border-0">
                                
                                <paginate name="var_itemsEnv" :per=4 :list="list_itemsEnv" class="card-body">
                                    <div  v-for="v_item2 in paginated('var_itemsEnv')">
                                    <form method="post" autocomplete="off">
                                    <div class="container  mb-5">
                                    <div class="d-flex justify-content-center row">
                                        <div class="col-md-10">
                                            <div class="row p-2 bg-white border rounded">
                                                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" :src="'/storage/'+v_item2.img"></div>
                                                <div class="col-md-6 mt-1">
                                                    <h5>{{v_item2.fecha}}</h5>
                                                    <h5>Fecha del evento: {{v_item2.fevent2}}</h5>
                                                    <p class="text-justify text-truncate para mb-0">Cliente: {{v_item2.name}} {{v_item2.ap}} {{v_item2.am}}</p>
                                                    <p class="text-justify text-truncate para mb-0">Paquete: {{v_item2.tipo}}</p>
                                                    <p class="text-justify text-truncate para mb-0">Servicios: {{v_item2.scant}}</p>
                                                     <div v-if="v_item2.sta==2">
                                                    <p class="text-justify text-truncate para mb-0">Estatus: Pagada/En Proceso</p>
                                                    </div>
                                                    <div v-if="v_item2.sta==3">
                                                    <p class="text-justify text-truncate para mb-0">Estatus: Concluida</p>
                                                    </div>
                                                </div>
                                                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                                                    <div class="d-flex flex-row align-items-center">
                                                        <h4 class="mr-1">${{v_item2.stotal}} MXN</h4>
                                                    </div>
                                                    <h5 class="text-success">Total</h5>
                                                    

                                                    
                                                </div>
                                            </div>
                                                
                                                </div>
                                            </div>
                                        </div>

                                        </form>

                                        </div>
                                                            

                                        </paginate>
                                       
                                 
                            </div>
                            
                        </div>
                        
                        

                        </div>

                    </div>


                    <div class="modal fade"  id="tarjeta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title text-dark" id="exampleModalLabel">Detalle Venta</h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                
                                <paginate name="var_itemsCar" :per=10 :list="list_itemsCar" class="card-body">
                                    <div  v-for="v_item in paginated('var_itemsCar')">
                                    <form method="post" autocomplete="off">
                                    <div class="container mt-5 mb-5">
                                        <div class="d-flex justify-content-center row">
                                            <div class="col-md-12">
                                                <div class="row p-2 bg-white border rounded">
                                                    <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" :src="'/storage/'+v_item.url_img"></div>
                                                    <div class="col-md-6 mt-1">
                                                        <h5>{{v_item.cat}}</h5>
                                                        <p class="text-justify text-truncate para mb-0">Nombre: {{v_item.tipo_serv}}</p>
                                                        <p class="text-justify text-truncate para mb-0">Cantidad: {{v_item.scant}}</p>
                                                        <p class="text-justify text-truncate para mb-0">Costo: {{v_item.precio}}</p>
                                                    </div>
                                                    
                                                </div>
                                            
                                            </div>
                                        </div>
                                    </div>

                                    </form>

                                        </div>
                                        

                                    </paginate>

                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-dark text-rosita" data-dismiss="modal" @click="cerrar()">Cerrar</button>
                            <button type="button" class="btn btn-dark text-cyan" @click="eliminar_alimento()" id="botoncito">Confirmar</button>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="modal fade"  id="tarjeta2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title text-dark" id="exampleModalLabel">Detalle Venta</h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                
                                <paginate name="var_itemsCar2" :per=10 :list="list_itemsCar2" class="card-body">
                                    <div  v-for="v_itemc in paginated('var_itemsCar2')">
                                    <form method="post" autocomplete="off">
                                    <div class="container mt-5 mb-5">
                                        <div class="d-flex justify-content-center row">
                                            <div class="col-md-12">
                                                <div class="row p-2 bg-white border rounded">
                                                    <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" :src="'/storage/'+v_itemc.url_img"></div>
                                                    <div class="col-md-6 mt-1">
                                                        <h5>{{v_itemc.cat}}</h5>
                                                        <p class="text-justify text-truncate para mb-0">Nombre: {{v_itemc.tipo_serv}}</p>
                                                        <p class="text-justify text-truncate para mb-0">Cantidad: {{v_itemc.scant}}</p>
                                                        <p class="text-justify text-truncate para mb-0">Costo: {{v_itemc.precio}}</p>
                                                    </div>
                                                    
                                                </div>
                                            
                                            </div>
                                        </div>
                                    </div>

                                    </form>

                                        </div>
                                        

                                    </paginate>

                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-dark text-rosita" data-dismiss="modal" @click="cerrar2()">Cerrar</button>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
            
            

                    <br>
                    </div>
                    <div class="col-1"></div>
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
                list_itemsEnv: {},
                list_itemsCar: {},
                paginate: ['var_item', 
                'var_itemsEnv', 
                'var_itemsCar',  
                'var_itemsCar2'],
                carrito: {},
                carrito2: {},
                list_itemsCar2: {},
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
                axios.get('/compras_listar2').then((response)=>{
                    this.list_items = response.data;
                }).catch((error)=>{
                    console.log(error.response);
                })
            },
            itemsConcluidos(){
                axios.get('/compras_listar3').then((response)=>{
                    this.list_itemsEnv = response.data;
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
            itemsCarrito2(){
                axios.get('/items_carrito2', {
                    params: {
                        carrito2: this.carrito2.id
                    }
                }).then((response)=>{
                    this.list_itemsCar2 = response.data;
                    
                }).catch((error)=>{
                    console.log(error.response);
                })
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
            abrir2(param_venta2){
                this.carrito2 = param_venta2;
                console.log(this.carrito2);
                this.itemsCarrito2();
              $("#tarjeta2").modal("toggle");
              
            },
            cerrar(){
              $("#tarjeta").modal("toggle");
              
            },
            cerrar2(){
              $("#tarjeta2").modal("toggle");
              
            },
        }
    }
</script>