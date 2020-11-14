<template>
  <div>
    <Navbar lokasi="obat" />
    <div class="container">
      <div class="mt-5">
        <img
          v-bind:src="kategori.gambar"
          alt=""
          srcset=""
          width="32px"
          height="32px"
          class="rounded-circle"
        />
        <span class="h4">{{ kategori.nama }}</span>
      </div>
      <div class="mt-5">
        <div class="card-deck">
          <div class="row">
            <Produk
              :dataProduk="obat"
              v-for="(obat, index) in listObat"
              v-bind:key="index"
            ></Produk>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from "../Homepage/Navbar";
import Produk from "../Homepage/Produk";
export default {
  name: "KategoriPage",
  components: {
    Navbar: Navbar,
    Produk: Produk,
  },
  data() {
    return {
      kategori: {},
      listObat: {},
    };
  },
  mounted() {
    this.loadKategori();
  },
  methods: {
    loadKategori() {
      axios
        .get("/api/kategori/" + this.$route.params.slug)
        .then((result) => {
          this.kategori = result.data.kategori;
          this.listObat = result.data.obats;
        })
        .catch((err) => {});
    },
  },
};
</script>

<style>
</style>