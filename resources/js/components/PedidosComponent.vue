<template>
<div class="bg-gris-oxford">
        <form>
                <div class="header bg-dark pt-6 pt-nd-12">
                  <div class="container-fluid">
                    <div class="header pb-12">
                      <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                          <h1 class=" text-rosita d-inline-block mb-0">Ventas</h1>
                          <h4 class="text-white mb-0">Aquí puedes visualizar tus Ventas</h4>
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
                                </ul>
                            </div>
                            <div class="card shadow">
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <h3 class="mb-0">&nbsp;Pendientes</h3>
                                </div>
                            </div>
                           <paginate name="var_pendientes" :per=5 :list="pendientes" class="card-body">
                                <div  v-for="pendiente in paginated('var_pendientes')">
                                    <form method="post" autocomplete="off">
                                        <div class="pl-lg-4">

                                                 <div>
                                            <div role="alert"  class="alert alert-secondary" >
                                                <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Romina Hadid">
                                                <img alt="Image placeholder" :src="'/storage/'+pendiente.foto">
                                            </a>
                                                <strong>{{pendiente.nombre}}</strong><br>
                                                <b>Cantidad:</b> {{pendiente.cantidad}}<br>
                                                <b>Cliente:</b> {{pendiente.name}}<br>
                                                <b>Direccion:</b> {{pendiente.calle}} MZ {{pendiente.exterior}} INT {{pendiente.interior}} COL {{pendiente.colonia}} {{pendiente.codigoPostal}}
                                              {{pendiente.localidad}} {{pendiente.estado}}
                                                <button type="button"  aria-label="Close" class="close" @click="enviar(pendiente.idItem)" >
                                                    <span aria-hidden="true"><i class="ni ni-button-play"></i></span>
                                                </button>
                                                <br>
                                            </div>
                                            <hr class="my-4">
                                            </div>


                                        </div>
                                    </form>
                                    </div>
                            </paginate>
                            <nav aria-label="...">
                                <paginate-links for="var_pendientes" :classes="{'ul': ['pagination','justify-content-end','nb-0'], 'li': 'page-item', 'a':['page-link', 'bg-dark']}"></paginate-links>
                            </nav>
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
        </form>
    </div>
</template>
<script>
    import VuePaginate from "vue-paginate";
    export default{
        mounted(){
            console.log("Component mounted.")
            this.listartodo();
        }, data(){
            return{
                pendientes:{},
                enviados: {},
                entregados: {},
                paginate: ['var_pendientes', 'var_enviados', 'var_entregados']
            }
        }, methods:{
            listar_pendientes(){
                axios.get('/pendientes').then((response)=>{
                    console.log('asdasdsadasd');
                    this.pendientes = response.data;
                }).catch((error)=>{
                    console.log('asdasdasdasdasdq3w123234');
                    console.log(error.response);
                })
            }, listar_enviados(){
                axios.get('/enviados').then((response)=>{
                    this.enviados = response.data;
                }).catch((error)=>{
                    console.log(error.response);
                })
            }, listar_entregados(){
                axios.get('/entregados').then((response)=>{
                    this.entregados = response.data;
                }).catch((error)=>{
                    console.log(error.response);
                })
            }
            , enviar(id){
                Swal.fire({
                    title: 'Envio?',
                    text: "¿Estas seguro que deseas enviar este producto?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Envialo!',
                    cancelButtonText: 'No! Olvidalo'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                        'Enviado!',
                        'El producto se envio.',
                        'success'
                        )
                        axios.get("/enviar/"+id).then((response)=>{
                        this.listartodo();
                                    }).catch((error)=>{
                                        console.log(error.response)
                                    })
                            }
                    })
            }, entregar(id){
                Swal.fire({
                    title: 'Entregado?',
                    text: "¿Estas seguro que entregaste este producto?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Lo entregue!',
                    cancelButtonText: 'No! Aun no'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                        'Entregado!',
                        'El producto se guardo exitosamente.',
                        'success'
                        )
                        axios.get("/entregar/"+id).then((response)=>{
                        this.listartodo();
                                    }).catch((error)=>{
                                        console.log(error.response)
                                    })
                            }
                    })
            }, listartodo(){
                this.listar_pendientes();
                this.listar_enviados();
                this.listar_entregados();
            }
        }
    }
</script>