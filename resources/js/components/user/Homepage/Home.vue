<template>
  <div>
    <vueLoading
      :active="isLoading"
      :is-full-page="true"
      :opacity="opacity"
      :loader="'bars'"
      :lock-scroll="lock"
      :transition="'fade'"
      :background-color="'#000'"
      :color="'#fff'"
      :height="100"
      :width="100"
    >
    </vueLoading>
    <Navbar lokasi="home" />
    <Carousel />
    <ProdukTerlaris />
    <ArtikelTerbaru />
    <Footer />
  </div>
</template>

<script>
import vueLoading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
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
    vueLoading: vueLoading,
  },
  data() {
    return {
      isLogin: {},
      isLoading: true,
      lock: true,
      opacity: 1,
      loadingTime: "",
    };
  },
  mounted() {
    this.isLoading = true;
    this.lock = true;
    this.loadData();
  },
  methods: {
    loadData() {
      axios
        .get("/api/home")
        .then((result) => {
          this.isLogin = result.data;
          loadingTime = this.timeLoading();
        })
        .catch((err) => {});
    },
    timeLoading() {
      setInterval(() => {
        if (this.opacity < 0) {
          this.isLoading = false;
          this.lock = false;
          clearInterval(this.loadingTime);
        } else {
          this.opacity -= 0.1;
        }
      }, 10);
    },
  },
};
</script>
<style scoped>
</style>