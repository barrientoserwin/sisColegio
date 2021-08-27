<template>
    <main class="main">
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">                
                <template v-if="listado==0">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>Roles de Usuarios
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter">
                                <thead class="text-primary">
                                    <tr>
                                        <th>Rol Usuarios</th>
                                        <th>Nro Usuarios</th>
                                        <th>Opcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="users in arrayUser" :key="users.id">
                                        <td v-text="users.rol_usuario"></td>
                                        <td v-text="users.nroUsuarios"></td>
                                        <td>
                                            <template v-if="users.rol_usuario=='administrador'">
                                                <i class="tim-icons icon-lock-circle"></i>
                                            </template>
                                            <template v-else>
                                                <button type="button" @click="detalleUsuario(users.rol_usuario)" class="btn btn-success btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </template>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>

                <template v-if="listado==1">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>Roles de Usuarios
                        <button type="button" @click="cerrar()" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Volver Anterior
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter">
                                <thead class="text-primary">
                                    <tr>
                                        <th>Nro Identidad</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Gmail</th>
                                        <th>Telefono</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="personal in arrayPersonal" :key="personal.id">
                                        <td v-text="personal.dni"></td>
                                        <td v-text="personal.nombre"></td>
                                        <td v-text="personal.apellidos"></td>
                                        <td v-text="personal.gmail"></td>
                                        <td v-text="personal.telefono"></td>
                                    </tr>
                                </tbody>
                            </table>
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
                arrayUser : [],
                arrayPersonal : [],
                listado: 0,
            }
        },
        methods : {
            listarUsers(){
                let me=this;
                var url='/users/roles';
                axios.get(url).then(function(response){
                    me.arrayUser = response.data;
                })
                .catch(function(error){
                    console.log(error)
                });
            },
            detalleUsuario(rol_usuario){
                let me=this;
                me.listado=1;

                var url='/users/personal?rol_usuario=' + rol_usuario;
                axios.get(url).then(function(response){
                    me.arrayPersonal = response.data;
                })
                .catch(function(error){
                    console.log(error)
                });

            },
            cerrar(){
                let me=this;
                me.listado=0;
                me.arrayPersonal=[];
            }
        },
        mounted() {
            this.listarUsers();            
        }
    }
</script>