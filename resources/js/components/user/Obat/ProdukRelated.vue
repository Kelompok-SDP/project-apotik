<template>
  <div>
    <p class="h4">PRODUK SEJENIS {{ id_kategori }}</p>
    <div class="row" v-for="obat in listObat" :key="obat.id">
      <div class="col-3 mr-2" style="max-height: 90px">
        <img
          :src="obat.gambar"
          :alt="'Gambar ' + obat.nama"
          class="img-thumbnail"
        />
      </div>
      <div class="col-8" style="word-break: break-all; white-space: normal">
        <p>
          {{ obat.deskripsi }}
        </p>
      </div>
    </div>
  </div>
</template>

<script defer>
export default {
  name: "ProdukRelated",
  props: {
    id_kategori: String,
  },
  data() {
    return {
      listObat: [],
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      console.log(this.id_kategori);
      axios
        .get("/obat/getRelated/" + this.id_kategori)
        .then((result) => {
          this.listObat = result.data;
        })
        .catch((err) => {});
    },
  },
};
</script>

<style scoped>
img {
  max-width: 90px;
  max-height: 90px;
}
</style>