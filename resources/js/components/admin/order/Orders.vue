<template>
      <div class="container-fluid">
       
       <div class="card mainpage">
       <!--card-header-->
           <div class="card-header">
           <div class="pull-right">
              
             <span><button type="button" class="btn btn-secondary  bg-dark btn-sm" @click="BackHome">
                 <i class="fa fa-times" aria-hidden="true"></i></button></span>
       
            ادارةالطلبيات 
           </div>
         
       
       
           </div>
       <!--card-body-->
           <div class="card-body">
       
           
             <!--Toolbar-->
                 
                   <div class="Toolbar">
                     <div class="row">
                     <div class="col-md-2 col-lg-2">
                       <div class="button">
                         <button type="button" class="btn btn-success  m-1"  @click="AddNew">
                           <i class="fa fa-plus-square" aria-hidden="true"></i>
                         </button>
                         <button type="button" class="btn btn-warning" @click="ReloadPage">
                           <i class="fa fa-refresh" aria-hidden="true"></i>
                         </button>
       
                         
                       </div>
                 
       
                   </div>
                   <div class="col-md-10 col-lg-10">
                     <form @submit.prevent="showAll()">
                     
                     <div class="row height d-flex justify-content-center align-items-center">
       
                       <div class="col-md-8">
       
                         <div class="search">
                           <i class="fa fa-search"></i>
                           <input type="text" class="form-control" v-model="search" placeholder="بحث!!!!!!!!!" @keyup="showAll()">
                           <button class="btn btn-warning"> بحث </button>
                         </div>
                         
                       </div>
                       
                     </div>
                     </form>
                   </div>
                   </div>
                 </div>
           <!--Toolbar-->
               <!--view table -->
             <div class="row">
               
                     <div class="table-responsive">
                       <table class="table table-bordered">
                         <thead class="bg-dark">
                           <tr class="text-center text-light">
                             <th class="col-1">#</th>
                             <th class="col-2"> صورة المنتج</th>
                             <th class="col-2">  كود الطلب  </th>
                             <th class="col-2">  كود المنتج  </th>
                             <th class="col-2"> الكميه </th>
                             <th class="col-2"> المحافظة </th>
                             <th class="col-2">#</th>
                           
                           </tr>
                         </thead>
                         <tbody v-for="item in  orders.data" :key="item.id">
                           <tr>
                             <td class="col-1">{{item.id}}</td>
                             <td class="col text-center" >
                                    <img :src="getFirstImage(item.product.productimage)" width="50%"
                                :alt="item.name"
  
                                class="img-fluid img-thumbnail images" style="width: 100px; ">
                       </td>
                             <td class="col-2">{{item.code}}</td>
                             <td class="col-2">{{item.product.code}}</td>
                            
                            
                             <td class="col-2">{{item.qty}}</td>
                             <td class="col-2">{{item.city.name}}</td>
                             <td class="col-2">
                               <div class="text-center">
                                 <router-link :to="{name: 'ordershow', params:{id: item.id}}"
                                  class="btn btn-success btn-sm m-1" >
                                   <i class="fa fa fa-eye" aria-hidden="true"></i>
                                 </router-link>
          
                               
       
                                 <button type="button" class="btn btn-danger btn-sm m-1" @click="Delete(item.id)">
                                   <i class="fa fa-trash-o" aria-hidden="true"></i>
                                 </button>
                               </div>
                             </td>
                           </tr>
                         
                       
                         
                         </tbody>
                       </table>
                       <Pagination :data="orders" @pagination-change-page="showAll" />
                     
                     </div>
                 </div>
                 </div>
       
        <!--view table -->
            
         
        
       
            
       
       
       
       </div>
       
       
     
             
       </div>
       
</template>

<script>
export default{
    name:"Orders",
    data(){
        return{
          orders:{},
            search: '',
             errors: [],
             ShowModal: false,


        }
    },
    methods: {
      
        // this code for convert array object for image 
        getFirstImage(images) {
      if (Array.isArray(images) && images.length > 0) {
        return images[0].imgpath;
      }
      return 'ssss'; // Return a default image URL or handle the case where no images are available
    },
                OpenModal(item) {
                            const body = document.querySelector("body")
                            this.errors = []
                            this.ShowModal = true;
                            this.orders=item;
                            
            
                           },
                        
                           CloseModal() {
                           
                           this.ShowModal = false;
                          this.showAll();
            
                       },
                     
                              ReloadPage() {
                          this.$router.go()
                      },
                              BackHome() {
                          this.$router.push({
                              name: 'dashboard'
                          })
                      },
            
                    
                
            /*show All order */
            async showAll(page = 1) {
              /**loding */
              let loader = this.$loading.show({
                  color: 'orange',
              });
            
              /**./loding */
              await axios.get(`api/GetallOrder?page=${page}&search=${this.search}`).then(response => {
                      this.orders = response.data
                      loader.hide();
                      //  console.warn(response.data);
                  })
                  .catch(error => {
                      loader.hide();
                  });
            
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
                              axios.delete('api/DeleteOrder/' + id).then(response => {
                                  if (response.data.status == 200) {
                                      Swal.fire(
                                          'Deleted!',
                                          'Your file has been deleted.',
                                          'success'
                                      )
            
                                  }
            
                              })
                              this.showAll()
            
                          }
                      })
                  },
            
            
              },
              mounted()
    {
        this.showAll();
    }
  
}

</script>