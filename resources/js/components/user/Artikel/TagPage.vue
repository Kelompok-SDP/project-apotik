<template>
  <div>
    <Navbar lokasi="artikel" />
    <div class="container">
      <div class="mt-5">
        <span class="h4">{{ tag.nama }}</span>
      </div>
      <div class="mt-5">
        <div class="card-deck">
          <div class="row">
            <Artikel
              :dataProduk="artikel"
              v-for="(artikel, index) in listartikel"
              v-bind:key="index"
            >
            </Artikel>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from "../Homepage/Navbar";
import Artikel from "../Homepage/Artikel";
export default {
  name: "TagPage",
  components: {
    Navbar: Navbar,
    Artikel: Artikel,
  },
  data() {
    return {
      tag: {},
      listartikel: {},
      listUrl: [],
    };
  },
  mounted() {
    this.loadTag();
  },
  methods: {
    loadTag() {
      axios
        .get("/api/tag/" + this.$route.params.id)
        .then((result) => {
          this.tag = result.data.tag;
          this.listartikel = result.data.artikel;
          this.listUrl = this.listartikel.map((k) => "/artikel/" + k.id);
          console.log(this.listUrl);
        })
        .catch((err) => {});
    },
  },
};
</script>

<style>
</style>
