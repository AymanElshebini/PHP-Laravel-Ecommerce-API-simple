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
              أدارة المحافظات
            </div>
                      <!--toolbar-->
                <div class="Toolbar">
                  <div class="row">
                    <div class="col-md-1 col-lg-1">
                      <button type="button" class="btn btn-success m-1" @click="AddNew">
                        <i class="fa fa-plus-square" aria-hidden="true">

                        </i>
                      </button>
                        </div>
                        
                        <div class="col-md-11 col-lg-11">
                          <form @submit.prevent="showAll()">
                            <div class="row">
                             <div class="search">
                              <i class="fa fa-search"></i>
                              <input type="text" class="form-control" placeholder="بحث!!!!!!!!!" v-model="search" @keyup="showAll()">
                              <button class="btn btn-warning"> بحث </button>
                            </div>
                         
                        </div>
                          </form>
                        </div>
                      </div>
                </div>
                <!--./toolbar-->
              <!--bodyform-->
              <div class="row">
                <div class="col-md-12 col-lg-12">
                  <div class="table-responsive">
                  <table class="table table-bordered StandardTable">
                    <thead class="tabel_hedar">
                      <tr class="text-center text-light">
                        <th scope="col">#</th>
                        <th scope="col"> المحافظة </th>
                      
                        <th scope="col">#</th>
                      </tr>
                    </thead>
                    <tbody v-for="item in city.data" :key="item.id">
                      <tr>
                        <td scope="row text-center">{{item.id}}</td>
                        <td class="text-center"> {{item.name}}</td>
                                           
                        <td>
                          <div class="text-center fromaction">
                           
                            <router-link type="button"
                            :to="{name: 'citydit', 
                                params:{id: item.id}}"
                            class="btn btn-warning btn-sm">
                              <i class="fa-solid fa-pen-to-square"></i>
                            
                            </router-link>

                            <button type="button" class="btn btn-danger btn-sm m-1" @click="Delete(item.id)">
                              <i class="fa-solid fa-trash"></i>
                             
                            </button>
                          </div>
                          
                        </td>
                      </tr>
                    
                    
                    </tbody>
                  </table>
                  <Pagination :data="city" @pagination-change-page="showAll" />
                  </div>
                 
                </div>
              </div>

               <!--./bodyform-->
          
           

        </div>
      </div>
  
   
  </section>

</template>

<script>

export default {

  name:"City",
 
  data(){
      return{       
          city: {},      
          search: '',
          errors: [],
         
      }
  },
  methods: {

   
   //refrash page       
       ReloadPage() {
              this.$router.go()
          },
        
          //go Dashbord
                  BackHome() {
              this.$router.push({
                  name: 'dashboard'
              })
          },

        
    
/*show All Catogery */
async showAll(page = 1) {
  /**loding */
  let loader = this.$loading.show({
      color: 'orange',
  });

  /**./loding */
  await axios.get(`api/GetAllCity?page=${page}&search=${this.search}`).then(response => {
          this.city = response.data
          loader.hide();
          //  console.warn(response.data);
      })
      .catch(error => {
          loader.hide();
      });

},

//go add new city
AddNew() {
            this.$router.push({
                name: "cityadd"
            });
        },



      
//Delete city          

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
                  axios.delete('api/DeleteCity/' + id).then(response => {
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
