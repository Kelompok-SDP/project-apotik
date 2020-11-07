<template>
  <div>
    <Sidebar @click="getCompState"></Sidebar>
    <Navbar @click="getCompState"></Navbar>
    <div class="content-wrapper">
      <component v-bind:is="currentState"></component>
      <!-- <router-view></router-view> -->
    </div>
  </div>
</template>

<script>
import Navbar from "./layouts/Navbar.vue";
import Sidebar from "./layouts/Sidebar.vue";
import Kategori from "./admin/Kategori.vue";
import Obat from "./admin/Obat.vue";
import Artikel from "./admin/Artikel.vue";
import Tag from "./admin/Tag.vue";
import Alat_Kesehatan from "./admin/Alat_Kesehatan.vue";

export default {
  components: {
    Navbar: Navbar,
    Sidebar: Sidebar,
    Kategori: Kategori,
    Obat: Obat,
    Artikel: Artikel,
    Tag: Tag,
    Alat_Kesehatan: Alat_Kesehatan,
  },
  data() {
    return {
      currentState: "",
    };
  },
  methods: {
    getCompState(value) {
      this.currentState = value;
      console.log(value);
      console.log(this.currentState);
      //biar ndak kelebaran waktu dimaster obat
      if (value == "Obat") {
        $(".content-wrapper").css("width", "83%");
      }
    },
  },
};
</script>

<style>
</style>
