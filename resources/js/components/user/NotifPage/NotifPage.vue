<template>
  <div>
    <Navbar />
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <NotifList
            v-for="(notif, index) in listNotif"
            :key="notif.id"
            :tanggal="notif.data.tanggal"
            :total="formatNumber(notif.data.total)"
            :read_at="notif.read_at"
            @click.native="loadDetail(notif.id, index)"
          />
        </div>
        <div class="col-lg mt-2 d-flex justify-content-center">
          <div v-if="notifDetail.data">
            <div
              class="card"
              v-for="(detail, index) in notifDetail.data"
              :key="detail.id"
              style="width: 25rem"
            >
              <img
                :src="detail.gambar"
                :alt="detail.nama"
                class="card-img-top"
              />
              <div class="card-body">
                <h5 class="card-title">{{ detail.nama }}</h5>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">Jumlah: {{ detail.jumlah }}</li>
                <li class="list-group-item">Harga: {{ detail.harga }}</li>
                <li class="list-group-item">
                  Subtotal: Rp. {{ formatNumber(detail.subtotal) }}
                </li>
              </ul>
              <div class="card-footer">Item ke {{ index + 1 }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from "../Homepage/Navbar";
import NotifList from "./NotifList";
export default {
  name: "NotifPage",
  components: {
    Navbar: Navbar,
    NotifList: NotifList,
  },
  data() {
    return {
      listNotif: [],
      notifDetail: [],
      gambarDetail: [],
      total: "",
    };
  },
  mounted() {
    this.loadNotif();
  },
  methods: {
    loadNotif() {
      axios
        .get("/api/notifHeader")
        .then((result) => {
          this.listNotif = result.data;
          this.listNotif = this.listNotif.notifs;
        })
        .catch((err) => {});
    },
    formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    },
    loadDetail(id, index) {
      axios
        .get("/api/notifDetail/" + id)
        .then((result) => {
          this.notifDetail = result.data;
          this.total = this.listNotif[index].data.total.toString();
          this.readDetail(id);
        })
        .catch((err) => {});
    },
    readDetail(id) {
      axios
        .get("/api/readDetail/" + id)
        .then((result) => {
          this.loadNotif();
        })
        .catch((err) => {});
    },
  },
};
</script>

<style>
</style>