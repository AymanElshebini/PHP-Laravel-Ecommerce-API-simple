<script setup>
import {ref} from 'vue';
const email =ref('');
const password =ref('');
const error =ref('');

const Login =()=>{
    if( email.value==='' || password.value=== '')
    {
       // alert('Please fill all fildes');
        Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "Something went wrong!",
  footer: '<a href="#">email and password null?</a>'
});

    }else {

    

      axios.get('/sanctum/csrf-cookie').then(response => {
                       axios.post('api/login', {
                        email:email.value,
                       password:password.value,
                       })
                       .then(response => {
                           if (response.data.success) {
                              localStorage.setItem('token',response.data.token)
                              Swal.fire({
                           title: 'تم تسجيل الدخول بنجاح',
                           text: "success",
                           icon: 'success',
                       });
                       window.location.href='/dashboard'
                              // this.$router.go('/dashboard')
                           } 
                           else {
                            alert(response.data.message)
                             //  this.error = response.data.message
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



</script>

<template>
   
     

 <section class="login ">
    <div class="container-fluid">
      <div class="row justify-content-center ">
        <div class="col-sm-4 col-sm-offset-4">
          <div class="card">
            <div class="card-header fw-bold">
              تسجيل دخول
            </div>
            <div class="card-body">
              <form class="form-body">
                <div class="mb-3">
                  <label for="email" class="form-label "> البريد الالكتروني : </label>
                
                    <input type="email" class="form-control" 
                    id="email" placeholder="name@example.com"
                    v-model="email"
                     name="email" required="" autofocus="" autocomplete="off">
              
                </div>
                <div class="mb-3">
               <label for="pwd" class="form-label"> كلمة المرور :</label>
            
                <input type="password" class="form-control" id="password"
                v-model="password"
                 placeholder="*******" required="" autocomplete="off" name="password">
             
            </div>
                <div class="form-group row mt-4">
                  <div class="text-center">
                    <div class="col-md-12">
                  <button class="btn btn-dark btn-lg w-100" type="button" @click="Login()">دخــول</button>
                 
                </div>
              </div>
            </div>
          </form>


              
             
             
                   
                  
             
          
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

