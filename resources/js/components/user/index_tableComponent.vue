<template>
  <div class="row d-flex d-flex flex-row">
        <div class="col-12 shadow-lg">
            <h4 class="my-3 text-center">UBICACIONES TAG ALBUMS</h4>
            <div class="row">
            </div>
           <div class="col-12  p-0 mb-4">
            <table id="tabla_user">
                <thead>
                    <tr>
                        <th scope="col">N<small>o</small></th>
                        <th scope="col"> Album</th>
                        <th scope="col"> Tag</th>
                        <th scope="col"> Ubicacion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="ut in users_table" :key="ut.id">
                        <td data-label="Id" v-text="ut.id"></td>
                        <td data-label="Album" v-text="ut.albums.title"></td>
                        <td data-label="Tag" >
                          <span class="badge badge-pill badge-primary">tag1</span>
                          <span class="badge badge-pill badge-primary">tag2</span>
                        </td>
                        <td data-label="Ubicaciones" v-text="ut.locations.name">
                        </td>
                                      
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        users_table: ""
      }
    },
    mounted () {
      this.get_user_table();
    },
    methods: {
      get_user_table(){
        axios.get('/user/album_user').then(result => {

          console.log(result.data[0].tags[0].title);

          this.users_table = result.data;

          this.$nextTick(() => {
           $('#tabla_user').DataTable({

            dom: "<'row'<'col-sm-12 mb-3 text-left'B>><'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 text-right'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

            buttons: [],
            language: {
            lengthMenu: "Mostrar _MENU_ registros",
            zeroRecords: "No se encontraron resultados",
            info:
                "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            sSearch: "Buscar:",
                oPaginate: {
                    sFirst: "Primero",
                    sLast: "Último",
                    sNext: "Siguiente",
                    sPrevious: "Anterior",
                    sProcessing: "Procesando...",
                },
            },

            "info": false,

           }).draw();
          });

        }).catch(error => {

           console.log(error);
        });
      },
    },
    
  }
</script>

<style lang="css" scoped>

</style>