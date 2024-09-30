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
          عرض تفاصيل المنتج 
            </div>
             
              <!--bodyform-->
              <div class="form-view">
                <div class="row" v-for="item in Product.data" :key="item.id">
                    <div class="col-md-3 col-lg-3 ">
                        <div class="viewtitle">
                            <div class="view-label"> كود المنتج  : </div>
                            <strong> {{item.code}} </strong>
                        </div>
                      
    
                    </div>

                    <div class="col-md-3 col-lg-3 ">
                      <div class="viewtitle">
                          <div class="view-label">  القسم  : </div>
                          <strong> {{item.category.name}} </strong>
                      </div>
                    
  
                  </div>
                  <div class="col-md-3 col-lg-3 ">
                    <div class="viewtitle">
                        <div class="view-label">  المورد  : </div>
                        <strong> {{item.supplier.name}}  </strong>
                    </div>
                   </div>

                <div class="col-md-3 col-lg-3 ">
                  <div class="viewtitle">
                      <div class="view-label">  أسم المنتج  : </div>
                      <strong>  {{item.name}} </strong>
                  </div>
                </div>

                <div class="col-md-3 col-lg-3 ">
                  <div class="viewtitle">
                      <div class="view-label">  سعر الشراء   : </div>
                      <strong>   {{item.supplierprice}}   </strong>
                  </div>
                </div>

                <div class="col-md-3 col-lg-3 ">
                  <div class="viewtitle">
                      <div class="view-label">  سعر البيع   : </div>
                      <strong>   {{item.pricesell}}   </strong>
                  </div>
                </div>
           

                <div class="col-md-3 col-lg-3 ">
                  <div class="viewtitle">
                      <div class="view-label">   سعر العرض  : </div>
                      <strong>      {{item.priceoffer}}   </strong>
                  </div>
                </div>

                <div class="col-md-3 col-lg-3 ">
                  <div class="viewtitle">
                      <div class="view-label">    المخزون  : </div>
                      <strong>    {{item.stock}}   </strong>
                  </div>
                </div>

                <div class="col-md-3 col-lg-3 ">
                  <div class="viewtitle">
                      <div class="view-label">    صافي الربح  : </div>
                      <strong>     {{item.pricesell - item.supplierprice}}   </strong>
                  </div>
                </div>

                <div class="col-md-3 col-lg-3 ">
                  <div class="viewtitle">
                      <div class="view-label">    قيمة البضاعة   : </div>
                      <strong>      {{item.supplierprice * item.stock}}   </strong>
                  </div>
                </div>

                <hr>






                    <div class="col-md-12 col-lg-12">
                        <div class="viewtitle">
                            <div class="view-label"> وصف المنتج </div>
                            <strong v-html="item.fullDesc">
                               
                              </strong>
                        </div>
                       
    
                       </div>

                       <hr>
                       <h2>SEO</h2>
                       <hr>

                    

                       <div class="col-md-6 col-lg-6">
                        <div class="viewtitle">
                            <div class="view-label">meta_keywords : </div>
                            <strong>
                              {{item.meta_keywords}}
                            </strong>
                        </div>
                      
    
                       </div>
                    
                       <hr>
                 

                       <div class="image-disply">
                        <div class="col-md-12 col-lg-12  text-center" v-for="item in prodactimages.data" :key="item.id" >
                        <img width="0" :src="item.imgpath" class="img-fluid img-thumbnail images" 
                        :alt="item.id" >
                        <h2> {{stripTags(item.imgpath)}}</h2>
                       </div>
                       </div>
                      
                       
    
    
    
                  </div>

              </div>

              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-footer">
                     
                      <button type="button" class="btn btn-danger" @click="BackHome()">
                      خروج 
                        <i class="fa-solid fa-arrow-rotate-left"></i>
                      </button>
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
  export default{
     name:"productShow",
     data()
     {
         return{
            Product:{},
            prodactimages:{},
         }
     },
     methods:{
      stripTags (text) {
            return text.replace("http://127.0.0.1:8000/uploads/product/", '');
        },
         async showProductSingel() {
              let loader = this.$loading.show({
                 color: 'orange',
             })
             await axios.get('/api/GetOneProduct/' + this.$route.params.id).then((response) => {
                this.Product = response.data
                 loader.hide();
           // console.log(response.data)
 
             })
 
         },
         async showProductImagesSingel() {
              let loader = this.$loading.show({
                 color: 'orange',
             })
             await axios.get('/api/ShowProductImage/' + this.$route.params.id).then((response) => {
                this.prodactimages = response.data
                 loader.hide();
           // console.log(response.data)
 
             })
 
         },
 
         BackHome() {
                 this.$router.push({
                     name: 'products'
                 })
             },
     },
 
     mounted()
     {
 
         this.showProductSingel();
         this.showProductImagesSingel();
     }
  }
 
 </script>