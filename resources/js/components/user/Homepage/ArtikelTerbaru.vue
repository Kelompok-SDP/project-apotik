<template>
  <div class="container">
    <h3 class="pt-5">Artikel Terbaru</h3>
    <div class="card-deck">
      <Artikel
        :dataProduk="product"
        v-for="(product, index) in products"
        v-bind:key="index"
      >
      </Artikel>
    </div>
  </div>
</template>

<script>
import Artikel from "./Artikel";
export default {
  components: {
    Artikel: Artikel,
  },
  data() {
    return {
      products: {},
    };
  },
  mounted() {
    this.loadArtikel();
  },
  methods: {
    loadArtikel() {
      axios
        .get("/api/admin/artikel")
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
