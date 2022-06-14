<template>
    <div class="row d-flex d-flex flex-row">
        <div class="col-12 col-sm-6 b shadow-lg">
            <h4 class="my-3 text-center">CREAR ROL</h4>
            <form>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input  type="email"  class="form-control" id="nombre" v-model="description"  placeholder="digita un nombre" />
                </div>
                <div class="form-group text-center">
                    <button  type="button" class="btn btn-primary" @click="guardar()"> Guardar
                    </button>
                </div>
            </form>
        </div>
        <div class="col-12 col-sm-6 b p-0 scroll">
            <table>
                <thead>
                    <tr>
                        <th scope="col">N<small>o</small></th>
                        <th scope="col">
                            Rol
                        </th>

                        <th scope="col">
                            Accion
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="role in roles" :key="role.id">

                        <td data-label="Id" v-text="role.id"></td>

                        <td data-label="Rol" v-text="role.description"></td>

                        <td data-label="Accion">

                            <!-- <a><button type="button" class="btn btn-info btn-sm">Editar</button></a> -->

                            <button type="button" class="btn btn-danger ml-3 btn-sm" @click="eliminar(role.id)">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            description: "",
            roles: []
        };
    },

    mounted () {
      this.get_role();
    },

    methods: {
        guardar() {
          const formdata = new FormData();
          formdata.append('description',this.description);

          axios.post('/role/store', formdata).then(result => {

                Swal.fire(
                  'DATOS DE LOCALIZACION GUARDADOS',
                );

              this.get_role();
              this.limpiar();

            }).catch(error => {

               let data = error.response.data.errors;

                 $.each(data, function(i, item) {

                 Swal.fire({
                    html: "<strong>"+item+"</strong>",
                    timer: 3500,
                    type: 'error'
                  })

              });
            });
        },

        get_role(){

          axios.get('/role/show').then(result => {

               this.roles =  result.data;

          }).catch(error => {

               console.log(error);
          });

        },

        eliminar(id){

            Swal.fire({
                title: 'Esta seguro que desea eliminar',
                text: "Una vez eliminado no podra verlo de nuevo",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar'
                }).then((result) => {
                if (result.isConfirmed) {
                let me = this;
                axios.post('/role/delete', {
                'id': id
                }).then(function (response) {

                me.get_role();

                 Swal.fire(
                    'Elimina!',
                    'Dato eliminado.',
                    'success'
                    )                 

                }).catch(function (error) {
                console.log(error);
                });

                }
                })

            

            
            

        },

         limpiar(){
          this.description = '';
         }
    }
};
</script>

<style lang="css" scoped>

.b {
    border: 1px solid red;
}
/* control del scroll  de comentarios*/
.scroll {
    height: 15em;
    overflow-y: scroll;
    overflow-x: hidden;
}

.scroll::-webkit-scrollbar {
    width: 6px;
    overflow: auto
}

.scroll::-webkit-scrollbar-thumb {
    background-color: #000;
    border-radius: 5px;
    overflow: auto;
    border: 1px solid #fff;
}

/*fin control scroll de comentarios*/
</style>
