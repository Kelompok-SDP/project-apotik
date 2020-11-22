<template>
  <div class="wrapper-sub-kategori">
    <br />
    <h1 class="m-0 text-dark">Admin Info</h1>
    <form enctype="multipart/form-data">
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
        <VueLoadingButton
          class="btn btn-primary"
          :styled="true"
          :loading="isLoading"
          @click.native="addData"
        />
      </div>
    </form>
  </div>
</template>

<script>
import VueLoadingButton from "vue-loading-button";
import Loading from "vue-loading-overlay";
export default {
  name: "Info",
  components: {
    VueLoadingButton: VueLoadingButton,
    Loading: Loading,
  },
  data() {
    return {
      info: {},
      form: {
        nama: "",
        nomor1: "",
        nomor2: "",
      },
      errors: {},
      isLoading: true,
    };
  },
  mounted() {
    this.loadInfo();
  },
  methods: {
    loadInfo() {
      this.isLoading = false;
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
        this.isLoading = true;
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
          })
          .finally(() =>
            setInterval(() => {
              this.isLoading = false;
            }, 3000)
          );
      } else {
        this.isLoading = true;
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
          })
          .finally(() =>
            setInterval(() => {
              this.isLoading = false;
            }, 3000)
          );
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