<template>
  <div class="container">
    <div
      id="carouselExampleControls"
      class="carousel slide"
      data-ride="carousel"
    >
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img
            class="d-block w-100"
            v-bind:src="carousel[0].gambar"
            alt="First slide"
          />
        </div>
        <div class="carousel-item">
          <img
            class="d-block w-100"
            v-bind:src="carousel[1].gambar"
            alt="Second slide"
          />
        </div>
        <div class="carousel-item">
          <img
            class="d-block w-100"
            v-bind:src="carousel[2].gambar"
            alt="Third slide"
          />
        </div>
      </div>
      <a
        class="carousel-control-prev"
        href="#carouselExampleControls"
        role="button"
        data-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a
        class="carousel-control-next"
        href="#carouselExampleControls"
        role="button"
        data-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: "Carousel",

  data() {
    return {
      carousel: [],
    };
  },
  mounted() {
    this.loadCarousel();
  },
  methods: {
    loadCarousel() {
      axios
        .get("/api/carousel")
        .then((result) => {
          this.carousel = result.data.data;
          console.log(this.carousel[0].gambar);
        })
        .catch((err) => {});
    },
  },
};

</script>

<style>
</style>
