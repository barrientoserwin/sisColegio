<template>
    <main class="main">
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Apoderados Estudiantiles
                    <button type="button" @click="btnNuevoApoderado()" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>

                <!-- Listado gestion -->
                <template v-if="listado==0">
                    <div class="card-body">
                        <table class="table tablesorter">
                            <thead class="text-primary">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Nro Carnet</th>
                                    <th>Ocupacion</th>
                                    <th>Telefono</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="apoderado in arrayApoderado" :key="apoderado.id">
                                    <td v-text="apoderado.nombre"></td>
                                    <td v-text="apoderado.apellidos"></td>
                                    <td v-text="apoderado.fecha_nac"></td>
                                    <td v-text="apoderado.dni"></td>
                                    <td v-text="apoderado.ocupacion"></td>
                                    <td v-text="apoderado.telefono"></td>
                                    <td>
                                        <div v-if="apoderado.estado">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivo</span>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" @click="verDetalleApoderado(apoderado)" class="btn btn-success btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </button> &nbsp;
                                        <template v-if="apoderado.estado">
                                            <button type="button" class="btn btn-success btn-sm" @click="desactivarApoderado(apoderado.id)">
                                                <i class="fa fa-unlock"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-danger btn-sm" @click="activarApoderado(apoderado.id)">
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
                    <div class="card-header text-center text-white bg-default">
                        <font size="5" face="Times New Roman">Formulario de Registro de Apoderados Estudiantiles</font>
                    </div>
                    <div class="card-body">
                        <div class="form-group row border">    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" v-model="datos.datos.nombre">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Apellidos</label>
                                    <input type="text" class="form-control" v-model="datos.datos.apellidos">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha Nacimiento</label>
                                    <input type="date" class="form-control" v-model="datos.datos.fecha_nac">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nro Carnet</label>
                                    <input type="text" class="form-control" v-model="datos.datos.dni">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input type="text" class="form-control" v-model="datos.datos.telefono">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Ocupacion</label>
                                    <input type="text" class="form-control" v-model="datos.datos.ocupacion">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label>Alumno <span style="color:red;" >(*Seleccione)</span></label>
                                <div class="input-group">                                
                                    <input type="text" readonly class="form-control" placeholder="Agregar Alumnos...">
                                    <button type="submit" @click="listarAlumno()" data-toggle="modal" data-target="#modalAlumno" class="btn btn-primary"><i class="fa fa-search"></i> Agregar</button>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <div v-show="errorApoderado" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjApoderado" :key="error" v-text="error">

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
                                            <th>Matricula</th>
                                            <th>Alumno</th>
                                            <th>Parentesco</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="(detalle,index) in arrayDetalle" :key="detalle.id">
                                            <td>
                                                <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-sm">
                                                    <i class="tim-icons icon-trash-simple"></i>
                                                </button>
                                            </td>
                                            <td v-text="detalle.matricula"></td>
                                            <td v-text="detalle.alumno"></td>
                                            <td>
                                                <input v-model="detalle.parentesco" type="text" class="form-control" placeholder="parentesco">
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="4">
                                                No hay detalles agregados
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>   
                        </div>
                        <div class="form-group row ">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                                <button type="button" @click="guardarApoderado()" class="btn btn-primary">Guardar Apoderado</button>
                            </div>
                        </div>                   
                   </div>                   
                </template>

                <template v-if="listado==2">
                    <div class="card-header text-center text-white bg-default">
                        <font size="5" face="Times New Roman">Formulario de Registro de Apoderados Estudiantiles</font>
                    </div>
                    <div class="card-body">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nombre Apoderado</label>
                                <input type="text" class="form-control" v-model="datos.datos.nombre" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Apellidos Apoderado</label>
                                <input type="text" class="form-control" v-model="datos.datos.apellidos" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Fecha Nacimiento</label>
                                <input type="date" class="form-control" v-model="datos.datos.fecha_nac" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nro Carnet</label>
                                <input type="text" class="form-control" v-model="datos.datos.dni" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ocupacion</label>
                                <input type="text" class="form-control" v-model="datos.datos.ocupacion" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Telefono</label>
                                <input type="text" class="form-control" v-model="datos.datos.telefono" disabled>
                            </div>
                        </div>
                    
                        <font size="5" face="Times New Roman">Estudiantes Tutelados</font>
                        <div class="form-group row border">
                            <div class="table-responsive">
                                <table class="table tablesorter">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>Alumno</th>
                                            <th>Parentesco</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="parentesco in arrayParentesco" :key="parentesco.id">
                                            <td v-text="parentesco.nombre + ' '+parentesco.apellidos"></td>
                                            <td v-text="parentesco.parentesco"></td>
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

        <div class="modal fade" id="modalAlumno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-default">
                        <h4 class="modal-title text-white">Busqueda de Alumnos</h4>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
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
                    datos:{
                        id : 0,
                        nombre: '',
                        apellidos : '',
                        fecha_nac : '',
                        dni : '',
                        ocupacion : '',
                        telefono : ''
                    },
                    detalle:[]
                },
                arrayDetalle : [],                                               
                arrayParentesco : [],
                arrayAlumno : [],
                arrayApoderado : [],                
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorApoderado : 0,
                errorMostrarMsjApoderado : [],
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
            listarApoderado(page, buscar, criterio){
                let me=this;
                var url='/apoderado?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function(response){
                    me.arrayApoderado=response.data.data;
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
                me.listarApoderado(page, buscar, criterio);
            },
            btnNuevoApoderado(){
               let me = this;
                me.listado=1;
                this.arrayDetalle = [];
                this.errorMostrarMsjApoderado=[];
                me.datos.datos = {
                    id : 0,
                    nombre: '',
                    apellidos : '',
                    fecha_nac : '',
                    dni : '',
                    ocupacion : '',
                    telefono : ''
                };
            },
            ocultarDetalle(){
                this.listado=0;
                this.listarApoderado(1,'', 'a.nombre');
            },
            desactivarApoderado(id){
                swal({
                title: 'Se desea eliminar este apoderado?',
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
                    axios.put('/apoderado/desactivar',{'id': id}).then(function (response) {
                        me.listarApoderado(1,'', 'a.nombre');
                        swal(
                        'Eliminado!',
                        'Este apoderado se ha eliminado con éxito.',
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
            activarApoderado(id){
                swal({
                title: 'Se desea habilitar este apoderado?',
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
                    axios.put('/apoderado/activar',{'id': id}).then(function (response) {
                        me.listarApoderado(1,'', 'a.nombre');
                        swal(
                        'Habilitado!',
                        'Este apoderado se ha habilitado con éxito.',
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
            verDetalleApoderado(data=[]){
                this.listado=2;
                this.datos.datos.id = data['id'];
                this.datos.datos.nombre = data['nombre'];
                this.datos.datos.apellidos = data['apellidos'];
                this.datos.datos.fecha_nac = data['fecha_nac'];
                this.datos.datos.dni = data['dni'];
                this.datos.datos.telefono = data['telefono'];
                this.datos.datos.ocupacion = data['ocupacion'];
                this.listarAlumnoApoderado(data['id']);
            },
            listarAlumnoApoderado(id_apoderado){
                let me = this;
                var url='/apoderado/alumno?id=' + id_apoderado;
                axios.get(url).then(function(response){
                    me.arrayParentesco= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            listarAlumno(buscarA, criterioA){
                let me = this;
                var url='/alumno/listar?buscarA=' + buscarA + '&criterioA=' + criterioA;
                axios.get(url).then(function(response){
                    me.arrayAlumno= response.data;
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
            guardarApoderado(){
                let me = this;
                me.datos.detalle= me.arrayDetalle;
                axios.post('/apoderado/guardar',this.datos).then(function (response) {
                    me.listado =0;
                    me.listarApoderado(1,'', 'a.nombre');
                    me.datos.datos = {
                        id : 0,
                        nombre: '',
                        apellidos : '',
                        fecha_nac : '',
                        dni : '',
                        ocupacion : '',
                        telefono : ''
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarApoderado(){
                let me = this;
                me.errorApoderado=0;
                me.errorMostrarMsjApoderado =[];
                if (me.arrayDetalle.length<=0) me.errorMostrarMsjApoderado.push("Ingrese alumnos");
                if (me.errorMostrarMsjApoderado.length) me.errorApoderado = 1;
                return me.errorApoderado;
            },
            seleccionarAlumno(data=[]){
                let me = this;
                if(me.encuentra(data['id'])){
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'Ese alumno ya se encuentra agregado!',
                    })
                }
                else{
                    me.arrayDetalle.push({
                        id_alumno : data['id'],
                        matricula : data['matricula'],
                        alumno : data['nombre'] + ' '+ data['apellidos'],
                        parentesco : ''
                    });
                }
            },
        },
        mounted() {
            this.listarApoderado(1, this.buscar, this.criterio);
        }
    }
</script>
<style>
    .modal-body{
        max-height:500px;
        overflow:auto;
    }
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