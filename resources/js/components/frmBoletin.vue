<template>
    <main class="main">
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <!-- Listado gestion -->
                <template v-if="listado==0">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Reporte de Notas por Trimestre
                        <button type="button" @click="btnNuevo()" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-header text-center bg-default">
                        <font class="text-white" size="5" face="Times New Roman">Boletin de Notas {{cod_gestion}}</font>
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
                                    <label>Paralelo</label>
                                    <select class="form-control" v-model="id_paralelo">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="paralelo in arrayParalelo" :key="paralelo.id" :value="paralelo.id" v-text="paralelo.nombre"></option>                                        
                                    </select> 
                                </div>
                            </div>                              
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Alumno</label>
                                    <input type="number" v-model="matricula" class="form-control">
                                </div>
                            </div>                        
                            <div class="col-md-4">
                                <label>Materias <span style="color:red;" >(*cargar)</span></label>
                                <div class="input-group">                                
                                    <button type="submit" @click="generarBoletinNota()" class="btn btn-success"><i class="tim-icons icon-refresh-01"></i></button>
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
                                            <th>Materia</th>
                                            <th>Trimestre 1</th>
                                            <th>Trimestre 2</th>
                                            <th>Trimestre 3</th>
                                            <th>Promedio Materia</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="(detalle,index) in arrayDetalle" :key="detalle.id">
                                            <td v-text="index+1"></td>
                                            <td v-text="detalle.materia"></td>
                                            <td v-text="detalle.nota1"></td>
                                            <td v-text="detalle.nota2"></td>
                                            <td v-text="detalle.nota3"></td>
                                            <td v-text="detalle.promedio"></td>
                                        </tr>
                                        <tr style="background-color: #CEECF5">
                                            <td colspan="5" align="right"> <strong>Nota Final:</strong> </td>
                                            <td>{{notaFinal}}</td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="6">
                                                No se encuentran datos
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>   
                            <div class="col-md-12">
                                <button type="button" @click="guardarNotaCurso()" class="btn btn-primary">Imprimir</button>
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
                id_paralelo: '',
                arrayDetalle: [],
                matricula:'',

                arrayGestion : [],                                        
                arrayParalelo : [],
                arrayCurso : [], 
                errorAlumnoMateria : 0,
                errorMostrarMsjAlumnoMateria : [],
                listado: 0
            }
        },
        computed : {
            notaFinal: function(){
                var resultado = 0.0;
                var cont=0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    resultado = resultado + (this.arrayDetalle[i].promedio);
                    cont=cont+1;
                }
                return (resultado/cont).toFixed(2);
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
            generarBoletinNota(){
                let me=this;
                var url='/alumno/materia/boletin?id_gestion_curso='+this.id_gestion_curso+'&matricula='+this.matricula;
                axios.get(url).then(function(response){
                    me.arrayDetalle = response.data;
                })
                .catch(function(error){
                    console.log(error)
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