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
          عرض تفاصيل القسم 
            </div>
             
              <!--bodyform-->
              <div class="form-view">
                <div class="row" v-for="item in Catogery.data" :key="item.id">
                    <div class="col-md-6 col-lg-6 ">
                        <div class="viewtitle">
                            <div class="view-label"> أسم القسم : </div>
                            <strong> {{ item.name }}</strong>
                        </div>
                      
    
                    </div>
                
                       <div class="col-md-6 col-lg-12">
                        <div class="viewtitle">
                            <div class="view-label">meta_keywords : </div>
                            <strong>
                                {{ item.meta_keywords }}
                            </strong>
                        </div>
                      
    
                       </div>
                       <div class="col-md-6 col-lg-12">
                        <div class="viewtitle">
                            <div class="view-label"> meta_description : </div>
                        <strong>
                            {{ item.meta_description }}
                            </strong>
                        </div>
                        
    
                       </div>
                       <hr>
                      
                       <div class="col-md-12 col-lg-12 text-center">
                        <img width="0" class="img-fluid img-thumbnail images" 
                        :src="item.imgpath" alt="item.name">
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
    name:"CategoryShow",
    data()
    {
        return{
            Catogery: {},    
        }
    },
    methods:
    {
        async showCatogerySingel() {
              let loader = this.$loading.show({
                 color: 'orange',
             })
             await axios.get('/api/GetOneCategory/' + this.$route.params.id).then((response) => {
                this.Catogery = response.data
                 loader.hide();
           console.log(response.data)
 
             })
 
         },
         
 
         BackHome() {
                 this.$router.push({
                     name: 'category'
                 })
             },
     },
 
     mounted()
     {
 
         this.showCatogerySingel();
    
     }
}

</script>
