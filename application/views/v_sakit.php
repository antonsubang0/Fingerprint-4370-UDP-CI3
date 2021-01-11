        <div class="col-md-9 col-10 pt-2 px-2 bg-light" id="app">
            <div class="card shadow-sm py-3">
                <div class="card-body overflow-auto pt-1 pb-0" style="height: 69vh;">
                    <div class="row mb-3 position-relative">
                        <div class="col-md-10 col-8">
                            <h4 class="mb-0">Permission and Sick</h4>
                            <small>Permission and Sick of Employers</small>
                        </div>
                        <div class="col-md-2 col-4 text-right">
                            <button type="button" class="btn btn-primary" v-on:click='vuebtnprint'>
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                              </svg>
                            </button>
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
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Reason</th>
                                        <th class="text-center">Sick</th>
                                        <th class="text-center">Permission</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for='(item, key) in info'>
                                        <td>{{ key+1 }}</td>
                                        <td>{{ item.tanggal }}</td>
                                        <td>{{ item.nama }}</td>
                                        <td>{{ item.bnama }}</td>
                                        <td>{{ item.reason }}</td>
                                        <td class="text-center">
                                          <div v-if="item.type==1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle text-primary" viewBox="0 0 16 16">
                                              <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                              <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                            </svg>
                                          </div>
                                          <div v-else>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle text-secondary" viewBox="0 0 16 16">
                                              <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                              <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                            </svg>
                                          </div>
                                        </td>
                                        <td class="text-center">
                                          <div v-if="item.type==2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle text-primary" viewBox="0 0 16 16">
                                              <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                              <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                            </svg>
                                          </div>
                                          <div v-else>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle text-secondary" viewBox="0 0 16 16">
                                              <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                              <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                            </svg>
                                          </div>
                                        </td>
                                        <td class="text-center">
                                          <div v-if="item.status" v-on:click="deletesakit(item.no)">
                                            <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-trash text-danger delcuticss' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg>
                                          </div>
                                          <div v-else>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                            <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                            <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299l.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                            <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884l-12-12 .708-.708 12 12-.708.708z"/>
                                          </svg>
                                          </div>
                                        </td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Permission</h5>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                        <label for="nama">Bagian</label>
                        <select class="form-control" id="nama" v-model='bagianselect' v-on:change='bybagian'>
                          <option v-for='bagian in bagianinfo' v-bind:value="bagian.id">{{ bagian.bnama }}</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="nama">Name</label>
                        <select class="form-control" id="nama" v-model='userselect'>
                          <option v-for='user in userinfo' v-bind:value="user.uid">{{ user.bnama }} - {{ user.nama }}</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="keperluan1">Reason</label>
                        <input type="text" class="form-control" id="keperluan1" v-model='datakeperluan'>
                      </div>
                      <div class="form-group">
                        <label for="tipee">Type</label>
                        <select class="form-control" id="tipee" v-model='typeselect'>
                          <option v-bind:value="1">Sick</option>
                          <option v-bind:value="2">Permission</option>
                        </select>
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
            <div class="row mx-1 mt-3 border-danger bg-white pt-3 pb-3 border-top shadow rounded-lg-top">
                <div class="col text-center">
                    <h6 class="mb-0">Powered by Antonius</h6>
                    <small>@ 2016-2022</small>
                </div>
            </div>
        </div>
    </div>
