<template>
    <main class="main">
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <!-- Listado gestion -->
                <template v-if="listado==0">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Control de Asistencia
                        <button type="button" @click="btnNuevo()" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-header text-center bg-default">
                        <font class="text-white" size="5" face="Times New Roman">Formulario de Asistencia</font>
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
                                    <select class="form-control" v-model="datos.id_gestion_curso" @change="selectCursoMateria()">
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
                                    <select class="form-control" v-model="datos.id_curso_paralelo">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="paralelo in arrayParalelo" :key="paralelo.id" :value="paralelo.id" v-text="paralelo.nombre"></option>                                        
                                    </select> 
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha Asistencia</label>
                                    <input type="date" v-model="datos.fecha" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Curso</label>
                                    <input type="time" v-model="datos.hora" class="form-control"> 
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Descripcion</label>
                                    <input type="text" v-model="datos.descripcion" class="form-control">
                                </div>
                            </div>                         
                            <div class="col-md-4">
                                <label>Asistencia <span style="color:red;" >(*registrar)</span></label>
                                <div class="input-group">                                
                                    <button type="submit" @click="guardarAsistencia()" class="btn btn-success">Guardar</button>
                                </div>
                            </div>
                        </div>              
                   </div>                   
                </template>

                <template v-if="listado==1">
                    <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Control de Asistencia</label>
                                    <select class="form-control" v-model="datos.id">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="asistencia in arrayAsistencia" :key="asistencia.id" :value="asistencia.id" v-text="asistencia.fecha"></option>                                        
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">                                
                                    <button type="submit" @click="tomarAsistencia()" class="btn btn-success">Listar</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row border">
                            <div class="table-responsive col-md-12">
                                <table class="table tablesorter">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>Nro</th>
                                            <th>Alumno</th>
                                            <th>Estado</th>
                                            <th>*</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(detalle,index) in arrayDetalle" :key="detalle.id">
                                            <td v-text="index+1"></td>
                                            <td v-text="detalle.alumno"></td>
                                            <td v-text="detalle.nombre + ' '+detalle.apellidos">
                                                <input v-model="detalle.estado" type="number" class="form-control">
                                            </td>
                                            <td>
                                                <template v-if="detalle.estado==0">
                                                    No vino
                                                </template>
                                                <template v-else>
                                                    Presente
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
    </main>
</template>

<script>    
    export default {
        data(){
            return {   
                datos : {
                    id : 0,
                    fecha: '',
                    hora : '',
                    descripcion : '',
                    id_curso_paralelo: '',
                    id_gestion_curso : '',
                }, 
                cod_gestion : '',    
                id_curso_materia: '',    
                arrayDetalle: [],
                arrayAsistencia: [],

                arrayGestion : [],                                        
                arrayCurso : [],                
                arrayCursoMateria : [],
                arrayParalelo : [],
                arrayAlumnoMateria:[],
                errorAlumnoMateria : 0,
                errorMostrarMsjAlumnoMateria : [],
                listado: 0
            }
        },
        methods : {
            btnNuevo(){
                let me = this;
                me.errorMostrarMsjAlumnoMateria=[];
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
                var url='/curso/materia/selectCursoMateria?id_gestion_curso='+this.datos.id_gestion_curso;
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
            guardarAsistencia(){
                let me = this;
                axios.post('/asistencia/guardar',this.datos).then(function (response) {
                    me.id_curso_materia='',
                    me.datos = {
                        id : 0,
                        fecha: '',
                        hora : '',
                        descripcion : '',
                        id_curso_paralelo: '',
                        id_gestion_curso : '',
                    }
                }).catch(function (error) {
                    console.log(error);
                });    
            },
            tomarAsistencia(id_asistencia){
                var arrayAlumnoT = [];
                var url='/asistencia/controlAsistencia?id_asistencia='+id_asistencia;
                axios.get(url).then(function(response){
                    arrayAlumnoT = response.data;

                    for(var i=0;i<arrayAlumnoT.length;i++){
                        me.arrayDetalle.push({
                            id_asistencia : me.datos.id,
                            id_alumno : arrayAlumnoT[i]['id'],
                            estado: arrayAlumnoT[i]['estado'],
                            alumno : arrayAlumnoT[i]['nombre']+ ' '+arrayAlumnoT[i]['apellidos'] ,
                        });   
                    }
                })
                .catch(function(error){
                    console.log(error)
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