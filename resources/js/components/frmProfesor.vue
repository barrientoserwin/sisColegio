<template>
    <main class="main">
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Profesores
                    <button type="button" @click="btnNuevoProfesor()" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>

                <!-- Listado y busqueda de secretaria -->
                <template v-if="listado==0">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                        <option value="nombre">Nombre</option>
                                        <option value="apellidos">Apellidos</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarProfesor(1, buscar, criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarProfesor(1, buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                    <th>Email</th>
                                    <th>Telefono</th>
                                    <th>Login</th>
                                    <th>Rol Usuario</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="profesor in arrayProfesor" :key="profesor.id">
                                    <td v-text="profesor.nombre"></td>
                                    <td v-text="profesor.apellidos"></td>
                                    <td v-text="profesor.fecha_nac"></td>
                                    <td v-text="profesor.dni"></td>
                                    <td v-text="profesor.gmail"></td>
                                    <td v-text="profesor.telefono"></td>
                                    <td v-text="profesor.login"></td>
                                    <td v-text="profesor.rol_usuario"></td>
                                    <td>
                                        <div v-if="profesor.estado">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivo</span>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" @click="abrirModal(profesor)" class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </button> &nbsp;
                                        <template v-if="profesor.estado">
                                            <button type="button" class="btn btn-success btn-sm" @click="desactivar(profesor.id)">
                                                <i class="fa fa-unlock"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-danger btn-sm" @click="activar(profesor.id)">
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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <center><h3>Registrar Profesor</h3></center>
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="datos.nombre" class="form-control" placeholder="Nombre docente">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Apellidos</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="datos.apellidos" class="form-control" placeholder="apellidos">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Fecha Nacimiento</label>
                                        <div class="col-md-9">
                                            <span style="color:red;" v-show="validarEdad<20">{{validarEdad}} años de edad? es incoherente!!</span>
                                            <input type="date" v-model="datos.fecha_nac" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Cédula de Identidad</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="datos.dni" class="form-control" placeholder="Cedula de identidad">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Correo Electronico</label>
                                        <div class="col-md-9">
                                            <input type="email" v-model="datos.gmail" class="form-control" placeholder="correo electronico">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Nro Telefonico</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="datos.telefono" class="form-control" placeholder="Nro celular">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Nombre Usuario</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="datos.login" class="form-control" placeholder="Nombre de Usuario">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Contraseña</label>
                                        <div class="col-md-9">
                                            <input type="password" v-model="datos.password" class="form-control">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Rol Usuaro</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="datos.rol_usuario" class="form-control" readonly>
                                        </div>
                                    </div> 
                                    <div v-show="errorProfesor" class="form-group row div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjProfesor" :key="error" v-text="error">

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6 col-xs-9">
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarListado1()" class="btn btn-secondary">Cerrar</button>
                                <button type="button" class="btn btn-primary" @click="guardarProfesor()">Guardar Profesor</button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>

        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" tabindex="-1" :class="{'mostrar' :modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-text="tituloModal"></h4>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="datos.nombre" class="form-control" placeholder="Nombre docente">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Apellidos</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="datos.apellidos" class="form-control" placeholder="apellidos">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Fecha Nacimiento</label>
                                <div class="col-md-9">
                                    <span style="color:red;" v-show="validarEdad<20">{{validarEdad}} años de edad? es incoherente!!</span>
                                    <input type="date" v-model="datos.fecha_nac" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Cédula de Identidad</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="datos.dni" class="form-control" placeholder="Cedula de identidad">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Correo Electronico</label>
                                <div class="col-md-9">
                                    <input type="email" v-model="datos.gmail" class="form-control" placeholder="correo electronico">
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nro Telefonico</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="datos.telefono" class="form-control" placeholder="Nro celular">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre Usuario</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="datos.login" class="form-control" placeholder="Nombre de Usuario">
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Contraseña</label>
                                <div class="col-md-9">
                                    <input type="password" v-model="datos.password" class="form-control">
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Rol Usuaro</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="datos.rol_usuario" class="form-control" readonly>
                                </div>
                            </div>
                            <div v-show="errorProfesor" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjProfesor" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" class="btn btn-primary" @click="modificarProfesor()">Modificar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->   
    </main>
</template>

<script>    
    import moment from 'moment';
    export default {
        data(){
            return {
                datos : {
                    id : 0,
                    nombre: '',
                    apellidos : '',
                    fecha_nac : '',
                    dni : '',
                    gmail : '',
                    telefono : '',
                    login : '',
                    password : '',
                    rol_usuario : 'profesor'
                },                                               
                arrayProfesor : [],                
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorProfesor : 0,
                errorMostrarMsjProfesor : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
                buscar : '',
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
            },
            validarEdad: function(){
                var fecha1 = moment().format('YYYY-MM-DD');
                var fecha2= moment(this.datos.fecha_nac, "YYYY-MM-DD"); 

                var fechaNacimiento = moment(fecha2); 
                var fechaActual = moment(fecha1); 
                var duration = moment.duration(fechaActual.diff(fechaNacimiento)); 
                var anio = duration.years();
                return anio;
            }
        },
        methods : {
            listarProfesor(page, buscar, criterio){
                let me=this;
                var url='/profesor?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function(response){
                    me.arrayProfesor=response.data.data;
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
                me.listarProfesor(page, buscar, criterio);
            },
            ocultarListado1(){
                this.listado=0;
            },
            validarProfesor(){
                this.errorProfesor = 0;
                this.errorMostrarMsjProfesor = [];
                if(!this.datos.nombre) this.errorMostrarMsjProfesor.push("Debe completar el campo Nombre ");
                if(!this.datos.apellidos) this.errorMostrarMsjProfesor.push("Debe completar el campo Apellidos");
                if(!this.datos.gmail) this.errorMostrarMsjProfesor.push("Debe completar el campo Gmail");
                if(!this.datos.login) this.errorMostrarMsjProfesor.push("Debe escribir su nombre de usuario");
                if(this.errorMostrarMsjProfesor.length) this.errorProfesor=1;
                return this.errorProfesor;
            },
            guardarProfesor(){                
                if(this.validarProfesor()){
                    return;
                }
                let me = this;
                axios.post('/profesor/guardar',this.datos).then(function (response) {
                    me.listado =0;
                    me.listarProfesor(1, '', 'nombre');
                    me.datos = {
                        id : 0,
                        nombre: '',
                        apellidos : '',
                        fecha_nac : '',
                        dni : '',
                        gmail : '',
                        telefono : '',
                        login : '',
                        password : '',
                        rol_usuario : 'profesor'
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            modificarProfesor(){
                if(this.validarProfesor()){
                    return;
                }
                let me = this;
                axios.put('/profesor/modificar',this.datos).then(function (response) {
                    me.modal = 0;
                    me.listarProfesor(1, '', 'nombre');
                    me.datos = {
                        id : 0,
                        nombre: '',
                        apellidos : '',
                        fecha_nac : '',
                        dni : '',
                        gmail : '',
                        telefono : '',
                        login : '',
                        password : '',
                        rol_usuario : 'profesor'
                    },
                    me.arraySecretaria = [];
                }).catch(function (error) {
                    console.log(error);
                });
            },
            desactivar(id){
                swal({
                title: 'Esta seguro de bloquear este profesor?',
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
                    axios.put('/users/desactivar',{'id': id}).then(function (response) {
                        me.listarProfesor(1, '', 'nombre');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
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
            activar(id){
                swal({
                title: 'Esta seguro de des_bloquear este profesor?',
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
                    axios.put('/users/activar',{'id': id}).then(function (response) {
                        me.listarProfesor(1, '', 'nombre');
                        swal(
                        'Eliminado!',
                        'El registro ha sido eliminado con éxito.',
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
            abrirModal(data=[]){
                this.modal = 1;
                this.tituloModal='Modificar Datos del Profesor';
                this.datos.id = data['id'];
                this.datos.nombre = data['nombre'];  
                this.datos.apellidos = data['apellidos'];      
                this.datos.fecha_nac = data['fecha_nac'];
                this.datos.dni = data['dni'];                                     
                this.datos.gmail = data['gmail'];
                this.datos.telefono = data['telefono'];
                this.datos.login = data['login'];
                this.datos.password = data['password'];
                this.datos.rol_usuario = data['rol_usuario'];
            },
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.errorMostrarMsjProfesor = [];
                this.datos = {
                    id : 0,
                    nombre: '',
                    apellidos : '',
                    fecha_nac : '',
                    dni : '',
                    gmail : '',
                    telefono : '',
                    login : '',
                    password : '',
                    rol_usuario : 'profesor'
                };
            },
            btnNuevoProfesor(){
                let me = this;
                me.listado=1;
                me.datos = {
                    id : 0,
                    nombre: '',
                    apellidos : '',
                    fecha_nac : '',
                    dni : '',
                    gmail : '',
                    telefono : '',
                    login : '',
                    password : '',
                    rol_usuario : 'profesor'
                };
            }
        },
        mounted() {
            this.listarProfesor(1, this.buscar, this.criterio);
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