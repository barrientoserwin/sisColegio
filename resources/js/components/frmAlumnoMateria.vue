<template>
    <main class="main">
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <!-- Listado gestion -->
                <template v-if="listado==0">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Administracion e Ingreso de Notas
                        <button type="button" @click="verDetalleNota()" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Detalle Notas
                        </button>
                    </div>
                    <div class="card-header text-center bg-default">
                        <font class="text-white" size="5" face="Times New Roman">Ingreso de Notas {{cod_gestion}}</font>
                    </div>
                    <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gestion</label>
                                    <select class="form-control" v-model="cod_gestion" @change="selectCursoGestion()">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="gestion in arrayGestion" :key="gestion.id" :value="gestion.cod_gestion" v-text="gestion.cod_gestion"></option>                                        
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Curso</label>
                                    <select class="form-control" v-model="id_gestion_curso" @change="selectCursoMateria()">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="gestCurso in arrayCurso" :key="gestCurso.id" :value="gestCurso.id" v-text="gestCurso.nombre"></option>                                        
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Materias</label>
                                    <select class="form-control" v-model="id_curso_materia" @change="selectCursoParalelo()">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="cursomateria in arrayCursoMateria" :key="cursomateria.id" :value="cursomateria.id" v-text="cursomateria.nombre"></option>                                        
                                    </select> 
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Paralelo</label>
                                    <select class="form-control" v-model="id_curso_paralelo">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="paralelo in arrayParalelo" :key="paralelo.id" :value="paralelo.id" v-text="paralelo.nombre"></option>                                        
                                    </select> 
                                </div>
                            </div>                              
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Periodo</label>
                                    <select class="form-control" v-model="id_periodo">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="periodo in arrayPeriodo" :key="periodo.id" :value="periodo.id" v-text="periodo.nombre"></option>                                        
                                    </select> 
                                </div>
                            </div>                        
                            <div class="col-md-4">
                                <label>Materias <span style="color:red;" >(*cargar)</span></label>
                                <div class="input-group">                                
                                    <button type="submit" @click="cargarAlumnoMateria()" class="btn btn-success"><i class="tim-icons icon-refresh-01"></i></button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div v-show="errorAlumnoMateria" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjAlumnoMateria" :key="error" v-text="error">

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
                                            <th>Nro Matricula</th>
                                            <th>Alumno</th>
                                            <th>Nota</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="(detalle,index) in arrayDetalle" :key="detalle.id">
                                            <td v-text="index+1"></td>
                                            <td v-text="detalle.matricula"></td>
                                            <td v-text="detalle.alumno"></td>
                                            <td>
                                                <span style="color:red;" v-show="detalle.nota>100">Error!..</span>
                                                <input v-model="detalle.nota" type="number" class="form-control">
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
                            <div class="col-md-12">
                                <button type="button" @click="btnNuevo()" class="btn btn-secondary">Nuevo</button>
                                <button type="button" @click="guardarNotaCurso()" class="btn btn-primary">Guardar</button>
                            </div>

                            <template v-if="alert==1">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Registro exitoso!</strong> Se ha registrado exitosamente las notas correspondientes.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div> 
                            </template>  
                        </div>                  
                   </div>                   
                </template>

                <template v-if="listado==1">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Administracion e Ingreso de Notas
                        <button type="button" @click="volverAnterior()" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Volver a la Administracion de Notas
                        </button>
                    </div>
                    <div class="card-header text-center bg-default">
                        <font class="text-white" size="5" face="Times New Roman">Detallle de Notas</font>
                    </div>
                    <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gestion</label>
                                    <select class="form-control" v-model="cod_gestion" @change="selectCursoGestion()">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="gestion in arrayGestion" :key="gestion.id" :value="gestion.cod_gestion" v-text="gestion.cod_gestion"></option>                                        
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Curso</label>
                                    <select class="form-control" v-model="id_gestion_curso" @change="selectCursoMateria()">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="gestCurso in arrayCurso" :key="gestCurso.id" :value="gestCurso.id" v-text="gestCurso.nombre"></option>                                        
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Materias</label>
                                    <select class="form-control" v-model="id_curso_materia" @change="selectCursoParalelo()">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="cursomateria in arrayCursoMateria" :key="cursomateria.id" :value="cursomateria.id" v-text="cursomateria.nombre"></option>                                        
                                    </select> 
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Paralelo</label>
                                    <select class="form-control" v-model="id_curso_paralelo">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="paralelo in arrayParalelo" :key="paralelo.id" :value="paralelo.id" v-text="paralelo.nombre"></option>                                        
                                    </select> 
                                </div>
                            </div>                              
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Periodo</label>
                                    <select class="form-control" v-model="id_periodo">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="periodo in arrayPeriodo" :key="periodo.id" :value="periodo.id" v-text="periodo.nombre"></option>                                        
                                    </select> 
                                </div>
                            </div>                        
                            <div class="col-md-4">
                                <label>Materias <span style="color:red;" >(*listar)</span></label>
                                <div class="input-group">                                
                                    <button type="submit" @click="listarAlumnoMateria()" class="btn btn-success"><i class="tim-icons icon-refresh-01"></i></button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div v-show="errorAlumnoMateria" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjAlumnoMateria" :key="error" v-text="error">

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
                                            <th>Nro Matricula</th>
                                            <th>Alumno</th>
                                            <th>Nota</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(alumno_mat,index) in arrayAlumnoMateria" :key="alumno_mat.id">
                                            <td v-text="index+1"></td>
                                            <td v-text="alumno_mat.matricula"></td>
                                            <td v-text="alumno_mat.nombre + ' '+alumno_mat.apellidos"></td>
                                            <td v-text="alumno_mat.nota"></td>
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
                cod_gestion : '',
                id_gestion_curso : '', 
                id_curso_materia:'',
                id_curso_paralelo:'',
                id_periodo: '',
                arrayDetalle: [],

                arrayGestion : [],                                        
                arrayParalelo : [],
                arrayCurso : [],                
                arrayCursoMateria : [],
                arrayPeriodo:[],
                arrayAlumnoMateria:[],
                errorAlumnoMateria : 0,
                errorMostrarMsjAlumnoMateria : [],
                listado: 0,
                alert: 0
            }
        },
        methods : {
            btnNuevo(){
                let me = this;
                me.errorMostrarMsjAlumnoMateria=[];
                // me.cod_gestion = '';
                // me.id_gestion_curso = '';
                // me.id_curso_materia='',
                // me.id_curso_paralelo='',
                // me.id_periodo='';
                // me.arrayCurso=[];
                // me.arrayCursoMateria=[];
                // me.arrayParalelo=[];
                // me.arrayPeriodo=[];
                me.arrayDetalle=[];
                me.selectGestion();
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
            selectPeriodo(){
                let me = this;
                var url='/periodo/selectPeriodo';
                axios.get(url).then(function(response){
                    me.arrayPeriodo= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            selectCursoGestion: function() {
                let me = this;
                var url='/gestion/curso/selectCursoGestion?cod_gestion='+this.cod_gestion;
                axios.get(url).then(function(response){
                    me.arrayCurso= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            selectCursoMateria: function() {
                let me = this;
                var url='/curso/materia/selectCursoMateria?id_gestion_curso='+this.id_gestion_curso;
                axios.get(url).then(function(response){
                    me.arrayCursoMateria= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            selectCursoParalelo: function() {
                let me = this;
                var url='/curso/paralelo/selectCursoParalelo?id_curso_materia='+this.id_curso_materia;
                axios.get(url).then(function(response){
                    me.arrayParalelo= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            cargarAlumnoMateria(){
                let me=this;
                var arrayAlumnoT = [];
                var url='/inscripcion/alumnoInscripcion?id_gestion_curso='+this.id_gestion_curso+'&id_curso_paralelo='+this.id_curso_paralelo;
                axios.get(url).then(function(response){
                    arrayAlumnoT = response.data;

                    for(var i=0;i<arrayAlumnoT.length;i++){
                        me.arrayDetalle.push({
                            id_alumno : arrayAlumnoT[i]['id'],
                            id_curso_paralelo : me.id_curso_paralelo,
                            id_periodo: me.id_periodo,
                            matricula : arrayAlumnoT[i]['matricula'],
                            alumno : arrayAlumnoT[i]['nombre']+ ' '+arrayAlumnoT[i]['apellidos'] ,
                            nota : 0,
                        });   
                    }
                })
                .catch(function(error){
                    console.log(error)
                });
            },
            guardarNotaCurso(){
                let me = this;
                axios.post('/alumno/materia/guardar',{'data':this.arrayDetalle}).then(function (response) {
                    me.alert=1;
                    me.btnNuevo();
                }).catch(function (error) {
                    console.log(error);
                });
            },
            verDetalleNota(){
                let me=this;
                me.listado=1;
                me.arrayAlumnoMateria=[];    
            },
            volverAnterior(){
                let me=this;
                me.listado=0;
                me.arrayDetalle=[];
            },
            listarAlumnoMateria(){
                let me =this;
                var url='/alumno/materia/listarAlumnos?id_curso_paralelo='+ me.id_curso_paralelo;
                axios.get(url).then(function(response){
                    me.arrayAlumnoMateria=response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            }
        },
        mounted() {
            this.selectGestion();
            this.selectPeriodo();
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