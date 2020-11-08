<template>
  <div>
    <Navbar lokasi="home" />
    <Carousel />
    <ProdukTerlaris />
  </div>
</template>

<script>
import Navbar from "./Navbar";
import Carousel from "./Carousel";
import ProdukTerlaris from "./ProdukTerlaris";
export default {
  name: "Home",
  components: {
    Navbar: Navbar,
    Carousel: Carousel,
    ProdukTerlaris: ProdukTerlaris,
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
          console.log(result.data);
        })
        .catch((err) => {});
    },
  },
};
</script>

<style scoped>
</style>