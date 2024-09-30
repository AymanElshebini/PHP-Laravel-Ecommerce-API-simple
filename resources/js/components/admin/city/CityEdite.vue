<template>
    
    <section class="main-form">
    <div class="container-fluid">
          <div class="card">
            <div class="card-header fw-bold">
              <span>
                <button type="button" class="btn btn-secondary  bg-dark btn-sm" @click="BackHome">
                  <i class="fa fa-times" aria-hidden="true"></i>
                </button>
              </span>
             تعديل المحافظات 
            </div>
            
              <!--bodyform-->
             <div class="form-contant">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">  المحافظة : </label>
                            <input type="text" :class="['form-control my-2' ,errors.name ?'is-invalid':'']" 
                            
                            id="name" placeholder="  أدخل المحافظة " name="name" v-model="form.name">
                            <small class="text-white p-1 rounded massege-error" v-if="errors.name">{{errors.name[0]}}</small>
                       
                        </div>
                      
                       
                    </div>

                   
                 

                  
                </div>
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-footer">
                        <button type="button" class="btn btn-save m-2" @click="UpdateForm">
                          حفظ
                          <i class="fa-regular fa-floppy-disk"></i>
                        </button>
                        <button type="button" class="btn btn-danger" @click="BackHome()">
                         الغاء
                          <i class="fa-solid fa-arrow-rotate-left"></i>
                        </button>
                      </div>
                    </div>
                    
                      
                  </div>
                </div>
             </div>

               <!--./bodyform-->
          
           

        </div>
      </div>
  
   
  </section>

  
  </template>
  
  <script>
  
  
  import Form from 'vform';
  
  export default {
  
    name:"CityEdite",
   
    data(){
        return{
           
          
            form: new Form({
                id: '',
                name: '',
              
            }),
          
          
            errors: [],
           
  
        }
    },
    methods: {
               
              
                   
                    ReloadPage() {
                this.$router.go()
            },
                    BackHome() {
                this.$router.push({
                    name: 'city'
                })
            },
  
          
      

        async EditForm() {
             let loader = this.$loading.show({
                color: 'orange',
            })
            await axios.get('/api/EditCity/' + this.$route.params.id).then((response) => {
                this.form = response.data
                loader.hide();
               // console.log(response.data)

            })

        },

  
        UpdateForm()
           {
            let formData = new FormData();
  
            formData.append("name", this.form.name);         
              axios.post('/api/UpdateCity/' + this.$route.params.id, formData)
                .then((response) => {
                    // console.log(res);
                    if (response.data.status == 'error') {
                        this.errors = response.data.errors
                    } else if (response.data.status == 200) {
                        Swal.fire({
                            title: 'تم الحفظ التعديل بنجاح',
                            text: "success",
                            icon: 'success',
                        });
                       
                        this.errors = []
                        this.form.name = ''
                        this.BackHome();
              
                     
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
           },
  
       
          
       
  
  
    },

    mounted() {
       this.EditForm();
           }
   
   
  
  }
  </script>
  