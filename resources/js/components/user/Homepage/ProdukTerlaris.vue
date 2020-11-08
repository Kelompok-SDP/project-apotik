<template>
  <div class="container">
    <h3 class="pt-5">Produk terlaris</h3>
    <div class="card-deck">
      <Produk
        :dataProduk="product"
        v-for="(product, index) in products"
        v-bind:key="index"
      ></Produk>
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
        })
        .catch((err) => {});
    },
  },
};
</script>

<style>
</style>