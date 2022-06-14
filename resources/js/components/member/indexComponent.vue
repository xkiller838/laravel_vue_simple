<template>
    <div class="row d-flex justify-content-center">

    <div class="col-12 col-sm-6 shadow-lg">
      <h4 class="my-3 text-center">CREAR MEMBRECIA</h4>
     <form>
        <div class="form-group">
          <label for="rol">Seleccione Rol</label>
          <select class="custom-select" v-model="role_id" id="rol">
            <option hidden selected>Seleccione Rol</option>
            <option  v-for="role in roles" :key="role.id" v-bind:value="role.id">{{role.description}}</option>
          </select>
        </div>
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" id="nombre" v-model="name" placeholder="digita un nombre">
        </div>
         <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" v-model="email"  placeholder="digita email">
        </div>
        <div class="form-group">
          <label for="telefono">Numero Telefono</label>
          <input type="number" class="form-control" id="telefono" v-model="phonenum"  placeholder="digita un telefono">
        </div>
        <div class="form-group">
          <label for="direccion">Direccion</label>
          <input type="text" class="form-control" id="direccion" v-model="address"  placeholder="digita una direccion">
        </div>
         <div class="form-group">
          <label for="direccion">Password</label>
          <input type="password"  class="form-control" id="direccion" v-model="password"  placeholder="digita una contraseña">
        </div>
        <div class="form-group text-center my-2">
             <button type="button" class="btn btn-primary mt-2" @click="guardar()">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        role_id: "",
        email:"",
        name:"",
        phonenum:"",
        address:"",
        password:"",
        roles:[]
      }
    },

    mounted () {
      this.select_rol();
    },

    methods: {

      select_rol() {

        axios.get('/member/select').then(result => {
           
           this.roles = result.data;

        }).catch(error => {

            console.log(error);
        });
        
      },

      guardar(){

        const formdata = new FormData();
        formdata.append('role_id',this.role_id);
        formdata.append('email',this.email);
        formdata.append('name',this.name);
        formdata.append('phonenum',this.phonenum);
        formdata.append('address',this.address);
        formdata.append('password',this.password);

        axios.post('/member/store', formdata).then(result => {

          Swal.fire(
            'DATOS GUARDADOS',
          );

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

        limpiar(){
          
        this.role_id = '';
        this.name = '';
        this.email = '';
        this.phonenum = '';
        this.address = '';
        this.password= '';
      }
    },
    
  }
</script>

<style lang="css" scoped>

</style>