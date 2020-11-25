<template>
    <div class="wrapper-sub-kategori">
        <br />
        <h1 class="m-0 text-dark">Admin Alat Kesehatan</h1>
        <br />

        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Insert Alat Kesehatan Baru</h3>
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
                <label for="">Search Title Alat Kesehatan</label>
                <div class="input-group">
                <input
                    type="text"
                    class="form-control"
                    id=""
                    placeholder="Co: Cara Pakai Puyer"
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
                <th>Title</th>
                <th>Gambar</th>
                <th>Url</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(alat, index) in alat_Kesehatans" :key="index">
                <td>{{ index + 1 }}</td>
                <td>{{ alat.nama }}</td>
                <td>
                    <!-- contoh path img -->
                    <!-- /img_database/Screenshot (4).png -->
                    <span v-if="!alat.gambar">Belum ada gambar</span>
                    <img
                    v-bind:src="alat.gambar"
                    v-if="alat.gambar"
                    alt=""
                    srcset=""
                    width="50px;"
                    />
                </td>
                <td>{{ alat.slug }}</td>
                <td>
                    <div
                    class="btn btn-sm btn-primary"
                    @click="getDetail(alat, alat.id)"
                    data-toggle="modal"
                    data-target="#myModal"
                    >
                    Edit
                    </div>
                    <div class="btn btn-sm btn-danger" @click="deleteData(alat)">
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

                <!-- <li
                class="page-item"
                v-for="(page, index) in parseInt(pagination.to)"
                :key="index"
            >
                <button class="page-link" @click="fetchPaginate(index + 1)">
                {{ index + 1 }}
                </button>
            </li> -->

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
            <h2 v-if="alat_Kesehatans.length == 0" class="text-center mt-2">
            Belum ada data alat kesehatan
            </h2>
        </div>
            <div class="card-header">
                <h3 class="card-title">Insert Alat Kesehatan Baru</h3>
            </div>

            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" @submit.prevent="addData()">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nama Alat Kesehatan</label>
                        <input
                        type="text"
                        class="form-control"
                        id=""
                        placeholder="Co: Kursi Roda"
                        v-model="form.nama"
                        />
                    </div>

                    <div class="form-group">
                        <label for="">Gambar Alat Kesehatan</label>
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm">
                            <label for="">Harga Alat Kesehatan</label>
                            <input
                            type="text"
                            class="form-control"
                            id=""
                            placeholder="Co: 5000"
                            v-model="form.harga"
                            />
                        </div>
                        <div class="form-group col-sm">
                            <label for="">Stok Alat Kesehatan</label>
                            <input
                            type="text"
                            class="form-control"
                            id=""
                            placeholder="Co: 10 pc"
                            v-model="form.stok"
                            />
                        </div>

                        <div class="form-group col-sm">
                            <label for="">Satuan Alat Kesehatan</label>
                            <input
                            type="text"
                            class="form-control"
                            id=""
                            placeholder="Co: 1 pasang"
                            v-model="form.satuan"
                            />
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="">Manufaktur Alat Kesehatan</label>
                        <input
                        type="text"
                        class="form-control"
                        id=""
                        v-model="form.manufaktur"
                        />
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
                    <div class="form-group">
                        <label for="">Kemasan Alat Kesehatan</label>
                        <input
                        type="text"
                        class="form-control"
                        id=""
                        v-model="form.kemasan"
                        />
                    </div>

                    <div class="form-group">
                        <label for="">Deskripsi Alat Kesehatan</label>
                        <textarea
                        class="form-control"
                        name=""
                        id=""
                        cols="30"
                        rows="10"
                        v-model="form.deskripsi"
                        ></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Keterangan Alat Kesehatan</label>
                        <textarea
                        class="form-control"
                        name=""
                        id=""
                        cols="30"
                        rows="10"
                        v-model="form.keterangan"
                        ></textarea>
                    </div>

                    <br />
                </div>

                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </div>
            </form>
        </div>

    <div
      class="modal fade show"
      id="modal-edit"
      style="display: hidden; padding-right: 16px"
      aria-modal="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Alat Kesehatan</h4>
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
                        <label for="">Nama Alat Kesehatan</label>
                        <input
                        type="text"
                        class="form-control"
                        id=""
                        placeholder="Co: Kursi Roda"
                        v-model="editForm.nama"
                        />
                    </div>

                    <div class="form-group">
                        <label for="">Gambar Alat Kesehatan</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input
                                type="file"
                                class="custom-file-input"
                                id=""
                                ref="file"
                                @change="processFile($event, 'add')"
                                />
                                <span class="custom-file-label">{{ editForm.gambar.name }} </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm">
                            <label for="">Harga Alat Kesehatan</label>
                            <input
                            type="text"
                            class="form-control"
                            id=""
                            placeholder="Co: 5000"
                            v-model="editForm.harga"
                            />
                        </div>
                        <div class="form-group col-sm">
                            <label for="">Stok Alat Kesehatan</label>
                            <input
                            type="text"
                            class="form-control"
                            id=""
                            placeholder="Co: 10 pc"
                            v-model="editForm.stok"
                            />
                        </div>
                        <div class="form-group col-sm">
                            <label for="">Satuan Alat Kesehatan</label>
                            <input
                            type="text"
                            class="form-control"
                            id=""
                            placeholder="Co: 1 pasang"
                            v-model="editForm.satuan"
                            />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Manufaktur Alat Kesehatan</label>
                        <input
                        type="text"
                        class="form-control"
                        id=""
                        v-model="editForm.manufaktur"
                        />
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
                        <div
                        class="form-group"
                        v-for="i in parseInt(manykategori)"
                        :key="i"
                        >
                        <select class="form-control tag-pilihan-update" id="">
                            <option v-for="kategori in kategories" :key="kategori.id" :value="kategori.id">
                            {{ kategori.nama }}
                            </option>
                        </select>
                        </div>
                        </div>
                    <div class="form-group">
                        <label for="">Kemasan Alat Kesehatan</label>
                        <input
                        type="text"
                        class="form-control"
                        id=""
                        v-model="editForm.kemasan"
                        />
                    </div>

                    <div class="form-group">
                        <label for="">Deskripsi Alat Kesehatan</label>
                        <textarea
                        class="form-control"
                        name=""
                        id=""
                        cols="30"
                        rows="10"
                        v-model="editForm.deskripsi"
                        ></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Keterangan Alat Kesehatan</label>
                        <textarea
                        class="form-control"
                        name=""
                        id=""
                        cols="30"
                        rows="10"
                        v-model="editForm.keterangan"
                        ></textarea>
                    </div>
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

<script>
export default {
  name: "Alat_Kesehatan",
  data() {
    return {
      alat_Kesehatans: [],
      pagination: [],
      tagsUpdate: [],
      Kategoris : [],
      kategories : [],
      perPage: 5,
      url: "/api/admin/alatkesehatan",
      keywords: "",
      tags: [],
      form: {
        nama: "",
        gambar: "",
        harga: "",
        stok: "",
        satuan: "",
        deskripsi: "",
        manufaktur: "",
        kemasan: "",
        keterangan: "",
      },
      editForm: {
        id:"",
        nama: "",
        gambar: "",
        harga: "",
        stok: "",
        satuan: "",
        deskripsi: "",
        manufaktur: "",
        kemasan: "",
        keterangan: "",
      },
      errors: {},
      isLoading: false,
      isSuccess: false,
      manyTags: 1,
      manykategori :1,
    };
  },
  mounted() {
    this.loadData();
    this.getKategoris();
  },
  methods: {
    loadData() {
      axios
        .get(this.url)
        .then((result) => {
            this.alat_Kesehatans = result.data.data;
            this.makePagination(result.data) ;
            this.form.nama = "";
            this.form.gambar = "";
            this.form.harga = "";
            this.form.stok = "";
            this.form.satuan = "";
            this.form.deskripsi = "";
            this.form.manufaktur = "";
            this.form.keterangan = "";
        })
        .catch((err) => {
          console.log("err");
        });
    },
    makeCombobox() {
      this.getKategoris();
    },
    getKategoris() {
      axios
        .get("/api/admin/obat/kategori")
        .then((result) => {
          this.kategories = result.data;
        })
        .catch((err) => {});
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
      this.url = "/api/admin/alatkesehatan/changePaginate/" + this.perPage;
      this.loadData();
    },
    search() {
      if (this.keywords.length > 0) {
        this.url =
          "/api/admin/alatkesehatan/search/" + this.keywords + "/" + this.perPage;
        console.log(this.url);
      } else {
        this.url = "/api/admin/alatkesehatan";
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
    addData() {
      this.errors = {};
      this.isLoading = true;
      this.isSuccess = false;

      let formData = new FormData();

      formData.append("nama", this.form.nama);
      formData.append("gambar", this.form.gambar);
      formData.append("harga", this.form.harga);
      formData.append("stok", this.form.stok);
      formData.append("satuan", this.form.satuan);
      formData.append("deskripsi", this.form.deskripsi);
      formData.append("manufaktur", this.form.manufaktur);
      formData.append("kemasan", this.form.kemasan);
      formData.append("keterangan", this.form.keterangan);
      var selectedTags = $(".tag-pilihan-insert")
                        .map((_, el) => el.value)
                        .get();

                    formData.append("kategoris", selectedTags);

      axios
        .post("/api/admin/alatkesehatan", formData)
        .then((response) => {
          this.isSuccess = true;
          this.loadData();
        });
    },
    updateData() {
      this.errors = {};
      this.isLoading = true;
      this.isSuccess = false;

      let formData = new FormData();
      formData.append("id", this.editForm.id);
      formData.append("nama", this.editForm.nama);
      formData.append("gambar", this.editForm.gambar);
      formData.append("harga", this.editForm.harga);
      formData.append("stok", this.editForm.stok);
      formData.append("satuan", this.editForm.satuan);
      formData.append("deskripsi", this.editForm.deskripsi);
      formData.append("manufaktur", this.editForm.manufaktur);
      formData.append("kemasan", this.editForm.kemasan);
      formData.append("keterangan", this.editForm.keterangan);
      var selectedTags = $(".tag-pilihan-update")
                        .map((_, el) => el.value)
                        .get();

                    formData.append("kategoris", selectedTags);

      axios
        .post("/api/admin/alatkesehatan/update", formData)
        .then((response) => {
          this.loadData();
          this.isSuccess = true;
          $("#modal-edit").modal("hide");
        })
        .catch(({ response }) => {
          this.errors = response.data.errors;
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    getDetail(alatkesehatan, id) {
      //ambil pada content pada array alatkesehatans dengan cari id yang sama
      let content = this.alat_Kesehatans.filter((art) => art.id == id);

      let alatkesehatanClone = Object.assign({}, alatkesehatan);
      $("#modal-edit").modal("show");
      this.editForm = alatkesehatanClone;

      if (alatkesehatanClone.gambar == null) {
        this.form.gambar = "Belum ada Gambar";
      }

    },
    deleteData(alatkesehatan) {
      axios
        .post("/api/admin/alatkesehatan/delete", {
          id: alatkesehatan.id,
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
