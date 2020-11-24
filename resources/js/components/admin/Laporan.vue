
<template>
    <div class="wrapper-sub-kategori">
         <br />
            <h1 class="m-0 text-dark">Master Laporan</h1>
         <br />
         <div class="card">
             <div class="card-header">
                <button class="btn btn-primary btn-click" @click="gantiLaporan(1)">Laporan Obat </button>
                <button class="btn btn-primary btn-click" @click="gantiLaporan(2)">Laporan Customer </button>
                <button class="btn btn-primary btn-click" @click="gantiLaporan(3)">Chart</button>
             </div>
             <div class="card-body">
                 <div class="row" v-if="tipeData == 1 ||tipeData ==2">
                     <div class="form-group col-sm">
                            <label for="">Banyak Data pada Tabel</label>
                            <input
                            type="number"
                            class="form-control"
                            id=""
                            placeholder="Co: 2"
                             v-model="perPage"
                            @change="changePage"
                            />
                      </div>
                      <div class="form-group col-sm">
                            <label for="">Acuan Search</label>
                            <div class="input-group">
                                <select class="form-control tag-pilihan-insert" id="acuanSearch" >
                                    <option v-for="(data, index) in acuanSearch" :key="index" :value="index">
                                    {{ data }}
                                    </option>
                                </select>

                            </div>
                        </div>
                        <div class="form-group col-sm">
                            <label for="">Search Data</label>
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    id=""
                                    placeholder="Co:  Puyer"
                                    v-model="keywords"
                                />
                                <button class="btn btn-primary" @click="search">Cari</button>
                            </div>
                        </div>
                 </div>
                 <div class="row"  v-if="tipeData == 1 ||tipeData ==2">
                        <div class="form-group col-sm">
                            <label for="">Order By</label>
                            <div class="input-group">
                                <select class="form-control"  @change="onChangeOrderBy($event)">
                                    <option v-for="(data, index) in arrorderBy" :key="index" :value="index">
                                    {{ data }}
                                    </option>
                                </select>

                            </div>
                        </div>
                        <div class="form-group col-sm">
                            <label for="">Secara</label>
                            <div class="input-group">
                                <select class="form-control"  id="#tag-orderBy" @change="onChangeSecara($event)">
                                    <option v-for="(data, index) in arrsecara" :key="index" :value="index">
                                    {{ data }}
                                    </option>
                                </select>

                            </div>
                        </div>
                        <div class="form-group col-sm">
                            <label for="">Jenis</label>
                            <div class="input-group">
                                <select class="form-control tag-pilihan-insert" id="mySelect"  @change="onChangeTipe($event)">
                                    <option v-for="(data, index) in arrTipe" :key="index" :value="index">
                                    {{ data }}
                                    </option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group col-sm">
                            <label for="">Tanggal Spesifik</label>
                            <div class="input-group">
                               <input  type="date" name="" class="form-control" id="datepicker" v-model="tanggalHari"  @change="onChange2" disabled>
                            </div>
                        </div>


                 </div>
                <div  class="row" v-if="tipeData ==1">
                 <!-- <div  class="row" id="tipe1"> -->
                                 <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                            <th style="width: 10px">No</th>
                                            <th >Id Obat</th>
                                            <th>Nama Obat</th>
                                            <th>Gambar</th>
                                            <th>Harga Obat</th>
                                            <th>Banyak Item yang Terbeli</th>
                                            <th>Tanggal Terjual</th>
                                            <!-- <th>Keterangan</th>
                                            <th>Dosis</th>
                                            <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr v-for="(data, index) in Data" :key="data.tanggal">
                                                    <td>{{ index+1 }}</td>
                                                    <td>{{ data.id }}</td>
                                                    <td>{{ data.nama }}</td>
                                                    <td> <span v-if="!data.gambar">Belum ada gambar</span>
                                                    <img
                                                    v-bind:src="data.gambar"
                                                    v-if="data.gambar"
                                                    alt=""
                                                    srcset=""
                                                    width="50px;"
                                                    /></td>
                                                    <td>Rp. {{ data.harga }}</td>
                                                    <td>{{ data.jum }}</td>
                                                     <td>{{ data.tanggal}}</td>
                                                </tr>
                                        </tbody>
                                 </table>


                                <div class="card-footer clearfix" style="width:100%">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        <li class="page-item">
                                            <button
                                                class="page-link"
                                                :disabled="!pagination.prev_page_url"
                                                @click="fetchPaginate(pagination.prev_page_url)"
                                            >
                                                Previous
                                            </button>
                                        </li>


                                        <li class="page-item">
                                            <button
                                                class="page-link"
                                                href="#"
                                                :disabled="!pagination.next_page_url"
                                                @click="fetchPaginate(pagination.next_page_url)"
                                            >
                                                Next
                                            </button>
                                        </li>
                                    </ul>
                                    <span
                                        >Page {{ pagination.current_page }} of {{ pagination.last_page }}
                                    </span>
                                </div>
                                <h2 v-if="Data.length == 0" class="text-center mt-2">
                                Belum ada data
                                </h2>
                    </div>


                    <!-- master laporan Customer -->
                    <div  class="row" v-if="tipeData ==2">
                    <!-- <div  class="row" id="tipe2"> -->
                                 <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                            <th style="width: 10px">No</th>
                                            <th >Id User</th>
                                            <th>Nama User</th>
                                            <th>Total pembelian</th>
                                            <th>Tanggal Pembelian</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr v-for="(data, index) in Data" :key="data.tanggal">
                                                    <td>{{ index+1 }}</td>
                                                    <td>{{ data.id }}</td>
                                                    <td>{{ data.nama }}</td>
                                                    <td>Rp. {{ data.subtotal }}</td>
                                                     <td>{{ data.tanggal}}</td>
                                                </tr>
                                        </tbody>
                                 </table>


                                <div class="card-footer clearfix" style="width:100%">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        <li class="page-item">
                                            <button
                                                class="page-link"
                                                :disabled="!pagination.prev_page_url"
                                                @click="fetchPaginate(pagination.prev_page_url)"
                                            >
                                                Previous
                                            </button>
                                        </li>


                                        <li class="page-item">
                                            <button
                                                class="page-link"
                                                href="#"
                                                :disabled="!pagination.next_page_url"
                                                @click="fetchPaginate(pagination.next_page_url)"
                                            >
                                                Next
                                            </button>
                                        </li>
                                    </ul>
                                    <span
                                        >Page {{ pagination.current_page }} of {{ pagination.last_page }}
                                    </span>
                                </div>
                                <h2 v-if="Data.length == 0" class="text-center mt-2">
                                Belum ada data
                                </h2>
                    </div>


                    <!-- master pendapatan -->
                    <!-- <div class="row" v-if="tipeData ==3 "> -->
                    <div class="row" id="tipe3" style="display:none">
                        <div class="col-12">
                            <div class="row">
                                <div class="form-group col-sm">
                                    <label for="">Banyak Data pada Chart</label>
                                    <input
                                    type="number"
                                    class="form-control"
                                    id=""
                                    placeholder="Co: 2"
                                    v-model="perPage"
                                    @change="changePage"
                                    />
                                </div>
                            </div>
                                    <div class="row">
                                        <div class="form-group col-sm">
                                                <label for="">Secara</label>
                                                <div class="input-group">
                                                    <select class="form-control"  id="#tag-orderBy" @change="onChangeisiTipe($event)">
                                                        <option v-for="(data, index) in isiTipeChart" :key="index" :value="index">
                                                        {{ data }}
                                                        </option>
                                                    </select>

                                                </div>
                                            </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-12">
                                                <chart :chart-data="datacollection"></chart>
                                            </div>
                                    </div>
                        </div>

                    </div>
                </div>
             </div>
         </div>

</template>

<script>
import chart from "./chart";
export default {
    name:"Laporan",
     components: {
       chart: chart,
    },
    data(){
        return{
            Data : [],
            acuanSearch : ['id','nama'],
            Search : 0,
            arrTipe : ['semua','perhari', 'perbulan','pertahun'],
            arrsecara : ['dsc','asc'],
            arrorderBy : ['tanggal','id','nama','total'],
            Tipe :0,
            secara:0,
            orderBy :0,
            tipeData : 1, //1 -> item, 2 -> Customer, 3-> chart
            tanggalHari :null,
            perPage: 5,
            keywords :"",
            pagination: [],
            url: "/api/admin/laporan",
            labelschart : [],
            dataschart : [],
            datacollection : null,
            judulChart : "Grafik Pendapatan Perhari",
            tipeChart : 0, // 0 -> pendapatan  hari terakhir, 1 -> obat yang paling banyak terjual, 2 -> obat paling sedikit terjual, 3 -> customer yang paling sering beli
            isiTipeChart : ["Grafik Pendapatan Perhari", "Grafik Obat yang paling laku (desc)", "Grafik Obat yang paling laku (asc)","Grafik Customer yang paling Sering membeli "]
        };
    },

    mounted(){
        this.changePage();
        this.thisDate();
    },
    methods: {
        loadData(){
             axios.get(this.url).then((response) => {
                 this.Data = [];
                 this.Data = response.data.data;
                 this.pagination = response.data;
                 console.log(this.Data);
                 console.log(this.tipeData);
                 //console.log(this.labelschart);
                    if(this.tipeData ==3){
                        this.addArray(this.Data);
                        //this.fillData();
                    }
             });
        },
        fetchPaginate(url) {
                this.url = url;
                this.loadData();
        },
        thisDate(){
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = yyyy+"-"+mm+"-"+dd;
            this.tanggalHari = today;
        },
        makePagination(data) {
            let pagination = {
                current_page: data.current_page,
                last_page: data.last_page,
                next_page_url: data.next_page_url,
                prev_page_url: data.prev_page_url,
            };
            this.pagination = pagination;
        },
        changePage() {
            this.url = "/api/admin/laporan/changePaginate/" + this.perPage+"/"+this.Tipe+"/"+this.secara+"/"+this.orderBy+"/"+this.tanggalHari+"/"+this.tipeData+"/"+this.tipeChart;
            this.loadData();
        },
        onChangeOrderBy(event){
            this.orderBy = event.target.value;
            this.url = "/api/admin/laporan/changePaginate/" + this.perPage+"/"+this.Tipe+"/"+this.secara+"/"+this.orderBy+"/"+this.tanggalHari+"/"+this.tipeData+"/"+this.tipeChart;
            this.loadData();
        },
         onChangeSecara(event){
            this.secara = event.target.value;
            this.url = "/api/admin/laporan/changePaginate/" + this.perPage+"/"+this.Tipe+"/"+this.secara+"/"+this.orderBy+"/"+this.tanggalHari+"/"+this.tipeData+"/"+this.tipeChart;
            this.loadData();
        },
        onChangeTipe(event){
            this.Tipe = event.target.value;
            if(this.Tipe ==0){
                document.getElementById("datepicker").disabled = true;
            }else{
                document.getElementById("datepicker").disabled = false;
            }
            this.tanggalHari = document.getElementById("datepicker").value;
            this.url = "/api/admin/laporan/changePaginate/" + this.perPage+"/"+this.Tipe+"/"+this.secara+"/"+this.orderBy+"/"+this.tanggalHari+"/"+this.tipeData+"/"+this.tipeChart;
            this.loadData();
        },
        onChange2(){
            this.tanggalHari = document.getElementById("datepicker").value;
            this.url = "/api/admin/laporan/changePaginate/" + this.perPage+"/"+this.Tipe+"/"+this.secara+"/"+this.orderBy+"/"+this.tanggalHari+"/"+this.tipeData+"/"+this.tipeChart;
            this.loadData();
        },
        search(){
            this.Search = document.getElementById("acuanSearch").value;
            if (this.keywords.length > 0) {
                this.url =
                "/api/admin/laporan/search/" + this.perPage+"/"+this.Tipe+"/"+this.secara+"/"+this.orderBy+"/"+this.tanggalHari+"/"+this.tipeData+"/"+this.Search+"/"+this.keywords;
                console.log(this.url);
            } else {
                this.url = "/api/admin/laporan/changePaginate/" + this.perPage+"/"+this.Tipe+"/"+this.secara+"/"+this.orderBy+"/"+this.tanggalHari+"/"+this.tipeData+"/"+this.tipeChart;

            }
            this.loadData();
        },
        gantiLaporan(event){
            this.tipeData = event;
            if(this.tipeData == 3) {
                this.perPage = 5;
                document.getElementById("tipe3").style.display = "inline";
            }else{

                document.getElementById("tipe3").style.display = "none";
            }
            this.changePage();
        },
        gantiAcuan(event){
            this.search = event.target.value;
        },
        addArray(obs){
            this.labelschart = [];
            this.dataschart = [];
            if(this.tipeChart == 0){
                 for(var i=0; i<obs.length;i++){
                    this.labelschart.push(obs[i].tanggal);
                    this.dataschart.push(obs[i].subtotal);
                }
            } else{
                 for(var i=0; i<obs.length;i++){
                    this.labelschart.push(obs[i].nama);
                    this.dataschart.push(obs[i].jum);
                }
            }

            this.fillData();

        }
        ,
        fillData () {
            this.datacollection = {
            // Data for the y-axis of the chart
            labels: this.labelschart,
                datasets: [
                    {
                        label:this.judulChart,
                        backgroundColor: '#00FFFF',
                        // Data for the x-axis of the chart
                        data: this.dataschart,
                    }
                ]
            }
        },
        onChangeisiTipe(event){
            this.tipeChart = event.target.value;
            this.judulChart = this.isiTipeChart[this.tipeChart];
             this.url = "/api/admin/laporan/changePaginate/" + this.perPage+"/"+this.Tipe+"/"+this.secara+"/"+this.orderBy+"/"+this.tanggalHari+"/"+this.tipeData+"/"+this.tipeChart;
            this.loadData();
        }

    }

}
</script>

<style scoped>
.wrapper-sub-kategori {
  margin-left: 3rem;
}
.btn-primary{
    margin: 2;
}

.ui-datepicker-calendar {
   display: none;
}
</style>
