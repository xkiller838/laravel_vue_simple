<template>
   <div class="row d-flex justify-content-center">

    <div class="col-12 col-sm-6 shadow-lg">
      <h4 class="my-3 text-center">CREAR ALBUM</h4>
     <form>
        <div class="form-group">
          <label for="title">Titulo Album</label>
          <input type="email" class="form-control" id="title" v-model="title" placeholder="digita un nombre">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <input type="text" class="form-control" id="description" v-model="description" placeholder="digita un nombre corto">
        </div>
        <div class="form-group text-center">
             <button type="button" class="btn btn-primary" @click="guardar()">Guardar</button>
             <button type="button" class="btn btn-secondary">Albums Creados</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        title: "",
        description:""
      }
    },

    methods: {
      guardar() {
        const formdata = new FormData();
        formdata.append('title',this.title);
        formdata.append('description',this.description);

        axios.post('/album/store', formdata).then(result => {

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
        this.title = '';
        this.description = '';
      }
    },
    
  }
</script>

<style lang="css" scoped>

</style>