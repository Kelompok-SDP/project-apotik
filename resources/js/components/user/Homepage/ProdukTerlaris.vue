<template>
  <div class="container">
    <h3 class="pt-5">Produk terlaris</h3>
    <div class="row mt-4">
      <div
        class="col-lg-3"
        v-for="(product, index) in products"
        v-bind:key="index"
      >
        <Produk :dataProduk="product"></Produk>
      </div>
    </div>
  </div>
</template>

<script>
import Produk from "./Produk";
export default {
  components: {
    Produk: Produk,
  },
  data() {
    return {
      listUrl: [],
      products: {},
    };
  },
  mounted() {
    this.loadProduk();
  },
  methods: {
    loadProduk() {
      axios
        .get("/api/produk")
        .then((result) => {
          this.products = result.data.data;
          this.listUrl = this.products.map((k) => "/api/obat/" + k.id);
        })
        .catch((err) => {});
    },
  },
};
</script>

<style>
</style>
