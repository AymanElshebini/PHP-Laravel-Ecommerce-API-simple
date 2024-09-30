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
              ادارة المنتجات
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
                        
                        <div class="col-md-6 col-lg-6">
                          <form>
                            <div class="row">
                             <div class="search">
                              <i class="fa fa-search"></i>
                              <input type="text" class="form-control" 
                              v-model="search" keyup="showAll()"
                               placeholder="بحث!!!!!!!!!">
                              <button class="btn btn-warning"> بحث </button>
                            </div>
                         
                        </div>
                          </form>
                        </div>
                        <div class="col-md-4 col-lg-4">
                          <div class="dropdown dropdown-serche">
                            <a class="btn btn-secondary dropdown-toggle"
                             href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            بحث بالقسم 
                            </a>
                          
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                              <li v-for="item in categories" :key="item.id">
                                <a class="dropdown-item" href="#" @click.prevent="ShowProductByCatogery(item.id)"> {{item.name}}</a>
                              
                              </li>
                            
                            </ul>
                          </div>
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
                        <th scope="col">Code</th>
                        <th scope="col">صورة</th>
                        <th scope="col">القسم</th>
                        <th scope="col">المنتج</th>
                        <th scope="col">المورد</th>
                        <th scope="col">سعر الشراء</th>
                        <th scope="col">سعر البيع</th>
                        <th scope="col">الربح</th>
                        <th scope="col">عروض</th>
                        <th scope="col">المخزن</th>
                        <th scope="col">#</th>
                      </tr>
                    </thead>
                    <tbody v-for="item in products.data" :key="item.id">
                      <tr>
                        <td scope="row text-center">{{item.code}}</td>
                        <td class="text-center"><img :src="getFirstImage(item.productimage)" class="prodact_image" :alt="item.name"> </td>
                        <td class="text-center">  {{item.category.name}} </td>
                        <td class="text-center"> {{item.name}} </td>
                        <td class="text-center"> {{item.supplier.name}} </td>
                        <td class="text-center">{{item.supplierprice}}</td>
                        <td class="text-center">{{item.pricesell}} </td>
                        <td class="text-center bg-warning text-white"> {{item.pricesell - item.supplierprice}}</td>
                        <td class="text-center bg-danger text-white">
                         {{ item.priceoffer }}
                        </td>

                        <td class="text-center">
                          {{item.stock}}  
                        </td>
                        
                   
                        <td>
                          <div class="text-center fromaction">
                          

                        
                            <router-link 
                            :to="{name: 'ProductShow', 
                                  params:{id: item.id}}"
                             class="btn btn-success btn-sm m-1">
                              <i class="fa-solid fa-eye"></i>
                         
                            </router-link>
                            <router-link 
                            :to="{name: 'productedite', 
                                  params:{id: item.id}}"
                            class="btn btn-warning btn-sm">
                              <i class="fa-solid fa-pen-to-square"></i>
                            
                            </router-link>

                            <button 
                            @click="Delete(item.id)"
                            type="button"
                             class="btn btn-danger btn-sm m-1">
                              <i class="fa-solid fa-trash"></i>
                             
                            </button>
                          </div>
                          
                        </td>
                      </tr>
                   
              
                    </tbody>
                  </table>
                  </div>
                  <div class="row">
                    <nav aria-label="Page navigation">
                      <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">السابق</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#"> التالي </a></li>
                      </ul>
                    </nav>
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
  
    name:"Products",
   
    data(){
        return{    
          categories:{},   
            products: {},      
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
  
            // this code for convert array object for image 
            getFirstImage(images) {
      if (Array.isArray(images) && images.length > 0) {
        return images[0].imgpath;
      }
      return 'ssss'; // Return a default image URL or handle the case where no images are available
    },
 
      
  /*show All Catogery */
  async showAll(page = 1) {
    /**loding */
    let loader = this.$loading.show({
        color: 'orange',
    });
  
    /**./loding */
    await axios.get(`api/GetAllProduct?page=${page}&search=${this.search}`).then(response => {
            this.products = response.data
            loader.hide();
            // console.warn(response.data);
        })
        .catch(error => {
            loader.hide();
        });
  
  },
  
  //go add new Catogery
  AddNew() {
              this.$router.push({
                  name: "productadd"
              });
          },
  
  
  
        
 //Delete Catogery          
  
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
                    axios.delete('api/DeleteProduct/' + id).then(response => {
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

 // Get All Catogery 
          GetAllCateories() {
            axios.get('/api/getallcategory')
                .then(response => {
                    // handle success
                    this.categories = response.data.data;

                    //console.log(response);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
        },

        // get prordact by catogery 
        ShowProductByCatogery(id) {
            axios.get('api/GetProdactCategory/' + id)
                .then(response => {
                    // handle success
                    this.products = response.data;

                    console.log(response);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
        },

  
  
    },
   
    mounted()
    {
        this.showAll();
        this.GetAllCateories();
      //  this. ShowProductByCatogery();
       
    }
  
  }
  </script>
  