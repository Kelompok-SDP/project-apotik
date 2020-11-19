<template>
  <div>
    <Navbar />
    <div class="containerNew">
      <div>
        <span class="h4 text-uppercase">{{ obat.nama }} </span> <br />
        <br />
        <span class="text-black">Rp. {{ obat.harga }} </span>
      </div>
      <div class="row">
        <div class="col-lg-2">
          <div>
            <img
              :src="obat.gambar"
              :alt="'Gambar Obat ' + obat.nama"
              width="200rem"
              height="200rem"
              class="rounded"
            />
          </div>
          <div class="d-flex justify-content-center">
            <button
              class="btn btn-danger rounded px-5 mt-3 mr-3"
              data-toggle="modal"
              data-target="#exampleModalCenter"
              @click="addToCart"
              disabled
              v-if="!isLogin.nama"
            >
              Tambah
            </button>
            <br />
            <button
              class="btn btn-danger rounded px-5 mt-3 mr-3"
              data-toggle="modal"
              data-target="#exampleModalCenter"
              @click="addToCart"
              v-if="isLogin.nama"
            >
              Tambah
            </button>
            <br />
            <span class="text-danger font-weight-light" v-if="!isLogin.nama">
              Login terlebih dahulu
            </span>
          </div>
        </div>
        <div class="col-lg-7">
          <span class="font-weight-bold">Indikasi Umum</span>
          <p class="font-weight-light">{{ obat.indikasi }}</p>

          <span class="font-weight-bold">Deskripsi</span>
          <p class="font-weight-light">{{ obat.deskripsi }}</p>
          <span class="font-weight-bold">Kategori</span>
          <p class="font-weight-light">
            <span v-if="listKategori.length == 0">
              <b>Tidak ada Kategori</b>
            </span>
            <span v-for="kategori in listKategori" :key="kategori.id">
              <router-link :to="'/produk/' + kategori.slug">
                <span class="text-danger">{{ kategori.nama + " " }}</span>
              </router-link>
            </span>
          </p>
          <span class="font-weight-bold">Kategori</span>
          <p class="font-weight-light">ini ini Kategori</p>
          <span class="font-weight-bold">Kategori</span>
          <p class="font-weight-light">ini ini Kategori</p>
          <span class="font-weight-bold">Kategori</span>
          <p class="font-weight-light">ini ini Kategori</p>
          <span class="font-weight-bold">Deskripsi</span>
          <p class="font-weight-light">ini ini desc</p>
          <span class="font-weight-bold">Kategori</span>
          <p class="font-weight-light">ini ini Kategori</p>
          <span class="font-weight-bold">Kategori</span>
          <p class="font-weight-light">ini ini Kategori</p>
          <span class="font-weight-bold">Kategori</span>
          <p class="font-weight-light">ini ini Kategori</p>
          <span class="font-weight-bold">Kategori</span>
          <p class="font-weight-light">ini ini Kategori</p>
        </div>
        <div class="col-lg-3">
          <ProdukRelated :id_kategori="id_kategori"></ProdukRelated>
        </div>
      </div>
    </div>
    <ModalSuccess msg="Berhasil Tambah Item ke Keranjang Belanja" />
    <Footer />
  </div>
</template>

<script>
import Navbar from "../Homepage/Navbar";
import Footer from "../Homepage/Footer";
import ModalSuccess from "../Homepage/ModalSuccess";
import ProdukRelated from "./ProdukRelated";

export default {
  name: "DetailObat",
  components: {
    Navbar: Navbar,
    Footer: Footer,
    ModalSuccess: ModalSuccess,
    ProdukRelated: ProdukRelated,
  },
  data() {
    return {
      obat: {},
      listKategori: [],
      id_kategori: "",
      isLogin: {},
    };
  },
  mounted() {
    this.loadData();
  },
  methods: {
    loadData() {
      axios
        .get(`/obat/getDetail/${this.$route.params.id}`)
        .then((result) => {
          this.obat = result.data.obat;
          this.listKategori = result.data.listKategori;
          this.id_kategori = this.listKategori[0].id;
        })
        .catch((err) => {});

      axios
        .get("/home")
        .then((result) => {
          this.isLogin = result.data;
        })
        .catch((err) => {
          console.log("error", this.isLogin.nama);
        });
    },
    addToCart() {
      axios
        .post("/addCart", {
          id: this.obat.id,
        })
        .then((result) => {})
        .catch((err) => {});
    },
  },
};
</script>

<style scoped>
.containerNew {
  width: 90%;
  margin: auto;
}
</style>