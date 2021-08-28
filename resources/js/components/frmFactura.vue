<template>
    <main class="main">
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Pago de Mensualidades
                    <button type="button" @click="btnNuevoPago()" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                
                <template v-if="listado==0">
                    <div class="card-header text-center bg-default">
                        <font class="text-white" size="5" face="Times New Roman">Formulario de Registro - Pago de Mensualidaes</font>
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
                                    <label>Paralelo</label>
                                    <select class="form-control" v-model="paralelo">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="paralelo in arrayParalelo" :key="paralelo.id" :value="paralelo.nombre" v-text="paralelo.nombre"></option>                                        
                                    </select> 
                                </div>
                            </div> 
                            <div class="col-md-8">
                                <label>Alumno <span style="color:red;" >(*Seleccione)</span></label>
                                <div class="input-group">                                
                                    <input type="text" readonly class="form-control" v-model="nombreAlumno" placeholder="Agregar Alumnos...">
                                    <button type="submit" data-toggle="modal" data-target="#modalAlumno" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                    <button type="submit" @click="listarMensualidad()" class="btn btn-success"><i class="tim-icons icon-refresh-02"></i></button>
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
                    
                        <div class="form-group row border">
                            <div class="table-responsive">
                                <table class="table tablesorter">
                                    <thead class="text-primary">
                                        <tr>                                            
                                            <th>Mensualidad</th>
                                            <th>Plazo Maximo</th>
                                            <th>Monto</th>
                                            <th>Fecha Pago</th>
                                            <th>Estado</th>
                                            <th>Opcion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="mensualidad in arrayMensualidad" :key="mensualidad.id">
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
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm" @click="facturaPdf(mensualidad.id_inscripcion)">
                                                    <i class="tim-icons icon-single-copy-04"></i>
                                                </button>
                                                <template v-if="mensualidad.estado">
                                                    
                                                </template>
                                                <template v-else>
                                                    <button type="button" class="btn btn-danger btn-sm" @click="pagarMensualidad(mensualidad.id_inscripcion,mensualidad.id_pago_mensual)">
                                                        <i class="tim-icons icon-coins"></i>
                                                    </button>
                                                </template>
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

        <div class="modal fade" id="modalAlumno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Busqueda de Alumnos</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="form-control col-md-6" v-model="criterioA">
                                            <option value="nombre">Nombre</option>
                                            <option value="apellidos">Apellidos</option>
                                            <option value="matricula">Matricula</option>
                                            <option value="dni">Nro Carnet</option>                               
                                        </select>
                                        <input type="text" v-model="buscarA" @keyup.enter="listarAlumno(buscarA, criterioA)" class="form-control" placeholder="Texto a buscar">
                                        <button type="submit" @click="listarAlumno(buscarA, criterioA)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                    </div>
                                </div>                   
                            </div>
                             <table class="table tablesorter">
                                <thead class="text-primary">
                                    <tr>
                                        <th>Cod. Alumno</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Dni</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="alumno in arrayAlumno" :key="alumno.id">
                                        <td v-text="alumno.matricula"></td>
                                        <td v-text="alumno.nombre"></td>
                                        <td v-text="alumno.apellidos"></td>
                                        <td v-text="alumno.dni"></td>
                                        <td>
                                            <button type="button" @click="seleccionarAlumno(alumno)" class="btn btn-success btn-sm" data-dismiss="modal" aria-label="Close">
                                            <i class="tim-icons icon-check-2"></i>
                                            </button>                                                                     
                                        </td>                             
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal alumno--> 
    </main>
</template>

<script>    
    export default {
        data(){
            return {
                datos : {
                    id_inscripcion : 0,
                    id_pago_mensual : 0,
                    id_gestion_curso : ''
                },  
                paralelo:'', 
                nombreAlumno : '',
                codGestion : '',
                arrayGestion : [],                                          
                arrayMensualidad : [],
                arrayAlumno : [],       
                arrayGCurso : [],    
                arrayParalelo : [],      
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorMensualidad : 0,
                errorMostrarMsjMensualidad : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                buscar : '',
                criterio : 'a.nombre',
                buscarA : '',
                criterioA : 'nombre',
                listado: 0
            }
        },
        computed : {
            isActived: function(){
                return this.pagination.current_page;
            },
            pagesNumber: function(){
                if(!this.pagination.to){
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while(from <= to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods : {
            btnNuevoPago(){
                let me = this;
                me.arrayGestion=[];
                me.arrayGCurso=[];
                me.nombreAlumno='';
                me.arrayMensualidad=[];
                me.arrayAlumno=[];
            },
            pagarMensualidad(id_inscripcion,id_pago_mensual){
                swal({
                title: 'Se desea pagar este mes?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;
                    me.datos.id_inscripcion=id_inscripcion;
                    me.datos.id_pago_mensual=id_pago_mensual;
                    axios.put('/mensualidad/pagoMes',this.datos).then(function (response) {
                        me.listarMensualidades(me.datos.id_inscripcion);
                        swal(
                        'Eliminado!',
                        'Esta mensualidad se ha registrado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });                   
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            listarAlumno(buscarA, criterioA){
                let me = this;
                var url='/inscripcion/alumnoInscripcion2?paralelo=' + me.paralelo+ '&id_gestion_curso=' + me.datos.id_gestion_curso;
                axios.get(url).then(function(response){
                    me.arrayAlumno= response.data;
                    
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            seleccionarAlumno(data=[]){
                let me = this;
                me.nombreAlumno = data['nombre'] + ' '+ data['apellidos'];
                me.datos.id_inscripcion = data['id_inscripcion'];

                this.listarMensualidades(data['id_inscripcion']);
            },
            listarMensualidades($id_inscripcion){
                let me = this;
                var url='/mensualidad/detalleCliente?id_inscripcion='+$id_inscripcion;
                axios.get(url).then(function(response){
                    me.arrayMensualidad= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            listarMensualidad(){
                let me = this;
                var url='/mensualidad/detalleCliente?id_inscripcion='+me.datos.id_inscripcion;
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
            selectParalelo(){
                let me = this;
                var url='/paralelo/selectParalelo';
                axios.get(url).then(function(response){
                    me.arrayParalelo= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            facturaPdf(id){
                window.open('http://127.0.0.1:8000/mensualidad/pago/pdf/'+ id);
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
            this.selectParalelo();
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