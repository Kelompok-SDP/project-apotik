<template>
  <div class="col-lg-3">
    <div class="card">
      <img class="card-img-top" :src="dataProduk.gambar" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">{{ dataProduk.nama }}</h5>
        <p class="card-text">
          {{ dataProduk.harga }}
        </p>
      </div>
      <div class="card-footer text-center">
        <router-link v-bind:to="urlProduk">
          <div class="btn btn-outline-danger rounded">Tambah</div>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Produk",
  props: {
    dataProduk: Object,
  },
  data() {
    return {
      urlProduk: "",
    };
  },
  mounted() {
    this.loadUrl();
  },
  methods: {
    loadUrl() {
      this.urlProduk = "/addCart/" + this.dataProduk.id;
    },
  },
};
</script>

<style>
</style>