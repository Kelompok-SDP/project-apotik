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
          <div class="col-12" v-if="notifDetail.data">
            <div
              class="row"
              v-for="detail in notifDetail.data"
              :key="detail.id"
            >
              <div class="row">
                <img :src="detail.gambar" :alt="detail.nama" width="100rem;" />
              </div>
              <div class="row">
                <div class="col-3">
                  {{ detail.nama }}
                </div>
                <div class="col-3">{{ detail.jumlah }}x</div>
                <div class="col-3">Rp. {{ formatNumber(detail.subtotal) }}</div>
              </div>
            </div>

            <div class="col-9">
              <strong>Ringkasan Pembayaran</strong>

              <div class="row">
                <div class="col-6">GrandTotal</div>
                <div class="col-3 text-right">Rp {{ formatNumber(total) }}</div>
              </div>
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