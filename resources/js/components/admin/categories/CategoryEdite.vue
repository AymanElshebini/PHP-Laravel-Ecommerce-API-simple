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
             تعديل قسم 
            </div>
            
              <!--bodyform-->
             <div class="form-contant">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name"> القسم : </label>
                            <input type="text"
                            :class="['form-control my-2' ,errors.name ?'is-invalid':'']" 

                              id="name" placeholder="أدخل أسم القسم " name="name" v-model="form.name">
                              <small class="text-white p-1 rounded massege-error" v-if="errors.name">{{errors.name[0]}}</small>
                          
                        </div>
                      
                        <div class="col-md-6">
                          <label for="meta_keywords"> Meta keywords :</label>
                          <textarea  class="form-control" placeholder="Meta keywords" 
                          :class="['form-control my-2' ,errors.meta_keywords ?'is-invalid':'']" 
                          v-model="form.meta_keywords"
                         cols="5" rows="5" maxlength="255" name="meta_keywords">
    
                        </textarea>
                        <small class="text-white  p-1 rounded massege-error" v-if="errors.name">{{errors.meta_keywords[0]}}</small>
                     
                      </div>
                        <div class="col-md-6">
                          <label for="pwd">Meta Description :</label>
                          <textarea class="form-control"
                          :class="['form-control my-2' ,errors.meta_description ?'is-invalid':'']" 
                          v-model="form.meta_description"
                          
                          placeholder="Meta Description" cols="5" rows="5" maxlength="255" name="meta_description">
    
                        </textarea>
                        <small class="text-white  p-1 rounded massege-error" v-if="errors.meta_description">{{errors.meta_description[0]}}</small>
                       
                      </div>
                    </div>
             <!--image uploads -->
                    <div class="row mt-4">

                     
                     <div class="col-md-12 text-center">
                        <img class="rounded" :src ="form.imgpath" alt="cat" v-if="seenImage">
                    </div>

                     <div v-if="!form.imgpath">
                        <input class="form-control form-control-lg" id="formFileLg" type="file" name="imgpath" @change='onFileChange'>
                        <small class="text-white  p-1 rounded massege-error" v-if="errors.imgpath">{{errors.imgpath[0]}}</small>
                    
                     </div>
                     <div class="mb-3 mt-4 text-center" v-else>
                       <button type="button" class="btn btn-warning mt-2" @click="RemoveImage">تغير الصورة</button>
                      </div>

                      <div class="col-md-12 text-center">
                        <img v-bind:src="imagePreview ==null ? form.imgpath :imagePreview"  v-show="showPreview">
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
  
    name:"CategoryEdite",
   
    data(){
        return{
           
          
            /** images */
            imagePreview: null,
            imageUpdateMode: false,
            showPreview: false,// hiden and show imags 
            seenImage:true, //hiden image in edit
             /** ./images */
            form: new Form({
                id: '',
                name: '',
                imgpath: '',
                meta_keywords:'',
                meta_description:'',
  
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
                    name: 'category'
                })
            },
  
            RemoveImage() {
            this.imageUpdateMode = false;
            this.form.imgpath = '';
            this.imagePreview=null;
            this.seenImage=false;
        },
        onFileChange(event) {
            /*
            Set the local file variable to what the user has selected.
            */
            this.form.imgpath = event.target.files[0];
  
            /*
            Initialize a File Reader object
            */
            let reader = new FileReader();
  
            /*
            Add an event listener to the reader that when the file
            has been loaded, we flag the show preview as true and set the
            image to be what was read from the reader.
            */
            reader.addEventListener("load", function () {
                this.showPreview = true;
                this.imagePreview = reader.result;
            }.bind(this), false);
  
            /*
            Check to see if the file is not empty.
            */
            if (this.form.imgpath) {
                /*
                    Ensure the file is an image file.
                */
                if (/\.(jpe?g|png|gif)$/i.test(this.form.imgpath.name)) {
  
                    console.log("here");
                    /*
                    Fire the readAsDataURL method which will read the file in and
                    upon completion fire a 'load' event which we will listen to and
                    display the image in the preview.
                    */
                    reader.readAsDataURL(this.form.imgpath);
                }
            }
        },


        async EditForm() {
             let loader = this.$loading.show({
                color: 'orange',
            })
            await axios.get('/api/EditCatogory/' + this.$route.params.id).then((response) => {
                this.form = response.data
                loader.hide();
               // console.log(response.data)

            })

        },

  
        UpdateForm()
           {
            let formData = new FormData();
  
            formData.append("name", this.form.name);
            formData.append("meta_keywords", this.form.meta_keywords);
            formData.append("meta_description", this.form.meta_description);
            formData.append("imgpath", this.form.imgpath);
  
            axios.post('/api/UpdateCatogery/' + this.$route.params.id, formData)
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
                this.form.meta_keywords=''
                this.form.meta_description=''
                this.RemoveImage();
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
  