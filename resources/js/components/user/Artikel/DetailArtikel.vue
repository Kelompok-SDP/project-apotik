<template>
  <div>
    <Navbar lokasi="artikel" />
    <div class="container">
      <div class="mt-5">
        <div v-for="artikel in contentArtikel" :key="artikel.id">
          <h3>{{ artikel.title }}</h3>
          <br />
          <h5 style="font-style: italic; color: gray; font-size: 15px">
            Dibuat pada: {{ tanggal }}
          </h5>
          <img
            v-bind:src="artikel.gambar"
            alt=""
            srcset=""
            width="100%"
            height="600px"
          />
          <div style="font-size: 20px">
            <p>
              <span style="color: red">UChicago Medicine</span> -
              {{ artikel.content }}
            </p>
          </div>
        </div>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script>
import Navbar from "../Homepage/Navbar";
import Footer from "../Homepage/Footer";
export default {
  name: "DetailArPage",
  components: {
    Navbar: Navbar,
    Footer: Footer,
  },
  data() {
    return {
      contentArtikel: {},
      tanggal: {},
    };
  },
  mounted() {
    this.loadContent();
  },
  methods: {
    loadContent() {
      axios
        .get("/api/artikel/" + this.$route.params.slug)
        .then((result) => {
          this.contentArtikel = result.data;
          this.tanggal = result.data;
          this.contentArtikel.forEach((element) => {
            this.formatDate(element.created_at);
          });
        })
        .catch((err) => {});
    },
    formatDate(tgl) {
      var date = new Date(tgl);
      var tahun = date.getFullYear();
      var bulan = date.getMonth();
      var tanggal = date.getDate();
      var hari = date.getDay();
      var jam = date.getHours()-7;
      if(jam < 10){
          jam = "0"+jam;
      }
      var menit = date.getMinutes();
      var detik = date.getSeconds();
      switch (hari) {
        case 0:
          hari = "Minggu";
          break;
        case 1:
          hari = "Senin";
          break;
        case 2:
          hari = "Selasa";
          break;
        case 3:
          hari = "Rabu";
          break;
        case 4:
          hari = "Kamis";
          break;
        case 5:
          hari = "Jum'at";
          break;
        case 6:
          hari = "Sabtu";
          break;
      }
      switch (bulan) {
        case 0:
          bulan = "Januari";
          break;
        case 1:
          bulan = "Februari";
          break;
        case 2:
          bulan = "Maret";
          break;
        case 3:
          bulan = "April";
          break;
        case 4:
          bulan = "Mei";
          break;
        case 5:
          bulan = "Juni";
          break;
        case 6:
          bulan = "Juli";
          break;
        case 7:
          bulan = "Agustus";
          break;
        case 8:
          bulan = "September";
          break;
        case 9:
          bulan = "Oktober";
          break;
        case 10:
          bulan = "November";
          break;
        case 11:
          bulan = "Desember";
          break;
      }
      var tampilTanggal =
        hari + ", " + tanggal + " " + bulan + " " + tahun + " ";
      var tampilWaktu = jam + ":" + menit + ":" + detik + " WIB";
      this.tanggal = tampilTanggal + tampilWaktu;
    },
  },
};
</script>

<style>
</style>
