<template>
  <div class="wrapper-sub-kategori">
    <br />
    <h1 class="m-0 text-dark">Admin Info</h1>
    <form enctype="multipart/form-data" @submit.prevent="addData()">
      <div class="card-body">
        <div class="form-group">
          <label for="">Nama Kontak</label>
          <input
            type="text"
            class="form-control"
            id=""
            placeholder="Co: Bambang Tanu"
            v-model="form.nama"
          />
        </div>
        <span
          class="invalid-feedback d-block"
          v-if="errors.hasOwnProperty('nama')"
        >
          {{ errors.nama[0] }}
        </span>
        <div class="form-group">
          <label for="">Nomor HP 1</label>
          <input
            type="text"
            class="form-control"
            id=""
            placeholder="Co: 085XXX"
            v-model="form.nomor1"
          />
          <span
            class="invalid-feedback d-block"
            v-if="errors.hasOwnProperty('nomor1')"
          >
            {{ errors.nomor1[0] }}
          </span>
        </div>
        <div class="form-group">
          <label for="">Nomor HP 2 (Optional)</label>
          <input
            type="text"
            class="form-control"
            id=""
            placeholder="Co: 085XXX"
            v-model="form.nomor2"
          />
          <span
            class="invalid-feedback d-block"
            v-if="errors.hasOwnProperty('nomor2')"
          >
            {{ errors.nomor2[0] }}
          </span>
        </div>
      </div>

      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Tambahkan</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "Info",
  data() {
    return {
      info: {},
      form: {
        nama: "",
        nomor1: "",
        nomor2: "",
      },
      errors: {},
    };
  },
  mounted() {
    this.loadInfo();
  },
  methods: {
    loadInfo() {
      axios
        .get("/api/admin/info")
        .then((result) => {
          this.info = result.data;
          this.form.nama = this.info[0].nama;
          this.form.nomor1 = this.info[0].nomor1;
          this.form.nomor2 = this.info[0].nomor2;
        })
        .catch((err) => {});
    },
    addData() {
      this.errors = {};
      if (this.info.length == 0) {
        axios
          .post("/api/admin/info/addInfo", {
            nama: this.form.nama,
            nomor1: this.form.nomor1,
            nomor2: this.form.nomor2,
          })
          .then((result) => {
            this.loadInfo();
          })
          .catch(({ response }) => {
            this.errors = response.data.errors;
          });
      } else {
        axios
          .post("/api/admin/info/updateInfo", {
            nama: this.form.nama,
            nomor1: this.form.nomor1,
            nomor2: this.form.nomor2,
          })
          .then((result) => {
            this.loadInfo();
          })
          .catch(({ response }) => {
            this.errors = response.data.errors;
          });
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