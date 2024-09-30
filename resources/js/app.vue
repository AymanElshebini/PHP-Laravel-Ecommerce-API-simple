<template>

       
    <main>
    
        <router-view></router-view>
    <a id="scrollUp" href="#top" class="scrollUp">
  <i class="fa fa-angle-up">

  </i></a>
    </main>



    <footer class="text-center  fixed-bottom">
<div class="container">
  <div class="row">
    <div class="col-md-12">
      Ayman El-sherbini
    </div>
  </div>
</div>
</footer>
  

</template>
<script>

export default {
    name: "app",
   
    data() {
        return {
            isLoggedIn: false,
            name: null,
        }
    },
  
    methods: {
       
   
},
beforeRouteEnter(to, from, next) {
    if (!window.Laravel.isLoggedin) {
        window.location.href = "/";
    }
    next();
}
  
}


</script>