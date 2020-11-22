<template>
  <footer class="page-footer font-small bg-primary text-white mt-5">
    <div class="footer-copyright text-center py-3">
      <span>Kontak Apotik: {{ kontak.nama }}</span> <br />
      <span>Nomor HP Pertama: {{ kontak.nomor1 }}</span> <br />
      <span v-if="kontak.nomo2 != ''">Nomor HP Kedua: {{ kontak.nomor2 }}</span>
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
  },
};
</script>

<style>
</style>