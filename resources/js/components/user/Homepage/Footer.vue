<template>
  <footer class="page-footer font-small bg-primary text-white mt-5">
    <div class="footer-copyright text-center py-3">
      <span>Kontak Apotik: {{ kontak.nama }}</span> <br />
      <span>Silahkan Klik Nomor dibawah untuk WA</span> <br />
      <!-- format nomor 62+nohp -->
      <span style="cursor: pointer"
        >Nomor HP Pertama:
        <span @click="ApiWa(kontak.nomor1)">{{ kontak.nomor1 }}</span></span
      >
      <br />
      <span v-if="kontak.nomor2 != ''" style="cursor: pointer"
        >Nomor HP Kedua:
        <span @click="ApiWa(kontak.nomor2)">{{ kontak.nomor2 }}</span></span
      >
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
          this.kontak.nama = this.dataInfo.nama;
          this.kontak.nomor1 = this.dataInfo.nomor1;
          this.kontak.nomor2 = this.dataInfo.nomor2;
        })
        .catch((err) => {});
    },
    ApiWa(nomor) {
      window.open(
        "https://api.whatsapp.com/send?phone=" +
          this.kontak.nomor +
          "&text=Halo Dengan " +
          this.kontak.nama +
          " Di Sini"
      );
    },
  },
};
</script>

<style>
</style>
