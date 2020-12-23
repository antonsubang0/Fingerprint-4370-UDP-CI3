<script src="<?= base_url(); ?>berkas/js/jquery-3.5.1.min.js"></script>
<script src="<?= base_url(); ?>berkas/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>berkas/js/vue.js"></script>
<script src="<?= base_url(); ?>berkas/js/axios.js"></script>
<script type="text/javascript">
	var loading = document.getElementsByClassName("loading-cs");
	loading[0].style.display = 'none';
	var app = new Vue({
	  	el: '#app',
	  	data () {
    	return {
      		info: null,
      		detail : false,
      		modaladdx : false,
      		search : '',
      		userinfo : null,
      		userselect : null,
      		datakeperluan : null,
      		datatglcuti : null,
      		jumlahdata : null,
      		jumlahpage : null,
      		perpage : 8,
      		page : [],
      		statepage :1,
      		datafull : null,
    		}
  		},
	  mounted () {
	  	this.reload();
	  },
	  methods : {
	  	reload : function () {
	  		axios.get('<?= base_url(); ?>cuti/ajaxalldata')
	      .then(response => {
	      	this.page = [];
	      	this.statepage = 1;
	      	this.datafull = response.data;  
	        this.jumlahdata = response.data.length;
	        this.jumlahpage = Math.ceil(this.jumlahdata / this.perpage);
	        for (var i = 1; i <= this.jumlahpage ; i++) {
	        	this.page.push(i);
	        }
	        this.info = this.datafull.slice((this.statepage - 1) * this.perpage, (this.statepage - 1) * this.perpage + this.perpage);
	      })
	      .catch(error => {
	        console.log(error);
	      })
	      .finally(() => this.loading = false);
	  	},
	  	paginate : function (e) {
	  		this.statepage = e;
	  		this.info = this.datafull.slice((this.statepage - 1) * this.perpage, (this.statepage - 1) * this.perpage + this.perpage);
	  	},
	  	deletex : function (e) {
	  		axios.get('<?= base_url(); ?>cuti/ajaxdeletecuti/' + e)
	      .then(response => {
	      	this.reload();
	      })
	      .catch(error => {
	        console.log(error);
	      })
	      .finally(() => this.loading = false)
	  	},
	  	adduseruid : function () {
	  		this.modaladdx= false;
	  		let formData = {
	  			no : null,
	  			uid : this.userselect,
	  			tgl_cuti : this.datatglcuti,
	  			keperluan : this.datakeperluan,
	  			cuti : 1
	  		};
	  		axios({
			  	method: 'post',
			  	url: '<?= base_url(); ?>cuti/ajaxtambahcuti',
			  	data: formData
			}).then(response => {
				if (response.data='success') {
					this.reload();
				}
			}).catch(error => {
			    console.log(error);
			}).finally(() => this.loading = false)
	  	},
	  	btnmodaladd : function () {
	  		if (this.modaladdx == false) {
	  			this.modaladdx= true;
	  			axios.get('<?= base_url(); ?>cuti/ajaxalluser')
				      .then(response => {
				        this.userinfo = response.data;
				      })
				      .catch(error => {
				        console.log(error);
				      })
				      .finally(() => this.loading = false);
	  		} else {
	  			this.modaladdx= false;
	  			this.userselect = null;
      			this.datakeperluan = null;
      			this.datatglcuti = null;
	  		}
	  	},
	  	clsmodaldetail : function (argument) {
	  		this.detail=false;
	  	},
	  	informasi : function (uid) {
	  		axios.get('<?= base_url(); ?>cuti/ajaxinfodetail/' + uid)
	      .then(response => {
	        this.detail = response.data[0];
	      })
	      .catch(error => {
	        console.log(error);
	      })
	      .finally(() => this.loading = false)
	  	},
	  	vuesearch : function () {
	  		axios.get('<?= base_url(); ?>cuti/ajaxsearchcuti/' + this.search)
	      .then(response => {
	      	if (response.data) {
	      		this.page = [];
	      		this.statepage = 1;
		      	this.datafull = response.data;  
		        this.jumlahdata = response.data.length;
		        this.jumlahpage = Math.ceil(this.jumlahdata / this.perpage);
		        for (var i = 1; i <= this.jumlahpage ; i++) {
		        	this.page.push(i);
		        }
		        this.info = this.datafull.slice((this.statepage - 1) * this.perpage, (this.statepage - 1) * this.perpage + this.perpage);
	      	} else {
	      		this.statepage = 1;
		        this.info = [{
		        	tgl_cuti : 'not found',
		        	nama : 'not found',
		        	bnama : 'not found',
		        	keperluan : 'not found',
		        	cuti : 'not found',
		        	no : 'not found'
		        }];
	      	}
	      })
	      .catch(error => {
	        console.log(error);
	      })
	      .finally(() => this.loading = false)
	  	}
	  } 
	})
</script>