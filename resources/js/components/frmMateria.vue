<template>
    <main class="main">
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i>Listado de materias
                </div>
                <!-- Listado y busqueda de cursos -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter">
                            <thead class="text-primary">
                                <tr>
                                    <th>Cod materia</th>
                                    <th>Materia</th>
                                    <th>Area</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="materia in arrayMateria" :key="materia.id">
                                    <td v-text="materia.id"></td>
                                    <td v-text="materia.nombre"></td>
                                    <td v-text="materia.area"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>   
    </main>
</template>

<script>    
    export default {
        data(){
            return {
                arrayMateria : [],
            }
        },
        methods : {
            listarMaterias(){
                let me=this;
                var url='/materia';
                axios.get(url).then(function(response){
                    me.arrayMateria = response.data;
                })
                .catch(function(error){
                    console.log(error)
                });
            }
        },
        mounted() {
            this.listarMaterias();
        }
    }
</script>