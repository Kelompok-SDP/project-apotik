<template>
  <div class="wrapper-sub-kategori">
    <br />
    <h1 class="m-0 text-dark">Admin Obat</h1>
    <br />

    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Insert Obat Baru</h3>
      </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2">
      <div class="col mb-4">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Form Obat Part 1</h5>
          </div>

          <form @submit.prevent="addData()">
            <div class="card-body">
              <div class="form-group">
                <label for="">Kode Obat</label>
                <input
                  type="text"
                  class="form-control"
                  id=""
                  placeholder="Kode"
                  disabled
                />
              </div>
              <div class="form-group">
                <label for="">Nama Obat</label>
                <input
                  type="text"
                  class="form-control"
                  id=""
                  placeholder="Contoh: Saridon"
                />
              </div>
              <div class="form-group">
                <label for="">Gambar Obat</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input
                      type="file"
                      class="custom-file-input"
                      id=""
                      ref="file"
                      @change="processFile($event, 'add')"
                    />
                    <span class="custom-file-label"> Pilih Gambar </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="">Tipe Obat</label>
                <select name="" id="" class="form-control">
                  <option value="">test 1</option>
                  <option value="">test 2</option>
                  <option value="">test 2</option>
                </select>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col mb-4">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Form Obat Part 2</h5>
          </div>
          <form @submit.prevent="addData()">
            <div class="card-body">
              <div class="form-group">
                <label for="">Kode Obat</label>
                <input
                  type="text"
                  class="form-control"
                  id=""
                  placeholder="Kode"
                  disabled
                />
              </div>
              <div class="form-group">
                <label for="">Nama Obat</label>
                <input
                  type="text"
                  class="form-control"
                  id=""
                  placeholder="Contoh: Saridon"
                />
              </div>
              <div class="form-group">
                <label for="">Gambar Obat</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input
                      type="file"
                      class="custom-file-input"
                      id=""
                      ref="file"
                      @change="processFile($event, 'add')"
                    />
                    <span class="custom-file-label"> Pilih Gambar </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="">Tipe Obat</label>
                <select name="" id="" class="form-control">
                  <option value="">test 1</option>
                  <option value="">test 2</option>
                  <option value="">test 2</option>
                </select>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2">
      <div class="col mb-4">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Form Obat Part 3</h5>
          </div>
          <form @submit.prevent="addData()">
            <div class="card-body">
              <div class="form-group">
                <label for="">Kode Obat</label>
                <input
                  type="text"
                  class="form-control"
                  id=""
                  placeholder="Kode"
                  disabled
                />
              </div>
              <div class="form-group">
                <label for="">Nama Obat</label>
                <input
                  type="text"
                  class="form-control"
                  id=""
                  placeholder="Contoh: Saridon"
                />
              </div>
              <div class="form-group">
                <label for="">Gambar Obat</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input
                      type="file"
                      class="custom-file-input"
                      id=""
                      ref="file"
                      @change="processFile($event, 'add')"
                    />
                    <span class="custom-file-label"> Pilih Gambar </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="">Tipe Obat</label>
                <select name="" id="" class="form-control">
                  <option value="">test 1</option>
                  <option value="">test 2</option>
                  <option value="">test 2</option>
                </select>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col mb-4">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Form Obat Part 4 (Terakhir)</h5>
          </div>
          <form @submit.prevent="addData()">
            <div class="card-body">
              <div class="form-group">
                <label for="">Kode Obat</label>
                <input
                  type="text"
                  class="form-control"
                  id=""
                  placeholder="Kode"
                  disabled
                />
              </div>
              <div class="form-group">
                <label for="">Nama Obat</label>
                <input
                  type="text"
                  class="form-control"
                  id=""
                  placeholder="Contoh: Saridon"
                />
              </div>
              <div class="form-group">
                <label for="">Gambar Obat</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input
                      type="file"
                      class="custom-file-input"
                      id=""
                      ref="file"
                      @change="processFile($event, 'add')"
                    />
                    <span class="custom-file-label"> Pilih Gambar </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="">Tipe Obat</label>
                <select name="" id="" class="form-control">
                  <option value="">test 1</option>
                  <option value="">test 2</option>
                  <option value="">test 2</option>
                </select>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Tambahkan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
.wrapper-sub-kategori {
  margin-left: 3rem;
}
</style>