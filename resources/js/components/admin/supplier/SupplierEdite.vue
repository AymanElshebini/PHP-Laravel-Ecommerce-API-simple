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
              تعديل مورد
            </div>
            
              <!--bodyform-->
             <div class="form-contant">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name"> أسم المورد : </label>
                            <input type="text" :class="['form-control my-2' ,errors.name ?'is-invalid':'']" 
                             id="name" placeholder="اسم المورد " name="name" maxlength="50" v-model="form.name">
                           
                            <small class="text-white bg-danger p-1 rounded massege-error"
                              v-if="errors.name">{{errors.name[0]}}</small>
                        </div>
                        <div class="col-md-6">
                          <label for="company"> الشركة: </label>
                          <input type="text" :class="['form-control my-2' ,errors.company  ?'is-invalid':'']" 
                          id="company" maxlength="50" v-model="form.company"
                          placeholder=" أسم الشركة " name="company">
                          <small class="text-white bg-danger p-1 rounded massege-error"
                                v-if="errors.company">{{errors.company[0]}}</small>
                         
                        </div>
                        <div class="col-md-4">
                          <label for="cityid">المحافظة  :</label>
                          <select name="cityid"
                           :class="['form-select form-select-lg form-control',errors.cityid ?'is-invalid':'']"  
                            aria-label="Default select example" v-model="form.cityid">
                            <option selected value="">-- أختار المحافظة --</option>
                            <option v-for="item in City" 
                           :key="item.id" :value="item.id">{{item.name}}</option>
                          </select>
                          <small class="text-white bg-danger p-1
                 rounded massege-errorr" v-if="errors.cityid">
                 {{errors.cityid[0]}}</small>
                         
                       
                      </div>
                        <div class="col-md-4">
                          <label for="tel1">  رقم التليفون 1: </label>
                          <input type="text"
                          :class="['form-control my-2' ,errors.tel1 ?'is-invalid':'']" 
                          
                           id="tel1" placeholder=" رقم التليفون" name="tel1" maxlength="50" v-model="form.tel1">
                           <small class="text-white bg-danger p-1 rounded massege-error"
                              v-if="errors.tel1">{{errors.tel1[0]}}</small>
                         
                       
                      </div>
                      <div class="col-md-4">
                          <label for="tel2">  رقم التليفون 1: </label>
                          <input type="text"
                          :class="['form-control my-2' ,errors.tel2 ?'is-invalid':'']" 
                          
                           id="tel2" placeholder=" رقم التليفون" name="tel2" maxlength="50" v-model="form.tel2">
                           <small class="text-white bg-danger p-1 rounded massege-error"
                              v-if="errors.tel2">{{errors.tel1[0]}}</small>
                         
                       
                      </div>
                    <div class="col-md-12">
                      <label for="address"> عنوان المورد :</label>
                      <textarea :class="['form-control my-2' ,errors.address ?'is-invalid':'']" 
                       v-model="form.address"
                       placeholder="عنوان المورد " cols="5" rows="5" maxlength="255" name="address">

                    </textarea>
                    <small class="text-white bg-danger p-1 rounded massege-erro" v-if="errors.address">{{errors.address[0]}}</small>

                   
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
  
    name:"SupplierEdite",
   
    data(){
        return{
           
            City: {},
            form: new Form({
                id:'',
                name:'',
                company:'',
                cityid:'',
                tel1:'',
                tel2:'',
                address:'',
             
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
                    name: 'supplier'
                })
            },
  
      
        GetAllcity() {
            axios.get('/api/GetAllCity')
                .then(response => {
                    // handle success
                    this.City = response.data.data;

                    // console.log(response);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
        },

        async EditForm() {
             let loader = this.$loading.show({
                color: 'orange',
            })
            await axios.get('/api/EditSupplier/' + this.$route.params.id).then((response) => {
               this.form = response.data
                loader.hide();
               // console.log(response.data)

            })

        },
  
        UpdateForm()
           {
            let formData = new FormData();      
            formData.append("name", this.form.name);
            formData.append("company", this.form.company);
            formData.append("cityid", this.form.cityid);          
            formData.append("tel1", this.form.tel1);
            formData.append("tel2", this.form.tel2);
            formData.append("address", this.form.address);           
           
  
            axios.post('/api/UpdateSupplier/'+ this.$route.params.id, formData)
                .then((response) => {
                    // console.log(res);
                    if (response.data.status == 'error') {
                        this.errors = response.data.errors
                    } else if (response.data.status == 200) {
                        Swal.fire({
                            title: 'تم التعديل بنجاح',
                            text: "success",
                            icon: 'success',
                        });
                        
                       
                this.errors = []        
                this.form.name = '' 
                this.form.company=''
                this.form.cityid=''
                this.form.tel1=''
                this.form.tel2=''
                this.form.address=''
                this.BackHome()
                
              
                     
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
           },
  
       
  
       
  
     
    },
    mounted()
    {
        this.GetAllcity();
        this.EditForm();
    }
   
   
  
  }
  </script>
  