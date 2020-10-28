
<template>
  <div class="wrapper-sub-kategori">
    <br />
    <h1 class="m-0 text-dark">Admin Kategori</h1>
    <br />
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">List Semua Kategori</h3>
      </div>
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
              <td>{{ index + 1 }}</td>
              <td>{{ kategori.nama }}</td>
              <td>
                <span v-if="!kategori.gambar">Belum ada gambar</span>
                <img
                  v-bind:src="kategori.gambar"
                  v-if="kategori.gambar"
                  alt=""
                  srcset=""
                  width="50px;"
                />
              </td>
              <td>{{ kategori.slug }}</td>
            </tr>
          </tbody>
        </table>

        <h2 v-if="kategories.length == 0" class="text-center mt-2">
          Belum ada data kategori
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
        <h3 class="card-title">Insert Kategori Baru</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form @submit.prevent="addData()">
        <div class="card-body">
          <div class="form-group">
            <label for="">Kode</label>
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
            <label for="">Nama Kategori</label>
            <input
              type="text"
              class="form-control"
              id=""
              placeholder="Co: Antibiotik"
              v-model="form.nama"
              @keyup="autogenKode()"
            />
          </div>
          <div class="form-group">
            <label for="">Gambar Kategori</label>
            <div class="input-group">
              <div class="custom-file">
                <input
                  type="file"
                  class="custom-file-input"
                  id=""
                  @change="processFile($event)"
                />
                <span class="custom-file-label">{{ form.gambar }} </span>
                <!-- <label class="" for=""> Pilih Gambar </label> -->
              </div>
              <div class="input-group-append">
                <span class="input-group-text" id="btnUploadGambar"
                  >Upload</span
                >
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="">Url Kategori</label>
            <input
              type="text"
              class="form-control"
              id=""
              placeholder="Co: anti-biotik"
              v-model="form.slug"
            />
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Tambahkan</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "Kategori",
  data() {
    return {
      kategories: [],
      form: {
        kode: "",
        nama: "",
        gambar: "Pilih Gambar",
        slug: "",
      },
      errors: [],
      isLoading: false,
      isSuccess: false,
    };
  },
  mounted() {
    this.loadData(), this.autogenKode();
  },
  methods: {
    loadData() {
      axios
        .get("/api/admin/kategori")
        .then((response) => {
          this.kategories = response.data.all_kategori;
          this.form.kode = "";
          this.form.nama = "";
          this.form.gambar = "";
          this.form.slug = "";
        })
        .catch((error) => {});
    },
    processFile(event) {
      this.form.gambar = event.target.files[0].name;
      console.log(this.form.gambar);
    },
    addData() {
      this.isLoading = true;
      this.isSuccess = false;
      axios
        .post("/api/admin/kategori", {
          id: this.form.kode,
          nama: this.form.nama,
          gambar: this.form.gambar,
          slug: this.form.slug,
        })
        .then((response) => {
          this.isSuccess = true;
          this.loadData();
        })
        .catch((error) => {
          if (error.status === 422) {
            this.errors = error.data.errors;
          }
        })
        .finally(() => (this.isLoading = false));
    },
    autogenKode() {
      if (this.form.nama.length > 1) {
        axios
          .post("/api/admin/kategori/generateID", {
            nama: this.form.nama,
          })
          .then((response) => {
            this.form.kode = response.data;
          })
          .catch((response) => {
            if (error.status === 422) {
              this.errors = error.data.errors;
            }
          });
      }

      if (this.form.nama.length < 2) {
        this.form.kode = "Kode";
      }
    },
  },
};
</script>

<style scoped>
.wrapper-sub-kategori {
  margin-left: 3rem;
}
</style>