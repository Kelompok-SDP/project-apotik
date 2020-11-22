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
        <router-link to="/artikelpage" class="navbar-text">Artikel</router-link>
      </div>
      <div class="p-2 mx-4" v-bind:class="{ active: cssLokasi.obat }">
        <router-link to="/produk" class="navbar-text"
          >Obat & Vitamin</router-link
        >
      </div>
    </div>

    <!-- <button class="btn btn-primary btn-toggle">Switch To Dark Mode</button> -->

    <div class="d-flex justify-content-between">
      <div class="col">
        <button class="btn btn-secondary" v-if="!isLogin.nama">
          <router-link to="/login" class="text-light">Login</router-link>
        </button>
      </div>
      <div class="col" v-if="isLogin.nama">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell" style="font-size: 2rem"></i>
            <span class="badge badge-warning navbar-badge"
              >{{ listNotif.length }}
            </span>
          </a>
          <div
            class="dropdown-menu dropdown-menu-lg dropdown-menu-right notifs"
            style="overflow-y: auto; max-height: 300px"
          >
            <span class="dropdown-item dropdown-header"
              >{{ listNotif.length }} Notifications</span
            >
            <div class="dropdown-divider"></div>
            <router-link
              to="/notifpage"
              class="dropdown-item dropdown-footer"
              style="position: sticky"
            >
              See All Notifications
            </router-link>
            <NotifList
              v-for="notif in listNotif"
              :key="notif.id"
              :tanggal="notif.data.tanggal"
              :total="formatNumber(notif.data.total)"
              :read_at="notif.read_at"
            />
          </div>
        </li>
      </div>
      <div class="col">
        <router-link to="/lihatCart" class="text-dark">
          <span
            class="fas fa-shopping-cart"
            style="font-size: 2rem; padding-top: 6px"
            v-if="isLogin.nama"
          ></span>
        </router-link>
      </div>
      <div class="col">
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
          <div class="dropdown-menu" aria-labelledby="dropdown03">
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
      </div>
    </div>
  </nav>
</template>

<script>
import NotifList from "../NotifPage/NotifList";
export default {
  props: ["lokasi"],
  components: {
    NotifList: NotifList,
  },
  data() {
    return {
      isLogin: {},
      cssLokasi: {
        home: false,
        artikel: false,
        obat: false,
      },
      listNotif: [],
    };
  },
  mounted() {
    this.getLokasi();
    this.loadData();
    this.loadNotif();
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
      }
    },
    resetLokasi() {
      this.cssLokasi.home = false;
      this.cssLokasi.artikel = false;
      this.cssLokasi.lokasi = false;
    },
    loadData() {
      axios
        .get("/api/home")
        .then((result) => {
          this.isLogin = result.data;
        })
        .catch((err) => {});
    },
    loadNotif() {
      axios
        .get("/api/notifUser")
        .then((result) => {
          this.listNotif = result.data;
          this.listNotif = this.listNotif.notifs;
        })
        .catch((err) => {});
    },
    formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    },
    logout() {
      axios
        .get("/api/logout")
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
.notifs::-webkit-scrollbar {
  width: 0.5rem;
}

.notifs::-webkit-scrollbar-track {
  background: #1e1e24;
}

.notifs::-webkit-scrollbar-thumb {
  background: #6649b8;
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
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  z-index: 1;
}
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
.dropdown-content a:hover {
  background-color: #f1f1f1;
}
.dropdown:hover .dropdown-content {
  display: block;
}
.dropdown:hover .dropbtn {
  background-color: #3d5c7f;
}
</style>
