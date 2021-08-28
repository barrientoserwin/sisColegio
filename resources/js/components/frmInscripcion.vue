<template>
    <main class="main">
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Inscripciones
                    <button type="button" @click="btnNuevoInscripcion()" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>

                <!-- Listado gestion -->
                <template v-if="listado==0">
                    <div class="card-body">
                        <font size="5" face="Times New Roman">Listado de Inscripciones</font>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                        <option value="a.nombre">Alumno: nombre</option>
                                        <option value="a.matricula">Alumno: matricula</option>
                                        <option value="c.nombre">Curso</option>
                                        <option value="g.cod_gestion">Gestion</option>                                        
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarInscripcion(1, buscar, criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarInscripcion(1, buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div> 
                        </div>
                        <table class="table tablesorter">
                            <thead class="text-primary">
                                <tr>
                                    <th>Matricula</th>
                                    <th>Alumno</th>
                                    <th>Fecha Inscripcion</th>
                                    <th>Secretaria</th>
                                    <th>Curso</th>
                                    <th>Gestion</th>
                                    <th>Paralelo</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="inscripcion in arrayInscripcion" :key="inscripcion.id">
                                    <td v-text="inscripcion.matricula"></td>
                                    <td v-text="inscripcion.alumno"></td>
                                    <td v-text="inscripcion.fecha_inscripcion"></td>
                                    <td v-text="inscripcion.secretaria"></td>
                                    <td v-text="inscripcion.curso"></td>
                                    <td v-text="inscripcion.cod_gestion"></td>
                                    <td v-text="inscripcion.paralelo"></td>
                                    <td>
                                        <div v-if="inscripcion.estado">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivo</span>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" @click="detalleInscripcion(inscripcion)" class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </button> &nbsp;
                                        <template v-if="inscripcion.estado">
                                            <button type="button" class="btn btn-success btn-sm" @click="anularInscripcion(inscripcion.id)">
                                                <i class="fa fa-unlock"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-danger btn-sm" @click="habilitarInscripcion(inscripcion.id)">
                                                <i class="fa fa-lock"></i>
                                            </button>
                                        </template>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1, buscar, criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page==isActived ? 'active' :'']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar, criterio)" v-text="page">1</a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, buscar, criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </template>
                
                <template v-if="listado==1">
                    <div class="card-header text-center bg-default">
                        <font class="text-white" size="5" face="Times New Roman">Inscripcion Academica Gestion</font>
                    </div>
                    <div class="card-body">
                        <div class="form-group row border">  
                             <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gestion</label>
                                    <select class="form-control" v-model="gestion" @change="selectCursoGestion()">
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
                                    <select class="form-control" v-model="datos.paralelo">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="paralelo in arrayParalelo" :key="paralelo.id" :value="paralelo.nombre" v-text="paralelo.nombre"></option>                                        
                                    </select> 
                                </div>
                            </div>                                                     
                            <div class="col-md-12">
                                <label>Alumno <span style="color:red;" >(*Seleccione)</span></label>
                                <div class="input-group">                                
                                    <input type="text" readonly class="form-control" v-model="nombreAlumno" placeholder="Agregar Alumno...">
                                    <button type="submit" data-toggle="modal" data-target="#modalAlumno" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                    <button type="button" data-toggle="modal" data-target="#frmAlumno" class="btn btn-success"><i class="fa fa-plus"></i>Nuevo</button>
                                </div>
                            </div>                           
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha Inscripcion</label><br>
                                    <input type="date" class="form-control" v-model="datos.fecha_inscripcion">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Costo Inscripcion</label><br>
                                    <input type="number" readonly class="form-control" v-model="datos.costo_inscripcion">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div v-show="errorInscripcion" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjInscripcion" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row ">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                                <button type="button" @click="guardarInscripcion()" class="btn btn-primary">Guardar Inscripcion</button>
                            </div>
                        </div>                   
                   </div>                   
                </template>

                <template v-if="listado==2">
                    <div class="card-header text-center bg-default">
                        <font class="text-white" size="5" face="Times New Roman">Detalle de la Inscripcion Academica Gestion</font>
                    </div>
                    <div class="card-body">
                        <div class="form-group row border">                                                       
                            <div class="col-md-8">
                                <label>Alumno <span style="color:red;" >(*Seleccione)</span></label>
                                <div class="input-group">                                
                                    <input type="text" readonly class="form-control" v-model="nombreAlumno" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Curso</label>
                                    <input type="text" readonly class="form-control" v-model="curso" disabled> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Paralelo</label>
                                    <input type="text" readonly class="form-control" v-model="datos.paralelo" disabled> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha Inscripcion</label><br>
                                    <font size="4" face="Times New Roman">{{datos.fecha_inscripcion}}</font>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row ">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                            </div>
                        </div>                   
                   </div>                   
                </template>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>

        <!--Inicio del modal Alumno-->
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
        <!-- Modal frmAlumno -->
          <div class="modal fade" id="frmAlumno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Formulario Alumno</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="datosAlumno.nombre" class="form-control" placeholder="Nombre completo del alumno">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Apellidos</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="datosAlumno.apellidos" class="form-control" placeholder="apellidos">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Fecha Nacimiento</label>
                                <div class="col-md-9">
                                    <span style="color:red;" v-show="validarEdad<10">{{validarEdad}} años de edad? es incoherente!!</span>
                                    <input type="date" v-model="datosAlumno.fecha_nac" class="form-control">
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Cédula de Identidad</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="datosAlumno.dni" class="form-control" placeholder="Cedula de identidad">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Matricula</label>
                                <div class="col-md-9">
                                    <input type="number" v-model="datosAlumno.matricula" class="form-control" placeholder="matricula">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cerrar</button>
                        <button type="button" class="btn btn-primary" @click="guardarAlumno()"  data-dismiss="modal" aria-label="Close">Guardar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal frmAlumno--> 
    </main>
</template>

<script>    
    import moment from 'moment';
    export default {
        data(){
            return {
                datos : {
                    id : 0,
                    fecha_inscripcion: moment().format('YYYY-MM-DD'),
                    costo_inscripcion: 30,
                    id_alumno : '',
                    paralelo : 'A',
                    id_gestion_curso : ''
                },
                datosAlumno : {
                    id : 0,
                    nombre: '',
                    apellidos : '',
                    fecha_nac : '',
                    dni : '',
                    matricula : ''
                },
                nombreAlumno : '',
                curso : '',
                gestion : '',
                arrayAlumno : [], 
                arrayInscripcion : [], 
                arrayGCurso : [],
                arrayGestion: [],
                arrayParalelo: [],
                errorInscripcion : 0,
                errorMostrarMsjInscripcion : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                listado: 0,
                buscar : '',
                criterio : 'a.nombre',
                buscarA : '',
                criterioA : 'nombre',
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
            },
            validarEdad: function(){
                var fecha1 = moment().format('YYYY-MM-DD');
                var fecha2= moment(this.datosAlumno.fecha_nac, "YYYY-MM-DD"); 

                var fechaNacimiento = moment(fecha2); 
                var fechaActual = moment(fecha1); 
                var duration = moment.duration(fechaActual.diff(fechaNacimiento)); 
                var anio = duration.years();
                return anio;
            }
        },
        methods : {
            listarInscripcion(page, buscar, criterio){
                let me=this;
                var url='/inscripcion?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function(response){
                    me.arrayInscripcion=response.data.data;
                    me.pagination={total:response.data.total, 
                        current_page:response.data.current_page,
                        per_page: response.data.per_page,
                        last_page: response.data.last_page,
                        from: response.data.from,
                        to: response.data.to
                    }
                })
                .catch(function(error){
                    console.log(error)
                });
            },
            cambiarPagina(page, buscar, criterio){
                let me=this;
                me.pagination.current_page=page;
                me.listarInscripcion(page, buscar, criterio);
            },
            btnNuevoInscripcion(){
                let me = this;
                me.listado=1;
                me.nombreAlumno ='';
                me.selectGestion();
                me.selectParalelo();
                this.errorMostrarMsjInscripcion=[];
                me.datos= {
                    id : 0,
                    fecha_inscripcion: moment().format('YYYY-MM-DD'),
                    costo_inscripcion: 30,
                    id_alumno : '',
                    paralelo : 'A',
                    id_gestion_curso : ''
                };
            },
            guardarAlumno(){
                let me = this;
                var arrayAlumnoT=[];
                axios.post('/alumno/inscripcion/guardar',this.datosAlumno).then(function (response) {
                    me.datosAlumno = {
                        id : 0,
                        nombre : '',
                        apellidos : '',
                        fecha_nac : '',
                        dni : '', 
                        matricula : ''
                    },
                    arrayAlumnoT= response.data;
                    me.datos.id_alumno=arrayAlumnoT[0]['id'];
                    me.nombreAlumno= arrayAlumnoT[0]['nombre']+ ' '+arrayAlumnoT[0]['apellidos'];
                }).catch(function (error) {
                    console.log(error);
                });
            },
            ocultarDetalle(){
                this.listado=0;
                this.listarInscripcion(1,'', 'a.nombre');
            },
            anularInscripcion(id){
                swal({
                title: 'Se desea anular esta Inscripcion?',
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
                    axios.put('/inscripcion/desactivar',{'id': id}).then(function (response) {
                        me.listarInscripcion(1,'', 'a.nombre');
                        swal(
                        'Desactivado!',
                        'Esta Inscripcion ha sido anulada.',
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
            habilitarInscripcion(id){
                swal({
                title: 'Se desea habilitar esta Inscripcion?',
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
                    axios.put('/inscripcion/activar',{'id': id}).then(function (response) {
                        me.listarInscripcion(1,'', 'a.nombre');
                        swal(
                        'Habilitado!',
                        'Esta Inscripcion ha sido habilitada.',
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
                var url='/alumno/listarSinPaginate?buscar=' + buscarA + '&criterio=' + criterioA;
                axios.get(url).then(function(response){
                    me.arrayAlumno= response.data;
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
            selectCursoGestion: function() {
                let me = this;
                var url='/gestion/curso/selectCursoGestion?cod_gestion='+this.gestion;
                axios.get(url).then(function(response){
                    me.arrayGCurso= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            guardarInscripcion(){
                let me = this;
                axios.post('/inscripcion/guardar',this.datos).then(function (response) {
                    me.listado =0;
                    me.listarInscripcion(1,'', 'a.nombre');
                    me.datos = {
                        id : 0,
                        fecha_inscripcion: moment().format('YYYY-MM-DD'),
                        costo_inscripcion: 30,
                        id_alumno : '',
                        paralelo : 'A',
                        id_gestion_curso : ''
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            detalleInscripcion(data=[]){
                let me = this;
                me.listado = 2;
                me.nombreAlumno = data['alumno'];
                me.curso = data['curso'];
                me.datos.fecha_inscripcion=data['fecha_inscripcion'];
                me.datos.paralelo=data['paralelo'];
            },
            seleccionarAlumno(data=[]){
                let me = this;
                me.nombreAlumno = data['nombre']+ ' ' + data['apellidos'];
                me.datos.id_alumno = data['id'];
            },
        },
        mounted() {
            this.listarInscripcion(1, this.buscar, this.criterio);
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