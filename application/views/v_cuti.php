        <div class="col-md-9 col-10 pt-2 px-2 bg-light" id="app">
            <div class="card shadow-sm py-3">
                <div class="card-body overflow-auto pt-1 pb-0" style="height: 69vh;">
                    <div class="row mb-3 position-relative">
                        <div class="col-md-10 col-8">
                            <h4 class="mb-0">Paid Leave</h4>
                            <small>Paid Leave Employers</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <button type="button" class="btn btn-primary" v-on:click='btnmodaladd'>
                              Add
                            </button>
                        </div>  
                        <div class="col mb-2">
                            <form class="form-inline">
                              <input class="form-control ml-auto mr-0" placeholder="Search" v-model='search' v-on:keyup='vuesearch'>
                            </form>
                        </div>
                    </div>
                    <div class="row bg-light rounded-lg py-3 mx-1">
                        <div class="col overflow-auto" style="height: 50vh;">
                            <table class="table table-sm table-striped table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Needed</th>
                                        <th>Paid Leave</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for='(item, key) in info'>
                                        <td>{{ key+1 }}</td>
                                        <td>{{ item.tgl_cuti }}</td>
                                        <td v-on:click="informasi(item.uid)" class="cutipointer">{{ item.nama }}</td>
                                        <td>{{ item.bnama }}</td>
                                        <td>{{ item.keperluan }}</td>
                                        <td>{{ item.cuti }}</td>
                                        <td v-on:click="deletex(item.no)"><svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-trash text-danger delcuticss' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                              <div class="col overflow-x">
                                <ul class="pagination">
                                  <li class="page-item" v-bind:class="{ active: statepage==pag }" v-for='pag in page'><a class="page-link vuepagination-cs" v-on:click='paginate(pag)'>{{ pag }}</a></li>
                                </ul>
                              </div>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade show" style="display: block; padding-right: 15px; background-color: rgba(0,0,0,0.3);" v-if="modaladdx">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Paid Leave</h5>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                        <label for="nama">Name</label>
                        <select class="form-control" id="nama" v-model='userselect'>
                          <option v-for='user in userinfo' v-bind:value="user.uid">{{ user.bnama }} - {{ user.nama }}</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="keperluan1">Needed</label>
                        <input type="text" class="form-control" id="keperluan1" v-model='datakeperluan'>
                      </div>
                      <div class="form-group">
                        <label for="cuti1">Date</label>
                        <input type="date" class="form-control" id="cuti1" v-model='datatglcuti'>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" v-on:click='btnmodaladd'>Close</button>
                    <button type="button" class="btn btn-primary" v-on:click="adduseruid">Add</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal -->
            <div class="modal fade show" style="display: block; padding-right: 15px; background-color: rgba(0,0,0,0.3);" v-if="detail">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Paid Leave Detail</h5>
                  </div>
                  <div class="modal-body">
                    <p>Name : {{ detail.nama }}</p><p>Position : {{ detail.bnama }}</p><p>Used : {{ 12 - detail.sisa_cuti}}</p><p>Not Used : {{ detail.sisa_cuti }}</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" v-on:click='clsmodaldetail'>Close</button>
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
