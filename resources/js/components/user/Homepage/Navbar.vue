<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <router-link class="navbar-brand" to="/">
      <img
        src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQUwecwxdvbSuOfRKmE5HI-lAHxYY-kBBfmWw&usqp=CAU"
        alt=""
        width="50rem"
      />
    </router-link>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarText"
    ></button>

    <div class="d-flex flex-row m-auto">
      <div class="p-2 mx-4">
        <router-link to="/" class="navbar-text">Home</router-link>
      </div>
      <div class="p-2 mx-4">
        <router-link to="/" class="navbar-text" :class="lokasi == 'artikel'"
          >Artikel</router-link
        >
      </div>
      <div class="p-2 mx-4">
        <router-link to="/" class="navbar-text" :class="lokasi == 'obat'"
          >Obat & Vitamin</router-link
        >
      </div>
      <div class="p-2 mx-4">
        <router-link to="/" class="navbar-text" :class="lokasi == 'kontak'"
          >Kontak Apotik</router-link
        >
      </div>
    </div>

    <button class="btn btn-secondary" v-if="!isLogin.nama">
      <router-link to="/login" class="text-light">Login</router-link>
    </button>
    <button class="btn btn-secondary" v-if="isLogin.nama">
      halo,{{ isLogin.nama }}
    </button>
  </nav>
</template>

<script>
export default {
  props: ["lokasi"],
  data() {
    return {
      isLogin: {},
      cssLokasi: {
        home: false,
        artikel: "",
        obat: "",
        kontak: "",
      },
    };
  },

  mounted() {
    this.getLokasi();
    this.loadData();
  },
  methods: {
    getLokasi() {
      if (this.lokasi == "home") {
        this.cssLokasi.home = true;
        console.log(this.cssLokasi.home);
      }
    },
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
.active {
  background: red;
}
</style>