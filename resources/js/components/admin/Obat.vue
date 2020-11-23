<template>
  <div class="wrapper-sub-kategori">
    <br />
    <h1 class="m-0 text-dark">Admin Obat</h1>
    <br />
        <div class="card">
      <div class="card-header">
        <h3 class="card-title">List Semua Obat</h3>
      </div>
      <div class="card-body">
          <div class="row">
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
            <label for="">Search Obat</label>
            <div class="input-group">
              <input
                type="text"
                class="form-control"
                id=""
                placeholder="Co: Puyer"
                v-model="keywords"
              />
              <button class="btn btn-primary" @click="search">Cari</button>
            </div>
          </div>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th>Nama</th>
              <th>Gambar</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Keterangan</th>
              <th>Dosis</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(obat, index) in Obats" :key="obat.id">
              <td>{{ index + 1 }}</td>
              <td>{{ obat.nama }}</td>
              <td>
                <!-- contoh path img -->
                <!-- /img_database/Screenshot (4).png -->
                <span v-if="!obat.gambar">Belum ada gambar</span>
                <img
                  v-bind:src="obat.gambar"
                  v-if="obat.gambar"
                  alt=""
                  srcset=""
                  width="50px;"
                />
              </td>
              <td>{{ obat.harga }}</td>
              <td>{{ obat.stok }}</td>
              <td>{{ obat.keterangan }}</td>
                <td>{{ obat.dosis }}</td>

               <td>
                <div
                  class="btn btn-sm btn-primary"
                  @click="getDetail(obat)"

                >
                  Edit
                </div>
                <div
                  class="btn btn-sm btn-danger"
                  @click="deleteData(obat)"
                >
                  Delete
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="card-footer clearfix">
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
        <h2 v-if="Obats.length == 0" class="text-center mt-2">
          Belum ada data Obat
        </h2>
      </div>
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
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title" v-if="form.tp == 1">Insert Obat Baru </h3>
                <h3 class="card-title" v-if="form.tp == 2">Edit Obat   <div
                  class="btn btn-sm btn-danger"
                  @click="loadData()"
                  style="margin-left:20vw"
                >
                  Insert baru
                </div></h3>

      </div>
    </div>
    <form enctype="multipart/form-data" @submit.prevent="addData()">
    <input type="hidden"
        v-model ="form.tp"
    >
    <div class="row row-cols-1 row-cols-md-2">
      <div class="col mb-4">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Form Obat Part 1</h5>
          </div>


            <div class="card-body">
              <div class="form-group">
                <label for="">Kode Obat</label>
                <input
                  type="text"
                  class="form-control"
                  id=""
                  placeholder="Kode"
                  v-model="form.kode"
                  disabled
                />
              </div>
              <div class="form-group">
                <label for="">Nama Obat</label>
                <input
                  type="text"
                  class="form-control"
                  id=""
                  placeholder="Contoh: Saridon"
                  v-model="form.nama"
                  @keyup="autogenKode()"
                />
                 <span
                    class="invalid-feedback d-block"
                    v-if="errors.hasOwnProperty('nama')"
                    >
                    {{ errors.nama[0] }}
                </span>
              </div>
              <div class="form-group">
                <label for="">Gambar Obat</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input
                      type="file"
                      class="custom-file-input"
                      id=""
                      ref="file"
                      @change="processFile($event, 'add')"
                    />
                    <span class="custom-file-label" v-if="form.tp ==1"> {{ form.gambar.name }} </span>
                    <span class="custom-file-label" v-if="form.tp ==2"> {{ form.gambar }} </span>
                  </div>
                  <span
                    class="invalid-feedback d-block"
                    v-if="errors.hasOwnProperty('gambar')"
                    >
                    {{ errors.gambar[0] }}
                </span>
                </div>
              </div>
              <div class="form-group">
                <label for="">Harga Obat</label>
                <input
                  type="number"
                  class="form-control"
                  id=""
                  v-model="form.harga"
                />
                 <span
                    class="invalid-feedback d-block"
                    v-if="errors.hasOwnProperty('harga')"
                    >
                    {{ errors.harga[0] }}
                </span>
              </div>
            </div>

        </div>
      </div>
      <div class="col mb-4">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Form Obat Part 2</h5>
          </div>

            <div class="card-body">
              <div class="form-group">
                <label for="">Indikasi Obat</label>
                <input
                  type="text"
                  class="form-control"
                  id=""
                  placeholder="Indikasi"
                  v-model="form.indikasi"
                />
                 <span
                    class="invalid-feedback d-block"
                    v-if="errors.hasOwnProperty('indikasi')"
                    >
                    {{ errors.indikasi[0] }}
                </span>
              </div>
              <div class="form-group">
                <label for="">Stok Obat</label>
                <input
                  type="number"
                  class="form-control"
                  id=""
                  placeholder=""
                  v-model="form.stok"
                />
                 <span
                    class="invalid-feedback d-block"
                    v-if="errors.hasOwnProperty('stok')"
                    >
                    {{ errors.stok[0] }}
                </span>
              </div>
              <div class="form-group">
                <label for="">Satuan Obat</label>
                <input
                  type="text"
                  class="form-control"
                  id=""
                  placeholder=""
                  v-model ="form.satuan"
                />
                 <span
                    class="invalid-feedback d-block"
                    v-if="errors.hasOwnProperty('satuan')"
                    >
                    {{ errors.satuan[0] }}
                </span>
              </div>
              <div class="form-group">
                <label for="">Kemasan Obat</label>
                <input
                  type="text"
                  class="form-control"
                  id=""
                  placeholder=""
                  v-model ="form.kemasan"
                />
                 <span
                    class="invalid-feedback d-block"
                    v-if="errors.hasOwnProperty('kemasan')"
                    >
                    {{ errors.kemasan[0] }}
                </span>
              </div>
            </div>

        </div>
      </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2">
      <div class="col mb-4">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Form Obat Part 3</h5>
          </div>

            <div class="card-body">
              <div class="form-group">
                <label for="">Deskripsi Obat</label>
                <textarea name="comment" class="form-control" placeholder="Enter text here..."
                  v-model ="form.deskripsi"
                ></textarea>
                 <span
                    class="invalid-feedback d-block"
                    v-if="errors.hasOwnProperty('deskripsi')"
                    >
                    {{ errors.deskripsi[0] }}
                </span>
              </div>
              <div class="form-group">
                <label for="">Komposisi Obat</label>
                <textarea name="comment" class="form-control" placeholder="Enter text here..."
                  v-model="form.komposisi"
                ></textarea>
                 <span
                    class="invalid-feedback d-block"
                    v-if="errors.hasOwnProperty('komposisi')"
                    >
                    {{ errors.komposisi[0] }}
                </span>
              </div>
              <div class="form-group">
                <label for="">Dosis Obat</label>
               <input type="text" class="form-control"
               placeholder="Dosis Obat"
                v-model ="form.dosis"
              >
               <span
                    class="invalid-feedback d-block"
                    v-if="errors.hasOwnProperty('dosis')"
                    >
                    {{ errors.dosis[0] }}
                </span>
              </div>
              <div class="form-group">
                 <label for="">Segmentasi Obat</label>
                <input type="text" class="form-control"
                placeholder="Segmentasi"
                  v-model ="form.segmentasi"
                >
                 <span
                    class="invalid-feedback d-block"
                    v-if="errors.hasOwnProperty('segmentasi')"
                    >
                    {{ errors.segmentasi[0] }}
                </span>
              </div>
            </div>

        </div>
      </div>
      <div class="col mb-4">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Form Obat Part 4 (Terakhir)</h5>
          </div>

            <div class="card-body">
              <div class="form-group">
                <label for="">Manufaktur</label>
                <input
                  type="text"
                  class="form-control"
                  id=""
                  placeholder="Manufaktur"
                  v-model ="form.manufaktur"
                />
                 <span
                    class="invalid-feedback d-block"
                    v-if="errors.hasOwnProperty('manufaktur')"
                    >
                    {{ errors.gambar[0] }}
                </span>
              </div>
              <div class="form-group">
                <label for="">Keterangan Obat</label>
                <textarea name="comment" class="form-control"
                 placeholder="Enter text here..."
                 v-model ="form.keterangan"></textarea>
                 <span
                    class="invalid-feedback d-block"
                    v-if="errors.hasOwnProperty('keterangan')"
                    >
                    {{ errors.keterangan[0] }}
                </span>
              </div>






        <div class="form-group">
                  <label for="">Banyaknya Kategori</label> <br />
                  <div v-if="form.tp ==2">
                        <label for="" >Kategori sebelumnya :</label>
                        <span
                            class="btn btn-sm btn-danger mr-2"

                            v-for="kategories in Kategoris"
                            :key="kategories"
                        >
                            {{ kategories }}
                        </span>
                  </div>
                  <br />
                  <input
                    type="number"
                    class="form-control"
                    id=""
                    placeholder="Co: 2"
                    v-model="manykategori"
                    @change="makeCombobox"
                  />
                  <span
                    class="invalid-feedback d-block"
                    v-if="errors.hasOwnProperty('kategories')"
                  >
                    {{ errors.kategories[0] }}
                  </span>
                </div>
                <div
                  class="form-group"
                  v-for="i in parseInt(manykategori)"
                  :key="i"
                >
                  <select class="form-control tag-pilihan-insert" id="">
                    <option v-for="kategori in kategories" :key="kategori.id" :value="kategori.id">
                      {{ kategori.nama }}
                    </option>
                  </select>
                </div>
                </div>
                <div class="card-footer">
              <button type="submit" class="btn btn-primary">
                  <span v-if="form.tp ==1">Tambahkan</span>
                  <span v-if="form.tp ==2">Simpan Perubahan</span>
             </button>
            </div>
        </div>
        </div>
    </div>
       </form>

  </div>

</template>
<style scoped>
.wrapper-sub-kategori {
  margin-left: 3rem;
}
</style>
<script src="./jquery.min.js" ></script>
<script>
export default {
  name: "Obat",
  data() {
    return {
      Obats: [],
      Kategoris : [],
      kategories : [],
      form: {
        kode: "",
        nama: "",
        gambar: "",
        harga: 0,
        indikasi:"",
        stok:0,
        satuan:"",
        kemasan:"",
        deskripsi:"",
        komposisi:"",
        dosis:"",
        segmentasi:"",
        manufaktur:"",
        keterangan:"",
        tp:1
      },
      errors: {},
      isLoading: false,
      isSuccess: false,
      manykategori :1,
      perPage: 5,
      keywords :"",
     pagination: [],
      url: "/api/admin/obat",
      dump : ""
    };
  },
  mounted() {
    this.loadData();
    this.getKategoris();
  },
  methods: {
    loadData() {
      axios.get(this.url).then((response) => {
        this.Obats = response.data.data;
        this.pagination = response.data;
        this.form.kode = "";
        this.form.nama = "";
        this.form.gambar = "";
        this.form.harga = 0;
        this.form.indikasi = "";
        this.form.stok = 0;
        this.form.satuan = "";
        this.form.kemasan = "";
        this.form.deskripsi = "";
        this.form.komposisi = "";
        this.form.dosis = "";
        this.form.segmentasi = "";
        this.form.manufaktur = "";
        this.form.keterangan = "";
        this.form.tp = 1;
        this.manykategori =1;
      });
    },
    addData() {
      this.errors = {};
      this.isLoading = true;
      this.isSuccess = false;

        if(this.form.tp == 1){
                  let formData = new FormData();
                    formData.append("id", this.form.kode);
                    formData.append("nama", this.form.nama);
                    formData.append("gambar", this.form.gambar);
                    formData.append("harga", this.form.harga);
                    formData.append("indikasi", this.form.indikasi);
                    formData.append("stok", this.form.stok);
                    formData.append("satuan", this.form.satuan);
                    formData.append("kemasan", this.form.kemasan);
                    formData.append("deskripsi", this.form.deskripsi);
                    formData.append("komposisi", this.form.komposisi);
                    formData.append("dosis", this.form.dosis);
                    formData.append("segmentasi", this.form.segmentasi);
                    formData.append("manufaktur", this.form.manufaktur);
                    formData.append("keterangan", this.form.keterangan);


                     //bikin array selectedTags isi nya id semua tag yang dipilih
                    var selectedTags = $(".tag-pilihan-insert")
                        .map((_, el) => el.value)
                        .get();

                    formData.append("kategoris", selectedTags);
                    axios
                        .post("/api/admin/obat", formData)
                        .then((response) => {
                        this.isSuccess = true;
                        this.loadData();
                        })
                        .catch(({ response }) => {
                        this.errors = response.data.errors;
                        alert(this.errors)
                        })
                        .finally(() => (this.isLoading = false));
        }else{
            let formData = new FormData();
                    formData.append("id", this.form.kode);
                    formData.append("nama", this.form.nama);
                    formData.append("gambar", this.form.gambar);
                    formData.append("harga", this.form.harga);
                    formData.append("indikasi", this.form.indikasi);
                    formData.append("stok", this.form.stok);
                    formData.append("satuan", this.form.satuan);
                    formData.append("kemasan", this.form.kemasan);
                    formData.append("deskripsi", this.form.deskripsi);
                    formData.append("komposisi", this.form.komposisi);
                    formData.append("dosis", this.form.dosis);
                    formData.append("segmentasi", this.form.segmentasi);
                    formData.append("manufaktur", this.form.manufaktur);
                    formData.append("keterangan", this.form.keterangan);

                       //bikin array selectedTags isi nya id semua tag yang dipilih
                    var selectedTags = $(".tag-pilihan-insert")
                        .map((_, el) => el.value)
                        .get();

                    formData.append("kategoris", selectedTags);

                    axios
                        .post("/api/admin/obat/update", formData)
                        .then((response) => {
                        this.isSuccess = true;
                        this.loadData();
                        })
                        .catch(({ response }) => {
                        this.errors = response.data.errors;

                        })
                        .finally(() => (this.isLoading = false));


        }
    },

     processFile(event, mode) {

        this.form.gambar = event.target.files[0];
    },
    fetchPaginate(url) {
      this.url = url;
      this.loadData();
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
      this.url = "/api/admin/obat/changePaginate/" + this.perPage;
      this.loadData();
    },
    search() {
      if (this.keywords.length > 0) {
        this.url =
          "/api/admin/obat/search/" + this.keywords + "/" + this.perPage;
        console.log(this.url);
      } else {
        this.url = "/api/admin/obat";
      }

      this.loadData();
    },
     autogenKode() {
      if (this.form.nama.length > 1) {
        axios
          .post("/api/admin/obat/generateID", {
            nama: this.form.nama,
          })
          .then((response) => {
            this.form.kode = response.data;
          })
          .catch(({ response }) => {
            this.errors = response.errors;
          });
      }

      if (this.form.nama.length < 2) {
        this.form.kode = "Kode";
      }
    },
    getDetail(obat) {
      //clone kategori supaya tidak merubah isi dari tabel asli
      let kategoriClone = Object.assign({}, obat);
      this.form = kategoriClone;
      this.form.kode = kategoriClone.id;
     this.form.nama = kategoriClone.nama;
        this.form.gambar = kategoriClone.gambar;
        this.form.harga = kategoriClone.harga;
        this.form.indikasi = kategoriClone.indikasi;
        this.form.stok = kategoriClone.stok;
        this.form.satuan = kategoriClone.satuan;
        this.form.kemasan = kategoriClone.kemasan;
        this.form.deskripsi = kategoriClone.deskripsi;
        this.form.komposisi = kategoriClone.komposisi;
        this.form.dosis = kategoriClone.dosis;
        this.form.segmentasi = kategoriClone.segmentasi;
        this.form.manufaktur = kategoriClone.manufaktur;
        this.form.keterangan = kategoriClone.keterangan;
        this.form.tp = 2;

        if(this.form.gambar == null) this.form.gambar ="";
         axios

        .get("/api/admin/obat/getKategori/" + this.form.kode)
        .then((result) => {
          this.Kategoris = result.data;
        })
         .catch(({ response }) => {
                        this.errors = response.data.errors;
                        alert(this.errors[0])
         })

        //this.manykategori = this.Kategoris.length;
    },
    getKategoris() {
      axios
        .get("/api/admin/obat/kategori")
        .then((result) => {
          this.kategories = result.data;
        })
        .catch((err) => {});
    },
    makeCombobox() {
      this.getKategoris();
    },
     deleteData(artikel) {
      axios
        .post("/api/admin/obat/delete", {
          id: artikel.id,
        })
        .then((response) => {
          this.loadData();
          alert("berhasil delete");
        })
        .catch((response) => {
          if (response.status === 422) {
            console.log("error hapus");
          }
        });
    },

  },
};
</script>

