<template>
  <div class="row d-flex justify-content-center">

    <div class="col-12 col-sm-6 shadow-lg">
      <h4 class="my-3 text-center"> LOCALIZACION</h4>
     <form>
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="email" class="form-control" id="nombre" v-model="name" placeholder="digita un nombre">
        </div>
        <div class="form-group">
          <label for="nombre_corto">Nombre Corto</label>
          <input type="text" class="form-control" id="nombre_corto" v-model="shortname" placeholder="digita un nombre corto">
        </div>
        <div class="form-group text-center">
             <button type="button" class="btn btn-primary" @click="guardar()">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        name: "",
        shortname:""
      }
    },
    methods: {
      guardar() {

        const formdata = new FormData();
        formdata.append('name',this.name);
        formdata.append('shortname',this.shortname);

        axios.post('/location/store', formdata).then(result => {

         Swal.fire(
            'DATOS DE LOCALIZACION GUARDADOS',
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
        this.name = '';
        this.shortname = '';
      }
    },
    
  }
</script>

<style lang="css" scoped>
  .b{
    border: 1px solid red;
  }
</style>