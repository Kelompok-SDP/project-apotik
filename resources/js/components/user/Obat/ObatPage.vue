<template>
  <div>
    <Navbar lokasi="obat" />
    <div class="container">
      <h4>Obat & Alat Kesehatan Berdasarkan Kategori</h4>
      <div class="row mt-4">
        <div
          class="col-lg-4"
          v-for="(kategori, index) in listKategori"
          :key="kategori.id"
        >
          <router-link v-bind:to="listUrl[index]">
            <KategoriCard :kategori="kategori" />
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from "../Homepage/Navbar";
import KategoriCard from "./KategoriCard";
export default {
  name: "ObatPage",
  components: {
    Navbar: Navbar,
    KategoriCard: KategoriCard,
  },
  data() {
    return {
      listKategori: {},
      listUrl: [],
    };
  },
  mounted() {
    this.loadKategori();
  },
  methods: {
    loadKategori() {
      axios
        .get("/kategori")
        .then((result) => {
          this.listKategori = result.data;
          this.listUrl = this.listKategori.map((k) => "/produk/" + k.slug);
          // console.table(this.listUrl);
        })
        .catch((err) => {});
    },
  },
};
</script>

<style>
</style>