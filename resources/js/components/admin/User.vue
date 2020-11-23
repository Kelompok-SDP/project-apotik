<template>
  <div class="wrapper-sub-kategori">
    <br />
    <h1 class="m-0 text-dark">Admin User</h1>
    <br />
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">List Semua User</h3>
      </div>

      <div class="card-body">
        <div class="row">
          <div class="form-group col-sm">
            <label for="">Banyak Data pada Tabel</label>
            <input
              type="number"
              class="form-control"
              id=""
              placeholder="Co: 2"
              v-model="perPage"
              @change="changePage"
            />
          </div>
          <div class="form-group col-sm">
            <label for="">Search Nama User</label>
            <div class="input-group">
              <input
                type="text"
                class="form-control"
                id=""
                placeholder="Co: John"
                v-model="keywords"
              />
              <button class="btn btn-primary" @click="search">Cari</button>
            </div>
          </div>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th>Nama</th>
              <th>Nomor HP</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(user, index) in users" :key="user.id">
                <td>{{ index + 1 }}</td>
                <td>{{ user.nama }}</td>
                <td>{{ user.noHp }}</td>
                <td>{{ user.email }}</td>
                <td v-if="user.status == 1">
                    <div
                    class="btn btn-sm btn-danger"
                    @click="banned(user)"
                    data-toggle="modal"
                    data-target="#myModal"
                    >
                    Banned
                    </div>
                </td>
                <td v-else-if="user.status == 2">
                    <div
                    class="btn btn-sm btn-primary"
                    @click="unBanned(user)"
                    data-toggle="modal"
                    data-target="#myModal"
                    >
                    UnBanned
                    </div>
                </td>
            </tr>
          </tbody>
        </table>

        <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-right">
            <li class="page-item">
              <button
                class="page-link"
                :disabled="!pagination.prev_page_url"
                @click="fetchPaginate(pagination.prev_page_url)"
              >
                Previous
              </button>
            </li>
            <li class="page-item">
              <button
                class="page-link"
                href="#"
                :disabled="!pagination.next_page_url"
                @click="fetchPaginate(pagination.next_page_url)"
              >
                Next
              </button>
            </li>
          </ul>
          <span
            >Page {{ pagination.current_page }} of {{ pagination.last_page }}
          </span>
        </div>

        <h2 v-if="users.length == 0" class="text-center mt-2">
          Belum ada data user
        </h2>
      </div>
    </div>
  </div>
</template>
<script src="./jquery.min.js" ></script>

<script>
export default {
    name: "User",
    data() {
        return {
        users: [],
        pagination: [],
        perPage: 5,
        url: "/api/admin/user",
        keywords: "",
        form: {
            kode: "",
            nama: "",
            noHp: "",
            email: "",
        },
        editForm: {
            kode: "",
            nama: "",
            noHp: "",
            email: "",
        },
        errors: {},
        isLoading: false,
        isSuccess: false,
        };
    },
    mounted() {
        this.loadData();
    },
    methods: {
        loadData() {
            axios.get(this.url).then((response) => {
                this.users = response.data.data;
                this.pagination = response.data;
                this.form.kode = "";
                this.form.nama = "";
                this.form.noHp = "";
                this.form.email = "";
                console.log("Jumlah: "+this.users.length);
            });
        },
        fetchPaginate(url) {
            this.url = url;
            this.loadData();
        },
        makePagination(data) {
            let pagination = {
                current_page: data.current_page,
                last_page: data.last_page,
                next_page_url: data.next_page_url,
                prev_page_url: data.prev_page_url,
            };
            this.pagination = pagination;
        },
        changePage() {
            this.url = "/api/admin/user/changePaginate/" + this.perPage;
            this.loadData();
        },
        banned(user) {
            axios
                .post("/api/admin/user/ban", {
                id: user.id,
                })
                .then((response) => {
                this.loadData();
                })
                .catch((response) => {
                if (response.status === 422) {
                    console.log("error hapus");
                }
            });
        },
        unBanned(user) {
            axios
                .post("/api/admin/user/unban", {
                id: user.id,
                })
                .then((response) => {
                this.loadData();
                })
                .catch((response) => {
                if (response.status === 422) {
                    console.log("error hapus");
                }
            });
        },
        search() {
            if (this.keywords.length > 0) {
                console.log("masuk");
                this.url =
                "/api/admin/user/search/" + this.keywords + "/" + this.perPage;
            } else {
                this.url = "/api/admin/user";
            }
            this.loadData();
        },
    },
};
</script>


<style scoped>
.wrapper-sub-kategori {
  margin-left: 3rem;
}
</style>
