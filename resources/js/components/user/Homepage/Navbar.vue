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
      <div class="p-2 mx-4" v-bind:class="{ active: cssLokasi.home }">
        <router-link to="/" class="navbar-text">Home</router-link>
      </div>
      <div class="p-2 mx-4" v-bind:class="{ active: cssLokasi.artikel }">
        <router-link to="/artikel" class="navbar-text">Artikel</router-link>
      </div>
      <div class="p-2 mx-4" v-bind:class="{ active: cssLokasi.obat }">
        <router-link to="/produk" class="navbar-text"
          >Obat & Vitamin</router-link
        >
      </div>
      <div class="p-2 mx-4" v-bind:class="{ active: cssLokasi.kontak }">
        <router-link to="/kontak" class="navbar-text"
          >Kontak Apotik</router-link
        >
      </div>
    </div>

    <button class="btn btn-secondary" v-if="!isLogin.nama">
      <router-link to="/login" class="text-light">Login</router-link>
    </button>

    <router-link to="/lihatCart" class="text-light">
      <button class="btn btn-primary" v-if="isLogin.nama">
        Keranjang Belanja
      </button>
    </router-link>

    <div>
      <button class="btn btn-secondary dropdown-toggle" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-if="isLogin.nama">
        halo,{{ isLogin.nama }}
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdown03">
      <router-link to="/profilUser" class="dropdown-item"
        >Your Profile</router-link
      >
      <router-link to="" class="dropdown-item">Log Out</router-link>
    </div>
    </div>

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
        artikel: false,
        obat: false,
        kontak: false,
      },
    };
  },

  mounted() {
    this.getLokasi();
    this.loadData();
  },
  methods: {
    getLokasi() {
      this.resetLokasi();
      if (this.lokasi == "home") {
        this.cssLokasi.home = true;
      } else if (this.lokasi == "artikel") {
        this.cssLokasi.artikel = true;
      } else if (this.lokasi == "obat") {
        this.cssLokasi.obat = true;
      } else if (this.lokasi == "kontak") {
        this.cssLokasi.kontak = true;
      }
    },
    resetLokasi() {
      this.cssLokasi.home = false;
      this.cssLokasi.artikel = false;
      this.cssLokasi.lokasi = false;
      this.cssLokasi.kontak = false;
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
router-link {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  font-weight: bold;
  color: red;
}
.active {
  border-bottom: 2px solid red;
}
</style>
