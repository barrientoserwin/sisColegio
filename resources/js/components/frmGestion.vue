<template>
    <main class="main">
        <!-- Breadcrumb -->
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Gestion
                    <button type="button" @click="btnNuevoGestion()" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                 <!-- Listado y busqueda de gestion -->                
                <template v-if="listado==0">
                    <div class="card-body">
                        <table class="table tablesorter">
                            <thead class="text-primary">
                            <tr>
                                <th>Gestion</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="gestion in arrayGestion" :key="gestion.id">
                                    <td v-text="gestion.cod_gestion"></td>
                                    <td v-text="gestion.fecha_inicio"></td>
                                    <td v-text="gestion.fecha_fin"></td>
                                    <td>
                                        <div v-if="gestion.estado">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivo</span>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" @click="verGestionEscolar(gestion)" class="btn btn-success btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </button> &nbsp;
                                        <template v-if="gestion.estado">
                                            <button type="button" class="btn btn-success btn-sm" @click="desactivarGestion(gestion.id)">
                                                <i class="fa fa-unlock"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-danger btn-sm" @click="activarGestion(gestion.id)">
                                                <i class="fa fa-lock"></i>
                                            </button>
                                        </template>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </template>

                <template v-if="listado==1">
                    <div class="card-header text-center bg-default">
                        <font class="text-white" size="5" face="Times New Roman">Apertura de Gestion Academica</font>
                    </div>
                    <div class="card-body">
                        <div class="form-group row border">                            
                            <div class="col-md-4">
                                <label>Gestion Academica</label>
                                <div class="form-group">                                
                                    <input type="number" class="form-control" v-model="datos.datos.cod_gestion">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha Inicio</label>
                                    <input type="date" class="form-control" v-model="datos.datos.fecha_inicio">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha Fin</label>
                                    <input type="date" class="form-control" v-model="datos.datos.fecha_fin">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label>Cursos <span style="color:red;" >(*Seleccione)</span></label>
                                <div class="input-group">            
                                    <input type="text" readonly class="form-control" placeholder="Agregar Cursos...">
                                    <button type="submit" @click="listarCurso()" data-toggle="modal" data-target="#modalCurso" class="btn btn-primary"><i class="fa fa-search"></i> Agregar</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div v-show="errorGestion" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjGestion" :key="error" v-text="error">

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
                                            <th>Curso</th>
                                            <th>Grado</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="(detalle,index) in arrayDetalle" :key="detalle.id">
                                            <td>
                                                <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-sm">
                                                    <i class="tim-icons icon-trash-simple"></i>
                                                </button>
                                            </td>
                                            <td v-text="detalle.curso"></td>
                                            <td v-text="detalle.grado"></td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="3">
                                                No hay Cursos agregados
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>   
                        </div>
                        <div class="form-group row ">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                                <button type="button" @click="guardarGestion()" class="btn btn-primary">Guardar Gestion</button>
                            </div>
                        </div>                   
                    </div>                   
                </template>

                <template v-if="listado==2">
                    <div class="card-header text-center bg-default">
                        <font class="text-white" size="5" face="Times New Roman">Apertura de Gestion Academica {{datos.datos.cod_gestion}}</font>
                    </div>
                    <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Fecha Inicio</label>
                                    <input type="date" class="form-control" v-model="datos.datos.fecha_inicio" disabled>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Fecha Fin</label>
                                    <input type="date" class="form-control" v-model="datos.datos.fecha_fin" disabled>
                                </div>
                            </div>
                        </div>
                    
                        <font size="5" face="Times New Roman">Cursos Programados</font>
                        <div class="form-group row border">
                            <div class="table-responsive">
                                <table class="table tablesorter">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>Curso</th>
                                            <th>Grado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="curso in arrayCursoG" :key="curso.id">
                                            <td v-text="curso.nombre"></td>
                                            <td v-text="curso.grado"></td>
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
        <!--Inicio del modal Curso--> 
        <div class="modal fade" id="modalCurso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-default">
                        <h4 class="modal-title text-white">SELECCIONE LOS CURSOS</h4>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    Listado de Cursos
                                </div>
                                <div class="col-md-3">
                                </div>                     
                            </div>
                             <table class="table tablesorter">
                                <thead class="text-primary">
                                    <tr>
                                        <th>Cod. Curso</th>
                                        <th>Curso</th>
                                        <th>Grado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="curso in arrayCurso" :key="curso.id">
                                        <td v-text="curso.id"></td>
                                        <td v-text="curso.nombre"></td>
                                        <td v-text="curso.grado"></td>
                                        <td>
                                            <button type="button" @click="seleccionarCurso(curso)" class="btn btn-success btn-sm">
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
        <!--Fin del modal producto--> 
    </main>
</template>

<script> 
    import moment from 'moment';
    export default {
        data(){
            return {
                datos:{
                    datos : {
                        id : 0,
                        cod_gestion: '',
                        fecha_inicio : '',
                        fecha_fin : '',
                    }, 
                    detalle:[]
                },
                arrayDetalle : [],                                               
                arrayCurso : [],
                arrayCursoG : [],
                arrayGestion : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorGestion : 0,
                errorMostrarMsjGestion : [],
                listado: 0,
            }
        },
        methods : {
            listarGestion(){
                let me=this;
                var url='/gestion';
                axios.get(url).then(function(response){
                    me.arrayGestion = response.data;
                })
                .catch(function(error){
                    console.log(error)
                });
            },
            btnNuevoGestion(){
               let me = this;
                me.listado=1;
                this.arrayDetalle = [];
                this.errorMostrarMsjGestion=[];
                me.datos.datos = {
                    id : 0,
                    cod_gestion: '',
                    fecha_inicio : '',
                    fecha_fin: ''
                };
            },
            ocultarDetalle(){
                this.listado=0;
                this.listarGestion();
            }, 
            desactivarGestion(id){
                swal({
                title: 'Se desea finalizar esta Gestion Escolar?',
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
                    axios.put('/gestion/desactivar',{'id': id}).then(function (response) {
                        me.listarGestion();
                        swal(
                        'Desactivado!',
                        'Esta Gestion Escolar finalizó con éxito.',
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
            activarGestion(id){
                swal({
                title: 'Se desea habilitar esta Gestion Escolar?',
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
                    axios.put('/gestion/activar',{'id': id}).then(function (response) {
                        me.listarGestion();
                        swal(
                        'Activado!',
                        'Esta Gestion Escolar se ha habilitado con éxito.',
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
            verGestionEscolar(data=[]){
                this.listado=2;
                this.datos.datos.id = data['id'];
                this.datos.datos.cod_gestion = data['cod_gestion'];
                this.datos.datos.fecha_inicio = data['fecha_inicio'];
                this.datos.datos.fecha_fin = data['fecha_fin'];
                this.detalleCursoGestion(data['id']);
            },
            detalleCursoGestion(id_gestion){
                let me = this;
                var url='/gestion/curso/detalle?id=' + id_gestion;
                axios.get(url).then(function(response){
                    me.arrayCursoG= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            listarCurso(){
                let me = this;
                var url='/curso';
                axios.get(url).then(function(response){
                    me.arrayCurso= response.data;
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
                    if(this.arrayDetalle[i].id_curso==id){
                        sw=true;
                    }
                }
                return sw;
            },
            validarGestion(){
                this.errorGestion = 0;
                this.errorMostrarMsjGestion = [];
                if(!this.datos.datos.fecha_inicio) this.errorMostrarMsjGestion.push("Debe completar el campo Fecha Inicio ");
                if(!this.datos.datos.fecha_fin) this.errorMostrarMsjGestion.push("Debe completar el campo Fecha Fin");
                if(this.errorMostrarMsjGestion.length) this.errorGestion=1;
                return this.errorGestion;
            },
            guardarGestion(){
                if(this.validarGestion()){
                    return;
                }
                let me = this;
                me.datos.detalle= me.arrayDetalle;
                axios.post('/gestion/guardar',this.datos).then(function (response) {
                    me.listado =0;
                    me.listarGestion();
                    me.datos.datos = {
                        id : 0,
                        cod_gestion: '',
                        fecha_inicio : '',
                        fecha_fin : ''
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarGestionCurso(){
                let me = this;
                me.errorGestion=0;
                me.errorMostrarMsjGestion =[];
                if (me.arrayDetalle.length<=0) me.errorMostrarMsjGestion.push("Ingrese cursos");
                if (me.errorMostrarMsjGestion.length) me.errorGestion = 1;
                return me.errorGestion;
            },
            seleccionarCurso(data=[]){
                let me = this;
                if(me.encuentra(data['id'])){
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'Ese curso ya se encuentra agregado!',
                    })
                }
                else{
                    me.arrayDetalle.push({
                        id_curso : data['id'],
                        curso : data['nombre'],
                        grado : data['grado']
                    });
                }
            },
        },
        mounted() {
            this.listarGestion();
        },
    }
</script>