<template>
  <div>
    <Navbar lokasi="alat" />
    <div class="container">
      <h4>Alat Kesehatan Berdasarkan Kategori</h4>
      <div class="row mt-4">
        <div
          class="col-lg-3"
          v-for="(kategori, index) in listKategori"
          :key="kategori.id"
        >
          <router-link v-bind:to="listUrl[index]">
            <KategoriCard :kategori="kategori" />
          </router-link>
        </div>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script>
import Navbar from "../Homepage/Navbar";
import KategoriCard from "./KategoriCard";
import Footer from "../Homepage/Footer";
export default {
  name: "ObatPage",
  components: {
    Navbar: Navbar,
    KategoriCard: KategoriCard,
    Footer: Footer,
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
        .get("/api/kategori")
        .then((result) => {
          this.listKategori = result.data;
          this.listUrl = this.listKategori.map((k) => "/alat/produk/" + k.slug);
        })
        .catch((err) => {});
    },
  },
};
</script>

<style>
</style>
