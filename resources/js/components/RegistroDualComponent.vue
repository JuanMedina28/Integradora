<template>
    <div class="bg-gris-oxford">
        <form>
                <div class="header bg-dark pt-6 pt-nd-12">
                  <div class="container-fluid">
                    <div class="header pb-12">
                      <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                          <h6 class="h2 text-white d-inline-block mb-0">Completa el Registro</h6>
                          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark bg-gris-oxford">
                              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home text-degradado"></i></a></li>
                              <li class="breadcrumb-item"><a href="#" class="text-rosita">Registro</a></li>
                            </ol>
                          </nav>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <div class="container bg-gris-oxford col-12" style="height: 82vh">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col"><br><br>
                        <div class="card">
                            <div class="nav-wrapper">
                                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0 active btn-dark" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-credit-card text-degradado"></i>&nbsp;&nbsp;Cliente</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0 btn-dark" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-shop text-degradado"></i>&nbsp;&nbsp;Negocio</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card shadow ">
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-alternative"  v-model="cliente.name" id="exampleFormControlInput1" placeholder="Nombre(s)">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-alternative"  v-model="cliente.apaterno"  id="exampleFormControlInput1" placeholder="Apellido Paterno">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-alternative"  v-model="cliente.amaterno"  id="exampleFormControlInput1" placeholder="Apellido Materno">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="number" class="form-control form-control-alternative" v-model="cliente.celular"    id="exampleFormControlInput1" placeholder="Telefono">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                
                                                <!--<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-white">Fecha de Nacimiento:</label>
                                                        <input type="Date" class="form-control form-control-alternative" v-model="cliente.fecha_nacimiento"  id="exampleFormControlInput1" >
                                                    </div>
                                                </div>-->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-white">Foto de Perfil:</label>
                                                        <input type="file" class="form-control form-control-alternative" id="url_img_us"  accept="image/*"  @change="subirFoto">
                                                    </div>
                                                </div>
                                            </div>
                                            <center>
                                                <button type="button" class="btn btn-dark text-cyan btn-lg" @click="guardarCliente()" >Guardar</button>
                                            </center>
                                        </div>
                                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                            <input type="text" class="form-control form-control-alternative" id="nombreNegocio" v-model="negocio.razon_social"  placeholder="Ingrese la Razon Social">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                            <input type="text" class="form-control form-control-alternative" id="descripcionNegocio"  v-model="negocio.rfc" placeholder="Escribe el RFC de tu negocio">
                                                            </div>
                                                        </div>
                                                        
                                                    </div>

                                                    <div class="row">
                                                         
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="tel" minlength="10" maxlength="10" class="form-control form-control-alternative" id="categoriaNegocio"  v-model="negocio.celular" placeholder="Telefono del Negocio">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select class="form-control" data-toggle="select" title="Simple select">
                                                                <option disabled selected>Elige tu tipo de Negocio</option>
                                                                <option>Ingeribles - Alimentos y bebidas.</option>
                                                                <option>Ambiente - Sonido y  luces.</option>
                                                                <option>Música - Músicos y DJ's.</option>
                                                                <option>Decoración - Exteriores e interiores.</option>
                                                                <option>Extras- Hileras, tortilleros, centros de mesa, recuerdos, etc.</option>
                                                                <option>Personal de servicio - Exteriores e interiores.</option>
                                                            </select>
                                                        </div>
                                                        
                                                        
                                                    </div>

                                                    <div class="row">

                                                         <div class="col-md-6">
                                                            <select class="form-control" data-toggle="select" title="Simple select" data-live-search="true" >
                                                                <option disabled selected>Estado de México</option>
                                                               
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select class="form-control" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." v-model="negocio.municipio">
                                                                <option disabled selected>Selecciona tu Municipio</option>
                                                                <option>Tecamac</option>
                                                                <option>Zumpango</option>
                                                                <option>Ecatepec</option>
                                                            </select>
                                                        </div>  

                                                        
                                                       
                                                        
                                                    </div>
                                                    <div class="row mt-4">
                                                    <div class="col-md-12">
                                                    <input type="file" class="form-control form-control-alternative" id="url_img_us"  accept="image/*" @change="subirFoto">
                                                    <br>
                                                    </div>
                                                    </div>
                                                        <center>

                                                <button type="button" class="btn btn-dark text-cyan btn-lg" @click="guardarNegocio">Guardar</button>
                                            </center>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    <br>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
    export default {
        mounted(){            
        },
        data(){
            return{
                cliente: {},
                negocio: {},
                url_img_us: null,
            }
        },
        methods:{
            subirFoto(e){
                this.url_img_us = e.target.files[0];
            },
            guardarNegocio(){
                const datosNegocio = new FormData;
                //datosNegocio.set('nombre',this.negocio.nombre);
                datosNegocio.set('razon_social',this.negocio.razon_social);
                datosNegocio.set('rfc',this.negocio.rfc);
                datosNegocio.set('tipo_ser',this.negocio.tipo_ser);
                datosNegocio.set('celular',this.negocio.celular);
                datosNegocio.set('estado',this.negocio.estado);
                datosNegocio.set('municipio',this.negocio.municipio);
                datosNegocio.set('url_logo',this.url_img_us);
                axios.post('/negocioGuardar',datosNegocio)
                    .then((response) => {
                        window.location="/home";                
                    })
                    .catch((error)=>{
                        console.log(error.response);
                        alert(error.response)
                    })
            },
             guardarCliente(){
              const datosCliente = new FormData
              datosCliente.set('name',this.cliente.name);
              datosCliente.set('apaterno', this.cliente.apaterno);
              datosCliente.set('amaterno', this.cliente.amaterno);
              datosCliente.set('celular', this.cliente.celular);
              //datosCliente.set('fecha_nacimiento', this.cliente.fecha_nacimiento);
              datosCliente.set('url_img_us', this.url_img_us);
              axios.post("/clienteGuardar", datosCliente).then((response)=>{
                        window.location="/home";     
                    }).catch((error)=>{
                      console.log(error.response);
                    })
                
            },
        }
    }
</script>