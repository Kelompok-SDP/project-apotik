
<template>
  <div class="wrapper-sub-tag">
    <br />
    <h1 class="m-0 text-dark">Admin Tag</h1>
    <br />
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">List Semua Tag</h3>
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
            <label for="">Search Nama Kategori</label>
            <div class="input-group">
              <input
                type="text"
                class="form-control"
                id=""
                placeholder="Co: Pil"
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
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(tag, index) in tags" :key="index">
              <td>{{ index + 1 }}</td>
              <td>{{ tag.nama }}</td>
              <td>
                <div
                  class="btn btn-sm btn-primary"
                  @click="getDetail(tag)"
                  data-toggle="modal"
                  data-target="#myModal"
                >
                  Edit
                </div>
                <div class="btn btn-sm btn-danger" @click="deleteData(tag)">
                  Delete
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <h2 v-if="tags.length == 0" class="text-center mt-2">
          Belum ada data tag
        </h2>
      </div>

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
    </div>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Insert Tag Baru</h3>
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
            <label for="">Nama Tag</label>
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
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <VueLoadingButton
            class="btn btn-primary"
            :styled="true"
            :loading="isLoading"
            @click.native="addData"
          />
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
            <h4 class="modal-title">Edit Tag</h4>
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
                  <label for="">Nama Tag</label>
                  <input
                    type="text"
                    class="form-control"
                    id=""
                    placeholder="Co: Pil"
                    v-model="editForm.nama"
                  />
                </div>

                <span
                  class="invalid-feedback d-block"
                  v-if="errors.hasOwnProperty('nama')"
                >
                  {{ errors.nama[0] }}
                </span>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <VueLoadingButton
                  class="btn btn-primary"
                  :styled="true"
                  :loading="isLoading"
                  @click.native="updateData"
                />
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
import VueLoadingButton from "vue-loading-button";
export default {
  name: "Tag",
  components: {
    VueLoadingButton: VueLoadingButton,
  },
  data() {
    return {
      tags: [],
      pagination: [],
      perPage: 5,
      url: "/api/admin/tag",
      keywords: "",
      form: {
        kode: "",
        nama: "",
      },
      editForm: {
        kode: "",
        nama: "",
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
      // let $this = this;
      axios
        .get(this.url)
        .then((response) => {
          this.tags = response.data.data;
          this.makePagination(response.data);
          this.form.kode = "";
          this.form.nama = "";
        })
        .catch((err) => {
          console.log("err");
        });
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
      this.url = "/api/admin/tag/changePaginate/" + this.perPage;
      this.loadData();
    },
    search() {
      if (this.keywords.length > 0) {
        this.url =
          "/api/admin/tag/search/" + this.keywords + "/" + this.perPage;
      } else {
        this.url = "/api/admin/tag";
      }

      this.loadData();
    },
    processFile(event, mode) {
      if (mode == "add") {
        this.form.gambar = event.target.files[0];
      } else {
        this.editForm.gambar = event.target.files[0];
      }
    },
    updateData() {
      this.errors = {};
      this.isLoading = true;
      this.isSuccess = false;

      let formData = new FormData();
      formData.append("id", this.editForm.kode);
      formData.append("nama", this.editForm.nama);

      axios
        .post("/api/admin/tag/update", formData)
        .then((response) => {
          this.loadData();
          this.isSuccess = true;
          $("#modal-edit").modal("hide");
        })
        .catch(({ response }) => {
          this.errors = response.data.errors;
        })
        .finally(() =>
          setInterval(() => {
            this.isLoading = false;
          }, 1000)
        );
    },
    addData() {
      this.errors = {};
      this.isLoading = true;
      this.isSuccess = false;

      let formData = new FormData();
      formData.append("id", this.form.kode);
      formData.append("nama", this.form.nama);

      axios
        .post("/api/admin/tag", formData)
        .then((response) => {
          this.isSuccess = true;
          this.loadData();
        })
        .catch(({ response }) => {
          this.errors = response.data.errors;
          console.log("error");
        })
        .finally(() =>
          setInterval(() => {
            this.isLoading = false;
          }, 1000)
        );
    },
    autogenKode() {
      if (this.form.nama.length > 1) {
        axios
          .post("/api/admin/tag/generateID", {
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
    getDetail(tag) {
      //clone tag supaya tidak merubah isi dari tabel asli
      let tagClone = Object.assign({}, tag);
      $("#modal-edit").modal("show");
      this.editForm = tagClone;
      this.editForm.kode = tagClone.id;
    },
    deleteData(tag) {
      axios
        .post("/api/admin/tag/delete", {
          id: tag.id,
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
.wrapper-sub-tag {
  margin-left: 3rem;
}
</style>
