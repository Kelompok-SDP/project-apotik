<template>
  <div class="card">
    <router-link v-bind:to="'/obat/' + dataProduk.id">
      <img class="card-img-top" :src="dataProduk.gambar" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">{{ dataProduk.nama }}</h5>
        <p class="card-text">Harga: {{ dataProduk.harga }}</p>
      </div>
    </router-link>
    <div class="card-footer text-center">
      <button
        class="btn btn-outline-danger rounded btnAdd"
        data-toggle="modal"
        data-target="#exampleModalCenter"
        @click="addToCart"
        disabled
        v-if="!isLogin.nama"
      >
        Tambah
      </button>
      <button
        class="btn btn-outline-danger rounded btnAdd"
        data-toggle="modal"
        data-target="#exampleModalCenter"
        @click="addToCart"
        v-if="isLogin.nama"
      >
        Tambah
      </button>
      <div class="text-danger font-weight-light" v-if="!isLogin.nama">
        Login terlebih dahulu
      </div>
    </div>
    <ModalSuccess :msg="'Berhasil Tambah Item ke Keranjang Belanja'" />
  </div>
</template>

<script>
import ModalSuccess from "./ModalSuccess";
export default {
  name: "Produk",
  props: {
    dataProduk: Object,
  },
  components: {
    ModalSuccess: ModalSuccess,
  },
  data() {
    return {
      isLogin: {},
    };
  },
  mounted() {
    this.loadData();
  },
  methods: {
    loadData() {
      axios
        .get("/home")
        .then((result) => {
          this.isLogin = result.data;
        })
        .catch((err) => {
          console.log("error", this.isLogin.nama);
        });
    },
    addToCart() {
      axios
        .post("/addCart", {
          id: this.dataProduk.id,
        })
        .then((result) => {})
        .catch((err) => {});
    },
  },
};
</script>

<style>
</style>