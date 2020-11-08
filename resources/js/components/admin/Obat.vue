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
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th>Nama</th>
              <th>Gambar</th>
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
              <td>{{ obat.Keterangan }}</td>
              <!-- <td>
                <div
                  class="btn btn-sm btn-primary"
                  @click="getDetail(kategori)"
                  data-toggle="modal"
                  data-target="#myModal"
                >
                  Edit
                </div>
                <div
                  class="btn btn-sm btn-danger"
                  @click="deleteData(kategori)"
                >
                  Delete
                </div>
              </td> -->
            </tr>
          </tbody>
        </table>

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
        <h3 class="card-title">Insert Obat Baru</h3>
      </div>
    </div>
    <form enctype="multipart/form-data" @submit.prevent="addData()">
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
                    <span class="custom-file-label"> Pilih Gambar </span>
                  </div>
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
              </div>
              <div class="form-group">
                <label for="">Komposisi Obat</label>
                <textarea name="comment" class="form-control" placeholder="Enter text here..."
                  v-model="form.komposisi"
                ></textarea>
              </div>
              <div class="form-group">
                <label for="">Dosis Obat</label>
               <input type="text" class="form-control"
               placeholder="Dosis Obat"
                v-model ="form.dosis"
              >
              </div>
              <div class="form-group">
                 <label for="">Segmentasi Obat</label>
                <input type="text" class="form-control"
                placeholder="Segmentasi"
                  v-model ="form.segmentasi"
                >
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
              </div>
              <div class="form-group">
                <label for="">Keterangan Obat</label>
                <textarea name="comment" class="form-control"
                 placeholder="Enter text here..."
                 v-model ="form.keterangan"></textarea>

              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Tambahkan</button>
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
        keterangan:""
      },
      errors: {},
      isLoading: false,
      isSuccess: false,
    };
  },
  mounted() {
    this.loadData();
  },
  methods: {
    loadData() {
      axios.get("/api/admin/obat").then((response) => {
        this.Obats = response.data;
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
      });
    },
    addData() {
      this.errors = {};
      this.isLoading = true;
      this.isSuccess = false;

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
    },
    processFile(event, mode) {
      if (mode == "add") {
        this.form.gambar = event.target.files[0];
      } else {
        this.editForm.gambar = event.target.files[0];
      }
    },
     processFile(event, mode) {
      if (mode == "add") {
        this.form.gambar = event.target.files[0];
      } else {
        this.editForm.gambar = event.target.files[0];
      }
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

  },
};
</script>

