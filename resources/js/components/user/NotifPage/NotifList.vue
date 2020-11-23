<template>
  <div class="list">
    <div class="dropdown-divider"></div>
    <router-link to="/notifpage" class="dropdown-item" :class="isUnread">
      <strong>Transaksi {{ tanggal }} </strong> <br />
      <span class="font-weight-light">Total Transaksi Rp {{ total }} </span>
    </router-link>
  </div>
</template>

<script>
export default {
  name: "NotifList",
  props: {
    tanggal: String,
    total: String,
    read_at: String,
  },
  computed: {
    isUnread: function () {
      return {
        unread: this.read_at == null,
      };
    },
  },
};
</script>

<style scoped>
.unread {
  background: gray;
  color: white;
}
.list {
  background: white;
}
</style>