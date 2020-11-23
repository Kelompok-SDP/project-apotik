<template>
  <footer class="page-footer font-small bg-primary text-white mt-5">
    <div class="footer-copyright text-center py-3">
      <span>Kontak Apotik: {{ kontak.nama }}</span> <br />
      <!-- format nomor 62+nohp -->
      <span >Nomor HP Pertama: <span @click="ApiWa">{{ kontak.nomor1 }}</span></span> <br />
      <span v-if="kontak.nomor2 != ''">Nomor HP Kedua: {{ kontak.nomor2 }}</span>
    </div>
    <div class="footer-copyright text-center py-3">
      © 2020 Copyright:
      <span>Kelompok Apotik</span>
    </div>
  </footer>
</template>

<script>
export default {
  data() {
    return {
      dataInfo: {},
      kontak: {
        nama: "",
        nomor1: "",
        nomor2: "",
      },
    };
  },
  mounted() {
    this.loadInfo();
  },
  methods: {
    loadInfo() {
      axios
        .get("/api/admin/info")
        .then((result) => {
          this.dataInfo = result.data;
          this.kontak.nama = this.dataInfo[0].nama;
          this.kontak.nomor1 = this.dataInfo[0].nomor1;
          this.kontak.nomor2 = this.dataInfo[0].nomor2;
        })
        .catch((err) => {});
    },
    ApiWa(){
        window.open("https://api.whatsapp.com/send?phone="+this.kontak.nomor1+"&text=Halo Dengan "+this.kontak.nama+" Di Sini");

    }
  },
};
</script>

<style>
</style>
