
<template>
    <div style="margin-left: 2rem;">
        <br>
        <h1 class="m-0 text-dark">Admin Kategori</h1>
        <br>
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Semua Kategori</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Nama</th>
                      <th>Gambar</th>
                      <th>Slug</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(kategori, index) in kategories" :key="kategori.id">
                      <td>{{ index+1 }} </td>
                      <td>{{ kategori.nama }}</td>
                      <td>
                          <span v-if="!kategori.gambar">Belum ada gambar</span>
                          <img v-bind:src="kategori.gambar" v-if="kategori.gambar" alt="" srcset="" width="50px;">
                      </td>
                      <td>{{ kategori.slug }} </td>
                    </tr>
                  </tbody>
                </table>
                
                <h2 v-if="kategories.length == 0"
                class="text-center mt-2"
                >
                    Belum ada data kategori
                </h2>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div>
            </div>
            
        <form @submit.prevent="addData()">
            <label for="">Kode</label>
                {{ form.kode  }} <br>
            <label for="">Nama</label>
            <input type="text" name="" id="" v-model="form.nama" @keyup="autogenKode()"> <br>
            <label for="">Gambar</label>
            <input type="text" name="" id="" v-model="form.gambar"> <br>
            <label for="">Slug</label>
            <input type="text" name="" id="" v-model="form.slug"> <br>
            <button type="submit" class="btn btn-primary">Tambah Kategori</button>
        </form>

        <span v-if="isSuccess" class="alert bg-success"> berhasil tambah kategori</span>
    </div>
</template>

<script>
export default {
    data(){
        return{
            kategories:[],
            form:{
                kode:'',
                nama:'',
                gambar:'',
                slug:'',
            },
            isLoading: false,
            isSuccess: false
        }
    },
    mounted(){
        this.loadData(),
        this.autogenKode()
    },
    methods:{
        loadData(){
            axios.get('/api/admin/kategori')
                .then((response) => {
                    this.kategories = response.data.all_kategori;
                    
                }).catch((error) => {
                    
                });
        },
        addData(){
            axios.post('/api/admin/kategori',{
                id:this.form.kode,
                nama:this.form.nama,
                gambar:this.form.gambar,
                slug:this.form.slug,
            }).then(response =>{
                this.isSuccess = true;
                this.loadData();
            }).catch((error)=>{

            });
        },autogenKode(){
            this.form.kode = this.form.nama;
        }
        
    },
    
}
</script>

<style>

</style>