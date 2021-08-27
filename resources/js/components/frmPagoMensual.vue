<template>
    <main class="main">
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Programacion Mensualidades
                    <button type="button" @click="verDetalleMensualidad()" class="btn btn-secondary">
                        <i class="icon-eye"></i>&nbsp;Ver Mensualidades
                    </button>
                    <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">&nbsp;Volver</button>
                </div>
                
                <template v-if="listado==0">
                    <div class="card-header text-center bg-default">
                        <font class="text-white" size="5" face="Times New Roman">Programación - Pago de Mensualidaes</font>
                    </div>
                    <div class="card-body">
                        <div class="form-group row border">    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gestion</label>
                                    <select class="form-control" v-model="codGestion" @change="selectCursoGestion()">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="gestion in arrayGestion" :key="gestion.id" :value="gestion.cod_gestion" v-text="gestion.cod_gestion"></option>                                        
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Curso</label>
                                    <select class="form-control" v-model="datos.id_gestion_curso">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="gestCurso in arrayGCurso" :key="gestCurso.id" :value="gestCurso.id" v-text="gestCurso.nombre"></option>                                        
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mes Pago</label>
                                    <select class="form-control" v-model="datos.mes">
                                        <option value="" disabled>Seleccione</option>
                                        <option value="Febrero">Febrero</option>       
                                        <option value="Marzo">Marzo</option>       
                                        <option value="Abril">Abril</option>       
                                        <option value="Mayo">Mayo</option>       
                                        <option value="Junio">Junio</option>       
                                        <option value="Julio">Julio</option>
                                        <option value="Agosto">Agosto</option>
                                        <option value="Septiembre">Septiembre</option>
                                        <option value="Octubre">Octubre</option>                                      
                                        <option value="Noviembre">Noviembre</option>
                                        <option value="Diciembre">Diciembre</option>
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Plazo Maximo  - Fecha</label>
                                    <input type="date" v-model="datos.plazo_fecha" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Monto Pago</label>
                                    <input type="number" v-model="datos.monto" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <div v-show="errorMensualidad" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjMensualidad" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                        </div>
                    
                        <div class="form-group row ">
                            <div class="col-md-12">
                                <button type="button" @click="programarMensualidad()" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>    
                        <template v-if="alert==1">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Registro exitoso!</strong> Se ha programado la mensualidad a los estudiantes correspondientes.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div> 
                        </template>                                    
                   </div>                   
                </template>

                <template v-if="listado==1">
                    <div class="card-header text-center bg-default">
                        <font class="text-white" size="5" face="Times New Roman">Detalle - Pago de Mensualidaes</font>
                    </div>
                    <div class="card-body">
                        <div class="form-group row border">    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gestion</label>
                                    <select class="form-control" v-model="codGestion" @change="selectCursoGestion()">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="gestion in arrayGestion" :key="gestion.id" :value="gestion.cod_gestion" v-text="gestion.cod_gestion"></option>                                      
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Curso</label>
                                    <select class="form-control" v-model="datos.id_gestion_curso">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="gestCurso in arrayGCurso" :key="gestCurso.id" :value="gestCurso.id" v-text="gestCurso.nombre"></option>                                        
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mes</label>
                                    <select class="form-control" v-model="datos.mes">
                                        <option value="" disabled>Seleccione</option>
                                        <option value="Febrero">Febrero</option>       
                                        <option value="Marzo">Marzo</option>       
                                        <option value="Abril">Abril</option>       
                                        <option value="Mayo">Mayo</option>       
                                        <option value="Junio">Junio</option>       
                                        <option value="Julio">Julio</option>
                                        <option value="Agosto">Agosto</option>
                                        <option value="Septiembre">Septiembre</option>
                                        <option value="Octubre">Octubre</option>                                      
                                        <option value="Noviembre">Noviembre</option>
                                        <option value="Diciembre">Diciembre</option>
                                    </select> 
                                </div>
                            </div>
                            <br>
                            <br>
                        </div>                    
                        <div class="form-group row ">
                            <div class="col-md-12">
                                <button type="button" @click="listarMensualidad()" class="btn btn-primary">Listar</button>
                            </div>
                        </div>      
                        <div class="form-group row border">
                            <div class="table-responsive">
                                <table class="table tablesorter">
                                    <thead class="text-primary">
                                        <tr>                                            
                                            <th>Alumno</th>
                                            <th>Mensualidad</th>
                                            <th>Fecha Plazo</th>
                                            <th>Pago Mensual</th>
                                            <th>Fecha Pago</th>
                                            <th>Estado</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="mensualidad in arrayMensualidad" :key="mensualidad.id">
                                            <td v-text="mensualidad.nombre + ' ' + mensualidad.apellidos"></td>
                                            <td v-text="mensualidad.mes"></td>
                                            <td v-text="mensualidad.plazo_fecha"></td>
                                            <td v-text="mensualidad.monto"></td>
                                            <td v-text="mensualidad.fecha_pago"></td>
                                            <td>
                                                <div v-if="mensualidad.estado">
                                                    <span class="badge badge-success">Pagado</span>
                                                </div>
                                                <div v-else>
                                                    <span class="badge badge-danger">No pagado</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>   
                        </div>            
                   </div>                
                </template>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>
    </main>
</template>

<script>    
    export default {
        data(){
            return {
                datos : {
                    id : 0,
                    plazo_fecha: '',
                    mes : '',
                    monto : '',
                    id_gestion_curso : ''
                },   
                codGestion : '',
                arrayGestion : [],                                          
                arrayMensualidad : [],     
                arrayGCurso : [],   
                errorMensualidad : 0,
                errorMostrarMsjMensualidad : [],
                alert : 0,
                listado: 0
            }
        },
        methods : {
            verDetalleMensualidad(){
                this.listado=1;
                this.arrayMensualidad=[];
            },
            ocultarDetalle(){
                this.listado=0;
                this.alert=0;
            },
            programarMensualidad(){
                let me = this;
                axios.post('/pago/mensual/programar',this.datos).then(function (response) {
                    me.alert=1;
                    me.datos = {
                        id : 0,
                        plazo_fecha: '',
                        mes : '',
                        monto : '',
                        id_gestion_curso : ''
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            listarMensualidad(){
                let me = this;
                var url='/mensualidad/detalle?id_gestion_curso='+me.datos.id_gestion_curso + '&mes=' + me.datos.mes;
                axios.get(url).then(function(response){
                    me.arrayMensualidad= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            selectGestion(){
                let me = this;
                var url='/gestion/selectGestion';
                axios.get(url).then(function(response){
                    me.arrayGestion= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            selectCursoGestion: function() {
                let me = this;
                var url='/gestion/curso/selectCursoGestion?cod_gestion='+this.codGestion;
                axios.get(url).then(function(response){
                    me.arrayGCurso= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            }
        },
        mounted() {
            this.selectGestion();
        }
    }
</script>
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>