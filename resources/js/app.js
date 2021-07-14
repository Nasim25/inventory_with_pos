
require('./bootstrap');


import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

    import {routes} from './routers.js'
    const router = new VueRouter({
        routes,
        mode: 'history'
      })

   // Import User Class
        import User from './Helpers/User';
        window.User = User

//  import noty

        import Notification from './Helpers/Notification'
        window.Notification = Notification

// sweetaleart
        import Swal from 'sweetalert2'
        window.Swal = Swal;

        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        });

        window.Toast = Toast;
//  sweetalert end

const app = new Vue({
    el: '#app',
    router,
});
