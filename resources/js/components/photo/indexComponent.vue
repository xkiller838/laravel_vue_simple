<template>
  <div class="row d-flex justify-content-center">

    <div class="col-12 col-sm-6 shadow-lg p-3">
      <h4 class="my-3 text-center">CREAR FOTO</h4>
      <div class="row">
        <div class="col-12 col-sm-6">
           <label for="album_id">Seleccione Album</label>
            <select class="custom-select" v-model="album_id" id="album_id">
              <option hidden selected>Seleccione </option>
              <option v-for="albun in album" :key="albun.id" v-bind:value="albun.id">{{albun.description}}</option>
            </select>
        </div>
        <div class="col-12 col-sm-6">
          <label for="album_id">Location</label>
          <select class="custom-select" v-model="location_id" id="album_id">
            <option hidden selected>Seleccione </option>
            <option v-for="locat in location" :key="locat.id" v-bind:value="locat.id">{{locat.name}}</option>
          </select>
        </div>
        
        <div class="col-12 col-sm-6 mt-2">
          <label for="album_id">Member</label>
          <select class="custom-select" v-model="member_id" id="album_id">
            <option hidden selected>Seleccione </option>
            <option v-for="mem in member" :key="mem.id" v-bind:value="mem.id">{{mem.name}}</option>
          </select>
        </div>

        <div class="col-12 col-sm-6 mt-2">
           <label for="titulo">Titulo</label>
          <input type="text" class="form-control"  id="titulo" v-model="title" placeholder="digita un nombre">
        </div>

        <div class="col-12 col-sm-12 mt-2">
          <label for="descripcion">Description</label>
          <textarea class="form-control"  v-model="description" id="descripcion" cols="50" rows="3"></textarea>
        </div>

        <div class="col-12 col-sm-6 mt-2">
          <label for="privacidad">Privacidad</label>
          <input type="text" class="form-control"  id="privacidad" v-model="privacy" placeholder="digita un nombre">
        </div>

        <div class="col-12 col-sm-6 mt-2">
          <label for="meeting-time">Fecha y Hora</label>
          <input type="datetime-local" class="form-control" v-model="uploaddate"  id="meeting-time" >
        </div>

        <div class="col-12 col-sm-6 mt-2">
          <label for="view">Vista</label>
          <input type="number" class="form-control"  id="view" v-model="view" placeholder="digita un nombre">
        </div>

        <div class="col-12 col-sm-6 mt-2">
          <label for="cargar_foto">Cargar Foto</label>
          <input type="file" name="files[]" multiple accept="image/*" class="form-control-file"  id="cargar_foto" @change="obtenerImagen">
        </div>

        <div class="col-12 mt-2">
          <label for="etiquetas">Etiqueta</label>
          <input-tag v-model="tags"></input-tag>
       </div>

        <div class="col-12 mt-4 text-center">
          <button type="button" class="btn btn-primary" @click="guardar()">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import InputTag from 'vue-input-tag'
  export default {
  components: {
      InputTag,
    },
    data() {
      return {
        album_id: "",
        location_id:"",
        member_id:"",
        title:"",
        description:"",
        privacy:"",
        uploaddate:"",
        view:"",
        imagepath:[],
        album:[],
        location:[],
        member:[],

        tag: '',
        tags: [],
      }
    },

    mounted () {
      this.get_select_album();
      this.get_select_location();
      this.get_select_member();
    },

    methods: {
     obtenerImagen(e){
        this.imagepath = e.target.files[0];
      },

      guardar(){
        const formdata = new FormData();
        formdata.append('album_id',this.album_id);
        formdata.append('location_id',this.location_id);
        formdata.append('member_id',this.member_id);
        formdata.append('title',this.title);
        formdata.append('description',this.description);
        formdata.append('privacy',this.privacy);
        formdata.append('uploaddate',this.uploaddate);
        formdata.append('view',this.view);
        formdata.append('tags[]',JSON.stringify(this.tags));
        formdata.append('imagepath',this.imagepath);

        axios.post('/photo/store', formdata).then(result => {

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
         this.album_id = '';
         this.location_id = '';
         this.member_id = '';
         this.title = '';
         this.description = '';
         this.privacy = '';
         this.uploaddate = '';
         this.view = '';
         this.imagepath = [];
         this.tags = [];
      },
      
      get_select_album(){

        axios.get('/photo/select_album').then(result => {

          this.album = result.data;

        }).catch(error => {

            console.log(error);

        });

      },

      get_select_location(){

        axios.get('/photo/select_location').then(result => {

            this. location = result.data;

        }).catch(error => {

          console.log(error);
        });
      },

      get_select_member(){

         axios.get('/photo/select_member').then(result => {

            this. member = result.data;

        }).catch(error => {

          console.log(error);
        });

      }
    },
    
  }
</script>

<style lang="css" scoped>

</style>