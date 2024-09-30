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
                تفاصيل المورد
            </div>
             
              <!--bodyform-->
              <div class="form-view">
                <div class="row" v-for="item in suppliers.data" :key="item.id">
                    <div class="col-md-4 col-lg-4 ">
                        <div class="viewtitle">
                            <div class="view-label"> أسم المورد: </div>
                            <strong> {{item.name}} </strong>
                        </div>
                      
    
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="viewtitle">
                            <div class="view-label"> أسم الشركة  : </div>
                            <strong> {{item.company}} </strong>
                        </div>
                       
    
                       </div>
                       <div class="col-md-4 col-lg-4">
                        <div class="viewtitle">
                            <div class="view-label"> المحافظة  : </div>
                            <strong> {{item.city.name}} </strong>
                        </div>
                       
    
                       </div>
                       <div class="col-md-4 col-lg-4">
                        <div class="viewtitle">
                            <div class="view-label"> رقم التليفون 1 : </div>
                            <strong> {{item.tel1}}</strong>
                        </div>   
                       </div>
                       <div class="col-md-4 col-lg-4">
                        <div class="viewtitle">
                            <div class="view-label"> رقم التليفون 2 : </div>
                            <strong> {{item.tel2}}</strong>
                        </div>   
                       </div>
                       <hr>

                       <div class="col-md-6 col-lg-12">
                        <div class="viewtitle">
                            <div class="view-label">العنوان  : </div>
                            <strong>
                              {{item.address}}
                            </strong>
                        </div>
                      
    
                       </div>
                     
                  
                      
                     
    
    
    
                  </div>

              </div>

              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-footer">
                     
                      <button type="button" class="btn btn-danger" @click="BackHome">
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
     name:"SupplierShow",
     data()
     {
         return{
          suppliers:{},
         }
     },
     methods:{
         async showSupplierSingel() {
              let loader = this.$loading.show({
                 color: 'orange',
             })
             await axios.get('/api/GetOneSupplier/' + this.$route.params.id).then((response) => {
                this.suppliers = response.data
                 loader.hide();
          //  console.log(response.data)
 
             })
 
         },
 
         BackHome() {
                 this.$router.push({
                     name: 'supplier'
                 })
             },
     },
 
     mounted()
     {
 
         this.showSupplierSingel();
     }
  }
 
 </script>