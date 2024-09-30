<template>
    
  <div class="container-fluid">
     
<div class="card mainpage">
<!--card-header-->
<div class="card-header">
    <div class="pull-right">
       
      <span><button type="button" class="btn btn-secondary  bg-dark btn-sm" @click="BackHome">
          <i class="fa fa-times" aria-hidden="true"></i></button></span>


أضافة صور المنتج 
{{ this.$route.params.id }}
    </div>
  


</div>
<!--card-body-->
<div class="card-body">
    <div class="container">
        <div class="row ">


            <div class="card" style="width: 10rem;" v-for="item in ImagesProdact.data" :key="item.id">
  <img :src="item.imgpath" class="card-img-top" :alt="item.id">
  <div class="card-body">
   <p class="card-text">{{item.imgpath}}</p>
   <div class="text-center">   
                    <button type="button" class="btn btn-danger btn-md m-1" @click="Delete(item.id)">
                              <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button> 
                        </div>
   
  </div>
</div>

       
                  
                       
            </div>
           
   
    </div>
  
  <div class="container-fluid">
   
      <div class="row form-body">
       

          <div class="col-md-6">
             
            
             <input type="hidden" :class="['form-control my-2' ,errors.productid ?'is-invalid':'']" 
              id="productid"
              placeholder="أدخل كود المنتج  " name="productid" v-model="form.productid">
              <small class="text-white bg-danger p-1 rounded massageerror" v-if="errors.productid">{{errors.productid[0]}}</small>
          
           </div>
        
              
            
             <!--image uploads -->
                  <div class="col-md-12">
                     
                      <div v-if="!form.imgpath" class="input-group mb-3">
                        
                        
                      <input class="form-control form-control-lg"  multiple
                          type="file" name="imgpath" @change='onFileChange' placeholder="image">
                         
                  

                      <small class="text-white bg-danger p-1 rounded massageerror" v-if="errors.imgpath">{{errors.imgpath[0]}}</small>


                      </div>
                      <div class="mb-3 text-center" v-else>
              <button @click="RemoveImage" type="button" class="btn btn-outline-warning mt-2">تغير الصورة</button>
                 </div>
  
            <div class="mb-3 text-center">
              
                <img v-bind:src="imagePreview ==null ? form.imgpath :imagePreview" width="200"   v-show="showPreview" />
  
             
              </div>

                  </div>
             <!--image uploads -->

             <div class="col-md-12">
              <div class="form-group col-md-6 col-md-12 text-center buttons-container m-2 b-2">
                      <button type="button" class="btn bg-warning m-2" @click="AddNew">
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

  name:"ProductImageAdd",
 
  data(){
      return{
          
         ImagesProdact:{},
        
          /**----- (images) ------*/
          imagePreview: null,
          imageUpdateMode: false,
          showPreview: false,// hiden and show imags 
               /**----- (./images) ------*/
          form: new Form({
              id: '',
             // productid: '',
             productid: this.$route.params.id,
              imgpath: '',
             

          }),
          search: '',
          errors: [],
         

      }
  },
  methods: {
      
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


        AddNew()
         {
          let formData = new FormData();

          formData.append("productid", this.form.productid);
           formData.append("imgpath[]", this.form.imgpath);

          axios.post('api/AddProductImage', formData)
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
                  
              this.form.productid = ''  
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

     Delete(id) {
            Swal.fire({
                title: 'هل تريد الحذف',
                text: "تحذير -- سيتم حذف البيانات نهائيا !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم, أحذف!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('api/DeleteProductImage/' + id).then(response => {
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
     this.ShowProductImage();
    }
 
 

}
</script>