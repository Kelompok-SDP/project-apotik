<template>
  <div class="wrapper-sub-kategori">
    <br />
    <h1 class="m-0 text-dark">Admin Obat Racikan</h1>
    <br />
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">List Semua Obat Racikan</h3>
      </div>

      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th>Nama</th>
              <th>Total Harga</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(obatracikan, index) in obatracikans" :key="obatracikan.id">
                <td>{{ index + 1 }}</td>
                <td>{{ obatracikan.nama }}</td>
                <td>{{ obatracikan.total }}</td>
                <td>
                    <div
                    class="btn btn-sm btn-danger"
                    @click="detail(obatracikan)"
                    data-toggle="modal"
                    data-target="#myModal"
                    >
                    Detail
                    </div>
                </td>
                <td>
                    <div
                    class="btn btn-sm btn-primary"
                    @click="edit(obatracikan)"
                    data-toggle="modal"
                    data-target="#myModal"
                    >
                    Edit
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

        <h2 v-if="obatracikans.length == 0" class="text-center mt-2">
          Belum ada data obat racikan
        </h2>
      </div>
    </div>

    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Insert Obat Racikan Baru</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form enctype="multipart/form-data" @submit.prevent="addData()">
        <div class="card-body">
          <div class="form-group">
            <label for="">Kode</label>
            <input
              type="text"
              class="form-control"
              id=""
              placeholder="Kode"
              v-model="form.kode"
              disabled
            />
          </div>
          <div class="form-group">
            <label for="">Nama Obat Racikan</label>
            <input
              type="text"
              class="form-control"
              id=""
              placeholder="Co: Antibiotik"
              v-model="form.nobatr"
              @keyup="autogenKode()"
            />
            <span
              class="invalid-feedback d-block"
              v-if="errors.hasOwnProperty('nama_obat_racikan')"
            >
              {{ errors.nama_obat_racikan[0] }}
            </span>
          </div>
          <div class="form-group">
            <label for="">Nama Dokter</label>
            <input
              type="text"
              class="form-control"
              id=""
              placeholder="Co: anti-biotik"
              v-model="form.ndokter"
            />
            <span
              class="invalid-feedback d-block"
              v-if="errors.hasOwnProperty('nama_dokter')"
            >
              {{ errors.nama_dokter[0] }}
            </span>
          </div>
          <div class="form-group">
            <label for="">Keterangan</label>
            <input
              type="text"
              class="form-control"
              id=""
              placeholder="Co: anti-biotik"
              v-model="form.keterangan"
            />
            <span
            class="invalid-feedback d-block"
            v-if="errors.hasOwnProperty('keterangan')"
            >
              {{ errors.keterangan[0] }}
            </span>
          </div>
          <div class="form-group">
            <label for="">Banyaknya Obat</label>
            <input
              type="number"
              class="form-control"
              id=""
              placeholder="Co: 2"
              v-model="manyObats"
              @change="makeCombobox()"
            />
          </div>
            <div class="form-group" v-for="i in parseInt(manyObats)" :key="i">
                <label for="">Nama Obat</label>
                <select name="" class="form-control" id="" v-model="choose" >
                <option v-for="obat in obats" :key="obat.id" :value="obat.id">
                    {{ obat.nama }}
                </option>
                </select>
                <label for="">Jumlah Obat</label>
                <input
                    type="number"
                    id=""
                    class="form-control"
                    placeholder="Co: 2"
                    v-model="jumlah"
                />
                <hr>
            </div>
          <br />
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Tambahkan</button>
        </div>
      </form>
    </div>
    <!-- =======  MODAL -->
    <div
      class="modal fade show"
      id="modal-detail"
      style="display: hidden; padding-right: 16px"
      aria-modal="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Detail Obat Racikan</h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
              <h4>Komposisi Racikan</h4>
              <div class="card-body" v-for="det in detObatRacikans" :key="det.id" >
                <div class="form-group" v-for="deto in detObats" :key="deto.id">
                  <p v-if="det.id_obat == deto[0].id">
                    <span> Nama Obat: {{ deto[0].nama }}</span>
                  </p>
                </div>
                <div class="form-group">
                  <span for="">Jumlah: {{ det.jumlah }}</span>
                </div>
                <div class="form-group">
                  <span for="">Harga: {{ det.harga }}</span>
                </div>
                <div class="form-group">
                  <span style="font-weight: bold;">Subtotal: {{ det.subtotal }}</span>
                </div>
              </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
</template>
<script src="./jquery.min.js" ></script>

<script>
export default {
    name: "ObatRacikan",
    data() {
        return {
        obatracikans: [],
        pagination: [],
        perPage: 5,
        url: "/api/admin/obatracikan",
        detObatRacikans: [],
        detObats: [],
        manyObats: 1,
        obats: [],
        choose: "",
        idObats: [],
        jmlObats: [],
        jumlah: 1,
        form: {
            kode: "",
            nobatr: "",
            ndokter: "",
            keterangan: "",
        },
        editForm: {
            kode: "",
            nobatr: "",
            ndokter: "",
            keterangan: "",
        },
        errors: {},
        isLoading: false,
        isSuccess: false,
        };
    },
    mounted() {
        this.loadData();
        this.getObats();
    },
    methods: {
        loadData() {
            axios.get(this.url).then((response) => {
                this.obatracikans = response.data.data;
                this.pagination = response.data;
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
            this.url = "/api/admin/obatracikan/changePaginate/" + this.perPage;
            this.loadData();
        },
        detail(obatracikan){
            this.url = "/api/admin/obatracikan/showDetail/" + obatracikan.id;
            $("#modal-detail").modal("show");
            axios.get(this.url).then((response) => {
                this.detObatRacikans = response.data.tdObatR;
                this.detObats = response.data.obat;
            });
        },
        addData() {
            this.errors = {};
            this.isLoading = true;
            this.isSuccess = false;

            let formData = new FormData();
            formData.append("id", this.form.kode);
            formData.append("nama_obat_racikan", this.form.nobatr);
            formData.append("nama_dokter", this.form.ndokter);
            formData.append("keterangan", this.form.keterangan);

            //bikin array idTags isi nya id semua tag yang dipilih
            for (let index = 0; index < this.manyObats; index++) {
                this.idObats.push(this.choose);
                this.jmlObats.push(parseInt(this.jumlah));
            }
            formData.append("id_obat", this.idObats);
            formData.append("jml_obat", this.jmlObats);
            axios
                .post("/api/admin/obatracikan/create", formData)
                .then((response) => {
                    this.isSuccess = true;
                    console.log(this.jmlObats);
                    console.log(this.idObats);
                })
                .catch(({ response }) => {
                    this.errors = response.data.errors;
                    console.log(idObats);

                })
                .finally(() => (this.isLoading = false));
        },
        autogenKode() {
        axios
            .post("/api/admin/obatracikan/generate", {
            nobatr: this.form.nobatr,
            })
            .then((result) => {
                this.form.kode = result.data;
                console.log(this.form.kode);
            })
            .catch((err) => {});
        },
        getObats() {
            axios
                .get("/api/admin/obatracikan/showObat")
                .then((result) => {
                    this.obats = result.data;
                })
                .catch((err) => {});
        },
        makeCombobox() {
            this.getObats();
        },
    },
};
</script>


<style scoped>
.wrapper-sub-kategori {
  margin-left: 3rem;
}
</style>
