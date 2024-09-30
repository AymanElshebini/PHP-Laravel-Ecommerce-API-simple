
import {createWebHistory, createRouter} from "vue-router";
import Home from '../components/pages/Home.vue';
import Login from '../components/pages/Login.vue';
import Dashboard from '../components/pages/Dashboard.vue';
import Users from '../components/admin/users/Users.vue';
import UsersAdd from '../components/admin/users/UsersAdd.vue';
import UsersEdite from '../components/admin/users/UsersEdite.vue';
import notFound from '../components/notFound.vue';
/**---------Catogery------------ */
import Category from '../components/admin/categories/Category.vue';
import CategoryAdd from '../components/admin/categories/CategoryAdd.vue';
import CategoryEdit from '../components/admin/categories/CategoryEdite.vue';
import CategoryShow from '../components/admin/categories/CategoryShow.vue';
/**---------./Catogery------------ */
/**---------City------------------- */
import City from '../components/admin/city/City.vue';
import CityAdd from '../components/admin/city/CityAdd.vue';
import CityEdite from '../components/admin/city/CityEdite.vue';
/**--------./City------------------- */

/**---------Supplier------------------- */
import Supplier from '../components/admin/supplier/Supplier.vue';
import SupplierAdd from '../components/admin/supplier/SupplierAdd.vue';
import SupplierEdite from '../components/admin/supplier/SupplierEdite.vue';
import SupplierShow from '../components/admin/supplier/SupplierShow.vue';
/**--------./Supplier------------------- */

/**---------Products------------------- */
import Products from '../components/admin/product/Products.vue';
import ProductAdd from '../components/admin/product/ProductAdd.vue';
import ProductEdite from '../components/admin/product/ProductEdite.vue';
import ProductShow from '../components/admin/product/ProductShow.vue';
/**---------./Products------------------- */
/**---------Products images------------------- */
import ProductImageAdd from '../components/admin/product/ProductImageAdd.vue';
/**---------Products images------------------- */
/**---------Orders------------------- */
import Orders from '../components/admin/order/Orders.vue';
import OrderShow from '../components/admin/order/OrderShow.vue';
/**---------./Orders------------------- */
/**---------Cmstags------------------- */
import Cmstags from '../components/admin/cmstags/Cmstags.vue';
import CmstagAdd from '../components/admin/cmstags/CmstagAdd.vue';
import CmstagEdite from '../components/admin/cmstags/CmstagEdite.vue';
/**---------./Cmstags------------------- */



export const routes = [
   {name:'Home',path:'/',component:Home,meta:{requiresAuth:false}},
    {name: 'login',path: '/login',component: Login,meta:{requiresAuth:false}}, 
    {name:'dashboard',path: '/Dashboard',component: Dashboard,meta:{requiresAuth:true}},
    {name:'users',path:'/Users',component:Users,meta:{requiresAuth:false}},
    {name:'usersadd',path:'/UsersAdd',component:UsersAdd,meta:{requiresAuth:false}},
    {name:'usersedite',path:'/UsersEdite/:id',component:UsersEdite,meta:{requiresAuth:false}},

     {name:'category',path:'/Category',component:Category,meta:{requiresAuth:false}},
    {name:'categoryadd',path:'/CategoryAdd',component:CategoryAdd,meta:{requiresAuth:false}},
    {name:'categoryedit',path:'/CategoryEdit/:id',component:CategoryEdit,meta:{requiresAuth:false}},
    {name:'CategoryShow',path:'/CategoryShow/:id',component:CategoryShow,meta:{requiresAuth:false}},

   
    {name:'city',path:'/City',component:City,meta:{requiresAuth:false}},
    {name:'cityadd',path:'/CityAdd',component:CityAdd,meta:{requiresAuth:false}},
    {name:'citydit',path:'/CityEdit/:id',component:CityEdite,meta:{requiresAuth:false}},

    {name:'supplier',path:'/Supplier',component:Supplier,meta:{requiresAuth:false}},
    {name:'supplieradd',path:'/SupplierAdd',component:SupplierAdd,meta:{requiresAuth:false}},
    {name:'supplieredite',path:'/SupplierEdite/:id',component:SupplierEdite,meta:{requiresAuth:false}},
    {name:'suppliershow',path:'/SupplierShow/:id',component:SupplierShow,meta:{requiresAuth:false}},

    {name:'products',path:'/Products',component:Products,meta:{requiresAuth:false}},
    {name:'productadd',path:'/ProductAdd',component:ProductAdd,meta:{requiresAuth:false}},
    {name:'productedite',path:'/ProductEdite/:id',component:ProductEdite,meta:{requiresAuth:false}},
    {name:'ProductShow',path:'/ProductShow/:id',component:ProductShow,meta:{requiresAuth:false}},
    {name:'ProductImageAdd',path:'/ProductImageAdd',component:ProductImageAdd,meta:{requiresAuth:false}},
    
    {name:'orders',path:'/Orders',component:Orders,meta:{requiresAuth:false}},

    {name:'ordershow',path:'/OrderShow/:id',component:OrderShow,meta:{requiresAuth:false}},


    {name:'cmstags',path:'/Cmstags',component:Cmstags,meta:{requiresAuth:false}},
    {name:'cmstagadd',path:'/CmstagAdd',component:CmstagAdd,meta:{requiresAuth:false}},
    {name:'cmstagedite',path:'/CmstagEdite/:id',component:CmstagEdite,meta:{requiresAuth:false}},
    
  

    {
        path:'/:pathMatch(.*)*',
        component:notFound
    },

  
  
    
   
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});


 /*
router.beforeEach((to, from, next)=> {

    const authenticatedUser = null;
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);

    // Check for protected route
    if (requiresAuth && ! authenticatedUser) next('/dashboard')
    else next();
   
    if(to.meta.requiresAuth )
    {
          return {name:'login'}
    }
   
    if(to.meta.requiresAuth == false && !localStorage.setItem('token'))
    {
          return {name:'dashboard'}
    }
  
    if (!window.Laravel.isLoggedin) {
        window.location.href = "/";
    }


   
})
    */

export default router;