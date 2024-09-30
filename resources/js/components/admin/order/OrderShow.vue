<template>
    <div class="container-fluid">
       
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card-header">
              <h5 class="title">  تفاصيل الطلب </h5>
            </div>
          
          </div>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body" v-for="item in  orders.data" :key="item.id">
                 <!--information prodact-->
               
                <div class="row m-3">
                 
                  <div class="col-md-4">
                      <div class="mb-2">
                                      <span class="titelorder">تاريخ الطلب : </span>  
                                      <strong>{{item.created_at}}</strong>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-2">
                                    <span class="titelorder"> كود الطلب : </span>  
                                     <strong> {{item.code}}</strong>
                                </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-2">
                                    <span class="titelorder">  الكميه المطلوبه: </span>  
                                     <strong> {{item.qty}}</strong>
                                </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-2">
                                   <span class="titelorder">  كود المنتج : </span>  
                                     <strong> {{item.product.code}}</strong>
                                </div>
                  </div>

                  <div class="col-md-4">
                    <div class="mb-2">
                                   <span class="titelorder"> اسم المنتج : </span>  
                                     <strong> {{item.product.name}}</strong>
                                </div>
                  </div>

                  <div class="col-md-4">
                    <div class="mb-2">
                                   <span class="titelorder"> سعر المنتج : </span>  
                                     <strong>  {{item.product.pricesell}}</strong>
                                </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-2">
                                   <span class="titelorder"> سعرالعرض  : </span>  
                                     <strong>{{item.product.priceoffer}}</strong>
                                </div>
                  </div>

                </div>
                   <!--information prodact./-->
                     <!--information order adress./-->
                     <hr>
                     <div class="row m-3">
                      <div class="col-md-4">
                    <div class="mb-2">
                                   <span class="titelorder"> أسم العميل  : </span>  
                                     <strong> {{item.fullname}}</strong>
                                </div>
                  </div>

                  <div class="col-md-4">
                    <div class="mb-2">
                                   <span class="titelorder"> المحافظة : </span>  
                                     <strong>{{item.city.name}}</strong>
                                </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-2">
                                   <span class="titelorder"> رقم التليفون الاول  : </span>  
                                     <strong>  {{item.phon1}}</strong>
                                </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-2">
                                   <span class="titelorder"> رقم التليفون الثاني  : </span>  
                                     <strong> {{item.phon2}}</strong>
                                </div>
                  </div>
                      </div>
                      <div class="row m-3">
                        <div class="col-md-12">
                          <div class="mb-2">
                                   <h5 class="titelorder"> العنوان : </h5>  
                                     <strong> {{item.address}}</strong>
                                </div>

                        </div>
                        <div class="col-md-12">
                          <div class="mb-2">
                                   <h5 class="titelorder"> ملاحظات: </h5>  
                                     <strong>   {{item.memo}}</strong>
                                </div>

                        </div>
                        <div class="col-md-12">
                          <div class="mb-2 text-center">
                                   
                            <img :src="getFirstImage(item.product.productimage)" width="100%"
                                :alt="item.name"
  
                                class="img-fluid img-thumbnail images" style="width: 400px; ">
                                </div>

                        </div>
                        <div class="col-md-12">
                          <div class="mb-2 text-center">
                        <div class="card-footer">
             <button type="button" class="btn btn-danger" @click="BackHome">
      خروج
   
       <i class="fa fa-undo" aria-hidden="true"></i>
   </button>
   </div>
   </div>
                        </div>

                      </div>
                       <!--information order adress-->

              </div>
            </div>
            </div>
            </div>

        </div>




    </div>
 </template>
 
 <script>
  export default{
     name:"showorder",
     data()
     {
         return{
          orders:{},
         }
     },
     methods:{

      getFirstImage(images) {
      if (Array.isArray(images) && images.length > 0) {
        return images[0].imgpath;
      }
      return 'ssss'; // Return a default image URL or handle the case where no images are available
    },

         async ShowOrderSingel() {
              let loader = this.$loading.show({
                 color: 'orange',
             })
             await axios.get('/api/GetOneOrder/' + this.$route.params.id).then((response) => {
                this.orders = response.data
                 loader.hide();
               console.log(response.data)
 
             })
 
         },
 
         BackHome() {
                 this.$router.push({
                     name: 'dashboard'
                 })
             },
     },
 
     mounted()
     {
 
         this.ShowOrderSingel();
     }
  }
 
 </script>