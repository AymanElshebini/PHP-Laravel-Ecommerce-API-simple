<template>
    
    <div class="container-fluid">
       
  <div class="card mainpage">
  <!--card-header-->
      <div class="card-header">
      <div class="pull-right">
         
        <span><button type="button" class="btn btn-secondary  bg-dark btn-sm" @click="BackHome">
            <i class="fa fa-times" aria-hidden="true"></i></button></span>
   Manage SEO
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
                      <input type="text" class="form-control" v-model="search" placeholder="بحث!!!!!!!!!" >
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
                        <th class="col-3"> لينك الصفحة  </th>
                     
                   
                        <th class="col-2">#</th>
                      
                      </tr>
                    </thead>
                    <tbody v-for="item in cmstags.data" :key="item.id">
                      <tr>
                        <td class="col-1">{{item.id}}</td>
                        <td class="col-3">{{item.url_page}}</td>
                       
  
                     
                        <td class="col-2">
                          <div class="text-center">
                            <button type="button" class="btn btn-success btn-sm m-1" @click="OpenModal(item)" >
                              <i class="fa fa fa-eye" aria-hidden="true"></i>
                            </button>
                            <router-link :to="{name: 'cmstagedite', 
                                  params:{id: item.id}}"
                             class="btn btn-warning btn-sm" >
                              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </router-link>
  
                            <button type="button" class="btn btn-danger btn-sm m-1" @click="Delete(item.id)">
                              <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                    
                  
                    
                    </tbody>
                  </table>
                  <Pagination :data="cmstags" @pagination-change-page="showAll" />
  
                
                </div>
            </div>
            </div>
  
   <!--view table -->
       
    
   
  
       
  
  
  
  </div>
  
  
  
   <!--show model information  -->
   <div ref="modalCreate" :class="{ show: ShowModal, 'd-block': ShowModal }" 
  class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close bg-warning" @click="CloseModal"></button>
        
            <h5  class="modal-title" id="exampleModalLabel">  عرض بيانات SEO </h5>
                  
        </div>
        <div class="modal-body">
          <div class="container mt-3 form-body">
                <div class="row">
                  <div class="col-md-6">
                    <strong class="text-success mt-3"> لينك الصفحة :</strong>
                    {{cmstags.url_page}}
                  </div>
                 
                  <div class="col-md-6">
                    <strong class="text-success mt-3"> meta_title :</strong>
                    {{cmstags.meta_title}}
                  </div>
  
                  <div class="col-md-12 mt-5">
                    <strong class="text-success mt-3"> meta_keywords :</strong>
                    {{cmstags.meta_keywords}}
                  </div>
  
                  <div class="col-md-12 mt-5">
                    <strong class="text-success mt-3"> meta_description :</strong>
                    {{cmstags.meta_description}}
                  </div>
  
                  
  
                  
                 
                  
                  
  
                
            </div>
              
              
           
  
              
         
          </div>
        </div>
        <div class="modal-footer pull-right">
  
          <div class="modal-footer">
  
  
  <button type="button" class="btn btn-danger" @click="CloseModal">
     خروج
  
      <i class="fa fa-undo" aria-hidden="true"></i>
  </button>
  
  </div>
  
        </div>
      </div>
    </div>
  </div>
   <!--show model information  -->
        
        
  </div>
  
  </template>
  
  <script>
  
  
  
  
  export default {
  
    name:"cmstags",
   
    data(){
        return{
           
            cmstags: {},  
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
                  this.cmstags=item;
                  
  
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
  
          
      
  /*show All cmstags */
  async showAll(page = 1) {
    /**loding */
    let loader = this.$loading.show({
        color: 'orange',
    });
  
    /**./loding */
    await axios.get(`api/GetAllCmstag?page=${page}&search=${this.search}`).then(response => {
            this.cmstags = response.data
            loader.hide();
            //  console.warn(response.data);
        })
        .catch(error => {
            loader.hide();
        });
  
  },
  
  AddNew() {
              this.$router.push({
                  name: "cmstagadd"
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
                    axios.delete('api/DeleteCmstag/' + id).then(response => {
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
  