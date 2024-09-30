<template>
  <div>
    <TopBarComponent></TopBarComponent>
    <section class="title">
     شاشه أدارة النظام 
    </section>

  <!--products-->
    <section class="dashboard">
      <div class="container">
        <div class="row">
          <!--users-->
          <div class="col-sm-12 col-md-2 dashboard-box">
            <router-link to="/users"  title="Menu">
              <div class="text-center">
                <i class="fa fa-user fa-4x">

                </i>
                <h5> مستخدمين </h5>
                <span><b>{{ countUsers }}</b></span>
              </div>
            </router-link>
          </div>
        
          <div class="col-sm-12 col-md-2 dashboard-box">
           
            <router-link to="/category"  title="Menu">
              <div class="text-center">
                <i class="fa-solid fa-wind fa-4x"></i>
             
                <h5> الاقسام </h5>
                <span><b>{{ countCategory }}</b></span>
            </div>
          </router-link>
        
        </div>
        <!--city-->
        <div class="col-sm-12 col-md-2 dashboard-box">
           
          <router-link to="/city"  title="Menu">
            <div class="text-center">
              <i class="fa-solid fa-location-dot fa-4x"></i>
          
           
              <h5> المحافظات </h5>
              <span><b>{{ countCity }}</b></span>
          </div>
        </router-link>
      
        </div>
        <!--supliers-->
        <div class="col-sm-12 col-md-2 dashboard-box">
           
          <router-link to="/supplier"  title="Menu">
            <div class="text-center">
              <i class="fa-solid fa-truck-fast fa-4x"></i>
          
           
            <h5> الموردين</h5>
            <span><b>{{ CountSuppliers }}</b></span>
          </div>
        </router-link>
      
        </div>
         <!--prodacts-->
         <div class="col-sm-12 col-md-2 dashboard-box">
           
          <router-link to="/Products"  title="Menu">
            <div class="text-center">
              <i class="fa-solid fa-layer-group fa-4x"></i>
            
           
            <h5> المنتجات</h5>
            <span><b>{{ CountProduct }}</b></span>
          </div>
        </router-link>
      
        </div>
          <!--orders-->
          <div class="col-sm-12 col-md-2 dashboard-box">
           
            <router-link to="/Orders"  title="Menu">
              <div class="text-center">
                <i class="fa-solid fa-cart-shopping fa-4x"></i>
           
             
              <h5>الطلبيات</h5>
              <span><b>{{ countOrder }}</b></span>
            </div>
          </router-link>
        
          </div>
           <!--Seo-->
           <div class="col-sm-12 col-md-2 dashboard-box">
           
            <router-link to="/Cmstags"  title="Menu">
              <div class="text-center">
               
                <i class="fa-solid fa-landmark fa-4x"></i>
             
              <h5> SEO</h5>
              <span><b>{{ countCmstag }}</b></span>
            </div>
          </router-link>
        
          </div>
      </div>
      </div>
    </section>
  <!--./products-->
  </div>
  
</template>

<script>
import TopBarComponent from '../layout/TopBarComponent.vue'
export default {
  name: "dashboard",
  data() {
    return {
      countUsers: {},
      countCategory: {},
      countCity: {},
      CountSuppliers: {},
      CountProduct: {},
      countCmstag: {},
      countOrder:{},


    }
  },
  components: {
    TopBarComponent,

  },

  methods: {

/* -( Show Count Category )--------------------------- */
      async showcountCategory() {
        await axios.get('api/countCategory').then(response => {
          this.countCategory = response.data
        })
      },

/* -( Show Count city )------- */
    async ShowCountCity() {
      await axios.get('api/CountCity').then(response => {
        this.countCity = response.data
      })
    },
/*-( Show Count User )------- */
    async ShowCountUser() {
      await axios.get('api/countUsers').then(response => {
        this.countUsers = response.data
      })
    },
/*-( Show Count Supplier )------- */
    async ShowCountSuppliers() {
      await axios.get('api/CountSuppliers').then(response => {
        this.CountSuppliers = response.data
      })

    },
    /* -------( Show Count Prodact )------- */
    async ShowCountProdact() {

      await axios.get('api/CountProduct').then(response => {
        this.CountProduct = response.data
      })
    },
    /* -------( Show Count SEO )------- */
    async showcountCmstag() {

      await axios.get('api/countCmstag').then(response => {
        this.countCmstag = response.data
      })
    },


     /* -------( Show Count Order )------- */
     async showcountOrder() {

await axios.get('api/CountOrder').then(response => {
  this.countOrder = response.data
})
},







  },





  created() {
    if (window.Laravel.user) {
      this.name = window.Laravel.user.name
    }
  },
  mounted() {

    this.ShowCountCity();
    this.showcountCategory();
    this.ShowCountUser();
    this.ShowCountSuppliers();
     this.ShowCountProdact();
    this.showcountCmstag();
    this.showcountOrder();


  },

  beforeRouteEnter(to, from, next) {
    if (!window.Laravel.isLoggedin) {
      window.location.href = "/";
    }
    next();
  }




}

</script>