
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
              <th>Url</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(kategori, index) in kategories" :key="kategori.id">
              <td>{{ index + 1 }}</td>
              <td>{{ kategori.nama }}</td>
              <td>
                <!-- contoh path img -->
                <!-- /img_database/Screenshot (4).png -->
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
              <td>
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
              </td>
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
      <form enctype="multipart/form-data" @submit.prevent="addData()">
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
            <span
              class="invalid-feedback d-block"
              v-if="errors.hasOwnProperty('nama')"
            >
              {{ errors.nama[0] }}
            </span>
          </div>

          <div class="form-group">
            <label for="">Gambar Kategori</label>
            <div class="input-group">
              <div class="custom-file">
                <input
                  type="file"
                  class="custom-file-input"
                  id=""
                  ref="file"
                  @change="processFile($event, 'add')"
                />
                <span class="custom-file-label">{{ form.gambar.name }} </span>
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
            <label for="">Url Kategori</label>
            <input
              type="text"
              class="form-control"
              id=""
              placeholder="Co: anti-biotik"
              v-model="form.slug"
            />
          </div>
          <span
            class="invalid-feedback d-block"
            v-if="errors.hasOwnProperty('slug')"
          >
            {{ errors.slug[0] }}
          </span>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Tambahkan</button>
        </div>
      </form>
    </div>

    <!-- modal -->
    <div
      class="modal fade show"
      id="modal-edit"
      style="display: hidden; padding-right: 16px"
      aria-modal="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Kategori</h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="updateData()">
              <div class="card-body">
                <div class="form-group">
                  <label for="">Kode</label>
                  <input
                    type="text"
                    class="form-control"
                    id=""
                    placeholder="Kode"
                    v-model="editForm.kode"
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
                    v-model="editForm.nama"
                  />
                </div>

                <span
                  class="invalid-feedback d-block"
                  v-if="errors.hasOwnProperty('nama')"
                >
                  {{ errors.nama[0] }}
                </span>
                <div class="form-group">
                  <label for="">Gambar Kategori</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input
                        type="file"
                        class="custom-file-input"
                        id=""
                        @change="processFile($event, 'edit')"
                      />

                      <!-- akan dijalankan kalo file sudah dipilih -->
                      <span
                        class="custom-file-label"
                        v-if="editForm.gambar.name"
                        >{{ editForm.gambar.name }}
                      </span>
                      <!-- akan dijalankan kalo file dibiarkan user -->
                      <span
                        class="custom-file-label"
                        v-if="!editForm.gambar.name"
                        >{{ '"' + editForm.gambar + '"' }}
                      </span>
                    </div>
                  </div>
                </div>

                <span
                  class="invalid-feedback d-block"
                  v-if="errors.hasOwnProperty('gambar')"
                >
                  {{ errors.gambar[0] }}
                </span>

                <div class="form-group">
                  <label for="">Url Kategori</label>
                  <input
                    type="text"
                    class="form-control"
                    id=""
                    placeholder="Co: anti-biotik"
                    v-model="editForm.slug"
                  />
                </div>

                <span
                  class="invalid-feedback d-block"
                  v-if="errors.hasOwnProperty('slug')"
                >
                  {{ errors.slug[0] }}
                </span>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                  Update Data
                </button>
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
</template>

<script src="./jquery.min.js" ></script>
<script>
export default {
  name: "Kategori",
  data() {
    return {
      kategories: [],
      form: {
        kode: "",
        nama: "",
        gambar: "",
        slug: "",
      },
      editForm: {
        kode: "",
        nama: "",
        gambar: "",
        slug: "",
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
      axios.get("/api/admin/kategori").then((response) => {
        this.kategories = response.data.all_kategori;
        this.form.kode = "";
        this.form.nama = "";
        this.form.gambar = "";
        this.form.slug = "";
      });
    },
    processFile(event, mode) {
      if (mode == "add") {
        this.form.gambar = event.target.files[0];
      } else {
        this.editForm.gambar = event.target.files[0];
      }
    },
    addData() {
      this.errors = {};
      this.isLoading = true;
      this.isSuccess = false;

      let formData = new FormData();
      formData.append("id", this.form.kode);
      formData.append("nama", this.form.nama);
      formData.append("gambar", this.form.gambar);
      formData.append("slug", this.form.slug);

      axios
        .post("/api/admin/kategori", formData)
        .then((response) => {
          this.isSuccess = true;
          this.loadData();
        })
        .catch(({ response }) => {
          this.errors = response.data.errors;
          console.log("error");
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
          .catch(({ response }) => {
            this.errors = response.data.errors;
          });
      }

      if (this.form.nama.length < 2) {
        this.form.kode = "Kode";
      }
    },
    getDetail(kategori) {
      //clone kategori supaya tidak merubah isi dari tabel asli
      let kategoriClone = Object.assign({}, kategori);
      $("#modal-edit").modal("show");
      this.editForm = kategoriClone;
      this.editForm.kode = kategoriClone.id;
      this.editForm.gambar = kategoriClone.gambar;
      console.log(this.editForm.gambar);
    },
    updateData() {
      this.errors = {};
      this.isLoading = true;
      this.isSuccess = false;

      let formData = new FormData();
      formData.append("id", this.editForm.kode);
      formData.append("nama", this.editForm.nama);
      formData.append("gambar", this.editForm.gambar);
      formData.append("slug", this.editForm.slug);

      axios
        .post("/api/admin/kategori/update", formData)
        .then((response) => {
          this.loadData();
          this.isSuccess = true;
          $("#modal-edit").modal("hide");
        })
        .catch(({ response }) => {
          this.errors = response.data.errors;
          console.log(this.errors);
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    deleteData(kategori) {
      axios
        .post("/api/admin/kategori/delete", {
          id: kategori.id,
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

<style scoped>
.wrapper-sub-kategori {
  margin-left: 3rem;
}
</style>