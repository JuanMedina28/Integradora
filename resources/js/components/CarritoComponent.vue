<template>
    <div>

        <div class="header pb-5 pt-5 pt-lg-8 d-flex align-items-center" style="background-image: url(&quot;../argon/img/theme/fondo-carrito.jpg&quot;); background-size: cover; background-position: center top;"><span class="mask bg-black-gradient opacity-6"></span> <div class="container-fluid d-flex align-items-center"><div class="row"><div class="col-md-12 col-lg-7"><h1 class="display-2 text-white">Bienvenido!</h1> <p class="text-white mt-0 mb-5">Esta es tu página de servicios. Puedes ver los servicios que te interese adquirir o eliminarlos.</p></div></div></div></div>

        <div class="container-fluid bg-gris-oxford" style="min-height: 80vh">
                <br><br>
                <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <h1 class="mb-0 text-rosita">&nbsp;Servicios</h1>
                                
                            </div>
                        </div>
                        

                        <paginate name="var_item" :per=2 :list="list_items" class="card-body">
                        <div  v-for="v_item in paginated('var_item')">
                        <form method="post" autocomplete="off">
                         <div class="container mt-5 mb-5">
                            <div class="d-flex justify-content-center row">
                                <div class="col-md-10">
                                    <div class="row p-2 bg-white border rounded">
                                        <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" :src="'/storage/'+v_item.url_img"></div>
                                        <div class="col-md-6 mt-1">
                                            <h5>{{v_item.cat}}</h5>
                                            <p class="text-justify text-truncate para mb-0">Nombre: {{v_item.tipo_serv}}</p>
                                            <p class="text-justify text-truncate para mb-0">Cantidad: {{v_item.scant}}</p>
                                            <p class="text-justify text-truncate para mb-0">Costo: {{v_item.precio}}</p>
                                        </div>
                                        <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                                            <div class="d-flex flex-row align-items-center">
                                                <h4 class="mr-1">${{v_item.stotal}} MXN</h4>
                                            </div>
                                            <h5 class="text-success">Total</h5>
                                            <div class="d-flex flex-column mt-4">
                                                
                                                <button class="btn btn-primary " type="button" @click="eliminar(v_item)">
                                                    <span  aria-hidden="true">Descartar</span>
                                                </button>
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

                        
                </div><br><br><br><br>

               
            <div class="modal fade" id="eliminacionAlimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content bg-gris-oxford">
                    <div class="modal-header">
                      <h1 class="modal-title text-white" id="exampleModalLabel">Eliminar</h1>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <h4 class=" text-white">¿Seguro que desea eliminar este servicio?</h4>
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-dark text-rosita" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-dark text-cyan" @click="eliminar_alimento()" id="botoncito">Eliminar</button>
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
            this.items();
        },data(){
            return {
                list_items: {},
                paginate: ['var_item'],
                ruta: '',
                unique_item: {},
            }
        },methods:{
             items(){
                axios.get('/items').then((response)=>{
                    this.list_items = response.data;
                }).catch((error)=>{
                    console.log(error.response);
                })
            },
            eliminar(param_negocio){
              $("#eliminacionAlimento").modal("toggle");
              this.unique_item = param_negocio;
            },
            eliminar_alimento(){
                 axios.post("/deleteItem", this.unique_item).then((response)=>{
                  
                    
                  
                }).catch((error)=>{
                  console.log(error.response);
                })
                axios.post("/compras_borrar", this.unique_item).then((response)=>{
                  
                    
                  
                  console.log(error.response);
                })
               
                $("#eliminacionAlimento").modal("toggle");
                this.items();
            },
            
        }
    }
</script>
