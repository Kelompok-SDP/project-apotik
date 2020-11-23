<template>
    <div>
        <Navbar lokasi="artikel" />
        <div class="container">
        <h4>Artikel Berdasarkan Tag</h4>
        <div class="row mt-4">
            <div
            class="col-lg-6"
            v-for="(tag, index) in listTag"
            :key="tag.id"
            >
            <router-link v-bind:to="listUrl[index]">
                <TagCard :tag="tag" />
            </router-link>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
import Navbar from "../Homepage/Navbar";
import TagCard from "./TagCard";
import Footer from "../Homepage/Footer";
export default {
  name: "ArtikelPage",
  components: {
    Navbar: Navbar,
    TagCard: TagCard,
    Footer: Footer,
  },
  data() {
    return {
      listTag: {},
      listUrl: [],
    };
  },
  mounted() {
    this.loadTag();
  },
  methods: {
    loadTag() {
      axios
        .get("/api/admin/artikel/tag")
        .then((result) => {
          this.listTag = result.data;
          this.listUrl = this.listTag.map((k) => "/artikelpage/" + k.id);
          console.log(this.listTag);
        })
        .catch((err) => {});
    },
  },
};

</script>

<style>
</style>
