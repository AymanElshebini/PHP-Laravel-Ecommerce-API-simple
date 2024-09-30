<template>
    
    <div class="container-fluid">
       
  <div class="card mainpage">
  <!--card-header-->
  <div class="card-header">
      <div class="pull-right">
         
        <span><button type="button" class="btn btn-secondary  bg-dark btn-sm" @click="BackHome">
            <i class="fa fa-times" aria-hidden="true"></i></button></span>
  
تعديل  seo 
      </div>
    
  
  
  </div>
  <!--card-body-->
  <div class="card-body">
    <div class="container-fluid">
        <div class="row form-body">
            <div class="col-md-6">
               
               <label for="url_page"> لينك الصفحة : </label>
               <input type="text" :class="['form-control my-2' ,errors.url_page ?'is-invalid':'']" 
                id="url_page"
                placeholder=" أدخل لينك الصفحة " name="url_page" v-model="form.url_page">
                <small class="text-white bg-danger p-1 rounded massageerror" v-if="errors.url_page">{{errors.url_page[0]}}</small>
            
             </div>
             <div class="col-md-6">
               
               <label for="meta_title"> Meta Title : </label>
               <input type="text"  :class="['form-control my-2' ,errors.meta_title ?'is-invalid':'']" 
               id="meta_title" placeholder="Meta Title" name="meta_title" maxlength="50" v-model="form.meta_title">
               <small class="text-white bg-danger p-1 rounded massageerror" v-if="errors.meta_title">{{errors.meta_title[0]}}</small>
         
             </div>
             <div class="col-md-6">
                <label for="meta_keywords"> Meta keywords :</label>
                <textarea class="form-control" placeholder="Meta keywords" 
                :class="['form-control my-2' ,errors.meta_keywords ?'is-invalid':'']" 
                v-model="form.meta_keywords"
                cols="5" rows="5" maxlength="255" name="meta_keywords">
    
                </textarea>
                <small class="text-white bg-danger p-1 rounded massageerror" v-if="errors.meta_keywords">{{errors.meta_keywords[0]}}</small>
                </div>
                <div class="col-md-6">
                    <label for="pwd">Meta Description :</label>
    
                <textarea class="form-control" placeholder="Meta Description" 
                :class="['form-control my-2' ,errors.meta_description ?'is-invalid':'']" 
                v-model="form.meta_description"
                cols="5" rows="5" maxlength="255" name="meta_description">
    
                </textarea>
                <small class="text-white bg-danger p-1 rounded massageerror" v-if="errors.meta_description">{{errors.meta_description[0]}}</small>
                    </div>
           

               <div class="col-md-12">
                <div class="form-group col-md-6 col-md-12 text-center buttons-container m-2 b-2">
                        <button type="button" class="btn bg-warning m-2" @click="UpdateForm">
                            حفـظ
                          <i class="fa fa-pencil mr-1" aria-hidden="true"></i>
                        </button>

                        <button type="button" class="btn btn-danger" @click="BackHome()">
                            الغاء
                            <i class="fa fa-undo" aria-hidden="true"></i>
                        </button>

                    </div>
                </div>

        </div>
    </div>
   
  
      
        </div>
  
   
       
    
   
  
       
  
  
  
  </div>
  
  
  

  
        
        
  </div>
  
  </template>
  
  <script>
  
  
  import Form from 'vform';
  
  export default {
  
    name:"cmstagedite",
   
    data(){
        return{
           
                    
            form: new Form({
                id: '',
                url_page: '',
                meta_title:'',
                meta_keywords:'',
                meta_description:'',
              
  
            }),
                     
            errors: [],
           
  
        }
    },
    methods:{

        
        ReloadPage() {
                this.$router.go()
            },
                    BackHome() {
                this.$router.push({
                    name: 'cmstags'
                })
            },
        

           async EditForm() {
             let loader = this.$loading.show({
                color: 'orange',
            })
            await axios.get('/api/EditCmstag/'+ this.$route.params.id)
            .then((response) => {
                this.form = response.data
                loader.hide();
             //  console.log(response.data)

            })

        },
        UpdateForm()
           {
            let formData = new FormData();
  
            formData.append("url_page", this.form.url_page);
            formData.append("meta_title", this.form.meta_title);
            formData.append("meta_keywords", this.form.meta_keywords);
            formData.append("meta_description", this.form.meta_description);
 
        
  
            axios.post('/api/UpdateCmstag/' + this.$route.params.id, formData)
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
                    
                   this.form.url_page = ''
                   this.form.meta_title=''
                   this.form.meta_keywords=''
                   this.form.meta_description=''
             
                
                     
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
           },
  
            
  
  
    },
   
  




    mounted() {
       this.EditForm();
           },
 
   
   
   
  

  
  }
  </script>
  