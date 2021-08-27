<template>
    <main class="main">
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <!-- Listado gestion -->               
                <template v-if="listado==0">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Control de Paralelos
                        <button type="button" @click="detalleCursoParalelo()" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Detalle Cupo Curso
                        </button>
                    </div>
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
                                    <select class="form-control" v-model="datos.id_gestion_curso">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="gestCurso in arrayCurso" :key="gestCurso.id" :value="gestCurso.id" v-text="gestCurso.nombre"></option>                                        
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Paralelo</label>
                                    <select class="form-control" v-model="datos.id_paralelo">
                                        <option value="" disabled>Seleccione</option>
                                        <option v-for="paralelo in arrayParalelo" :key="paralelo.id" :value="paralelo.id" v-text="paralelo.nombre"></option>                                        
                                    </select> 
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
                    
                        <div class="form-group row ">
                            <div class="col-md-12">
                                <button type="button" @click="btnNGestionCurso()" class="btn btn-secondary">Nuevo</button>
                                <button type="button" @click="guardarCursoParalelo()" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>                   
                   </div>                   
                </template>

                <template v-if="listado==1">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Control de Paralelos
                        <button type="button" @click="volverAtras()" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Volver a Formulario de Adminsitracion
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table tablesorter">
                            <thead class="text-primary">
                                <tr>
                                    <th>Gestion</th>
                                    <th>Curso</th>
                                    <th>Grado</th>
                                    <th>Paralelo</th>
                                    <th>Cantidad Inscritos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="gestCurso in arrayGCurso" :key="gestCurso.id">
                                    <td v-text="gestCurso.cod_gestion"></td>
                                    <td v-text="gestCurso.curso"></td>
                                    <td v-text="gestCurso.grado"></td>
                                    <td v-text="gestCurso.paralelo"></td>
                                    <td v-text="gestCurso.cantInscrito"></td>
                                </tr>
                            </tbody>
                        </table>
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
                    id_gestion_curso : '',
                    id_paralelo : ''
                },   
                codGestion : '',
                curso : '',
                arrayParalelo : [],       
                arrayGCurso : [],
                arrayGestion : [],                                        
                arrayCurso : [],   
                errorGestionCurso : 0,
                errorMostrarMsjGestionCurso : [],
                listado: 0
            }
        },
        methods : {
            detalleCursoParalelo(){
                let me=this;
                me.listado=1;
                var url='/gestion/curso/listarGestionCursoInscritos';
                axios.get(url).then(function(response){
                    me.arrayGCurso=response.data;
                })
                .catch(function(error){
                    console.log(error)
                });
            },
            btnNGestionCurso(){
                let me = this;
                me.errorMostrarMsjGestionCurso=[];
                me.selectGestion();
                me.selectParalelo();
            },
            volverAtras(){
                this.listado=0;
                this.arrayGCurso=[];
            },
            guardarCursoParalelo(){
                let me = this;
                axios.post('/curso/paralelo/guardar',this.datos).then(function (response) {
                    me.listado =1;
                    me.detalleCursoParalelo();
                    me.datos = {
                        id_gestion_curso : '',
                        id_paralelo : ''
                    }
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
            selectParalelo(){
                let me = this;
                var url='/paralelo/selectParalelo';
                axios.get(url).then(function(response){
                    me.arrayParalelo= response.data;
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