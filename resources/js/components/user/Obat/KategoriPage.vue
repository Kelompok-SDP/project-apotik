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
        <h3>asdad</h3>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from "../Homepage/Navbar";
export default {
  name: "KategoriPage",
  components: {
    Navbar: Navbar,
  },
  data() {
    return {
      kategori: {},
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
        })
        .catch((err) => {});
    },
  },
};
</script>

<style>
</style>