<template>
    <div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div v-if="error !==null" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                
                    <strong>{{ error }}</strong> 
                </div>
                <div class="card card-default">
                    <div class="card-header">
                        <h5>
                            login
                        </h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group row ">
                                <label for="email" > البريد الالكتروني : </label>
                                <div class="col-md-8">
                                    <input type="email" class="form-control" id="email" placeholder="أدخل البريد الالكتروني" v-model="email" name="email"
               required autofocus autocomplete="off"> 
               <small class="text-white p-1 rounded massege-error" v-if="errors.email">{{errors.email[0]}}</small>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label for="pwd"> كلمة المرور :</label>
                                <div class="col-md-8">
                                    <input type="password" class="form-control" id="password" placeholder="أدخل كلمة المرور" 
              required autocomplete="off" 
              
              v-model="password" name="password">
                                </div>
                            </div>
                            <div class="form-group row ">
                              
                                <div class="col-md-8 offset-md-4">
                                    <button type="button" class="btn btn-warning btn-lg" @click="handleSubmit"> دخول</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default{
    name:"login",
    data() {
            return {
                email: '',
                password: '',
                errors: [],
            }
        },

        methods: {
            handleSubmit(e) {
                e.preventDefault()
                if(this.password.length > 0) {
                    this.$axios.get('/sanctum/csrf-cookie').then(response => {
                        this.$axios.post('api/login', {
                            email: this.email,
                            password: this.password
                        })
                        .then(response => {
                            if (response.data.success) {
                               localStorage.setItem('token',response.data.token)
                               Swal.fire({
                            title: 'تم تسجيل الدخول بنجاح',
                            text: "success",
                            icon: 'success',
                        });
                                this.$router.go('/dashboard')
                            } 
                            else {
                                this.error = response.data.message
                                Swal.fire({
                            title: 'OPPS',
                            text: "خطاء ",
                            icon: 'warning',
                        });
                                
                            }
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
                    })
                }
            }
        },
   
        beforeRouteEnter(to, from, next) {
            if (window.Laravel.isLoggedin) {
                return next('dashboard');
            }
            next();
        }
    
    


}

</script>