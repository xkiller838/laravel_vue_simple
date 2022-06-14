require('./bootstrap');


import datatable from 'datatables.net-bs4'
require('datatables.net-buttons/js/dataTables.buttons')
require('datatables.net-buttons/js/buttons.html5')
import print from 'datatables.net-buttons/js/buttons.print'

window.Vue = require('vue');

//Import Sweetalert2
import Swal from 'sweetalert2';
window.Swal = Swal;



// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('location_index', require('./components/location/indexComponent.vue').default);

Vue.component('album_index', require('./components/album/indexComponent.vue').default);

Vue.component('role_index', require('./components/role/indexComponent.vue').default);

Vue.component('photo_index', require('./components/photo/indexComponent.vue').default);

Vue.component('photo_show', require('./components/photo/showComponent.vue').default);

Vue.component('member_index', require('./components/member/indexComponent.vue').default);

Vue.component('comment_index', require('./components/comment/indexComponent.vue').default);

Vue.component('user_index', require('./components/user/indexComponent.vue').default);

Vue.component('user_table', require('./components/user/index_tableComponent.vue').default);


const app = new Vue({
    el: '#app',
});