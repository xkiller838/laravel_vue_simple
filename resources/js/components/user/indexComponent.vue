<template>
      <div class="row d-flex d-flex flex-row">
        <div class="col-12 shadow-lg">
            <h4 class="my-3 text-center">USUARIOS</h4>

            <div class="row">
             
            </div>
           <div class="col-12  p-0 mb-4">
            <table>
                <thead>
                    <tr>
                        <th scope="col">N<small>o</small></th>
                        <th scope="col"> Name</th>
                        <th scope="col"> email </th>
                        <th scope="col"> Admin</th>
                        <th scope="col"> Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="u in user" :key="u.id">
                        <td data-label="Id" v-text="u.id"></td>
                        <td data-label="Name" v-text="u.name"></td>
                        <td data-label="Email" v-text="u.email"></td>
                        <td data-label="Admin">
                           <button type="button" v-if="u.is_admin == 1" class="btn btn-success ml-3 btn-sm" @click="admin(u.id)">Is admin</button>
                           <button type="button" v-else class="btn btn-danger ml-3 btn-sm" @click="no_admin(u.id)">No admin</button>
                        </td>
                        <td data-label="Estado" >
                          <button type="button" v-if="u.estado == 1" class="btn btn-success ml-3 btn-sm" @click="Activar(u.id)">Activo</button>
                          <button type="button" v-else class="btn btn-danger ml-3 btn-sm" @click="desactivar(u.id)">Inactivo</button>
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
        user: []
      }
    },

    mounted () {
      this.get_user();
    },

    methods: {
      get_user(){
        axios.get('/user/ver').then(result => {

          this.user = result.data;

        }).catch(error => {

           console.log(error);
        });
      },
      
      admin(id) {

       const formdata = new FormData();
       formdata.append('id',id);

       axios.post('/user/no_admin', formdata).then(result => {

         Swal.fire(
            'USUARIO NO ADMINISTRADOR',
          );

          this.get_user();

        }).catch(error => {

          console.log(error);
        });     
      },


      no_admin(id){
       const formdata = new FormData();
       formdata.append('id',id);

       axios.post('/user/is_admin', formdata).then(result => {

         Swal.fire(
            'USUARIO ADMINISTRADOR',
          );

          this.get_user();

        }).catch(error => {

          console.log(error);
        });   
      },

      Activar(id){

      const formdata = new FormData();
       formdata.append('id',id);

       axios.post('/user/desactivar', formdata).then(result => {

         Swal.fire(
            'USUARIO ACTIVADO',
          );

          this.get_user();

        }).catch(error => {

          console.log(error);
        });
        

      },

      desactivar(id){
       const formdata = new FormData();
       formdata.append('id',id);

       axios.post('/user/activar', formdata).then(result => {

         Swal.fire(
            'USUARIO DESACTIVADO',
          );

          this.get_user();

        }).catch(error => {

          console.log(error);
        });
      }
    },
    
  }
</script>

<style lang="css" scoped>

</style>