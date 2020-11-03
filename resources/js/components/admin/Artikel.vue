<template>
  <div class="wrapper-sub-kategori">
    <br />
    <h1 class="m-0 text-dark">Admin Artikel</h1>
    <br />

    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Insert Artikel Baru</h3>
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
              placeholder="Co: Antibiotik"
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
            <select name="" class="form-control" id="">
              <option v-for="tag in tags" :key="tag.id" :value="tag.id">
                {{ tag.nama }}
              </option>
            </select>
          </div>
          <br />
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
  name: "Artikel",
  data() {
    return {
      artikels: [],
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
    this.getTags();
  },
  methods: {
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

      //bikin array idTags isi nya id semua tag yang dipilih
      let idTags = this.tags.map((tag) => tag.id);
      formData.append("tags", idTags);
      axios
        .post("/api/admin/artikel", formData)
        .then((response) => {
          this.isSuccess = true;
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
  },
};
</script>

<style>
</style>