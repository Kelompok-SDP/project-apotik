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
        <div class="btn btn-outline-danger rounded" @click="addToCart">
          Tambah
        </div>
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
    addToCart() {
      axios.post("/addCart", {
        id: this.dataProduk.id,
      });
    },
  },
};
</script>

<style>
</style>
