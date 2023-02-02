<template>
    <div class="container">
        <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#modalCreacion" @click="openModalNewCategory">Crear nueva categoria</button><br>
        <br>
        <table class="table table-striped" style="text-align:center;">
            <thead>
                <tr>
                    <th scope="col">Categorias</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in categorias">
                    <th scope="row">{{ item.name }}</th>
                    <td>
                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#editarModal" @click="nombreModalCategoria(item)">
                            Editar
                        </button>
                        <button type="button" class="btn btn-danger" @click="eliminarCategoria(item.id)">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="modalCreacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title w-100 text-center" id="exampleModalLabel" style="color:rgba(56,193,114,255)"><b>Nueva Categoria</b></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input
                            ref="inputCategory"
                            class="form-control"
                            type="text"
                            placeholder="Nombre de la categoria"
                            v-model="nombre_categoria"
                            v-on:keyup.enter="crearCategoria"
                            >
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-outline-success" @click="crearCategoria">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title w-100 text-center " id="exampleModalLabel" style="color:#6cb2eb">Editar categoria</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input
                            ref="inputCategory"
                            class="form-control"
                            type="text"
                            v-model="categoria_editar"
                            v-on:keyup.enter="editarCategoria"
                            >
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-outline-info" @click="editarCategoria">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    const axios = require("axios");
    import Swal from "sweetalert2"
    export default {
        name:'categoria-component',
        data(){
            return {
                categorias:null,
                nombre_categoria:null,
                id_editar:null,
                categoria_editar:null
            }
        },
        mounted() {
            this.getTodasLasCategorias();
        },
        methods:{
            openModalNewCategory(){
                this.nombre_categoria = null
                // this.$refs.inputCategory.focus();
                this.nombre_categoria.focus();
            },
            getTodasLasCategorias(){
                axios
                    .get("/listar-categorias")
                    .then( (respuesta) => {
                        // console.log(respuesta.data);
                        this.categorias=respuesta.data;
                    });
            },
            crearCategoria(){
                var formData = new FormData();
                formData.append('name', this.nombre_categoria);

                axios
                    .post("/categorias", formData)
                    .then((response) => {
                        // window.alert("Categoria creada");
                        Swal.fire({
                            icon: 'success',
                            title: 'Bien!',
                            text: 'Categoria creada',
                            confirmButtonColor: "rgba(56,193,114,255)",
                            allowEnterKey: true
                        });

                        this.nombre_categoria = null;
                        $('#modalCreacion').modal('hide');
                        this.getTodasLasCategorias();
                });
            },
            eliminarCategoria(id){
                axios
                    .delete("/categorias/"+id)
                    .then((response) =>{
                        Swal.fire({
                            icon: 'success',
                            title: 'Bien!',
                            text: 'Eliminado exitosamente',
                            confirmButtonColor: "#FA182C",
                            allowEnterKey: true
                        });
                        this.getTodasLasCategorias();
                    } );
            },
            nombreModalCategoria(item){
                // console.log(item);
                this.categoria_editar = item.name;
                this.id_editar = item.id;
            },
            editarCategoria(){
                const array={
                    name: this.categoria_editar
                };
                axios
                    .put("/categorias/"+this.id_editar, array)
                    .then((response) =>{
                        // window.alert("Categoria editada");
                        Swal.fire({
                            icon: 'success',
                            title: 'Bien!',
                            text: 'Editado exitosamente',
                            confirmButtonColor: "#6cb2eb",
                            allowEnterKey:true,
                            focusConfirm:true,
                            showConfirmButton:true
                        });
                        $('#editarModal').modal('hide');
                        this.getTodasLasCategorias();
                    });
            }
        }
    }
</script>
<style>

</style>
