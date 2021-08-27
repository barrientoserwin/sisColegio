<template>
    <main class="main">
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i>Listado de Cursos
                </div>
                <!-- Listado y busqueda de cursos -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter">
                            <thead class="text-primary">
                                <tr>
                                    <th>Cod Curso</th>
                                    <th>Curso</th>
                                    <th>Grado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="curso in arrayCurso" :key="curso.id">
                                    <td v-text="curso.id"></td>
                                    <td v-text="curso.nombre"></td>
                                    <td v-text="curso.grado"></td>
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
                arrayCurso : [], 
            }
        },
        methods : {
            listarCurso(){
                let me=this;
                var url='/curso';
                axios.get(url).then(function(response){
                    me.arrayCurso = response.data;
                })
                .catch(function(error){
                    console.log(error)
                });
            }
        },
        mounted() {
            this.listarCurso();
        }
    }
</script>