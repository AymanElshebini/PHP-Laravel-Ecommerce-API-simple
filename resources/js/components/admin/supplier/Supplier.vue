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
           أدارة الموردين 
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
                          <form>
                            <div class="row">
                             <div class="search">
                              <i class="fa fa-search"></i>
                              <input type="text" class="form-control"  v-model="search" @keyup="showAll()"
                               placeholder="بحث!!!!!!!!!">
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
                        <th scope="col">الاسم  </th>
                        <th scope="col"> الشركة </th>
                        <th scope="col"> المحافظة</th>
                        <th scope="col">#</th>
                      </tr>
                    </thead>
                    <tbody v-for="item in  supplier.data" :key="item.id">
                      <tr>
                        <td scope="row text-center">{{item.id}}</td>
                        <td class="text-center">  {{item.name}}</td>
                        <td class="text-center">
                          {{item.company}}
                             </td>
                             <td class="text-center">
                              {{item.city.name}}
                                 </td>
                        <td>
                          <div class="text-center fromaction">
                            <router-link :to="{name: 'suppliershow', params:{id: item.id}}" type="button" class="btn btn-success btn-sm m-1">
                              <i class="fa-solid fa-eye"></i>
                         
                            </router-link>
                            <router-link :to="{name: 'supplieredite', 
                                  params:{id: item.id}}"
                            type="button" class="btn btn-warning btn-sm">
                              <i class="fa-solid fa-pen-to-square"></i>
                            
                            </router-link >

                            <button type="button" class="btn btn-danger btn-sm m-1" @click="Delete(item.id)">
                              <i class="fa-solid fa-trash"></i>
                             
                            </button>
                          </div>
                          
                        </td>
                      </tr>

                     
                    </tbody>
                  </table>
                  <Pagination :data=" supplier" @pagination-change-page="showAll" />
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
  
    name:"supplier",
   
    data(){
        return{
           
            supplier: {},    
            search: '',
             errors: [],
             ShowModal: false,
           
  
        }
    },
    methods: {
                
      OpenModal(item) {
                  const body = document.querySelector("body")
                  this.errors = []
                  this.ShowModal = true;
                  this.supplier=item;
                  
  
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
  
          
      
  /*show All Catogery */
  async showAll(page = 1) {
    /**loding */
    let loader = this.$loading.show({
        color: 'orange',
    });
  
    /**./loding */
    await axios.get(`api/GetAllSuppliers?page=${page}&search=${this.search}`).then(response => {
            this.supplier = response.data
            loader.hide();
            //  console.warn(response.data);
        })
        .catch(error => {
            loader.hide();
        });
  
  },
  
  AddNew() {
              this.$router.push({
                  name: "supplieradd"
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
                    axios.delete('api/DeleteSupplier/' + id).then(response => {
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
  