<template>
  <div class="card">
    <img class="card-img-top" :src="dataProduk.gambar" alt="Card image cap" />
    <div class="card-body">
      <h5 class="card-title">{{ dataProduk.title }}</h5>
      <p class="card-text">{{ dataProduk.content }}</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
      <br />
      <span>
        <router-link v-bind:to="Url">
          <p style="color: blue">See more details >></p>
        </router-link>
      </span>
      <div class="row">
        <button
          class="btn btn-sm btn-danger col-4 p-0 m-2"
          v-for="(tag, index) in listTag"
          :key="tag.id"
        >
          <router-link v-bind:to="listUrl[index]">{{ tag.nama }} </router-link>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Artikel",
  props: {
    dataProduk: Object,
  },
  data() {
    return {
      Url: {},
      listTag: [],
      listUrl: [],
    };
  },
  mounted() {
    this.cutString();
    this.getTags();
  },
  methods: {
    cutString() {
      if (this.dataProduk.content.length > 50) {
        this.dataProduk.content =
          this.dataProduk.content.substring(0, 50) + "...";
      }
      this.Url = "/artikelpage/artikel/" + this.dataProduk.slug;
    },
    getTags() {
      axios
        .get(`/api/artikel/getTag/${this.dataProduk.id}`)
        .then((result) => {
          this.listTag = result.data;
          this.listUrl = this.listTag.map((t) => `/artikelpage/${t.id}`);
        })
        .catch((err) => {});
    },
  },
};
</script>

<style scoped>
a {
  color: white;
  text-decoration: none;
}
</style>
