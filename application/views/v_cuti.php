        <div class="col-md-9 col-10 pt-2 px-2 bg-light">
            <div class="card shadow-sm py-3">
                <div class="card-body overflow-auto pt-1 pb-0" style="height: 69vh;">
                    <div class="row mb-3 position-relative">
                        <div class="col-md-10 col-8">
                            <h4 class="mb-0">Home</h4>
                            <small>Welcome to Attandance CPI Subang</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                                                        <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                              Add
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    ...
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>  
                    </div>
                    <div class="row" id="app">
                        <div class="col d-flex justify-content-center">
                            <table class="table table-sm table-striped table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama</th>
                                        <th>Bagian</th>
                                        <th>Keperluan</th>
                                        <th>Sisa Cuti</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for='item in list'>
                                        <td>{{ item.no }}</td>
                                        <td>{{ item.tanggal }}</td>
                                        <td>{{ item.nama }}</td>
                                        <td>{{ item.bagian }}</td>
                                        <td>{{ item.keperluan }}</td>
                                        <td>{{ item.sisa }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-1 mt-3 border-danger bg-white pt-3 pb-3 border-top shadow rounded-lg-top">
                <div class="col text-center">
                    <h6 class="mb-0">Powered by Antonius</h6>
                    <small>@ 2016-2022</small>
                </div>
            </div>
        </div>
    </div>