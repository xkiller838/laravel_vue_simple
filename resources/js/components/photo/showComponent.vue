<template>
    <div class="row d-flex d-flex flex-row">
        <div class="col-12 shadow-lg">
            <h4 class="my-3 text-center">TABLA FOTOS</h4>

            <div class="row">
              <div class="col-12 col-sm-4 my-4">
                  <select class="custom-select" id="album_id">
                    <option hidden selected>Seleccione </option>
                    <option>g</option>
                  </select>
              </div>
              <div class="col-12 col-sm-6 my-4">
                 <input type="text" class="form-control" >
              </div>
              <div class="col-12 col-sm-2 my-4">
                    <button type="button" class="btn btn-secondary ml-3 btn-sm pt-2">Buscar</button>
              </div>
            </div>
           <div class="col-12  p-0 mb-4">
            <table>
                <thead>
                    <tr>
                        <th scope="col">N<small>o</small></th>
                        <th scope="col"> Album  </th>
                        <th scope="col"> Location  </th>
                        <th scope="col"> Member </th>
                        <th scope="col"> Title</th>
                        <th scope="col"> Description </th>
                        <th scope="col"> Privacidad</th>
                        <th scope="col"> Fecha</th>
                        <th scope="col"> Vista  </th>
                        <th scope="col"> Imagen</th>

                        <th scope="col">
                            Accion
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="tp in tabla_photo" :key="tp.id">

                        <td data-label="Id" v-text="tp.id"></td>
                        <td data-label="Album" v-text="tp.albums.title"></td>
                        <td data-label="Location" v-text="tp.locations.name">JJ</td>
                        <td data-label="Member" v-text="tp.members.name">JJ</td>
                        <td data-label="Tile" v-text="tp.title">JJ</td>
                        <td data-label="Description" v-text="tp.description"></td>
                        <td data-label="Privacidad" v-text="tp.privacy"></td>
                        <td data-label="Fecha" v-text="tp.uploaddate"></td>
                        <td data-label="Vista" v-text="tp.view"></td>
                        <td data-label="Imagen" >
                          <div class="piture">
                             <img class="img-responsive" :src="tp.imagepath" >
                             </div>
                        </td>
                        <td data-label="Accion">

                             <a><button type="button" class="btn btn-info btn-sm">Editar</button></a>

                            <button type="button" class="btn btn-danger ml-3 btn-sm" @click="eliminar()">Eliminar</button>
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
      tabla_photo: []
    }
  },
  mounted () {
    this. get_table_photo();
  },
  methods: {
    get_table_photo(){
      axios.get('/photo/tabla_photos').then(result => {

        console.log(result.data);

        this.tabla_photo  =  result.data;

      }).catch(error => {

      console.log(error);
      });
    }
  },
};
</script>

<style lang="css" scoped>
.piture{
  height: 5em;
  width: 5em;
}

.piture img{
  height: 5em;
  width: 5em;
}
</style>
