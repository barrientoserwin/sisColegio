<template>
    <main class="main">
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <!-- Listado gestion -->                
                <template v-if="listado==0">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Gestion Academica - Asignación de Materias
                        <button type="button" @click="listadoGestionCurso()" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Ver Detalles
                        </button>
                    </div>
                    <div class="card-header text-center bg-default">
                        <font class="text-white" size="5" face="Times New Roman">Administracion Academica Gestion/Curso</font>
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
                                <label>Revisar <span style="color:red;" >(*Acceso Administracion)</span></label>
                                <div class="form-group">      
                                    <button type="submit" @click="verificarInstancia()" class="btn btn-primary">Verificar</button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Materias <span style="color:red;" >(*Seleccione)</span></label>
                                <div class="form-group">   
                                    <template v-if="validar==0">
                                        <button type="submit" class="btn btn-primary" disabled><i class="fa fa-search"></i> Seleccione</button>
                                    </template>   
                                    <template v-else>
                                        <button type="submit" @click="listarMateria()" data-toggle="modal" data-target="#modalMateria" class="btn btn-primary"><i class="fa fa-search"></i> Seleccione</button>
                                    </template>
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
                            <div class="table-responsive">
                                <table class="table tablesorter">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>Opcion</th>
                                            <th>Materia</th>
                                            <th>Area</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="(detalle,index) in arrayDetalle" :key="detalle.id">
                                            <td>
                                                <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-sm">
                                                    <i class="tim-icons icon-simple-delete"></i>
                                                </button>
                                            </td>
                                            <td v-text="detalle.materia"></td>
                                            <td v-text="detalle.area"></td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="3">
                                                No hay Materias agregadas
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>   
                        </div>
                        <div class="form-group row ">
                            <div class="col-md-12">
                                <button type="button" @click="btnNGestionCurso()" class="btn btn-secondary">Nuevo</button>
                                <button type="button" @click="guardarGCurso()" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>                   
                   </div>                   
                </template>

                <template v-if="listado==1">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Gestion Academica - Asignación de Materias
                        <button type="button" @click="volverListadoCero()" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Volver a Formulario
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table tablesorter">
                            <thead class="text-primary">
                                <tr>
                                    <th>Gestion</th>
                                    <th>Curso</th>
                                    <th>Grado</th>
                                    <th>Cantidad Materias</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="gestCurso in arrayGCurso" :key="gestCurso.id">
                                    <td v-text="gestCurso.cod_gestion"></td>
                                    <td v-text="gestCurso.curso"></td>
                                    <td v-text="gestCurso.grado"></td>
                                    <td v-text="gestCurso.cantMateria"></td>
                                    <td>
                                        <button type="button" @click="detalleGestionCurso(gestCurso)" class="btn btn-success btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </template>

                <template v-if="listado==2">
                    <div class="card-header text-center bg-default">
                        <font class="text-white" size="5" face="Times New Roman">Gestion Academica {{codGestion}} - Materias</font>
                    </div>
                    <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Curso</label>
                                    <input type="text" class="form-control" v-model="curso" disabled>
                                </div>
                            </div>
                        </div>
                    
                        <font size="5" face="Times New Roman">Materias Asignadas</font>
                        <div class="form-group row border">
                            <div class="table-responsive">
                                <table class="table tablesorter">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>Nro</th>
                                            <th>Materia</th>
                                            <th>Area</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(materia,index) in arrayMateria" :key="materia.id">
                                            <td>{{index+1}}</td>
                                            <td v-text="materia.nombre"></td>
                                            <td v-text="materia.area"></td>
                                        </tr>
                                    </tbody>
                                </table>
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

        <!--Inicio del modal Materia-->
        <div class="modal fade" id="modalMateria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-default">
                        <h4 class="modal-title text-white">Seleccione las materias</h4>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    Listado de Materias
                                </div>                   
                            </div>
                             <table class="table tablesorter">
                                <thead class="text-primary">
                                    <tr>
                                        <th>Cod. Materia</th>
                                        <th>Materia</th>
                                        <th>Area</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="materia in arrayMateria" :key="materia.id">
                                        <td v-text="materia.id"></td>
                                        <td v-text="materia.nombre"></td>
                                        <td v-text="materia.area"></td>
                                        <td>
                                            <button type="button" @click="seleccionarMateria(materia)" class="btn btn-success btn-sm">
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
        <!--Fin del modal materia--> 
    </main>
</template>

<script>    
    export default {
        data(){
            return {
                datos : {
                    id_gestion_curso : '',
                    detalle:[]
                },   
                codGestion : '',
                curso : '',
                arrayDetalle : [],       
                arrayGCurso : [],
                arrayGestion : [],                                        
                arrayCurso : [],                
                arrayMateria : [],
                errorGestionCurso : 0,
                errorMostrarMsjGestionCurso : [],
                listado: 0,
                validar:0,
            }
        },
        methods : {
            listadoGestionCurso(){
                let me=this;
                me.listado=1;

                var url='/gestion/curso/listado';
                axios.get(url).then(function(response){
                    me.arrayGCurso=response.data;
                })
                .catch(function(error){
                    console.log(error)
                });
            },
            btnNGestionCurso(){
                let me = this;
                me.arrayDetalle = [];
                me.errorMostrarMsjGestionCurso=[];
                me.codGestion = '';
                me.validar=0;
            },
            volverListadoCero(){
                this.listado=0;
                this.arrayGCurso=[];
            },
            ocultarDetalle(){
                this.listado=1;
                this.listadoGestionCurso();
            },
            detalleGestionCurso(data=[]){
                this.listado=2;
                this.arrayMateria=[];
                this.codGestion = data['cod_gestion'];
                this.curso = data['curso'];
                this.listarCursoMateria(data['id']);
            },
            listarCursoMateria(id_gestion_curso){
                let me = this;
                var url='/curso/materia/listarMateriaGestion?id_gestion_curso=' + id_gestion_curso;
                axios.get(url).then(function(response){
                    me.arrayMateria= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            verificarInstancia(){
                let me=this;
                var url='/curso/materia/validar?id_gestion_curso='+me.datos.id_gestion_curso;
                axios.get(url).then(function(response){
                    if(response.data==1){
                        alert("Error... Ya se encuentran Administradas! - <<Dirigase a Ver Detalles>>");
                    }
                    else{
                        me.validar=1;
                    }
                })
                .catch(function(error){
                    console.log(error)
                });
            },
            listarMateria(){
                let me = this;
                var url='/materia';
                axios.get(url).then(function(response){
                    me.arrayMateria=response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            eliminarDetalle(index){
                let me = this;
                me.arrayDetalle.splice(index,1);
            },
            encuentra(id){
                var sw=0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    if(this.arrayDetalle[i].idMateria==id){
                        sw=true;
                    }
                }
                return sw;
            },
            guardarGCurso(){
                if(this.validarGestionCurso()){
                    return;
                }
                let me = this;
                me.datos.detalle= me.arrayDetalle;
                axios.post('/curso/materia/guardar',this.datos).then(function (response) {
                    me.listado =1;
                    me.datos = {
                        id_gestion_curso : '',
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarGestionCurso(){
                let me = this;
                me.errorGestion=0;
                me.errorMostrarMsjGestionCurso =[];
                if (me.arrayDetalle.length<=0) me.errorMostrarMsjGestionCurso.push("Ingrese Materias");
                if (me.errorMostrarMsjGestionCurso.length) me.errorGestionCurso = 1;
                return me.errorGestionCurso;
            },
            seleccionarMateria(data=[]){
                let me = this;
                if(me.encuentra(data['id'])){
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'Esta materia ya se encuentra agregada!',
                    })
                }
                else{
                    me.arrayDetalle.push({
                        idMateria : data['id'],
                        materia : data['nombre'],
                        area : data['area']
                    });
                }
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