<template>

<header>
<!--navbar-->
    <nav class="navbar navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand">
          <i class="fa fa-bookmark" aria-hidden="true">

          </i>
          Admin
    
        
        </a>
        <div class="logout">
          <a href="#" @click="logout">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            خروج {{ name }}
           </a>
        </div>
       
      </div>
    </nav>
<!--./navbar-->
<router-view></router-view>
  </header>

</template>

<script>

export default {
        name: "TopBarComponent",
        data() {
            return {
                isLoggedIn: false,
                name: null,
            }
        },
        methods: {
            logout(e) {
                e.preventDefault()
                this.$axios.get('/sanctum/csrf-cookie').then(response => {
                    this.$axios.post('api/logout')
                    .then(response => {
                        if(response.data.success) {
                            localStorage.removeItem('token')
                            window.location.href = "/"
                        } else {
                            console.log(response);
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
                })
            }
        },
        created() {
            if (window.Laravel.user) {
            this.name = window.Laravel.user.name
        }
            if (window.Laravel.isLoggedin) {
                this.isLoggedIn = true
            }
        },
        
         /*
        beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
    */

      
    }
</script>