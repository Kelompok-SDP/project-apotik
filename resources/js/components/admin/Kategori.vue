<template>
    <div>
        <h1>Admin Kategori</h1>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">List Semua Kategori </h4>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"
                v-for="kategori in kategories" :key="kategori.id"
                >
                    {{ kategori.nama }}
                </li>
            </ul>
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
                    this.kategories = response.data;
                    
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