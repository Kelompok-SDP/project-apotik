<template>
  <div class="wrapper-sub-kategori">
    <br />
    <h1 class="m-0 text-dark">Admin Artikel</h1>
    <br />

    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Insert Artikel Baru</h3>
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
            <label for="">Search Title Artikel</label>
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
            <tr v-for="(artikel, index) in artikels" :key="index">
              <td>{{ index + 1 }}</td>
              <td>{{ artikel.title }}</td>
              <td>
                <!-- contoh path img -->
                <!-- /img_database/Screenshot (4).png -->
                <span v-if="!artikel.gambar">Belum ada gambar</span>
                <img
                  v-bind:src="artikel.gambar"
                  v-if="artikel.gambar"
                  alt=""
                  srcset=""
                  width="50px;"
                />
              </td>
              <td>{{ artikel.slug }}</td>
              <td>
                <div
                  class="btn btn-sm btn-primary"
                  @click="getDetail(artikel, artikel.id)"
                  data-toggle="modal"
                  data-target="#myModal"
                >
                  Edit
                </div>
                <div class="btn btn-sm btn-danger" @click="deleteData(artikel)">
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
        <h2 v-if="artikels.length == 0" class="text-center mt-2">
          Belum ada data artikel
        </h2>
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
            <label for="">Title Artikel</label>
            <input
              type="text"
              class="form-control"
              id=""
              placeholder="Co: Penyebab Pusing Kepala"
              v-model="form.title"
              @keyup="autogenKode()"
            />
            <span
              class="invalid-feedback d-block"
              v-if="errors.hasOwnProperty('title')"
            >
              {{ errors.title[0] }}
            </span>
          </div>

          <div class="form-group">
            <label for="">Gambar Artikel</label>
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
            <label for="">Content Artikel</label>
            <textarea
              class="form-control"
              name=""
              id=""
              cols="30"
              rows="10"
              v-model="form.content"
            ></textarea>
            <span
              class="invalid-feedback d-block"
              v-if="errors.hasOwnProperty('content')"
            >
              {{ errors.content[0] }}
            </span>
          </div>

          <div class="form-group">
            <label for="">Url Artikel</label>
            <input
              type="text"
              class="form-control"
              id=""
              placeholder="Co: Penyebab-Pusing-Kepala"
              v-model="form.slug"
            />
          </div>
          <span
            class="invalid-feedback d-block"
            v-if="errors.hasOwnProperty('slug')"
          >
            {{ errors.slug[0] }}
          </span>

          <div class="form-group">
            <label for="">Banyaknya Tag Artikel</label>
            <input
              type="number"
              class="form-control"
              id=""
              placeholder="Co: 2"
              v-model="manyTags"
              @change="makeCombobox"
            />
          </div>
          <div class="form-group" v-for="i in parseInt(manyTags)" :key="i">
            <select class="form-control tag-pilihan-insert" id="">
              <option v-for="tag in tags" :key="tag.id" :value="tag.id">
                {{ tag.nama }}
              </option>
            </select>
          </div>
          <span
            class="invalid-feedback d-block"
            v-if="errors.hasOwnProperty('tags')"
          >
            {{ errors.tags[0] }}
          </span>
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
                  <label for="">Title Artikel</label>
                  <input
                    type="text"
                    class="form-control"
                    id=""
                    placeholder="Co: Antibiotik"
                    v-model="editForm.title"
                  />
                </div>

                <span
                  class="invalid-feedback d-block"
                  v-if="errors.hasOwnProperty('nama')"
                >
                  {{ errors.title[0] }}
                </span>
                <div class="form-group">
                  <label for="">Gambar Artikel</label>
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
                  <label for="">Content Artikel</label>
                  <textarea
                    class="form-control"
                    name=""
                    id=""
                    cols="30"
                    rows="10"
                    v-model="editForm.content"
                  ></textarea>
                  <span
                    class="invalid-feedback d-block"
                    v-if="errors.hasOwnProperty('content')"
                  >
                    {{ errors.content[0] }}
                  </span>
                </div>

                <div class="form-group">
                  <label for="">Url Artikel</label>
                  <input
                    type="text"
                    class="form-control"
                    id=""
                    placeholder="Co: anti-biotik"
                    disabled
                    v-model="editForm.slug"
                  />
                </div>

                <div class="form-group">
                  <label for="">Banyaknya Tag Artikel</label> <br />
                  <label for="">Tag sebelumnya:</label>
                  <span
                    class="btn btn-sm btn-danger mr-2"
                    v-for="tags in tagsUpdate"
                    :key="tags"
                  >
                    {{ tags }}
                  </span>
                  <br />
                  <input
                    type="number"
                    class="form-control"
                    id=""
                    placeholder="Co: 2"
                    v-model="manyTags"
                    @change="makeCombobox"
                  />
                  <span
                    class="invalid-feedback d-block"
                    v-if="errors.hasOwnProperty('tags')"
                  >
                    {{ errors.tags[0] }}
                  </span>
                </div>
                <div
                  class="form-group"
                  v-for="i in parseInt(manyTags)"
                  :key="i"
                >
                  <select class="form-control tag-pilihan-update" id="">
                    <option v-for="tag in tags" :key="tag.id" :value="tag.id">
                      {{ tag.nama }}
                    </option>
                  </select>
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

<script>
export default {
  name: "Artikel",
  data() {
    return {
      artikels: [],
      pagination: [],
      tagsUpdate: [],
      perPage: 5,
      url: "/api/admin/artikel",
      keywords: "",
      tags: [],
      form: {
        kode: "",
        title: "",
        gambar: "",
        content: "",
        slug: "",
      },
      editForm: {
        kode: "",
        title: "",
        gambar: "",
        content: "",
        slug: "",
      },
      errors: {},
      isLoading: false,
      isSuccess: false,
      manyTags: 1,
    };
  },
  mounted() {
    this.loadData();
    this.getTags();
  },
  methods: {
    loadData() {
      axios
        .get(this.url)
        .then((result) => {
          this.artikels = result.data.data;
          this.pagination = result.data;
          this.form.kode = "";
          this.form.title = "";
          this.form.gambar = "";
          this.form.content = "";
          this.form.slug = "";
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
      this.url = "/api/admin/artikel/changePaginate/" + this.perPage;
      this.loadData();
    },
    search() {
      if (this.keywords.length > 0) {
        this.url =
          "/api/admin/artikel/search/" + this.keywords + "/" + this.perPage;
        console.log(this.url);
      } else {
        this.url = "/api/admin/artikel";
      }

      this.loadData();
    },
    autogenKode() {
      axios
        .post("/api/admin/artikel/generate", {
          title: this.form.title,
        })
        .then((result) => {
          this.form.kode = result.data.newId;
          this.form.slug = result.data.slug;
        })
        .catch((err) => {});
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
      formData.append("title", this.form.title);
      formData.append("gambar", this.form.gambar);
      formData.append("content", this.form.content);
      formData.append("slug", this.form.slug);

      //bikin array selectedTags isi nya id semua tag yang dipilih
      var selectedTags = $(".tag-pilihan-insert")
        .map((_, el) => el.value)
        .get();

      formData.append("tags", selectedTags);
      axios
        .post("/api/admin/artikel", formData)
        .then((response) => {
          this.isSuccess = true;
          this.loadData();
        })
        .catch(({ response }) => {
          this.errors = response.data.errors;
        })
        .finally(() => (this.isLoading = false));
    },
    getTags() {
      axios
        .get("/api/admin/artikel/tag")
        .then((result) => {
          this.tags = result.data;
        })
        .catch((err) => {});
    },
    makeCombobox() {
      this.getTags();
    },
    getDetail(artikel, id) {
      //ambil pada content pada array artikels dengan cari id yang sama
      let content = this.artikels.filter((art) => art.id == id);

      let artikelClone = Object.assign({}, artikel);
      $("#modal-edit").modal("show");
      this.editForm = artikelClone;
      this.editForm.kode = artikelClone.id;
      this.editForm.content = content[0].content;

      if (artikelClone.gambar == null) {
        this.editForm.gambar = "Belum ada Gambar";
      }

      axios
        .get("/api/admin/artikel/getTag/" + id)
        .then((result) => {
          this.tagsUpdate = result.data;
        })
        .catch((err) => {});
    },
    updateData() {
      this.errors = {};
      this.isLoading = true;
      this.isSuccess = false;

      let formData = new FormData();
      formData.append("id", this.editForm.kode);
      formData.append("title", this.editForm.title);
      formData.append("gambar", this.editForm.gambar);
      formData.append("content", this.editForm.content);
      formData.append("slug", this.editForm.slug);

      //bikin array selectedTags isi nya id semua tag yang dipilih
      var selectedTags = $(".tag-pilihan-update")
        .map((_, el) => el.value)
        .get();

      formData.append("tags", selectedTags);
      axios
        .post("/api/admin/artikel/update", formData)
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
    deleteData(artikel) {
      axios
        .post("/api/admin/artikel/delete", {
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

<style scoped>
.wrapper-sub-kategori {
  margin-left: 3rem;
}
</style>