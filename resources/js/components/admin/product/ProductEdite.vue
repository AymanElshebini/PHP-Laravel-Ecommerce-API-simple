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
         تعديل منتج 
            </div>
            
              <!--bodyform-->
             <div class="form-contant">
                <div class="container">
                   <div class="row">
                    <!--code -->
                    <div class="col-md-2">
                      <label for="code"> code: </label>
                      <input type="text"
                      :class="['form-control my-2',errors.code ?'is-invalid':'']" 
                      id="code" placeholder=" أدخل الكود  " name="code" v-model="form.code">
                      <small class="text-white bg-danger p-1 rounded massege-error"
                 v-if="errors.code">{{errors.code[0]}}</small>
                  

                    </div>
                    <!--catogery -->
                    <div class="col-md-4">
                      <label for="categoryid"> القسم  :</label>
                      <select  :class="['form-select form-select-lg form-control'
                            ,errors.category_id ?'is-invalid':'']" 
                             aria-label="Default select example" v-model="form.categoryid">
                             <option selected value="">-- أختار القسم --</option>
                             <option v-for="item in categories" 
                            :key="item.id" :value="item.id">{{item.name}}</option>
                       
                      </select>
                      <small class="text-white bg-danger p-1
                    rounded  massege-error" v-if="errors.categoryid">
                    {{errors.categoryid[0]}}</small>
                 
                    </div>
                     <!--supliers -->
                    <div class="col-md-3">
                        <label for="supplierid">  المورد: </label>
                      <select  name="supplierid"
                      :class="['form-select form-select-lg form-control'
                       ,errors.supplierid ?'is-invalid':'']" 
                       aria-label="Default select example" v-model="form.supplierid">
                       <option selected value="">-- أختار المورد --</option>
                       <option v-for="item in suppliers" 
                       :key="item.id" :value="item.id">{{item.name}}
                    </option>
                      </select>
                      <small class="text-white bg-danger p-1
               rounded massege-error" v-if="errors.supplierid">
               {{errors.supplierid[0]}}</small>

              
                    </div>
                   
                       <!--prodact name-->
                    <div class="col-md-3">
                      <label for="name"> أسم المنتج : </label>
                      <input type="text" :class="['form-control my-2' ,errors.name ?'is-invalid':'']" 
                      id="name" placeholder=" أدخل  أسم المنتج  " name="name" maxlength="50" v-model="form.name">
                      <small class="text-white bg-danger p-1 rounded massege-error"
               v-if="errors.name">{{errors.name[0]}}</small>
                    
                    </div>
                     <!--purches price-->
                     <div class="col-md-3">
                      <label for="supplierprice"> سعر الشراء: </label>
                      <input type="text" :class="['form-control my-2' ,errors.supplierprice ?'is-invalid':'']" 
                       id="supplierprice" placeholder=" أدخل سعر الشراء  " name="supplierprice"
                        maxlength="50" v-model="form.supplierprice">
                        <small class="text-white bg-danger p-1 rounded massege-error" 
                        v-if="errors.supplierprice">{{errors.supplierprice[0]}}</small>
                    
                    </div>
                    <!--sell price-->
                    <div class="col-md-2">
                      <label for="pricesell"> سعر البيع: </label>
                      <input type="text"  :class="['form-control my-2' ,errors.pricesell  ?'is-invalid':'']" 
                       id="pricesell" placeholder=" أدخل سعر البيع  " name="pricesell" maxlength="50" v-model="form.pricesell">

                       <small class="text-white bg-danger p-1 rounded massege-error"
               v-if="errors.pricesell">{{errors.pricesell[0]}}</small>

                 
                    </div>
                  
                   
                
                    <!--offers price-->
                    <div class="col-md-2">
                      <label for="priceoffer"> سعر العرض : </label>
                      <input type="text" :class="['form-control my-2 bg-warning' ,errors.priceoffer  ?'is-invalid':'']" 
                      id="priceoffer"
                       placeholder=" أدخل  سعر العرض  " name="priceoffer"  maxlength="50" v-model="form.priceoffer">
                       <small class="text-white bg-danger p-1 rounded massege-error"
               v-if="errors.priceoffer">{{errors.priceoffer[0]}}</small>
                   
                    </div>
                        <!--quinity-->
                        <div class="col-md-2">
                      <label for="stock"> الكميه : </label>
                      <input type="text" class="form-control"
                      
                      id="nstock" placeholder=" أدخل  الكميه  " name="stock" maxlength="50" v-model="form.stock">

                      <small class="text-white bg-danger p-1 rounded massege-error"
               v-if="errors.stock">{{errors.stock[0]}}</small>
                     
                    </div>
                    <!--prodact decription-->
                    <div class="col-md-12">
                      <label for="fullDesc">وصف المنتج   :</label>

                      <vue-editor v-model="form.fullDesc" :class="['form-control my-2' ,errors.fullDesc ?'is-invalid':'']"/>
                      <small class="text-white bg-danger p-1 rounded  massege-error" v-if="errors.fullDesc">{{errors.fullDesc[0]}}</small>
                     

                    </div>
                    <hr>
                <!--image show -->
                    <div class="col-md-12" >
                        <div class="row">
                            <div class="image-disply">
                                <div class="card" style="width: 10rem;" v-for="item in ImagesProdact.data" :key="item.id">
  <img :src="item.imgpath" class="card-img-top" :alt="item.id">
  <div class="card-body text-center">
   <p class="card-text">{{stripTags(item.imgpath)}}</p>
   
   <button type="button" class="btn btn-danger btn-sm " @click="DeleteImage(item.id)">
                                   <i class="fa-solid fa-trash"></i>
                            </button> 
                        
   
  </div>
</div>
                            </div>
                          
                        </div>


                   

            
                    </div>
                   
                    <div class="row mt-4">
                        <div class="mb-3 mt-4 text-center">
                            <label for="imgpath"> image: </label>
                      <input class="form-control form-control-lg" id="formFileLg" type="file" name="imgpath"
                      
                      multiple  @change='onFileChange'>
                      <small class="text-white bg-danger p-1 rounded massege-error" v-if="errors.imgpath">{{errors.imgpath[0]}}</small>

                       <button type="button" class="btn btn-warning mt-2" @click="RemoveImage">تغير الصورة</button>
                      </div>
                    </div>

                      <div class="col-md-12 text-center"
                       v-for="image in form.imgpath" :key="image">
                        <img class="rounded img-fluid img-thumbnail" 
                        v-bind:src="form.imgpath[0]" width="200">
                      </div>
                     
                    
                     
                           <!--image uploads -->
                      <hr>
                    
                    <div class="col-md-6">
                      <label for="meta_keywords"> Meta keywords :</label>
                      <textarea class="form-control" placeholder="Meta keywords" 
                :class="['form-control my-2' ,errors.meta_keywords ?'is-invalid':'']" 
                v-model="form.meta_keywords"
                cols="5" rows="5" maxlength="500" name="meta_keywords">
    
                </textarea>
                <small class="text-white bg-danger p-1 rounded massege-error" v-if="errors.name">{{errors.meta_keywords[0]}}</small>

                   
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


              
             </div>

               <!--./bodyform-->
          
           

        </div>
  
  
   
  </section>


  </template>
  
  <script>
  
  
  import Form from 'vform';
  
  export default {
  
    name:"productedite",
   
    data(){
        return{
            ImagesProdact:{},
            files: [],
            categories: {},   
            suppliers: {},    
            /**----- (images) ------*/
            imagePreview: null,
            imageUpdateMode: false,
            showPreview: false,// hiden and show imags 
            seenImage:true, //hiden image in edit
                 /**----- (./images) ------*/
            form: new Form({
                id: '',
                code:'',
                supplierid:'',
                supplierprice: '0',
                categoryid:'',
                name: '',
                pricesell:'0',
                priceoffer:'0',
                stock:'0',
                fullDesc:'',
                meta_keywords:'',
                imgpath:[],
              
  
            }),
            search: '',
            errors: [],
           
  
        }
    },
    methods: {
        stripTags (text) {
            return text.replace("http://127.0.0.1:8000/uploads/product/", '');
        },
                    ReloadPage() {
                this.$router.go()
            },
            BackHome() {
                this.$router.push({
                    name: 'products'
                })
            },
            RemoveImage() {
            this.imageUpdateMode = false;
            this.form.imgpath = '';
            this.imagePreview=null;
        },
        onFileChange(event) {
            /*
            Set the local file variable to what the user has selected.
            */
         const files=  this.form.imgpath = event.target.files;
  
            /*
            Initialize a File Reader object
            */
            let reader = new FileReader();
  
            /*
            Add an event listener to the reader that when the file
            has been loaded, we flag the show preview as true and set the
            image to be what was read from the reader.
            */
           for(let i=0; i< files.length; i++)
           {
            reader.addEventListener("load", function () {
                this.showPreview = true;
                this.imagePreview = reader.result;
            }.bind(this), false);
            if (files) {
                /*
                    Ensure the file is an image file.
                */
                if (/\.(jpe?g|png|gif)$/i.test(files.name)) {
  
                    console.log("here");
                   
                    /*
                    Fire the readAsDataURL method which will read the file in and
                    upon completion fire a 'load' event which we will listen to and
                    display the image in the preview.
                    */
               
                }
            }

           }
           reader.readAsDataURL(files[i]);

          
            /*
            Check to see if the file is not empty.
            */
            
        },

       
     

        async EditForm() {
             let loader = this.$loading.show({
                color: 'orange',
            })
            await axios.get('/api/EditProduct/' + this.$route.params.id).then((response) => {
                this.form = response.data
                loader.hide();
               // console.log(response.data)

            })

        },


        GetAllCateories() {
            axios.get('/api/getallcategory')
                .then(response => {
                    // handle success
                    this.categories = response.data.data;

                    // console.log(response);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
        },

        GetAllSuppliers() {
            axios.get('/api/GetAllSuppliers')
                .then(response => {
                    // handle success
                    this.suppliers = response.data.data;

                    // console.log(response);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
        },

        UpdateForm()
           {
            let formData = new FormData();
            formData.append("code", this.form.code);  
            formData.append("supplierid", this.form.supplierid);  
            formData.append("supplierprice", this.form.supplierprice);  
            formData.append("categoryid", this.form.categoryid);  
            formData.append("name", this.form.name);
            formData.append("pricesell", this.form.pricesell);  
            formData.append("priceoffer", this.form.priceoffer); 
            formData.append("stock", this.form.stock);  
            formData.append("fullDesc", this.form.fullDesc);     
            formData.append("meta_keywords", this.form.meta_keywords);
            
            for (let i = 0; i < this.form.imgpath.length; i++) {
               formData.append('imgpath[]', this.form.imgpath[i]);
             }
          
  
            axios.post('/api/UpdateProduct/' + this.$route.params.id, formData)
                .then((response) => {
                    // console.log(res);
                    if (response.data.status == 'error') {
                        this.errors = response.data.errors
                    } else if (response.data.status == 200) {
                        Swal.fire({
                            title: 'تم الحفظ بنجاح',
                            text: "success",
                            icon: 'success',
                        });
                       
                        this.errors = []
                    
                        this.form.name= ''
                this.form.categoryid=''
                this.form.supplierprice=''   
                this.form.pricesell=''
                this.form.meta_keywords=''
                this.RemoveImage();
                this.BackHome();
                     
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
           },
  
       
  
           async ShowProductImage() {
             let loader = this.$loading.show({
                color: 'orange',
            })
            await axios.get('/api/ShowProductImage/' + this.$route.params.id).then((response) => {
                this.ImagesProdact = response.data
                loader.hide();
                console.log(response.data)

            })

        },
       
  
     

        DeleteImage(id) {
            Swal.fire({
                title: ' هل تريد الحذف',
                text: "تحذير -- سيتم حذف البيانات نهائيا !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم, أحذف!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/DeleteProductImage/' + id).then(response => {
                        if (response.data.status == 200) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
  
                        }
                        this.ShowProductImage();
  
                    })
                   
  
                }
            })
        },

  
    },
    mounted()
    {
      this.GetAllCateories();
      this.GetAllSuppliers();
      this.EditForm();
      this.ShowProductImage();
    
        
    },
   
  
  }
  </script>
  