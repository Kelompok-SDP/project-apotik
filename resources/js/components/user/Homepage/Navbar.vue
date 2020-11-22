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
      <div class="p-2 mx-4" v-bind:class="{ active: cssLokasi.alat }">
        <router-link to="/produk" class="navbar-text"
          >Alat Kesehatan</router-link
        >
      </div>
    </div>

    <!-- <button class="btn btn-primary btn-toggle">Switch To Dark Mode</button> -->

    <button class="btn btn-secondary" v-if="!isLogin.nama">
      <router-link to="/login" class="text-light">Login</router-link>
    </button>

    <router-link to="/lihatCart" class="text-light">
      <button class="btn btn-primary" v-if="isLogin.nama">
        Keranjang Belanja
      </button>
    </router-link>

    <div class="dropdown">
      <button
        class="btn btn-secondary dropbtn dropdown-toggle"
        id="dropdown03"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
        v-if="isLogin.nama"
      >
        halo,{{ isLogin.nama }}
      </button>
      <div class="dropdown-menu " aria-labelledby="dropdown03">
        <router-link to="/profilUser">
          <span class="dropdown-item">Your Profile</span>
        </router-link>
        <router-link to="/admin" v-if="isLogin.role == 1">
          <span class="dropdown-item">Admin Dashboard</span>
        </router-link>
        <span class="dropdown-item" style="cursor: pointer" @click="logout"
          >Log Out</span
        >
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
        alat: false,
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
      }else if (this.lokasi == "alat") {
        this.cssLokasi.alat = true;
      }
    },
    resetLokasi() {
      this.cssLokasi.home = false;
      this.cssLokasi.artikel = false;
      this.cssLokasi.lokasi = false;
      this.cssLokasi.kontak = false;
      this.cssLokasi.alat = false;
    },
    loadData() {
      axios
        .get("/home")
        .then((result) => {
          this.isLogin = result.data;
        })
        .catch((err) => {});
    },
    logout() {
      axios
        .get("/logout")
        .then((result) => {
          window.location.replace("/login");
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


.dropbtn {
  background-color: #29374681;
  color: white;
  padding: 12px;
  font-size: 14px;
  border: none;
  cursor: pointer;
  border-radius: 3px;
}
.dropdown {
  position: relative;
  display: inline-block;
}
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
.dropdown-content a:hover {background-color: #f1f1f1}
.dropdown:hover .dropdown-content {
  display: block;
}
.dropdown:hover .dropbtn {
  background-color: #3D5C7F;
}

</style>
