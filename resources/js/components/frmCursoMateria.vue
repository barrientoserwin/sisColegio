<template>
    <main class="main">
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Programacion de Profesores a Materias
                    <button type="button" @click="btnNuevo()" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nueva
                    </button>
                </div>

                <!-- Listado gestion -->
                <template v-if="listado==0">
                    <div class="card-header text-center bg-default">
                        <font class="text-white" size="5" face="Times New Roman">Gestion Escolar  Academica {{codGestion}}</font>
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
                                    <select class="form-control" v-model="id_gestion_curso">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="gestCurso in arrayCurso" :key="gestCurso.id" :value="gestCurso.id" v-text="gestCurso.nombre"></option>                                        
                                    </select> 
                                </div>
                            </div>                            
                            <div class="col-md-4">
                                <label>Materias <span style="color:red;" >(*cargar)</span></label>
                                <div class="input-group">                                
                                    <button type="submit" @click="listarCursoMateria()" class="btn btn-success"><i class="tim-icons icon-refresh-01"></i></button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div v-show="errorGestionCurso" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjGestionCurso" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group row border">
                            <div class="table-responsive col-md-12">
                                <table class="table tablesorter">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>Nro</th>
                                            <th>Materia</th>
                                            <th>Area</th>
                                            <th>Docente</th>
                                            <th>Opcion</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayMateria.length">
                                        <tr v-for="(materia,index) in arrayMateria" :key="materia.id">
                                            <td v-text="index+1"></td>
                                            <td v-text="materia.nombre"></td>
                                            <td v-text="materia.area"></td>
                                            <template v-if="(materia.nombreProfe)!=null">
                                                <td v-text="materia.nombreProfe + ' ' +materia.apellidos"></td>
                                            </template>
                                            <template v-else>
                                                <td>No asignado</td>
                                            </template>                                            
                                            <td>
                                                <button type="button" @click="selectCursoMateria(materia.id)" data-toggle="modal" data-target="#modalProfesor" class="btn btn-primary"><i class="fa fa-search"></i> Asignar</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="4">
                                                No se encuentran datos
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
        <!--Inicio del modal Alumno-->
        <div class="modal fade" id="modalProfesor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Busqueda de Profesores</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="form-control col-md-6" v-model="criterio">
                                            <option value="nombre">Nombre</option>
                                            <option value="apellidos">Apellidos</option>
                                            <option value="dni">Nro Carnet</option>                               
                                        </select>
                                        <input type="text" v-model="buscar" @keyup.enter="listarProfesor(buscar, criterio)" class="form-control" placeholder="Texto a buscar">
                                        <button type="submit" @click="listarProfesor(buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                    </div>
                                </div>                   
                            </div>
                             <table class="table tablesorter">
                                <thead class="text-primary">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Fecha Nacimiento</th>
                                        <th>Nro Carnet</th>
                                        <th>Correo Electronico</th>
                                        <th>Opcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="profesor in arrayProfesor" :key="profesor.id">
                                        <td v-text="profesor.nombre"></td>
                                        <td v-text="profesor.apellidos"></td>  
                                        <td v-text="profesor.fechaNac"></td>
                                        <td v-text="profesor.dni"></td>
                                        <td v-text="profesor.gmail"></td>
                                        <td>
                                            <button type="button" @click="seleccionarProfesor(profesor.id)" class="btn btn-success btn-sm" data-dismiss="modal" aria-label="Close">
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
                    id_curso_materia : '',
                    id_profesor : ''
                },
                codGestion : '',
                id_gestion_curso : '', 
                arrayProfesor : [],
                arrayGestion : [],                                        
                arrayCurso : [],                
                arrayMateria : [],
                errorGestionCurso : 0,
                errorMostrarMsjGestionCurso : [],
                buscar : '',
                criterio : 'nombre',
                listado: 0
            }
        },
        methods : {
            btnNuevo(){
                let me = this;
                me.errorMostrarMsjGestionCurso=[];
                me.codGestion = '';
                me.id_gestion_curso = '';
                me.arrayCurso=[];
                me.arrayMateria=[];
                me.selectGestion();
            },
            listarCursoMateria(){
                let me = this;
                var url='/curso/materia/listarCursoMateria?id_gestion_curso='+ me.id_gestion_curso;
                axios.get(url).then(function(response){
                    me.arrayMateria=response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            listarProfesor(buscar,criterio){
                let me = this;
                var url='/profesor/listarSinPaginate?buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function(response){
                    me.arrayProfesor=response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            selectCursoMateria(id_curso_materia){
                this.datos.id_curso_materia=id_curso_materia;
            },
            seleccionarProfesor(id_profesor){
                let me = this;
                me.datos.id_profesor=id_profesor;
                axios.put('/curso/materia/asignarProfesor',this.datos).then(function (response) {
                    me.listarCursoMateria();
                }).catch(function (error) {
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
                    me.arrayCurso= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
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