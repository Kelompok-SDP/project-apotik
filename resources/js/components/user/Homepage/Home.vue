<template>
  <div>
    <Navbar lokasi="home" />
    <Carousel />
    <ProdukTerlaris />
    <ArtikelTerbaru />
    <Footer />
  </div>
</template>

<script>
import Navbar from "./Navbar";
import Carousel from "./Carousel";
import ProdukTerlaris from "./ProdukTerlaris";
import ArtikelTerbaru from "./ArtikelTerbaru";
import Footer from "./Footer";
export default {
  name: "Home",
  components: {
    Navbar: Navbar,
    Carousel: Carousel,
    ProdukTerlaris: ProdukTerlaris,
    ArtikelTerbaru: ArtikelTerbaru,
    Footer: Footer,
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
        .catch((err) => {});
    },
  },
};
</script>

<style scoped>
</style>