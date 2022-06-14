<template>
    <div class="row" >
        <div class="col-12 col-sm-5 col-md-2" v-for="ip in img_photo" :key="ip.id">
            <div class="card">
                <img :src="ip.imagepath"  >
                <div class="card-body p-0">
                    <div class="row p-0">
                      
                      <div class="col-12">
                        <label for="meeting-time">Fecha y Hora</label>
                        <input type="datetime-local" v-model="ip.postdate" class="form-control"  id="meeting-time" >
                      </div>
                       <div class="col-12">
                        <label for="view">Comentario</label>
                        <textarea class="form-control" v-model="ip.content"  id="" cols="10" rows="3"></textarea>
                      </div>
                       
                      <div class="col-12 text-center">
                        <button type="button" class="btn btn-primary" @click="guardar(ip)">Guardar</button>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      img_photo: []
    }
  },

  mounted () {
    this.get_img_photo();
  },

  methods: {

    guardar(ip){
      const formdata = new FormData();
      formdata.append('photo_id', ip.id);
      formdata.append('postdate',ip.postdate);
      formdata.append('content',ip.content);
      
      axios.post('/comment/store', formdata).then(result => {

         Swal.fire(
            'DATOS  GUARDADOS',
          );

          this.limpiar(ip);

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

    get_img_photo() {

      axios.get('/comment/img').then(result => {

        this.img_photo = result.data;

      }).catch(error => {
         console.log(error);
      });
      
    },

    limpiar(ip){
      ip.postdate = '';
      ip.content = '';
    }
  },
};
</script>

<style lang="css" scoped></style>
