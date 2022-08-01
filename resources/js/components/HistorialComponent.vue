<template>
   <div>

        <div class="header pb-5 pt-5 pt-lg-8 d-flex align-items-center" style="background-image: url(&quot;../argon/img/theme/fondo-carrito.jpg&quot;); background-size: cover; background-position: center top;"><span class="mask bg-black-gradient opacity-6"></span> <div class="container-fluid d-flex align-items-center"><div class="row"><div class="col-md-12 col-lg-7"><h1 class="display-2 text-white">Historial de Compras</h1> <p class="text-white mt-0 mb-5">Esta es tu página de compras. Puedes ver las compras que has realizado</p></div></div></div></div>

        <div class="container-fluid bg-gris-oxford" style="min-height: 80vh">
                <br><br>
                <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <h1 class="mb-0 text-rosita">&nbsp;Mis compras</h1>
                            </div>
                        </div>
    
    <paginate name="var_item" :per=10 :list="list_items" class="card-body">
    <div  v-for="v_item in paginated('var_item')">
    <form method="post" autocomplete="off">
    <div class="container mt-5 mb-5">
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
                    <div v-if="v_item.status==1">
                    <div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-sm" type="button" @click="abrir()">Pagar</button><button class="btn btn-outline-primary btn-sm mt-2" type="button" @click="eliminar()">Descartar</button></div>
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

                <div class="modal fade" id="tarjeta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content bg-gris-oxford">
                    <div class="modal-header">
                      <h1 class="modal-title text-white" id="exampleModalLabel">Datos Tarjeta</h1>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                     <form id="payment-form" method="post" action="/procesarPagos"  autocomplete="off">
                                    <h6 class="heading-small text-muted mb-4">Informaci&oacute;n de Cuenta Bancaria</h6>
                                    <input type="hidden" name="token_id" id="token_id">
                                    <input type="hidden" name="_token" :value="csrf">
                                    <div class="pl-lg-4">
                                        <div class="">
                                            <label class="form-control-label" for="input-name">N&uacute;mero de Cuenta:</label>
                                            <input type="number" name="nCuenta" id="nCuenta" class="form-control form-control-alternative" data-openpay-card="card_number" placeholder="4111111111111111" required autofocus>
                                        </div>
                                        <div class="">
                                            <label class="form-control-label" for="input-email">Nombre:</label>
                                            <input type="text" name="name" id="name" class="form-control form-control-alternative" data-openpay-card="holder_name" required>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <label class="form-control-label" for="input-email">Mes:</label>
                                                <input type="number" id="mes" name="mes" class="form-control form-control-alternative" data-openpay-card="expiration_month" min="1" max="12" placeholder="01-12">
                                            </div>
                                            <div class="col">
                                                <label class="form-control-label" for="input-email">A&ntilde;o:</label>
                                                <input type="number" id="anio" name="anio" class="form-control form-control-alternative" data-openpay-card="expiration_year" min="21" placeholder="21">
                                            </div>
                                            <div class="col">
                                                <label class="form-control-label" for="input-email">CCV:</label>
                                                <input type="number" id="ccv" name="ccv" class="form-control form-control-alternative" data-openpay-card="cvv2" placeholder="010">
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <!--<button type="button" id="pay-button" class="btn btn-success mt-4">Guardar</button>-->
                                            <button type="button" id="pay-button"  class="btn btn-success mt-4">Guardar</button>
                                        </div>
                                    </div>
                                </form>
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-dark text-rosita" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-dark text-cyan" @click="eliminar_alimento()" id="botoncito">Confirmar</button>
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
            this.ftotal();
        },data(){
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                list_items: {},
                paginate: ['var_item'],
                ruta: '',
                unique_item: {},
                total: 0
            }
        },methods:{
             items(){
                axios.get('/compras_listar').then((response)=>{
                    this.list_items = response.data;
                }).catch((error)=>{
                    console.log(error.response);
                })
            },
             abrir(){
              $("#tarjeta").modal("toggle");
              
            },
        }
    }
</script>
